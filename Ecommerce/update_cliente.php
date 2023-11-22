<?php
require_once("mysqli_conexao.php");

if(isset($_POST['update'])){
    $id = mysqli_real_escape_string($conn, $_POST['id_cliente']);
    $desc = mysqli_real_escape_string($conn, $_POST['nome_cliente']);

    if(empty($desc)) {
        echo "<font color='red'>Cliente precisa ser preenchida</font>";
    } else {
        $result = mysqli_query($conn, "UPDATE cor SET nome_cliente='$desc' WHERE id_cliente=$id");
        echo "<font color='green'>Cliente atualizado";
    }
    echo "<a href='read_cliente.php'>Voltar para a lista de cores";
}