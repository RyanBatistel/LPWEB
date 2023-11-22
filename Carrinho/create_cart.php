<?php
require_once("mysqli_conexao.php");

if(isset($_POST['submit'])){
    $productId = mysqli_real_escape_string($conn, $_POST['product_id']);
    $productName = mysqli_real_escape_string($conn, $_POST['product_name']);
    $productPrice = mysqli_real_escape_string($conn, $_POST['product_price']);

    $stmt = $db->prepare("INSERT INTO cart (product_id, product_name, product_price) VALUES (?, ?, ?)");
    $stmt->execute([$productId, $productName, $productPrice]);
}

header('Location: produtos.html');
?>
