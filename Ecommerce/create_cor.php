<html>
  <head>
    <title>Adicionando Cor</title>
  </head>
<body>    
<?php
require_once("mysqli_conexao.php");

if(isset($_POST['submit'])){
    $desc = mysqli_real_escape_string($conn, $_POST['desc_cor']);

    if(empty($desc)){
        echo "<font color = 'red'>Descrição não pode ficar em branco</font><br/>";
    } else {
        $result = mysqli_query($conn, 
          "INSERT INTO Cor (desc_cor) VALUES ('$desc')");
        echo "<p><font color='green'>Cor adicionada</p>";
    }
    echo "<a href='adicionar_cor.php'>Voltar à tela anterior</a>";
}
?>
</body>
</html>



