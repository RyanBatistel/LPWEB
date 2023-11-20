<?php
require_once("mysqli_conexao.php");

$id = $_GET['id_cliente'];

$result = mysqli_query($conn, "SELECT * FROM cliente WHERE id_cliente=$id");
$resultData = mysqli_fetch_assoc($result);

$desc = $resultData['nome_cliente'];
?>
<html>
    <head>
        <title>Editando Cliente</title>
    </head>
    <body>
        <h2>Editando Cliente</h2>
        <p>
            <a href="read_cliente.php">Voltar para lista de cores</a>
        </p>

        <form name="edit" method="post" action="update_cliente.php">
            <p>Descrição</p>  
            <input type="text" name="nome_cliente" value="<?php echo $desc; ?>">
            <input type="hidden" name="id_cliente" value="<?php echo $id; ?>">
            <input type="submit" name="update" value="Atualizar">
        </form>
    </body>
</html>
