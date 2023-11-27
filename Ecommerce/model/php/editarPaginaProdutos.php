<?php
require_once("classeProduto.php");
require_once("mysqliConexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber os dados do formulário
    $imagemProduto1 = mysqli_real_escape_string($conn, $_POST['produto1Imagem']);
    $tituloProduto1 = mysqli_real_escape_string($conn, $_POST['produto1Titulo']);
    $precoProduto1 = mysqli_real_escape_string($conn, $_POST['produto1Preco']);

    $imagemProduto2 = mysqli_real_escape_string($conn, $_POST['produto2Imagem']);
    $tituloProduto2 = mysqli_real_escape_string($conn, $_POST['produto2Titulo']);
    $precoProduto2 = mysqli_real_escape_string($conn, $_POST['produto2Preco']);

    $imagemProduto3 = mysqli_real_escape_string($conn, $_POST['produto3Imagem']);
    $tituloProduto3 = mysqli_real_escape_string($conn, $_POST['produto3Titulo']);
    $precoProduto3 = mysqli_real_escape_string($conn, $_POST['produto3Preco']);

    // Criar instâncias da classe Produto
    $produto1 = new Produto(1, $id_modelo1, $id_cor1, $desc_produto1, $capacidade_modelo1, $vlr_sugerido1, $vlr_custo1, $voltagem1);
    $produto2 = new Produto(2, $id_modelo2, $id_cor2, $desc_produto2, $capacidade_modelo2, $vlr_sugerido2, $vlr_custo2, $voltagem2);
    $produto3 = new Produto(3, $id_modelo3, $id_cor3, $desc_produto3, $capacidade_modelo3, $vlr_sugerido3, $vlr_custo3, $voltagem3);

    // Atualizar as informações no banco de dados
    if ($produto1->atualizarInformacoesNoBanco() && $produto2->atualizarInformacoesNoBanco() && $produto3->atualizarInformacoesNoBanco()) {
        echo "Informações dos produtos atualizadas com sucesso!";
    } else {
        echo "Erro ao atualizar as informações dos produtos: " . mysqli_error($conn);
    }

    // Fecha a conexão
    fecharConexao($conn);
}
?>
