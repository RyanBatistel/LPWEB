<html>
  <head>
    <title>Adicionando Produto</title>
  </head>
<body>    
<?php
require_once("mysqli_conexao.php");

if(isset($_POST['submit'])){
    $desc = mysqli_real_escape_string($conn, $_POST['desc_produto']); //ok
    $marca = mysqli_real_escape_string($conn, $_POST['desc_marca']); //ok
    $linha = mysqli_real_escape_string($conn, $_POST['desc_linha']);  //ok
    $modelo = mysqli_real_escape_string($conn, $_POST['desc_modelo']); //ok
    $capacidade = mysqli_real_escape_string($conn, $_POST['capacidade_modelo']); //ok 
    $vlr_sugerido = mysqli_real_escape_string($conn, $_POST['vlr_sugerido']); //ok
    $vlr_custo = mysqli_real_escape_string($conn, $_POST['vlr_custo']); //ok
    $voltagem = mysqli_real_escape_string($conn, $_POST['voltagem']); //ok
    $cor = mysqli_real_escape_string($conn, $_POST['desc_cor']); //ok
    $estoque = mysqli_real_escape_string($conn, $_POST['qt_estoque']);  //ok
    $imagem = mysqli_real_escape_string($conn, $_POST['imagem_caminho']);

    echo "<p>variaveis prontas</p><br>";
    $erro = "";
    if(empty($desc)){
        $erro = $erro . "<font color = 'red'>Descricao nao pode ficar vazio</font><br>";
    } 
    if(empty($modelo)){
      $erro = $erro . "<font color = 'red'>Modelo nao pode ficar vazio</font><br>";
    } 
  
    if(empty($capacidade)){
      $erro = $erro . "<font color = 'red'>Capacidade nao pode ficar vazio</font><br>";
    } 
    
    if(empty($vlr_sugerido)){
      $erro = $erro . "<font color = 'red'>Valor sugerido nao pode ficar vazio</font><br>";
    } 

    echo $erro;

    if($erro == "") {
      $qry = "CALL sp_InserirProduto('
        $desc','
        $marca','
        $linha','
        $modelo','
        $capacidade','
        $vlr_sugerido','
        $vlr_custo','
        $voltagem','
        $cor','
        $estoque','
        $imagem')";      

echo $qry;

      $result = mysqli_query($conn, $qry); 
        echo "<p><font color='green'>Produto foi adicionado</p>";
    }
    echo "<a href='read_produto.php'>Voltar a tela anterior</a>";
}
?>
</body>
</html>