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

    // Chamar a stored procedure
    $query = "CALL sp_insert_produto('$desc', '$marca', '$linha', '$modelo', '$capacidade', '$vlr_sugerido', '$vlr_custo', '$voltagem', '$cor', '$estoque', '$imagem')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<p><font color='green'>Produto adicionado</p>";
    } else {
        echo "<p><font color='red'>Erro ao adicionar produto</p>";
    }

    echo "<a href='read_produto.php'>Voltar à tela anterior</a>";
}
?>
