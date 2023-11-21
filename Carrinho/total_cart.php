<?php
require_once("mysqli_conexao.php");

$result->query("SELECT SUM(product_price) AS total FROM cart");
$total = $result->fetch(PDO::FETCH_ASSOC)['total'];

echo number_format($total, 2);
?>