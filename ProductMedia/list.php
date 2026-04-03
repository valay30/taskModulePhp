<?php
require_once __DIR__ . '/product_media.php';
require_once __DIR__ . '/../Product/product.php';

$media = new ProductMedia();
$rows  = $media->getAll();

$productModel = new Product();
$products     = $productModel->getAll();
$productMap   = [];
foreach ($products as $p) {
    $productMap[$p->product_id] = $p->name;
}
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Product Media List</h2>
        <a href="ProductMedia/form.php" class="btn btn-primary">New Product Media</a>
    </div>

    <?php if (isset($_GET['error']) && $_GET['error'] === 'noselect'): ?>
        <div class="alert alert-warning">Please select at least one record to delete.</div>
    <?php endif; ?>

    <form method="POST" action="ProductMedia/delete.php">
        <div class="mb-2">
            <button type="submit" class="btn btn-danger btn-sm">Delete Selected</button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover bg-white">
                <thead class="table-dark">
                    <tr>
                        <th><input type="checkbox" onclick="toggleAll(this,'ids[]')"></th>
                        <th>ID</th>
                        <th>Product</th>
                        <th>File Path</th>
                        <th>Alt Text</th>
                        <th>Sort Order</th>
                        <th>Is Primary</th>
                        <th>Created Date</th>
                        <th>Updated Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($rows)): ?>
                        <?php foreach ($rows as $row): ?>
                        <tr>
                            <td><input type="checkbox" name="ids[]" value="<?= $row->product_media_id ?>"></td>
                            <td><?= $row->product_media_id ?></td>
                            <td><?= htmlspecialchars($productMap[$row->product_id] ?? '—') ?></td>
                            <td><?= htmlspecialchars($row->file_path) ?></td>
                            <td><?= htmlspecialchars($row->alt_text ?? '') ?></td>
                            <td><?= $row->sort_order ?></td>
                            <td>
                                <?php if ($row->is_primary == 1): ?>
                                    <span class="badge bg-success">Yes</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">No</span>
                                <?php endif; ?>
                            </td>
                            <td><?= $row->created_date ?></td>
                            <td><?= $row->updated_date ?></td>
                            <td><a href="ProductMedia/form.php?id=<?= $row->product_media_id ?>" class="btn btn-sm btn-warning">Edit</a></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="10" class="text-center">No product media found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </form>
</div>

<script>
function toggleAll(src, name) {
    document.querySelectorAll('input[name="' + name + '"]').forEach(cb => cb.checked = src.checked);
}
</script>
