<html>
<head>
    <title>Adicionando Cor</title>
</head>
<body>
<?php
require_once("mysqliConexao.php");

// Conectar ao banco de dados
$conn = conectarAoBanco();

if (isset($_POST['submit'])) {
    $desc = mysqli_real_escape_string($conn, $_POST['desc_cor']);

    if (empty($desc)) {
        echo "<font color='red'>Descrição não pode ficar em branco</font><br/>";
    } else {
        $result = mysqli_query($conn,
            "INSERT INTO Cor (desc_cor) VALUES ('$desc')");

        if ($result) {
            echo "<p><font color='green'>Cor adicionada</p>";
        } else {
            echo "<p><font color='red'>Erro ao adicionar cor</p>";
        }
    }

    // Fechar a conexão com o banco de dados
    fecharConexao($conn);

    echo "<a href='adicionarCor.php'>Voltar à tela anterior</a>";
}
?>
</body>
</html>
