<?php
require_once("mysqli_conexao.php");

$id = $_GET['id_cliente'];


$result_a = mysqli_query($conn, "SELECT * FROM cliente WHERE id_cliente=$id");
$resultData_a = mysqli_fetch_assoc($result_a);

$result_b = mysqli_query($conn, "SELECT * FROM email WHERE id_cliente=$id");
$resultData_b = mysqli_fetch_assoc($result_b);

$result_c = mysqli_query($conn, "SELECT * FROM fone WHERE id_cliente=$id");
$resultData_c = mysqli_fetch_assoc($result_c);

$result_d = mysqli_query($conn, "SELECT * FROM endereco WHERE id_cliente=$id");
$resultData_d = mysqli_fetch_assoc($result_d);

$desc = $resultData_a['nome_cliente'];
$dt_nascimento = $resultData_a['data_nascimento'];
$dt_cadastro = $resultData_a['data_cadastro'];
$dt_cpf_cnpj = $resultData_a['cpf_cnpj'];
$dt_genero = $resultData_a['genero'];
$email = $resultData_b['email_cliente'];
$fone = $resultData_c['numero_cliente'];
$cep = $resultData_d['cep'];
$logradouro = $resultData_d['dt_logradouro'];
$cidade = $resultData_d['cidade'];
$bairo = $resultData_d['bairro'];
$estado = $resultData_d['estado'];
$numero = $resultData_d['numero'];

?>
<html>
    <head>
        <title>Editando Cliente</title>
    </head>
    <body>
        <h2>Editando Cliente</h2>
        <p>
            <a href="read_cliente.php">Voltar para lista de clientes</a>
        </p>

        <form name="edit" method="post" action="update_cliente.php">
            <h1>Descrição</h1> 
            <p>Nome</p> 
            <input type="text" name="nome_cliente" value="<?php echo $desc; ?>"> 
            <br> <p>Data Nascimento</p>
            <input type="date" name="data_nascimento" value="<?php echo $dt_nascimento; ?>"> 
            <br> <p>Data Cadastro</p>
            <input type="date" name="data_cadastro" value="<?php echo $dt_cadastro; ?>"> 
            <br> <p>CPF/CNPJ</p>
            <input type="text" name="cpf_cnpj" value="<?php echo $dt_cpf_cnpj; ?>"> 
            <br> <p>Genero</p>
            <select name="genero">
                <option value="M" <?php echo ($dt_genero === 'M') ? 'selected' : ''; ?>>Masculino</option>
                <option value="F" <?php echo ($dt_genero === 'F') ? 'selected' : ''; ?>>Feminino</option>
                <option value="O" <?php echo ($dt_genero === 'O') ? 'selected' : ''; ?>>Outro</option>
            </select> 
            <br>
            <p>Email</p>
            <input type="text" name="email_cliente" value="<?php echo $email; ?>"> 
            <br> <p>Telefone</p>
            <input type="text" name="numero_cliente" value="<?php echo $fone; ?>"> 
            <br> <p>CEP</p>
            <input type="text" name="cep" value="<?php echo $cep; ?>"> <br> 
            <p>Logradouro</p>
            <input type="text" name="dt_logradouro" value="<?php echo $logradouro; ?>"> 
            <br> <p>Cidade</p>
            <input type="text" name="cidade" value="<?php echo $cidade; ?>"> 
            <br> <p>Bairro</p>
            <input type="text" name="bairro" value="<?php echo $bairo; ?>">
            <br><p>Estado</p>
            <input type="text" name="estado" value="<?php echo $estado; ?>"> 
            <br> <p>numero</p>
            <input type="text" name="numero" value="<?php echo $numero; ?>"> <br>
            <input type="hidden" name="id_cliente" value="<?php echo $id; ?>">
            <input type="submit" name="update" value="Atualizar">
        </form>
    </body>
</html>
