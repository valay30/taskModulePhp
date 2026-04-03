<?php
require_once __DIR__ . '/customer_group.php';

$group = new CustomerGroup();
if (isset($_GET['id'])) {
    $group->load($_GET['id']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Customer Group Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><?= isset($_GET['id']) ? 'Edit Customer Group' : 'Add Customer Group' ?></h4>
        </div>
        <div class="card-body">
            <form method="POST" action="save.php">
                <input type="hidden" name="customer_group_id" value="<?= $group->customer_group_id ?>">

                <div class="mb-3">
                    <label class="form-label">Group Name</label>
                    <input type="text" name="group_name" class="form-control"
                           value="<?= $group->group_name ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3"><?= $group->description ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="1" <?= $group->status == 1 ? 'selected' : '' ?>>Active</option>
                        <option value="0" <?= $group->status == 0 ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="../index.php?page=customer_group" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success">
                        <?= isset($_GET['id']) ? 'Update Customer Group' : 'Save Customer Group' ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
