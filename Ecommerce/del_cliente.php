<?php
require_once("mysqli_conexao.php");

if (isset($_GET['id_cliente'])) {
    $id = $_GET['id_cliente'];

    // Chamar a stored procedure para excluir o cliente
    $query = "CALL sp_delete_cliente($id)";
    $result = mysqli_query($conn, $query);

    // Verificar se houve erros na execução da stored procedure
    if (!$result) {
        die('Erro na exclusão do cliente: ' . mysqli_error($conn));
    }

    echo '<html>
            <head>
                <title>Cliente excluído</title>
            </head>
            <body>
                <p>Cliente excluído!</p>
                <p><a href="read_cliente.php">Voltar para a página de clientes</a></p>
            </body>
          </html>';
} else {
    echo 'ID do cliente não fornecido.';
}
?>
