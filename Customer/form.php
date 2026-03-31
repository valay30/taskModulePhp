<?php
require_once __DIR__ . '/customer.php';
require_once __DIR__ . '/../CustomerGroup/customer_group.php';

$customer = new Customer();
if (isset($_GET['id'])) {
    $customer->load($_GET['id']);
}

$groupModel = new CustomerGroup();
$groups = $groupModel->getAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Customer Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><?= isset($_GET['id']) ? 'Edit Customer' : 'Add Customer' ?></h4>
        </div>
        <div class="card-body">
            <form method="POST" action="save.php">
                <input type="hidden" name="customer_id" value="<?= $customer->value('customer_id') ?>">

                <div class="mb-3">
                    <label class="form-label">Customer Group</label>
                    <select name="customer_group_id" class="form-select">
                        <option value="">— None —</option>
                        <?php foreach ($groups as $g): ?>
                            <option value="<?= $g['customer_group_id'] ?>"
                                <?= $customer->value('customer_group_id') == $g['customer_group_id'] ? 'selected' : '' ?>>
                                <?= $g['group_name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control"
                               value="<?= $customer->value('first_name') ?>" required>
                    </div>
                    <div class="col">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control"
                               value="<?= $customer->value('last_name') ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control"
                           value="<?= $customer->value('email') ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control"
                           value="<?= $customer->value('phone') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="1" <?= $customer->value('status') == 1 ? 'selected' : '' ?>>Active</option>
                        <option value="0" <?= $customer->value('status') == 0 ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="../index.php?page=customer" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success">
                        <?= isset($_GET['id']) ? 'Update Customer' : 'Save Customer' ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
