<?php
$title = 'Admin Panel';
require_once 'templates/header.php';
?>

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

        <h1 class="mb-4">Admin Dashboard</h1>

        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addProductModal">
            Add Product
        </button>

        <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form enctype="multipart/form-data" method="post" action="add_product.php">
                            <div class="mb-3">
                                <label for="productName" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="productName" name="productName" required>
                            </div>
                            <div class="mb-3">
                                <label for="productDescription" class="form-label">Product Description</label>
                                <textarea class="form-control" id="productDescription" name="productDescription" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="productPrice" class="form-label">Product Price</label>
                                <input type="number" class="form-control" id="productPrice" name="productPrice" required>
                            </div>
                            <div class="mb-3">
                                <label for="productImage" class="form-label">Product Image</label>
                                <input type="file" class="form-control" id="productImage" name="productImage" accept="image/*" required>
                            </div>
                            <input type="hidden" name="addProduct" value="1">
                            <button type="submit" class="btn btn-success">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form enctype="multipart/form-data" method="post" action="edit_product.php">
                            <input type="hidden" name="editProduct" value="1">
                            <input type="hidden" id="productId" name="productId">
                            <input type="hidden" id="existingImage" name="existingImage">

                            <div class="mb-3">
                                <label for="productName" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="productName" name="productName" required>
                            </div>
                            <div class="mb-3">
                                <label for="productDescription" class="form-label">Product Description</label>
                                <textarea class="form-control" id="productDescription" name="productDescription" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="productPrice" class="form-label">Product Price</label>
                                <input type="number" class="form-control" id="productPrice" name="productPrice" required>
                            </div>
                            <div class="mb-3">
                                <label for="currentProductImage" class="form-label">Current Product Image</label><br>
                                <img id="currentProductImage" src="" style="max-width: 200px;" alt="Current Product Image">
                            </div>
                            <div class="mb-3">
                                <label for="newProductImage" class="form-label">New Product Image</label>
                                <input type="file" class="form-control" id="newProductImage" name="productImage" accept="image/*">
                            </div>

                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="mt-5">Existing Products</h2>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php require_once 'load_product_list.php'; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once 'templates/footer.php'; ?>
<script>
    function loadEditProductModal(productId) {
        $.ajax({
            url: 'get_product_details.php',
            type: 'POST',
            data: { productId: productId },
            success: function(response) {
                let product = JSON.parse(response);

                $('#editProductModal #productId').val(product.id);
                $('#editProductModal #productName').val(product.name);
                $('#editProductModal #productDescription').val(product.description);
                $('#editProductModal #productPrice').val(parseInt(product.price));

                $('#editProductModal #existingImage').val(product.image);
                $('#editProductModal #currentProductImage').attr('src', product.image);

                $('#editProductModal').modal('show');
            }
        });
    }
</script>

