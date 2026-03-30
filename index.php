<?php
$page = $_GET['page'] ?? 'product';
$allowed = ['product', 'category', 'customer_group', 'customer', 'product_media'];
if (!in_array($page, $allowed)) {
    $page = 'product';
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Task Module</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand px-3">
    <div class="navbar-nav">
        <a class="nav-link <?= $page === 'product'        ? 'active fw-bold' : '' ?>" href="?page=product">Product</a>
        <a class="nav-link <?= $page === 'category'       ? 'active fw-bold' : '' ?>" href="?page=category">Category</a>
        <a class="nav-link <?= $page === 'customer_group' ? 'active fw-bold' : '' ?>" href="?page=customer_group">Customer Group</a>
        <a class="nav-link <?= $page === 'customer'       ? 'active fw-bold' : '' ?>" href="?page=customer">Customer</a>
        <a class="nav-link <?= $page === 'product_media'  ? 'active fw-bold' : '' ?>" href="?page=product_media">Product Media</a>
    </div>
</nav>

<?php
$map = [
    'product'        => 'Product/list.php',
    'category'       => 'Category/list.php',
    'customer_group' => 'CustomerGroup/list.php',
    'customer'       => 'Customer/list.php',
    'product_media'  => 'ProductMedia/list.php',
];
include $map[$page];
?>

</body>
</html>
