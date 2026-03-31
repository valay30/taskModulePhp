<?php
require_once __DIR__ . '/category.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = new Category();
    $id = $_POST['category_id'] ?? '';

    if ($id !== '') {
        $category->load($id);
    }

    $skip = ['category_id'];
    foreach ($_POST as $key => $value) {
        if (!in_array($key, $skip)) {
            $category->value($key, $value);
        }
    }

    if ($id === '') {
        $category->value('created_date', date('Y-m-d H:i:s'));
    } else {
        $category->value('updated_date', date('Y-m-d H:i:s'));
    }

    $category->save();
}

header('Location: ../index.php?page=category');
exit;
