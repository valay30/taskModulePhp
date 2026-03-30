<?php
require_once __DIR__ . '/product.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $product = new Product();

    if($id !== ''){
        $product->load($id);
    }

    $skip = ['product_id'];
    foreach ($_POST as $key => $value) {
        if (!in_array($key, $skip)) {
            $product->value($key, $value);
        }
    }

    if($id === ''){
        $product->value('created_date', date('Y-m-d H:i:s'));
    }else{
        $product->value('updated_date', date('Y-m-d H:i:s'));
    }
    $product->save();
}  

header('Location: ../index.php?page=product');
exit;
