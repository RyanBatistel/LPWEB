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
            <option value="Masculino">Masculino</option>
            <option value="Feminino">Feminino</option>
            <option value="Outro">Outro</option>
            </select>
        <input type="submit" name="submit" value="Adicionar">
</form>
    <a href="read_cliente.php">Voltar à tela anterior</a>
</body>
</html>