<?php

$servidor_s = 'localhost';
$usuario_u = 'root';
$bancodados_d = 'microondas';
$senha_p = '';

$conexao = mysqli_connect($servidor_s, $usuario_u, $senha_p, $bancodados_d);

if(!$conexao) {
    die("conexao falhou: " . mysqli_connect_error());
}
echo "banco de dados conectado";

mysqli_close($conexao);
