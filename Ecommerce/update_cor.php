<?php
require_once("mysqli_conexao.php");

if(isset($_POST['update'])){
    $id = mysqli_real_escape_string($conn, $_POST['id_cor']);
    $desc = mysqli_real_escape_string($conn, $_POST['desc_cor']);

    if(empty($desc)) {
        echo "<font color='red'>Cor precisa ser preenchida</font>";
    } else {
        $result = mysqli_query($conn, "UPDATE cor SET desc_cor='$desc' WHERE id_cor=$id");
        echo "<font color='green'>Cor atualizada";
    }
    echo "<a href='read_cor.php'>Voltar para a lista de cores";
}