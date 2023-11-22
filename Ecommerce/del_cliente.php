<?php
require_once("mysqli_conexao.php");

$id = $_GET['id_cliente'];

$result = mysqli_query($conn, "DELETE FROM cliente WHERE id_cliente = $id");
?>
<html>
    <head>
        <title>Cliente excluido</title>
    </head>
    <body>
        <p>Cliente excluido!</p>
        <p><a href="read_cor.php">Voltar para lista de cores</a></p>
    </body>
</html>