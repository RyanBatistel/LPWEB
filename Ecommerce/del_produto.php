<?php
require_once("mysqli_conexao.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['submit'])) {
    $id_produto = mysqli_real_escape_string($conn, $_POST['id_produto']);

    // Chamar a stored procedure
    $query = "CALL DeletarProduto('$id_produto')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<p><font color='green'>Produto deletado com sucesso</p>";
    } else {
        echo "<p><font color='red'>Erro ao deletar produto: " . mysqli_error($conn) . "</p>";
    }

    echo "<a href='read_produto.php'>Voltar à tela anterior</a>";
}
?>
