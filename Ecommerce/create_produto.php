<html>
<head>
    <title>Adicionando Produto</title>
</head>
<body>
<?php
require_once("mysqli_conexao.php");

if(isset($_POST['submit'])){
    $desc = mysqli_real_escape_string($conn, $_POST['desc_produto']); 
    $marca = mysqli_real_escape_string($conn, $_POST['desc_marca']); 
    $linha = mysqli_real_escape_string($conn, $_POST['desc_linha']); 
    $modelo = mysqli_real_escape_string($conn, $_POST['desc_modelo']); 
    $capacidade = mysqli_real_escape_string($conn, $_POST['capacidade_modelo']);  
    $vlr_sugerido = mysqli_real_escape_string($conn, $_POST['vlr_sugerido']); 
    $vlr_custo = mysqli_real_escape_string($conn, $_POST['vlr_custo']); 
    $voltagem = mysqli_real_escape_string($conn, $_POST['voltagem']); 
    $cor = mysqli_real_escape_string($conn, $_POST['desc_cor']); 
    $estoque = mysqli_real_escape_string($conn, $_POST['qt_estoque']);
    $imagem = mysqli_real_escape_string($conn, $_POST['caminho_imagem']);

    if (empty($desc)) {
        echo "<font color='red'>Descrição não pode ficar em branco</font><br/>";
    } else {

        // Inserir na tabela Marca
        $result_marca = mysqli_query($conn, "INSERT INTO marca (desc_marca) 
            VALUES ('$marca')");
           $id_marca = mysqli_insert_id($conn);
        // Inserir na tabela Linha
        $result_linha = mysqli_query($conn, "INSERT INTO linha (desc_linha) 
            VALUES ('$linha')");
             $id_linha = mysqli_insert_id($conn);
        $result_cor = mysqli_query($conn, "INSERT INTO cor (desc_cor) 
             VALUES ('$cor')");
              $id_cor = mysqli_insert_id($conn);

        if ($result_marca && $result_linha) {
            $result_modelo = mysqli_query($conn, "INSERT INTO modelo (id_marca, id_linha, desc_modelo) 
            VALUES ('$id_marca', '$id_linha', '$modelo')");
            // Inserir na tabela Estoque
            $id_modelo = mysqli_insert_id($conn);

        }
        if ($modelo) {
            // Se todas as inserções nas tabelas referenciadas foram bem-sucedidas,
            // inserir na tabela Produto
            $result_produto = mysqli_query($conn, "INSERT INTO produto (id_modelo, id_cor, desc_produto, capacidade_modelo, vlr_sugerido, vlr_custo, voltagem) 
                VALUES ('$id_modelo', '$id_cor', '$desc', '$capacidade', '$vlr_sugerido', '$vlr_custo', '$voltagem')");
        
            $id_produto = mysqli_insert_id($conn);
            $result_estoque = mysqli_query($conn, "INSERT INTO estoque (id_produto, id_filial, qt_estoque) 
              VALUES ('$id_produto', '1', '$estoque')");

            if ($result_produto) {
                echo "<p><font color='green'>Produto adicionado</p>";
            } else {
                echo "<p><font color='red'>Erro ao adicionar produto</p>";
            }
        } else {
            echo "<p><font color='red'>Erro ao adicionar dados relacionados (cor, marca, linha, estoque)</p>";
        }
    }
    echo "<a href='read_produto.php'>Voltar à tela anterior</a>";
}
?>
</body>
</html>
