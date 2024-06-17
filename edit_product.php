<?php
require_once 'ProductInMySQLRepository.php';

$productRepository = new ProductInMySQLRepository();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editProduct'])) {
    $id = $_POST['productId'];
    $name = $_POST['productName'];
    $description = $_POST['productDescription'];
    $price = $_POST['productPrice'];

    $image = $_POST['existingImage'];
    if (isset($_FILES['productImage']) && $_FILES['productImage']['error'] == UPLOAD_ERR_OK) {
        $image = 'uploads/' . basename($_FILES['productImage']['name']);
        move_uploaded_file($_FILES['productImage']['tmp_name'], $image);
    }

    $productRepository->updateProduct($id, $name, $description, $price, $image);
    header("Location: admin.php");
    exit;
} else {
    header("Location: admin.php");
    exit;
}
?>
