<?php
require_once("mysqliConexao.php");
$result = mysqli_query($conn, "SELECT * FROM cliente");
?>
<html>
  <head>
    <title>Cadastro de Cliente</title>
  </head>
  <body>
    <h2>CADASTRO DE CLIENTE</h2>
    <p>
      <a href="adicionarCliente.php">Nova Cliente</a>
    </p>
    <table width='80%' border=0>
      <tr gbcolor='#DDDDDD'>
        <td>Descrição</td>
        <td>Ações</td>
      <tr>      
      <?php
      while ($res = mysqli_fetch_assoc($result)) {         
        echo "<tr>";
        echo "<td>".$res['nome_cliente']."</td>";
        echo "<td><a href='editCliente.php?id_cliente=$res[id_cliente]'>Editar</a>|
                   <a href='delCliente.php?id_cliente=$res[id_cliente]' 
                  onClick=\"return confirm('Tem certeza?')\">Deletar</a></td>";
        echo "</tr>";
      }   
      ?>
    </table>
  </body>
</html>
