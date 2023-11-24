<?php
require_once("mysqli_conexao.php");

if(isset($_POST['update'])){
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

    if(empty($desc)) {
        echo "<font color='red'>Cliente precisa ser preenchido</font>";
    } else {
        $result = mysqli_query($conn, "UPDATE cliente SET nome_cliente='$desc', data_nascimento='$dt_nascimento', 
        data_cadastro='$dt_cadastro', cpf_cnpj='$dt_cpf_cnpj', genero='$dt_genero' 
        WHERE id_cliente=$id");

        $result = mysqli_query($conn, "UPDATE email SET email_cliente='$email'
        WHERE id_cliente=$id");

        $result = mysqli_query($conn, "UPDATE fone SET numero_cliente='$fone'
        WHERE id_cliente=$id");

        $result = mysqli_query($conn, "UPDATE endereco SET cep='$cep', dt_logradouro='$dt_logradouro', 
        cidade='$cidade', bairro='$bairo', estado='$estado', numero='$numero' 
        WHERE id_cliente=$id");

        echo "<font color='green'>Cliente atualizado<br>"; 
    }
    echo "<a href='read_cliente.php'>Voltar para a lista de clientes";
}
?>
