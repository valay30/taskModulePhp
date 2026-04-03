<?php
require_once __DIR__ . '/product.php';

$product = new Product();

if(isset($_GET['id'])){
    $product->load($_GET['id']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Form</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                <?= isset($_GET['id']) ? 'Edit Product' : 'Add Product' ?>
            </h4>
        </div>

        <div class="card-body">
            <form method="POST" action="save.php">
                <input type="hidden" name="product_id" value="<?= $product->product_id ?>">

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control"
                           value="<?= $product->name ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Quantity</label>
                    <input type="number" name="quantity" class="form-control"
                           value="<?= $product->quantity ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="text" name="price" class="form-control"
                           value="<?= $product->price ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3"><?= $product->description ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="1" <?= $product->status == 1 ? 'selected' : '' ?>>Enabled</option>
                        <option value="2" <?= $product->status == 2 ? 'selected' : '' ?>>Disabled</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="../index.php?page=product" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success">
                        <?= isset($_GET['id']) ? 'Update Product' : 'Add Product' ?>
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

</body>
</html>