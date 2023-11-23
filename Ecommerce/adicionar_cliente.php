<html>
  <head>
    <title>Novo Cliente</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <h2>Novo Cliente</h2>
   
    <form action="create_cliente.php" method="post" name="add">
        <p>Nome Cliente</p>
        <input type="text" name="nome_cliente">
        
        <p>Data de Nascimento</p>
        <input type="date" name="data_nascimento">

        <p>Data de Cadastro</p>
        <input type="date" name="data_cadastro">

        <p>Cpf ou Cnpj</p>
        <input type="text" name="cpf_cnpj">

        <p>Gênero</p>
            <select name="genero">
            <option value="M">M</option>
            <option value="F">F</option>
            <option value="O">O</option>
            </select>

        <p>Email</p>
        <input type="text" name="email_cliente">

        <p>Telefone</p>
        <input type="text" name="numero_cliente">

        <p>CEP</p>
        <input type="text" name="cep">

        <p>Logradouro</p>
        <input type="text" name="dt_logradouro">

        <p>Cidade</p>
        <input type="text" name="cidade">

        <p>Bairro</p>
        <input type="text" name="bairo">

        <p>Estado</p>
        <input type="text" name="estado">

        <p>Numero Casa/Apartamento</p>
        <input type="text" name="numero">


        <input type="submit" name="submit" value="Adicionar">
</form>
    <a href="read_cliente.php">Voltar à tela anterior</a>
</body>
</html>