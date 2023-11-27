<?php
require_once("classeInformacoesEmpresa.php");
require_once("mysqliConexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber os dados do formulário
    $sobre = mysqli_real_escape_string($conn, $_POST['sobre']);
    $missao = mysqli_real_escape_string($conn, $_POST['missao']);
    $visao = mysqli_real_escape_string($conn, $_POST['visao']);
    $valores = mysqli_real_escape_string($conn, $_POST['valores']);

    // Criar uma instância da classe InformacoesEmpresa
    $informacoesEmpresa = new InformacoesEmpresa(1, $sobre, $missao, $visao, $valores);

    // Atualizar as informações no banco de dados
    if ($informacoesEmpresa->atualizarInformacoesNoBanco()) {
        echo "Informações da empresa atualizadas com sucesso!";
    } else {
        echo "Erro ao atualizar as informações da empresa: " . mysqli_error($conn);
    }

    // Fechar a conexão
    fecharConexao($conn);
}
?>
