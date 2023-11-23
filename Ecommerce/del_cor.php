<?php
require_once("mysqli_conexao.php");

$id = $_GET['id_cor'];

$result = mysqli_query($conn, "DELETE FROM cor WHERE id_cor = $id");
?>
<html>
    <head>
        <title>Cor excluida</title>
    </head>
    <body>
        <p>Cliente excluido!</p>
        <p><a href="read_cliente.php">Voltar para lista de Cliente</a></p>
    </body>
</html>

