<?php
require_once 'ProductInMySQLRepository.php';

$productRepository = new ProductInMySQLRepository();
$products = $productRepository->getAllProducts();

foreach ($products as $product) {
    $formattedPrice = number_format($product['price'], 0, '.', '');

    echo '
    <tr>
        <td>' . $product['id'] . '</td>
        <td id="productName_' . $product['id'] . '">' . $product['name'] . '</td>
        <td id="productDescription_' . $product['id'] . '">' . $product['description'] . '</td>
        <td id="productPrice_' . $product['id'] . '">$' . $formattedPrice . '</td>
        <td><img id="productImage_' . $product['id'] . '" src="' . $product['image'] . '" style="max-width: 100px;" alt="image"></td>
        <td>
            <button type="button" class="btn btn-sm btn-primary" onclick="loadEditProductModal(' . $product['id'] . ')">edit</button>
            <a href="delete_product.php?id=' . $product['id'] . '" class="btn btn-sm btn-danger">delete</a>
        </td>
    </tr>';
}
?>
