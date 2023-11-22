<html>
  <head>
    <title>Adicionando Cliente</title>
  </head>
<body>    
<?php
require_once("mysqli_conexao.php");

if(isset($_POST['submit'])){
    $desc = mysqli_real_escape_string($conn, $_POST['nome_cliente']);
    $dt_nascimento = mysqli_real_escape_string($conn, $_POST['data_nascimento']);
    $dt_cadastro = mysqli_real_escape_string($conn, $_POST['data_cadastro']);
    $cnpj_cpf = mysqli_real_escape_string($conn, $_POST['cpf_cnpj']);
    $genero = mysqli_real_escape_string($conn, $_POST['genero']);

    if(empty($desc)){
        echo "<font color = 'red'>Descrição não pode ficar em branco</font><br/>";
    } else {
        $result = mysqli_query($conn, 
          "INSERT INTO Cliente (nome_cliente) VALUES ('$desc')");
          /* PROCEDURE AQUI AO INVES DE INSERT */
        echo "<p><font color='green'>Cliente adicionada</p>";
    }
    echo "<a href='adicionar_cliente.php'>Voltar à tela anterior</a>";
}
?>
</body>
</html>
