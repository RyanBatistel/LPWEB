<?php
require_once("mysqli_conexao.php");

if (isset($_GET['id_produto'])) {
    $id = $_GET['id_produto'];

    $result_estoque = mysqli_query($conn, "DELETE FROM estoque WHERE id_produto = $id");

        if (!$result_estoque) {
            die('Erro na exclusão do estoque: ' . mysqli_error($conn));
        }

    $result_produto = mysqli_query($conn, "DELETE FROM produto WHERE id_produto = $id");
        if (!$result_produto) {
            die('Erro na exclusão do produto: ' . mysqli_error($conn));
        }
        // OK esta aqui linha / marca / modelo / 
        $result_modelo = mysqli_query($conn, "DELETE FROM modelo WHERE id_produto = $id");
        if (!$result_modelo) {
            die('Erro na exclusão do modelo: ' . mysqli_error($conn));
        }
        $result_marca = mysqli_query($conn, "DELETE FROM marca WHERE id_produto = $id");
        if (!$result_marca) {
            die('Erro na exclusão do marca: ' . mysqli_error($conn));
        }
        $result_linha = mysqli_query($conn, "DELETE FROM linha WHERE id_produto = $id");
        if (!$result_linha) {
            die('Erro na exclusão do marca: ' . mysqli_error($conn));
        }
//-------------------------------------------------------------

    echo '<html>
            <head>
                <title>Cliente excluído</title>
            </head>
            <body>
                <p>Produto excluído!</p>
                <p><a href="read_produto.php">Voltar para a pagina de Produtos</a></p>
            </body>
          </html>';
} else {
    echo 'ID do produto não fornecido.';
}
?>
