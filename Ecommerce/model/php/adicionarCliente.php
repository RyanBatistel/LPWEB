<html>
  <head>
    <title>Novo Cliente</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <h2>Novo Cliente</h2>
   
    <form action="createCliente.php" method="post" name="add">
        <p>Nome Cliente</p>
        <input type="text" name="nome_cliente" autocomplete="off">
        
        <p>Data de Nascimento</p>
        <input type="date" name="data_nascimento" autocomplete="off">

        <p>Data de Cadastro</p>
        <input type="date" name="data_cadastro" autocomplete="off">

        <p>Cpf ou Cnpj</p>
        <input type="text" name="cpf_cnpj" autocomplete="off">

        <p>Gênero</p>
            <select name="genero" autocomplete="off">
            <option value="M">Masculino</option>
            <option value="F">Feminino</option>
            </select>

        <p>Email</p>
        <input type="text" name="email_cliente" autocomplete="off">

        <p>Telefone</p>
        <input type="text" name="numero_cliente" autocomplete="off">

        <p>CEP</p>
        <input type="text" name="cep" autocomplete="off">

        <p>Logradouro</p>
        <input type="text" name="dt_logradouro" autocomplete="off">

        <p>Cidade</p>
        <input type="text" name="cidade" autocomplete="off">

        <p>Bairro</p>
        <input type="text" name="bairo" autocomplete="off">

        <p>Estado</p>
        <!-- <input type="text" name="estado"> -->

         <select name="estado"> 
          <option value="AC">Acre</option>
          <option value="AL">Alagoas</option>
          <option value="AP">Amapá</option>
          <option value="AM">Amazonas</option>
          <option value="BA">Bahia</option>
          <option value="CE">Ceará</option>
          <option value="DF">Distrito Federal</option>
          <option value="ES">Espírito Santo</option>
          <option value="GO">Goiás</option>
          <option value="MA">Maranhão</option>
          <option value="MT">Mato Grosso</option>
          <option value="MS">Mato Grosso do Sul</option>
          <option value="MG">Minas Gerais</option>
          <option value="PA">Pará</option>
          <option value="PB">Paraíba</option>
          <option value="PR">Paraná</option>
          <option value="PE">Pernambuco</option>
          <option value="PI">Piauí</option>
          <option value="RJ">Rio de Janeiro</option>
          <option value="RN">Rio Grande do Norte</option>
          <option value="RS">Rio Grande do Sul</option>
          <option value="RO">Rondônia</option>
          <option value="RR">Roraima</option>
          <option value="SC">Santa Catarina</option>
          <option value="SP">São Paulo</option>
          <option value="SE">Sergipe</option>
          <option value="TO">Tocantins</option>
        </select>
        <p>Numero Casa/Apartamento</p>
        <input type="text" name="numero" autocomplete="off">
        <input type="submit" name="submit" value="Adicionar">
</form>
    <a href="readCliente.php">Voltar à tela anterior</a>
</body>
</html>