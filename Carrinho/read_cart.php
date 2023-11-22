<?php
require_once("mysqli_conexao.php");

$result->mysqli_query($conn, "SELECT * FROM cart");
$cartItems = $result->fetchAll(PDO::FETCH_ASSOC);

foreach ($cartItems as $item) {
    echo "<li>{$item['product_name']} - R${$item['product_price']}</li>";
}
?>
