<?php
$servidor='localhost';
$usuario= 'root';
$senha='';
$bancodedados='microondas';



    $conn = mysqli_connect($servidor,
                       $usuario,
                       $senha,
                       $bancodedados);
// validando a conexao
if (!$conn){
    die("Conexão falhou:" . mysqli_connect_error());
}
//echo "Banco de dados conectado!!!";

//Fechando a Conexão
//mysqli_close($conn);
?>


