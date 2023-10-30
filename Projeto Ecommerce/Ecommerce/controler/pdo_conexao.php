<?php 
$servername = "localhost";
$database = "microondas";
$username = "root";
$password = "";

try {
 $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
 echo "Conectado a $database em $servername com sucesso usando PDO.";
}
catch (PDOException $pe) {
    $mensagem = "Drivers disponiveis: " . implode(",", PDO::getAvailableDrivers());
    $mensagem .= "\nErros: " . $pe->getMessage();
    throw new Exception($mensagem);
}
?>