<?php
require_once __DIR__ . '/customer.php';
require_once __DIR__ . '/../CustomerGroup/customer_group.php';

$customer = new Customer();
$rows = $customer->getAll();

$groupModel = new CustomerGroup();
$groupRows  = $groupModel->getAll();
$groupMap   = [];
foreach ($groupRows as $g) {
    $groupMap[$g['customer_group_id']] = $g['group_name'];
}
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Customer List</h2>
        <a href="Customer/form.php" class="btn btn-primary">New Customer</a>
    </div>

    <?php if (isset($_GET['error']) && $_GET['error'] === 'noselect'): ?>
        <div class="alert alert-warning">Please select at least one record to delete.</div>
    <?php endif; ?>

    <form method="POST" action="Customer/delete.php">
        <div class="mb-2">
            <button type="submit" class="btn btn-danger btn-sm">Delete Selected</button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover bg-white">
                <thead class="table-dark">
                    <tr>
                        <th><input type="checkbox" onclick="toggleAll(this,'ids[]')"></th>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Customer Group</th>
                        <th>Status</th>
                        <th>Created Date</th>
                        <th>Updated Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($rows)): ?>
                        <?php foreach ($rows as $row): ?>
                        <tr>
                            <td><input type="checkbox" name="ids[]" value="<?= $row['customer_id'] ?>"></td>
                            <td><?= $row['customer_id'] ?></td>
                            <td><?= htmlspecialchars($row['first_name']) ?></td>
                            <td><?= htmlspecialchars($row['last_name']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['phone'] ?? '') ?></td>
                            <td><?= htmlspecialchars($groupMap[$row['customer_group_id']] ?? '—') ?></td>
                            <td>
                                <?php if ($row['status'] == 1): ?>
                                    <span class="badge bg-success">Active</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Inactive</span>
                                <?php endif; ?>
                            </td>
                            <td><?= $row['created_date'] ?></td>
                            <td><?= $row['updated_date'] ?></td>
                            <td><a href="Customer/form.php?id=<?= $row['customer_id'] ?>" class="btn btn-sm btn-warning">Edit</a></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="11" class="text-center">No customers found.</td></tr>
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
