<?php
function conectarAoBanco() {
    $servidor = 'localhost';
    $usuario = 'root';
    $senha = '';
    $bancodedados = 'microondas';
    $porta = '3306';

    $conn = mysqli_connect($servidor, $usuario, $senha, $bancodedados, $porta);

    // Verificando a conexão
    if (!$conn) {
        die("Conexão falhou: " . mysqli_connect_error());
    }

    return $conn;
}

function fecharConexao($conn) {
    // Fechando a Conexão
    mysqli_close($conn);
}

$conn = conectarAoBanco();

?>
