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
    //erro Warning: Undefined array key "dt_logradouro" in C:\xampp\htdocs\codigos\Ecommerce\create_cliente.php on line 15
    $logradouro = mysqli_real_escape_string($conn, $_POST['dt_logradouro']);
    $cidade = mysqli_real_escape_string($conn, $_POST['cidade']);
    $bairo = mysqli_real_escape_string($conn, $_POST['bairo']);
    $estado = mysqli_real_escape_string($conn, $_POST['estado']);
    $numero = mysqli_real_escape_string($conn, $_POST['numero']);

    if (empty($desc)) {
        echo "<font color='red'>Descrição não pode ficar em branco</font><br/>";
    } else {
        // Inserir na tabela Cliente
        $result_cliente = mysqli_query($conn, "INSERT INTO Cliente (nome_cliente, data_nascimento, data_cadastro, cpf_cnpj, genero) 
          VALUES ('$desc', '$dt_nascimento', '$dt_cadastro', '$cnpj_cpf', '$genero')");

        // Obter o id_cliente recém-inserido
        $id_cliente = mysqli_insert_id($conn);

        // Inserir na tabela email usando o id_cliente
        $result_email = mysqli_query($conn, "INSERT INTO email (id_cliente, email_cliente) 
          VALUES ('$id_cliente', '$email')");

        // Inserir na tabela fone usando o id_cliente
        $result_fone = mysqli_query($conn, "INSERT INTO fone (id_cliente, numero_cliente) 
          VALUES ('$id_cliente', '$fone')");

        // Inserir na tabela endereco usando o id_cliente
        $result_endereco = mysqli_query($conn, "INSERT INTO endereco (id_cliente, dt_logradouro, numero, cep, bairro, cidade, estado) 
          VALUES ('$id_cliente', '$logradouro', '$numero', '$cep', '$bairo','$cidade', '$estado')");

        if ($result_cliente && $result_email && $result_fone && $result_endereco) {
            echo "<p><font color='green'>Cliente adicionado</p>";
        } else {
            echo "<p><font color='red'>Erro ao adicionar cliente</p>";
        }
    }
    echo "<a href='adicionar_cliente.php'>Voltar à tela anterior</a>";
}
?>
