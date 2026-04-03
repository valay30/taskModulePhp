<?php
require_once __DIR__ . '/category.php';

$category = new Category();
if(isset($_GET['ids'])){
    $category->load($_GET['ids']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Category Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><?= isset($_GET['id']) ? 'Edit Category' : 'Add Category' ?></h4>
        </div>

        <div class="card-body">
            <form method="POST" action="save.php">
                <input type="hidden" name="category_id" value="<?= $category->category_id ?>">

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control"
                           value="<?= $category->name ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3"><?= $category->description ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="1" <?= $category->status == 1 ? 'selected' : '' ?>>Active</option>
                        <option value="0" <?= $category->status == 0 ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="../index.php?page=category" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success">
                        <?= isset($_GET['id']) ? 'Update Category' : 'Save Category' ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>