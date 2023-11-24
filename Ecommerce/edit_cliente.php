<?php
require_once("mysqli_conexao.php");

$id = $_GET['id_cliente'];


$result_a = mysqli_query($conn, "SELECT * FROM cliente WHERE id_cliente=$id");
$resultData_a = mysqli_fetch_assoc($result_a);

$result_b = mysqli_query($conn, "SELECT * FROM email WHERE id_cliente=$id");
$resultData_b = mysqli_fetch_assoc($result_b);

$result_c = mysqli_query($conn, "SELECT * FROM fone WHERE id_cliente=$id");
$resultData_c = mysqli_fetch_assoc($result_c);

$result_d = mysqli_query($conn, "SELECT * FROM endereco WHERE id_cliente=$id");
$resultData_d = mysqli_fetch_assoc($result_d);

$desc = $resultData_a['nome_cliente'];
$dt_nascimento = $resultData_a['data_nascimento'];
$dt_cadastro = $resultData_a['data_cadastro'];
$dt_cpf_cnpj = $resultData_a['cpf_cnpj'];
$dt_genero = $resultData_a['genero'];
$email = $resultData_b['email_cliente'];
$fone = $resultData_c['numero_cliente'];
$cep = $resultData_d['cep'];
$logradouro = $resultData_d['dt_logradouro'];
$cidade = $resultData_d['cidade'];
$bairo = $resultData_d['bairro'];
$estado = $resultData_d['estado'];
$numero = $resultData_d['numero'];

?>
<html>
    <head>
        <title>Editando Cliente</title>
    </head>
    <body>
        <h2>Editando Cliente</h2>
        <p>
            <a href="read_cliente.php">Voltar para lista de clientes</a>
        </p>

        <form name="edit" method="post" action="update_cliente.php">
            <h1>Descrição</h1> 
            <p>Nome</p> 
            <input type="text" name="nome_cliente" value="<?php echo $desc; ?>"><br>
            <p>Data Nascimento</p>
            <input type="date" name="data_nascimento" value="<?php echo $dt_nascimento; ?>"><br>
            <p>Data Cadastro</p>
            <input type="date" name="data_cadastro" value="<?php echo $dt_cadastro; ?>"><br>
            <p>CPF/CNPJ</p>
            <input type="text" name="cpf_cnpj" value="<?php echo $dt_cpf_cnpj; ?>"><br>
            <p>Genero</p>
            <select name="genero">
                <option value="M" <?php echo ($dt_genero === 'M') ? 'selected' : ''; ?>>Masculino</option>
                <option value="F" <?php echo ($dt_genero === 'F') ? 'selected' : ''; ?>>Feminino</option>
            </select><br>
            <p>Email</p>
            <input type="text" name="email_cliente" value="<?php echo $email; ?>"><br>
            <p>Telefone</p>
            <input type="text" name="numero_cliente" value="<?php echo $fone; ?>"><br>
            <p>CEP</p>
            <input type="text" name="cep" value="<?php echo $cep; ?>"><br> 
            <p>Logradouro</p>
            <input type="text" name="dt_logradouro" value="<?php echo $logradouro; ?>"><br>
            <p>Cidade</p>
            <input type="text" name="cidade" value="<?php echo $cidade; ?>"><br>
            <p>Bairro</p>
            <input type="text" name="bairro" value="<?php echo $bairo; ?>"><br>
            <p>Estado</p>
            <!-- <input type="text" name="estado" value="<?php echo $estado; ?>"> -->
            <select name="estado">
                <option value="AC" <?php echo ($estado === 'AC') ? 'selected' : ''; ?>>Acre</option>
                <option value="AL" <?php echo ($estado === 'AL') ? 'selected' : ''; ?>>Alagoas</option>
                <option value="AP" <?php echo ($estado === 'AP') ? 'selected' : ''; ?>>Amapá</option>
                <option value="AM" <?php echo ($estado === 'AM') ? 'selected' : ''; ?>>Amazonas</option>
                <option value="BA" <?php echo ($estado === 'BA') ? 'selected' : ''; ?>>Bahia</option>
                <option value="CE" <?php echo ($estado === 'CE') ? 'selected' : ''; ?>>Ceará</option>
                <option value="DF" <?php echo ($estado === 'DF') ? 'selected' : ''; ?>>Distrito Federal</option>
                <option value="ES" <?php echo ($estado === 'ES') ? 'selected' : ''; ?>>Espírito Santo</option>
                <option value="GO" <?php echo ($estado === 'GO') ? 'selected' : ''; ?>>Goiás</option>
                <option value="MA" <?php echo ($estado === 'MA') ? 'selected' : ''; ?>>Maranhão</option>
                <option value="MT" <?php echo ($estado === 'MT') ? 'selected' : ''; ?>>Mato Grosso</option>
                <option value="MS" <?php echo ($estado === 'MS') ? 'selected' : ''; ?>>Mato Grosso do Sul</option>
                <option value="MG" <?php echo ($estado === 'MG') ? 'selected' : ''; ?>>Minas Gerais</option>
                <option value="PA" <?php echo ($estado === 'PA') ? 'selected' : ''; ?>>Pará</option>
                <option value="PB" <?php echo ($estado === 'PB') ? 'selected' : ''; ?>>Paraíba</option>
                <option value="PR" <?php echo ($estado === 'PR') ? 'selected' : ''; ?>>Paraná</option>
                <option value="PE" <?php echo ($estado === 'PE') ? 'selected' : ''; ?>>Pernambuco</option>
                <option value="PI" <?php echo ($estado === 'PI') ? 'selected' : ''; ?>>Piauí</option>
                <option value="RJ" <?php echo ($estado === 'RJ') ? 'selected' : ''; ?>>Rio de Janeiro</option>
                <option value="RN" <?php echo ($estado === 'RN') ? 'selected' : ''; ?>>Rio Grande do Norte</option>
                <option value="RS" <?php echo ($estado === 'RS') ? 'selected' : ''; ?>>Rio Grande do Sul</option>
                <option value="RO" <?php echo ($estado === 'RO') ? 'selected' : ''; ?>>Rondônia</option>
                <option value="RR" <?php echo ($estado === 'RR') ? 'selected' : ''; ?>>Roraima</option>
                <option value="SC" <?php echo ($estado === 'SC') ? 'selected' : ''; ?>>Santa Catarina</option>
                <option value="SP" <?php echo ($estado === 'SP') ? 'selected' : ''; ?>>São Paulo</option>
                <option value="SE" <?php echo ($estado === 'SE') ? 'selected' : ''; ?>>Sergipe</option>
                <option value="TO" <?php echo ($estado === 'TO') ? 'selected' : ''; ?>>Tocantins</option>
            </select><br>
            <p>Numero</p>
            <input type="text" name="numero" value="<?php echo $numero; ?>"> <br>
            <input type="hidden" name="id_cliente" value="<?php echo $id; ?>">
            <input type="submit" name="update" value="Atualizar">
        </form>
    </body>
</html>
