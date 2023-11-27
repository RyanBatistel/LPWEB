<?php
require_once("mysqli_conexao.php");

if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id_cliente']);
    $desc = mysqli_real_escape_string($conn, $_POST['nome_cliente']);
    $dt_nascimento = mysqli_real_escape_string($conn, $_POST['data_nascimento']);
    $dt_cadastro = mysqli_real_escape_string($conn, $_POST['data_cadastro']);
    $dt_cpf_cnpj = mysqli_real_escape_string($conn, $_POST['cpf_cnpj']);
    $dt_genero = mysqli_real_escape_string($conn, $_POST['genero']);
    $email = mysqli_real_escape_string($conn, $_POST['email_cliente']);
    $fone = mysqli_real_escape_string($conn, $_POST['numero_cliente']);
    $cep = mysqli_real_escape_string($conn, $_POST['cep']);
    $dt_logradouro = mysqli_real_escape_string($conn, $_POST['dt_logradouro']);
    $cidade = mysqli_real_escape_string($conn, $_POST['cidade']);
    $bairo = mysqli_real_escape_string($conn, $_POST['bairro']);
    $estado = mysqli_real_escape_string($conn, $_POST['estado']);
    $numero = mysqli_real_escape_string($conn, $_POST['numero']);

    if (empty($desc)) {
        echo "<font color='red'>Cliente precisa ser preenchido</font>";
    } else {
        // Chamar a stored procedure para atualizar o cliente
        $query = "CALL sp_update_cliente(
            $id,
            '$desc',
            '$dt_nascimento',
            '$dt_cadastro',
            '$dt_cpf_cnpj',
            '$dt_genero',
            '$email',
            '$fone',
            '$cep',
            '$dt_logradouro',
            '$cidade',
            '$bairo',
            '$estado',
            '$numero',
            @resultado
        )";
        
        $result = mysqli_query($conn, $query);

        // Verificar se houve erros na execução da stored procedure
        if (!$result) {
            die('Erro na atualização do cliente: ' . mysqli_error($conn));
        }

        // Obter o resultado da stored procedure
        $resultado = mysqli_query($conn, "SELECT @resultado AS resultado")->fetch_assoc();
        
        echo "<font color='green'>" . $resultado['resultado'] . "</font><br>";
    }
    echo "<a href='read_cliente.php'>Voltar para a lista de clientes</a>";
}
?>
