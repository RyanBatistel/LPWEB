<?php
require_once("mysqli_conexao.php");

if(isset($_POST['submit'])){
    $result->exec("TRUNCATE TABLE cart");
}

header('Location: produtos.html');
?>