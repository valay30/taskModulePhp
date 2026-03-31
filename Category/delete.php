<?php
require_once __DIR__ . '/category.php';

if(empty($_POST['ids'])){
    header('Location: ../index.php?page=category&error=noselect');
    exit;
}

foreach($_POST['ids'] as $id){
    $category = new Category();
    $category->load($id);
    $category->delete();
}

header('Location: ../index.php?page=category');
exit;

?>