<?php
require_once("mysqliConexao.php");
$result = mysqli_query($conn, "SELECT * FROM cor");
?>
<html>
  <head>
    <title>Cadastro de Cores</title>
  </head>
  <body>
    <h2>CADASTRO DE CORES</h2>
    <p>
      <a href="adicionarCor.php">Nova Cor</a>
    </p>
    <table width='80%' border=0>
      <tr gbcolor='#DDDDDD'>
        <td>Descrição</td>
        <td>Ações</td>
      <tr>      
      <?php
      while ($res = mysqli_fetch_assoc($result)) {         
        echo "<tr>";
        echo "<td>".$res['desc_cor']."</td>";
        echo "<td><a href='editCor.php?id_cor=$res[id_cor]'>Editar</a>|
                   <a href='delCor.php?id_cor=$res[id_cor]' 
                  onClick=\"return confirm('Tem certeza?')\">Deletar</a></td>";
        echo "</tr>";
      }   
      ?>
    </table>
  </body>
</html>
