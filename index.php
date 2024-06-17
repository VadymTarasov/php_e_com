<?php
$title = 'Home';

require_once 'ProductInMySQLRepository.php';
$productRepository = new ProductInMySQLRepository();
$products = $productRepository->getAllProducts();
?>

<?php require_once 'templates/header.php'; ?>

<div class="content">
    <div class="container">
        <header class="d-flex justify-content-center py-3">
            <ul class="nav nav-pills">
                <li class="nav-item"><a href="index.php" class="nav-link" aria-current="page">Home</a></li>
                <li class="nav-item">
                    <a href="admin.php" class="nav-link">Admin</a>
                </li>
            </ul>
        </header>
    </div>

    <div class="container mt-5">
        <h1 class="mb-4">Products</h1>
        <div class="row">
            <?php
            foreach ($products as $product) {
                echo '
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="' . $product['image'] . '" class="card-img-top" alt="' . $product['name'] . '">
                        <div class="card-body">
                            <h5 class="card-title">' . $product['name'] . '</h5>
                            <p class="card-text">$' . $product['price'] . '</p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal' . $product['id'] . '">Details</button>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="productModal' . $product['id'] . '" tabindex="-1" aria-labelledby="productModalLabel' . $product['id'] . '" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="productModalLabel' . $product['id'] . '">' . $product['name'] . '</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img src="' . $product['image'] . '" class="img-fluid mb-3" alt="' . $product['name'] . '">
                                <p>' . $product['description'] . '</p>
                                <p><strong>Price: $' . $product['price'] . '</strong></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                ';
            }
            ?>
        </div>
    </div>
</div>

<?php require_once 'templates/footer.php'; ?>
