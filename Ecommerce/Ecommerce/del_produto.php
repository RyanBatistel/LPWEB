<?php
require_once("mysqli_conexao.php");

if (isset($_GET['id_produto'])) {
    $p_id_produto = $_GET['id_produto'];

    // Chamar a stored procedure para excluir o cliente
    $query = "CALL sp_delete_produto($p_id_produto)";
    $result = mysqli_query($conn, $query);

    // Verificar se houve erros na execução da stored procedure
    if (!$result) {
        die('Erro na exclusão do produto: ' . mysqli_error($conn));
    }

    echo '<html>
            <head>
                <title>Produto excluído</title>
            </head>
            <body>
                <p>Cliente excluído!</p>
                <p><a href="read_produto.php">Voltar para a página de produtos</a></p>
            </body>
          </html>';
} else {    
    echo 'ID do produto não fornecido.';
}
?>
