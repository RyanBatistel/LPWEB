<?php
require_once("mysqli_conexao.php");

if (isset($_GET['id_cliente'])) {
    $id = $_GET['id_cliente'];

    // Excluir registros relacionados na tabela email
    $result_email = mysqli_query($conn, "DELETE FROM email WHERE id_cliente = $id");

    // Verificar erros na exclusão da tabela email
    if (!$result_email) {
        die('Erro na exclusão do email: ' . mysqli_error($conn));
    }

    // Excluir registros relacionados na tabela fone
    $result_fone = mysqli_query($conn, "DELETE FROM fone WHERE id_cliente = $id");

    // Verificar erros na exclusão da tabela fone
    if (!$result_fone) {
        die('Erro na exclusão do fone: ' . mysqli_error($conn));
    }

    // Excluir registros relacionados na tabela endereco
    $result_endereco = mysqli_query($conn, "DELETE FROM endereco WHERE id_cliente = $id");

    // Verificar erros na exclusão da tabela endereco
    if (!$result_endereco) {
        die('Erro na exclusão do endereço: ' . mysqli_error($conn));
    }

    // Agora, você pode excluir o cliente
    $result_cliente = mysqli_query($conn, "DELETE FROM cliente WHERE id_cliente = $id");

    // Verificar erros na exclusão da tabela cliente
    if (!$result_cliente) {
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
