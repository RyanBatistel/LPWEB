<?php
require_once("mysqliConexao.php");

if (isset($_GET['id_cor'])) {
    $id = $_GET['id_cor'];

    // Iniciar transação
    mysqli_begin_transaction($conn);

    try {
        // Excluir registros na tabela cor
        $result = mysqli_query($conn, "DELETE FROM cor WHERE id_cor = $id");

        // Verificar erros na exclusão
        if (!$result) {
            throw new Exception('Erro na exclusão da cor: ' . mysqli_error($conn));
        }

        // Commit (efetivar transação)
        mysqli_commit($conn);

        echo '<html>
                <head>
                    <title>Cor excluída</title>
                </head>
                <body>
                    <p>Cor excluída!</p>
                    <p><a href="readCor.php">Voltar para a lista de cores</a></p>
                </body>
              </html>';
    } catch (Exception $e) {
        // Se ocorrer algum erro, rollback (desfazer transação)
        mysqli_rollback($conn);

        echo '<html>
                <head>
                    <title>Erro</title>
                </head>
                <body>
                    <p>Ocorreu um erro durante a exclusão: ' . $e->getMessage() . '</p>
                    <p><a href="readCor.php">Voltar para a lista de cores</a></p>
                </body>
              </html>';
    }

} else {
    echo 'ID da cor não fornecido.';
}

// Fechar a conexão com o banco de dados
fecharConexao($conn);
?>
