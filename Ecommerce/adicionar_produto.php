<html>
  <head>
    <title>Novo Produto</title>
  </head>
  <body>
    <h2>Novo Produto</h2>
    <p><a href="read_produto.php">Voltar</a></p>
    <form action="create_produto.php" method="post" name="add">
      <p>Nome do produto<br>
        <input type="text" name="desc_produto" autocomplete="off">
      </p>
      <p>Nome da marca<br>
        <input type="text" name="desc_marca" autocomplete="off">
      </p>
      <p>Nome da linha<br>
        <input type="text" name="desc_linha" autocomplete="off">
      </p>
      <p>Nome do modelo<br>
        <input type="text" name="desc_modelo" autocomplete="off">
      </p>
      <p>Capacidade<br> 
        <input type="text" name="capacidade_modelo" autocomplete="off">
      </p>
      <p>Valor de venda sugerido<br>
        <input type="text" name="vlr_sugerido" autocomplete="off">
      </p>
      <p>Valor de custo<br>
        <input type="text" name="vlr_custo" autocomplete="off">
      </p>
      <p>Voltagem<br>
        <select name="voltagem"> 
          <option value="Bivolt">Bivolt</option>
          <option value="120">120V </option>
          <option value="220">220V</option>
        </select>
      </p>
      <p>Nome da cor<br>
        <select name="desc_cor"> 
          <option value="Preto">Preto</option>
          <option value="Branco">Branco</option>
          <option value="Fosco Preto">Fosco Preto</option>
          <option value="Prata">Prata</option>
          <option value="Beje">Beje</option>
          <option value="Azul">Azul</option>
        </select>
      </p>
      <p>Quantidade em estoque<br>
        <input type="text" name="qt_estoque" autocomplete="off">
      </p>
      <p>Imagem<br>
        <input type="text" name="caminho_imagem" autocomplete="off">
      </p>
      <br>
      <input type="submit" name="submit" value="Adicionar" autocomplete="off">
    </form>
  </body>
</html>