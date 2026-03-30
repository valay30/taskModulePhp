<?php
require_once __DIR__ . '/product.php';

$product = new Product();
$rows = $product->getAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Product List</h2>
        <a href="Product/form.php" class="btn btn-primary">New Product</a>
    </div>

    <?php if (isset($_GET['error']) && $_GET['error'] === 'noselect'): ?>
        <div class="alert alert-warning">Please select at least one record to delete.</div>
    <?php endif; ?>

    <form method="POST" action="Product/delete.php">

        <div class="mb-3">
            <button type="submit" class="btn btn-danger">Delete Selected</button>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover bg-white">
                <thead class="table-dark">
                    <tr>
                        <th>
                            <input type="checkbox" onclick="toggle(this)">
                        </th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Created Date</th>
                        <th>Updated Date</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if(!empty($rows)): ?>
                        <?php foreach($rows as $row): ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="ids[]" value="<?= $row['product_id'] ?>">
                            </td>
                            <td><?= $row['product_id'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['quantity'] ?></td>
                            <td>₹ <?= $row['price'] ?></td>
                            <td>
                                <?php if($row['status'] == 1): ?>
                                    <span class="badge bg-success">Enabled</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Disabled</span>
                                <?php endif; ?>
                            </td>
                            <td><?= $row['created_date'] ?></td>
                            <td><?= $row['updated_date'] ?></td>
                            <td><a href="Product/form.php?id=<?= $row['product_id'] ?>" class="btn btn-sm btn-warning">Edit</a></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="9" class="text-center">No products found.</td></tr>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>

    </form>

</div>

<script>
function toggle(source) {
    let checkboxes = document.getElementsByName('ids[]');
    for (let i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = source.checked;
    }
}
</script>

</body>
</html>