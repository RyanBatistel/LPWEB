<?php
require_once("mysqli_conexao.php");

if(isset($_POST['update'])){
    $id = mysqli_real_escape_string($conn, $_POST['id_produto']);
    $desc = mysqli_real_escape_string($conn, $_POST['desc_produto']);
    $capacidade = mysqli_real_escape_string($conn, $_POST['capacidade']);
    $vlr_sugerido = mysqli_real_escape_string($conn, $_POST['vlr_sugerido']);
    $desc_modelo = mysqli_real_escape_string($conn, $_POST['desc_modelo']);
    $desc_cod = mysqli_real_escape_string($conn, $_POST['desc_cor']);
    $vlr_custo = mysqli_real_escape_string($conn, $_POST['vlr_custo']);
    $voltagem = mysqli_real_escape_string($conn, $_POST['voltagem']);
    $estoque = mysqli_real_escape_string($conn, $_POST['estoque']);
   
    $erro = '';

    if(empty($desc)) {
        echo "<font color='red'>Descricao precisa ser preenchida</font>";
    }

    if(empty($desc_modelo)){
       $erro = $erro . "<p><font color = 'red'>Modelo nao pode ficar vazio</font></p>";
    } 
    
    if(empty($capacidade)){
      $erro = $erro . "<p><font color = 'red'>Capacidade nao pode ficar vazio</font></p>";
    } 
      
    if(empty($vlr_sugerido)){
        $erro = $erro . "<p><font color = 'red'>Valor sugerido nao pode ficar vazio</font></p>";
    } 
  
    if($erro == "") {
        // Criar a SP de update
        // CREATE PROCEDURE SP_EDIT_PRODUTO (... ACAO = I/U)
        $result = mysqli_query($conn, "UPDATE produto SET desc_produto='$desc' WHERE id_produto=$id");
        echo "<font color='green'>Produto atualizado";
    } else {
        echo $erro;
    }
    echo "<a href='read_produto.php'>Voltar para a lista de produtos";
}