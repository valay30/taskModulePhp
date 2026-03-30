<?php
require_once __DIR__ . '/product.php';

if(empty($_POST['ids'])){
    header('Location: ../index.php?page=product&error=noselect');
    exit;
}

foreach($_POST['ids'] as $id){
    $product = new Product();
    $product->load($id);
    $product->delete();
}

header('Location: ../index.php?page=product');
exit;