<?php
require_once("../mysqli_conexao.php");
require_once("Produto.php");
$area = isset($_GET['area']) ? $_GET['area'] : NULL;
$acao = isset($_GET['acao']) ? $_GET['acao'] : NULL;

$produto = new Produto();

if ($area == "produtos") {
  switch ($acao) {
    case "informacoes":
      $id = isset($_GET["id"]) ? $_GET["id"] : NULL;

      $produto->DetalhesProduto($id);

      if ($produto->getEstoque() == 0) {
        $linkadd = "Produto esgotado";
      } else {
        $linkadd = `<p class="botaoFormulario">
                      <a href="?area=carrinho&acao=adicionar&id='.$produto->getID()'">
                         <img alt="carrinho" src="./res/img/btn_comprar.png" border=0 />
                      </a>
                    </p>`;
      }

      echo `<div><h1>`.$produto->getDescProduto().`<h1></div>
      <div>`.$produto->getVlrSugerido().`</div>
      <div>.linkadd.</div>      
      <p class="tituloForm">
          Valor: R$ `.number_format($produto->getVlrSugerido(), 2, ",", ".").`</p>
       <p>Formas de Pagamento</p>
       <p><img src="./res/img/formas_pagto.png" border=0/></p>
       <p><img src="./res/img/continua_comprando.png" border=0/> Continuar comprando</p>
       </a>`;
    }
}

$result = mysqli_query($conn, "SELECT * FROM Produto");

echo "<table width=600 border=0>";
while ($x = $result->fetch_object()) {
  echo "<tr>
          <td>$x->nome</td>
          <td>$x->preco</td>
          <td><a href=\"?area=produtos&acao=informacoes&id=".$x->id."\">Detalhes</td>
        </tr>";
}
echo "</table>";
?>
