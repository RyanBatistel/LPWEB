<?php
require_once("mysqli_conexao.php");

if (isset($_POST['submit'])) {
    $desc = mysqli_real_escape_string($conn, $_POST['nome_cliente']);
    $dt_nascimento = mysqli_real_escape_string($conn, $_POST['data_nascimento']);
    $dt_cadastro = mysqli_real_escape_string($conn, $_POST['data_cadastro']);
    $cnpj_cpf = mysqli_real_escape_string($conn, $_POST['cpf_cnpj']);
    $genero = mysqli_real_escape_string($conn, $_POST['genero']);
    $email = mysqli_real_escape_string($conn, $_POST['email_cliente']);
    $fone = mysqli_real_escape_string($conn, $_POST['numero_cliente']);
    $cep = mysqli_real_escape_string($conn, $_POST['cep']);
    $logradouro = mysqli_real_escape_string($conn, $_POST['dt_logradouro']);
    $cidade = mysqli_real_escape_string($conn, $_POST['cidade']);
    $bairro = mysqli_real_escape_string($conn, $_POST['bairo']);
    $estado = mysqli_real_escape_string($conn, $_POST['estado']);
    $numero = mysqli_real_escape_string($conn, $_POST['numero']);

    if (empty($desc)) {
        echo "<font color='red'>Descrição não pode ficar em branco</font><br/>";
    } else {
        // Chamar a stored procedure para inserir o cliente
        $query = "CALL sp_insert_cliente('$desc', '$dt_nascimento', '$dt_cadastro', '$cnpj_cpf', '$genero', '$email', '$fone', '$cep', '$logradouro', '$cidade', '$bairro', '$estado', @resultado)";
        $result = mysqli_query($conn, $query);

        // Capturar o valor da variável de saída
        $resultOutput = mysqli_query($conn, "SELECT @resultado as resultado");
        $row = mysqli_fetch_assoc($resultOutput);
        $resultado = $row['resultado'];

        if ($result) {
            echo "<p><font color='green'>$resultado</font></p>";
        } else {
            echo "<p><font color='red'>Erro ao adicionar cliente</font></p>";
        }
    }

    echo "<a href='adicionar_cliente.php'>Voltar à tela anterior</a>";
}
?>
