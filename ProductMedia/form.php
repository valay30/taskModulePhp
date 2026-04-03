<?php
require_once __DIR__ . '/product_media.php';
require_once __DIR__ . '/../Product/product.php';

$media = new ProductMedia();
if (isset($_GET['id'])) {
    $media->load($_GET['id']);
}

$productModel = new Product();
$products = $productModel->getAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Product Media Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><?= isset($_GET['id']) ? 'Edit Product Media' : 'Add Product Media' ?></h4>
        </div>
        <div class="card-body">
            <form method="POST" action="save.php">
                <input type="hidden" name="product_media_id" value="<?= $media->product_media_id ?>">

                <div class="mb-3">
                    <label class="form-label">Product</label>
                    <select name="product_id" class="form-select" required>
                        <option value="">— Select Product —</option>
                        <?php foreach ($products as $p): ?>
                            <option value="<?= $p['product_id'] ?>"
                                <?= $media->product_id == $p['product_id'] ? 'selected' : '' ?>>
                                <?= $p['name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">File Path</label>
                    <input type="text" name="file_path" class="form-control"
                           value="<?= $media->file_path ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alt Text</label>
                    <input type="text" name="alt_text" class="form-control"
                           value="<?= $media->alt_text ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Sort Order</label>
                    <input type="number" step="0.01" name="sort_order" class="form-control"
                           value="<?= $media->sort_order ?? '0' ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Is Primary</label>
                    <select name="is_primary" class="form-select" required>
                        <option value="1" <?= $media->is_primary == 1 ? 'selected' : '' ?>>Yes</option>
                        <option value="0" <?= $media->is_primary == 0 ? 'selected' : '' ?>>No</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="../index.php?page=product_media" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success">
                        <?= isset($_GET['id']) ? 'Update Media' : 'Save Media' ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
