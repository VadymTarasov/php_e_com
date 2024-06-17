<?php
require_once 'ProductInMySQLRepository.php';

$productRepository = new ProductInMySQLRepository();

if (isset($_GET['id'])) {
    $productRepository->deleteProduct($_GET['id']);
    header("Location: admin.php");
    exit;
}
?>
