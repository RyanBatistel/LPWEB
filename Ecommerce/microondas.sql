-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Tempo de geração: 27/11/2023 às 22:21
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `microondas`
--

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_delete_cliente` (IN `p_id_cliente` INT)   BEGIN
    -- Excluir registros relacionados na tabela email
    DELETE FROM email WHERE id_cliente = p_id_cliente;

    -- Excluir registros relacionados na tabela fone
    DELETE FROM fone WHERE id_cliente = p_id_cliente;

    -- Excluir registros relacionados na tabela endereco
    DELETE FROM endereco WHERE id_cliente = p_id_cliente;

    -- Excluir o cliente
    DELETE FROM cliente WHERE id_cliente = p_id_cliente;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_delete_produto` (`p_id_produto` INT)   BEGIN
    DECLARE id_modelo, id_marca, id_linha, id_cor INT;

    -- Obter IDs relacionados ao produto
    SELECT id_modelo, id_cor
    INTO id_modelo, id_cor
    FROM produto
    WHERE id_produto = p_id_produto;

    -- Deletar da tabela Estoque
    DELETE FROM estoque WHERE id_produto = p_id_produto;

    -- Deletar da tabela Produto
    DELETE FROM produto WHERE id_produto = p_id_produto;

    -- Obter IDs relacionados ao modelo
    SELECT id_marca, id_linha
    INTO id_marca, id_linha
    FROM modelo
    WHERE id_modelo = id_modelo;

    -- Exibir informações para debug
    SELECT id_modelo, id_cor, id_marca, id_linha;

    -- Deletar da tabela Modelo (e Marca e Linha, se não estiverem sendo usadas por outros modelos)
    DELETE FROM modelo WHERE id_modelo = id_modelo AND NOT EXISTS (
        SELECT 1 FROM produto WHERE id_modelo = modelo.id_modelo AND id_produto != p_id_produto
    );

    -- Exibir informações para debug
    SELECT ROW_COUNT() AS deleted_rows_modelo;

    -- Deletar da tabela Marca (se não estiver sendo usada por outros modelos)
    DELETE FROM marca WHERE id_marca = id_marca AND NOT EXISTS (
        SELECT 1 FROM modelo WHERE id_marca = marca.id_marca AND id_modelo != id_modelo
    );

    -- Exibir informações para debug
    SELECT ROW_COUNT() AS deleted_rows_marca;

    -- Deletar da tabela Linha (se não estiver sendo usada por outros modelos)
    DELETE FROM linha WHERE id_linha = id_linha AND NOT EXISTS (
        SELECT 1 FROM modelo WHERE id_linha = linha.id_linha AND id_modelo != id_modelo
    );

    -- Exibir informações para debug
    SELECT ROW_COUNT() AS deleted_rows_linha;

    -- Deletar da tabela Cor (se não estiver sendo usada por outros produtos)
    DELETE FROM cor WHERE id_cor = id_cor AND NOT EXISTS (
        SELECT 1 FROM produto WHERE id_cor = cor.id_cor AND id_produto != p_id_produto
    );

    -- Exibir informações para debug
    SELECT ROW_COUNT() AS deleted_rows_cor;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insert_cliente` (IN `p_nome_cliente` VARCHAR(50), IN `p_data_nascimento` DATE, IN `p_data_cadastro` DATE, IN `p_cpf_cnpj` VARCHAR(20), IN `p_genero` VARCHAR(10), IN `p_email_cliente` VARCHAR(255), IN `p_numero_cliente` VARCHAR(20), IN `p_cep` VARCHAR(10), IN `p_logradouro` VARCHAR(255), IN `p_cidade` VARCHAR(255), IN `p_bairro` VARCHAR(255), IN `p_estado` VARCHAR(255), OUT `p_resultado` VARCHAR(50))   BEGIN
    DECLARE cliente_existente INT;
    DECLARE id_cliente INT;

    -- Verifica se um cliente com o mesmo CPF/CNPJ já existe na tabela
    SELECT COUNT(*) INTO cliente_existente
    FROM cliente
    WHERE cpf_cnpj = p_cpf_cnpj;

    IF cliente_existente = 0 THEN
        -- O cliente não existe, então podemos inseri-lo
        INSERT INTO cliente (nome_cliente, data_nascimento, data_cadastro, cpf_cnpj, genero)
        VALUES (p_nome_cliente, p_data_nascimento, p_data_cadastro, p_cpf_cnpj, p_genero);

        -- Obter o id_cliente recém-inserido
        SELECT LAST_INSERT_ID() INTO id_cliente;

        -- Inserir na tabela email usando o id_cliente
        INSERT INTO email (id_cliente, email_cliente) 
        VALUES (id_cliente, p_email_cliente);

        -- Inserir na tabela fone usando o id_cliente
        INSERT INTO fone (id_cliente, numero_cliente) 
        VALUES (id_cliente, p_numero_cliente);

        -- Inserir na tabela endereco usando o id_cliente
        INSERT INTO endereco (id_cliente, dt_logradouro, numero, cep, bairro, cidade, estado) 
        VALUES (id_cliente, p_logradouro, p_numero_cliente, p_cep, p_bairro, p_cidade, p_estado);

        SET p_resultado = 'Cliente adicionado com sucesso.';
    ELSE
        SET p_resultado = 'Cliente já existente.';
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insert_produto` (IN `p_desc_produto` VARCHAR(255), IN `p_desc_marca` VARCHAR(255), IN `p_desc_linha` VARCHAR(255), IN `p_desc_modelo` VARCHAR(255), IN `p_capacidade_modelo` INT, IN `p_vlr_sugerido` DECIMAL(10,2), IN `p_vlr_custo` DECIMAL(10,2), IN `p_voltagem` VARCHAR(50), IN `p_desc_cor` VARCHAR(255), IN `p_qt_estoque` INT, IN `p_caminho_imagem` VARCHAR(255))   BEGIN
    DECLARE id_marca, id_linha, id_cor, id_modelo, id_produto INT;

    -- Inserir na tabela Marca
    INSERT INTO marca (desc_marca) VALUES (p_desc_marca);
    SET id_marca = LAST_INSERT_ID();

    -- Inserir na tabela Linha
    INSERT INTO linha (desc_linha) VALUES (p_desc_linha);
    SET id_linha = LAST_INSERT_ID();

    -- Inserir na tabela Cor
    INSERT INTO cor (desc_cor) VALUES (p_desc_cor);
    SET id_cor = LAST_INSERT_ID();

    -- Inserir na tabela Modelo
    INSERT INTO modelo (id_marca, id_linha, desc_modelo) VALUES (id_marca, id_linha, p_desc_modelo);
    SET id_modelo = LAST_INSERT_ID();

    -- Inserir na tabela Produto
    INSERT INTO produto (id_modelo, id_cor, desc_produto, capacidade_modelo, vlr_sugerido, vlr_custo, voltagem) 
    VALUES (id_modelo, id_cor, p_desc_produto, p_capacidade_modelo, p_vlr_sugerido, p_vlr_custo, p_voltagem);
    SET id_produto = LAST_INSERT_ID();

    -- Inserir na tabela Estoque
    INSERT INTO estoque (id_produto, id_filial, qt_estoque) VALUES (id_produto, 1, p_qt_estoque);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_update_cliente` (IN `p_id_cliente` INT, IN `p_nome_cliente` VARCHAR(255), IN `p_data_nascimento` DATE, IN `p_data_cadastro` DATE, IN `p_cpf_cnpj` VARCHAR(20), IN `p_genero` VARCHAR(10), IN `p_email_cliente` VARCHAR(255), IN `p_numero_cliente` VARCHAR(20), IN `p_cep` VARCHAR(10), IN `p_dt_logradouro` VARCHAR(255), IN `p_cidade` VARCHAR(255), IN `p_bairro` VARCHAR(255), IN `p_estado` VARCHAR(255), IN `p_numero` VARCHAR(20), OUT `p_resultado` VARCHAR(255))   BEGIN
    DECLARE cliente_existente INT;

    -- Verificar se o cliente existe
    SELECT COUNT(*) INTO cliente_existente
    FROM cliente
    WHERE id_cliente = p_id_cliente;

    IF cliente_existente > 0 THEN
        -- Atualizar dados do cliente
        UPDATE cliente
        SET 
            nome_cliente = p_nome_cliente,
            data_nascimento = p_data_nascimento,
            data_cadastro = p_data_cadastro,
            cpf_cnpj = p_cpf_cnpj,
            genero = p_genero
        WHERE id_cliente = p_id_cliente;

        -- Atualizar email
        UPDATE email
        SET email_cliente = p_email_cliente
        WHERE id_cliente = p_id_cliente;

        -- Atualizar telefone
        UPDATE fone
        SET numero_cliente = p_numero_cliente
        WHERE id_cliente = p_id_cliente;

        -- Atualizar endereço
        UPDATE endereco
        SET 
            cep = p_cep,
            dt_logradouro = p_dt_logradouro,
            cidade = p_cidade,
            bairro = p_bairro,
            estado = p_estado,
            numero = p_numero
        WHERE id_cliente = p_id_cliente;

        SET p_resultado = 'Cliente atualizado com sucesso.';
    ELSE
        SET p_resultado = 'Cliente não encontrado.';
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `administradores`
--

INSERT INTO `administradores` (`id`, `nome`, `email`, `senha`) VALUES
(1, 'Fabrício Corrêa de Souza', 'fabriciocs9950@gmail.com', 'fcs250199');

-- --------------------------------------------------------

--
-- Estrutura para tabela `assunto`
--

CREATE TABLE `assunto` (
  `id_assunto` int(11) NOT NULL,
  `desc_assunto` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `assunto`
--

INSERT INTO `assunto` (`id_assunto`, `desc_assunto`) VALUES
(1, 'Suporte'),
(2, 'Reclamacao'),
(3, 'Sugestao');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nome_cliente` varchar(100) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `data_cadastro` date NOT NULL,
  `cpf_cnpj` varchar(14) DEFAULT NULL,
  `genero` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome_cliente`, `data_nascimento`, `data_cadastro`, `cpf_cnpj`, `genero`) VALUES
(1, 'Joao Pedro', '2000-05-10', '2023-11-07', '40592985321', 'M'),
(40, 'Ryan', '2000-05-10', '2023-11-22', '10054142754', 'M');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cor`
--

CREATE TABLE `cor` (
  `id_cor` int(11) NOT NULL,
  `desc_cor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cor`
--

INSERT INTO `cor` (`id_cor`, `desc_cor`) VALUES
(1, 'branco'),
(2, 'rosa choque'),
(4, 'preto'),
(19, 'Branco'),
(20, 'Prata'),
(21, 'Prata'),
(22, 'Preto'),
(24, 'Cinza Claro'),
(25, 'Preto');

-- --------------------------------------------------------

--
-- Estrutura para tabela `email`
--

CREATE TABLE `email` (
  `id_email` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `email_cliente` varchar(50) DEFAULT NULL,
  `tipo_cliente` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `email`
--

INSERT INTO `email` (`id_email`, `id_cliente`, `email_cliente`, `tipo_cliente`) VALUES
(1, 1, 'joao@gmail.com', 'PF'),
(32, 40, 'ryan@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `endereco`
--

CREATE TABLE `endereco` (
  `id_endereco` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `dt_logradouro` varchar(100) NOT NULL,
  `numero` varchar(40) DEFAULT NULL,
  `cep` varchar(8) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT 'CURITIBA',
  `estado` varchar(2) DEFAULT 'PR',
  `tipo` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `endereco`
--

INSERT INTO `endereco` (`id_endereco`, `id_cliente`, `dt_logradouro`, `numero`, `cep`, `bairro`, `cidade`, `estado`, `tipo`) VALUES
(1, 1, 'Rua Alameda Perneta', '525', '12340000', 'Agua Verde', 'Curitiba', 'PR', 'Casa'),
(19, 40, 'Rua Vesnelau', '778', '11600-00', 'Centro', 'Curitiba', 'PR', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `estoque`
--

CREATE TABLE `estoque` (
  `id_estoque` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `id_filial` int(11) NOT NULL,
  `qt_estoque` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `estoque`
--

INSERT INTO `estoque` (`id_estoque`, `id_produto`, `id_filial`, `qt_estoque`) VALUES
(14, 16, 1, 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `filial`
--

CREATE TABLE `filial` (
  `id_filial` int(11) NOT NULL,
  `nome_filial` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `filial`
--

INSERT INTO `filial` (`id_filial`, `nome_filial`) VALUES
(1, 'Filial PR');

-- --------------------------------------------------------

--
-- Estrutura para tabela `fone`
--

CREATE TABLE `fone` (
  `id_fone` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `numero_cliente` varchar(20) DEFAULT NULL,
  `tipo_cliente` varchar(20) DEFAULT NULL,
  `contato_cliente` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `fone`
--

INSERT INTO `fone` (`id_fone`, `id_cliente`, `numero_cliente`, `tipo_cliente`, `contato_cliente`) VALUES
(1, 1, '41987654321', 'PF', 'Celular'),
(29, 40, '41 953872511', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `imagem`
--

CREATE TABLE `imagem` (
  `id` int(11) NOT NULL,
  `imagem` blob DEFAULT NULL,
  `caminho_imagem` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `imagem_produto`
--

CREATE TABLE `imagem_produto` (
  `id_imagem` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `caminho` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `imagem_produto`
--

INSERT INTO `imagem_produto` (`id_imagem`, `id_produto`, `caminho`) VALUES
(7, 13, 'C:\\xampp\\htdocs\\LPWEB\\Ecommerce\\view\\img\\micro1.png'),
(8, 14, 'C:\\xampp\\htdocs\\LPWEB\\Ecommerce\\view\\img\\micro2.png'),
(9, 15, 'C:\\xampp\\htdocs\\LPWEB\\Ecommerce\\view\\img\\micro3.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `informacoes_empresa`
--

CREATE TABLE `informacoes_empresa` (
  `id` int(11) NOT NULL,
  `sobre` text DEFAULT NULL,
  `missao` text DEFAULT NULL,
  `visao` text DEFAULT NULL,
  `valores` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `informacoes_empresa`
--

INSERT INTO `informacoes_empresa` (`id`, `sobre`, `missao`, `visao`, `valores`) VALUES
(1, 'Somos uma empresa dedicada a fornecer produtos de alta qualidade para tornar a vida na cozinha mais fácil e prazerosa. Com anos de experiência, estamos comprometidos em oferecer soluções inovadoras para nossos clientes!', 'Nossa missão é fornecer micro-ondas de alta qualidade a preços acessíveis, tornando o cozimento mais rápido e eficiente para nossos clientes.', 'Nossa visão é ser a principal referência em soluções de aquecimento e cozimento, sempre inovando e atendendo às necessidades culinárias em constante evolução.', 'Nossos valores incluem compromisso com a qualidade, ética nos negócios e satisfação do cliente em todos os aspectos do nosso trabalho.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `item_venda`
--

CREATE TABLE `item_venda` (
  `id_item` int(11) NOT NULL,
  `id_venda` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `vlr_venda` decimal(8,2) DEFAULT NULL,
  `qtd_venda` int(11) NOT NULL,
  `status_venda` varchar(20) DEFAULT NULL,
  `total` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `linha`
--

CREATE TABLE `linha` (
  `id_linha` int(11) NOT NULL,
  `desc_linha` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `linha`
--

INSERT INTO `linha` (`id_linha`, `desc_linha`) VALUES
(1, 'TRX'),
(17, 'AZZ'),
(18, 'HLX'),
(19, 'Plus Plus'),
(20, 'Embutir'),
(21, 'Prata'),
(22, 'MS'),
(23, 'Teste');

-- --------------------------------------------------------

--
-- Estrutura para tabela `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(11) NOT NULL,
  `desc_marca` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `marca`
--

INSERT INTO `marca` (`id_marca`, `desc_marca`) VALUES
(1, 'Philco'),
(21, 'Eletrolux'),
(22, 'philco'),
(23, 'Original Plus'),
(24, 'Song'),
(25, 'Continental'),
(26, 'LG'),
(27, 'Teste');

-- --------------------------------------------------------

--
-- Estrutura para tabela `mensagem`
--

CREATE TABLE `mensagem` (
  `id_mensagem` int(11) NOT NULL,
  `id_email` int(11) NOT NULL,
  `id_fone` int(11) NOT NULL,
  `id_assunto` int(11) NOT NULL,
  `nome` varchar(20) DEFAULT NULL,
  `desc_mensagem` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `mensagem`
--

INSERT INTO `mensagem` (`id_mensagem`, `id_email`, `id_fone`, `id_assunto`, `nome`, `desc_mensagem`) VALUES
(1, 1, 1, 3, 'Joao', 'Sugiro encaminhar a nota fiscal junto com o produt');

-- --------------------------------------------------------

--
-- Estrutura para tabela `modelo`
--

CREATE TABLE `modelo` (
  `id_modelo` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `id_linha` int(11) NOT NULL,
  `desc_modelo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `modelo`
--

INSERT INTO `modelo` (`id_modelo`, `id_marca`, `id_linha`, `desc_modelo`) VALUES
(1, 1, 1, 'Microondas'),
(4, 21, 17, 'AZZ Star Plus'),
(5, 22, 18, 'Model'),
(13, 1, 1, 'Microondas'),
(14, 21, 17, 'AZZ Star Plus'),
(15, 22, 18, 'Modelo'),
(16, 27, 23, 'Teste');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `id_produto` int(11) NOT NULL,
  `id_modelo` int(11) NOT NULL,
  `id_cor` int(11) NOT NULL,
  `desc_produto` varchar(100) DEFAULT NULL,
  `capacidade_modelo` decimal(4,1) DEFAULT NULL,
  `vlr_sugerido` decimal(8,2) NOT NULL,
  `vlr_custo` decimal(8,2) NOT NULL,
  `voltagem` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`id_produto`, `id_modelo`, `id_cor`, `desc_produto`, `capacidade_modelo`, `vlr_sugerido`, `vlr_custo`, `voltagem`) VALUES
(1, 1, 1, 'Microondas', 8.0, 699.00, 250.00, 'Bivolt]'),
(13, 1, 1, 'Microondas Embutir Song 33 Litros Crissair', 8.0, 99.99, 250.00, 'Bivolt'),
(14, 4, 21, 'Micro-ondas Continental Prata 34 Litros (MC34S)', 8.0, 149.99, 250.00, 'Bivolt'),
(15, 5, 22, 'Forno Micro-ondas LG MS3097AR | 30 Litros - Fujioka', 8.0, 199.99, 250.00, 'Bivolt'),
(16, 16, 25, 'Microondas', 10.0, 3.00, 4.00, 'Bivolt');

-- --------------------------------------------------------

--
-- Estrutura para tabela `venda`
--

CREATE TABLE `venda` (
  `id_venda` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `data_venda` date DEFAULT NULL,
  `nr_documento_venda` int(11) DEFAULT NULL,
  `status_venda` varchar(20) DEFAULT NULL,
  `prc_desconto_venda` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `venda`
--

INSERT INTO `venda` (`id_venda`, `id_cliente`, `id_vendedor`, `data_venda`, `nr_documento_venda`, `status_venda`, `prc_desconto_venda`) VALUES
(1, 1, 1, '2023-11-07', 189, 'Finalizada', 0.09);

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendedor`
--

CREATE TABLE `vendedor` (
  `id_vendedor` int(11) NOT NULL,
  `nome_vendedor` varchar(100) DEFAULT NULL,
  `data_admissao_vendedor` date DEFAULT NULL,
  `data_demissao_vendedor` date DEFAULT NULL,
  `comissao_vendedor` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `vendedor`
--

INSERT INTO `vendedor` (`id_vendedor`, `nome_vendedor`, `data_admissao_vendedor`, `data_demissao_vendedor`, `comissao_vendedor`) VALUES
(1, 'Carlos Eduardo', '2022-11-15', '0000-00-00', 0.20);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `assunto`
--
ALTER TABLE `assunto`
  ADD PRIMARY KEY (`id_assunto`);

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Índices de tabela `cor`
--
ALTER TABLE `cor`
  ADD PRIMARY KEY (`id_cor`);

--
-- Índices de tabela `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`id_email`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Índices de tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`id_endereco`),
  ADD KEY `FK_ENDERECO_CLIENTE` (`id_cliente`);

--
-- Índices de tabela `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`id_estoque`),
  ADD KEY `id_produto` (`id_produto`),
  ADD KEY `id_filial` (`id_filial`);

--
-- Índices de tabela `filial`
--
ALTER TABLE `filial`
  ADD PRIMARY KEY (`id_filial`);

--
-- Índices de tabela `fone`
--
ALTER TABLE `fone`
  ADD PRIMARY KEY (`id_fone`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Índices de tabela `imagem_produto`
--
ALTER TABLE `imagem_produto`
  ADD PRIMARY KEY (`id_imagem`),
  ADD KEY `id_produto` (`id_produto`);

--
-- Índices de tabela `informacoes_empresa`
--
ALTER TABLE `informacoes_empresa`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `item_venda`
--
ALTER TABLE `item_venda`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `id_venda` (`id_venda`),
  ADD KEY `id_produto` (`id_produto`);

--
-- Índices de tabela `linha`
--
ALTER TABLE `linha`
  ADD PRIMARY KEY (`id_linha`);

--
-- Índices de tabela `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`);

--
-- Índices de tabela `mensagem`
--
ALTER TABLE `mensagem`
  ADD PRIMARY KEY (`id_mensagem`),
  ADD KEY `id_email` (`id_email`),
  ADD KEY `id_fone` (`id_fone`),
  ADD KEY `id_assunto` (`id_assunto`);

--
-- Índices de tabela `modelo`
--
ALTER TABLE `modelo`
  ADD PRIMARY KEY (`id_modelo`),
  ADD KEY `id_marca` (`id_marca`),
  ADD KEY `id_linha` (`id_linha`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id_produto`),
  ADD KEY `id_cor` (`id_cor`),
  ADD KEY `id_modelo` (`id_modelo`);

--
-- Índices de tabela `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`id_venda`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_vendedor` (`id_vendedor`);

--
-- Índices de tabela `vendedor`
--
ALTER TABLE `vendedor`
  ADD PRIMARY KEY (`id_vendedor`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `assunto`
--
ALTER TABLE `assunto`
  MODIFY `id_assunto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de tabela `cor`
--
ALTER TABLE `cor`
  MODIFY `id_cor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `email`
--
ALTER TABLE `email`
  MODIFY `id_email` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `id_endereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `estoque`
--
ALTER TABLE `estoque`
  MODIFY `id_estoque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `filial`
--
ALTER TABLE `filial`
  MODIFY `id_filial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `fone`
--
ALTER TABLE `fone`
  MODIFY `id_fone` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `imagem_produto`
--
ALTER TABLE `imagem_produto`
  MODIFY `id_imagem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `informacoes_empresa`
--
ALTER TABLE `informacoes_empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `item_venda`
--
ALTER TABLE `item_venda`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `linha`
--
ALTER TABLE `linha`
  MODIFY `id_linha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `mensagem`
--
ALTER TABLE `mensagem`
  MODIFY `id_mensagem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `modelo`
--
ALTER TABLE `modelo`
  MODIFY `id_modelo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `venda`
--
ALTER TABLE `venda`
  MODIFY `id_venda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `vendedor`
--
ALTER TABLE `vendedor`
  MODIFY `id_vendedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `email`
--
ALTER TABLE `email`
  ADD CONSTRAINT `email_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);

--
-- Restrições para tabelas `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `FK_ENDERECO_CLIENTE` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);

--
-- Restrições para tabelas `estoque`
--
ALTER TABLE `estoque`
  ADD CONSTRAINT `estoque_ibfk_1` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id_produto`),
  ADD CONSTRAINT `estoque_ibfk_2` FOREIGN KEY (`id_filial`) REFERENCES `filial` (`id_filial`);

--
-- Restrições para tabelas `fone`
--
ALTER TABLE `fone`
  ADD CONSTRAINT `fone_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);

--
-- Restrições para tabelas `imagem_produto`
--
ALTER TABLE `imagem_produto`
  ADD CONSTRAINT `fk_imagem_produto` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id_produto`);

--
-- Restrições para tabelas `item_venda`
--
ALTER TABLE `item_venda`
  ADD CONSTRAINT `item_venda_ibfk_1` FOREIGN KEY (`id_venda`) REFERENCES `venda` (`id_venda`),
  ADD CONSTRAINT `item_venda_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id_produto`);

--
-- Restrições para tabelas `mensagem`
--
ALTER TABLE `mensagem`
  ADD CONSTRAINT `mensagem_ibfk_1` FOREIGN KEY (`id_email`) REFERENCES `email` (`id_email`),
  ADD CONSTRAINT `mensagem_ibfk_2` FOREIGN KEY (`id_fone`) REFERENCES `fone` (`id_fone`),
  ADD CONSTRAINT `mensagem_ibfk_3` FOREIGN KEY (`id_assunto`) REFERENCES `assunto` (`id_assunto`);

--
-- Restrições para tabelas `modelo`
--
ALTER TABLE `modelo`
  ADD CONSTRAINT `modelo_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`),
  ADD CONSTRAINT `modelo_ibfk_2` FOREIGN KEY (`id_linha`) REFERENCES `linha` (`id_linha`);

--
-- Restrições para tabelas `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`id_cor`) REFERENCES `cor` (`id_cor`),
  ADD CONSTRAINT `produto_ibfk_2` FOREIGN KEY (`id_modelo`) REFERENCES `modelo` (`id_modelo`);

--
-- Restrições para tabelas `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `venda_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `venda_ibfk_2` FOREIGN KEY (`id_vendedor`) REFERENCES `vendedor` (`id_vendedor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
