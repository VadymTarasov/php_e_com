<?php
require_once 'ProductInMySQLRepository.php';

$productRepository = new ProductInMySQLRepository();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = $_POST['productId'];
    $product = $productRepository->getProductById($productId);
    echo json_encode($product);
}
?>
