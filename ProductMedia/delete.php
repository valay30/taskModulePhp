<?php
require_once __DIR__ . '/product_media.php';

if(empty($_POST['ids'])){
    header('Location: ../index.php?page=product_media&error=noselect');
    exit;
}

foreach($_POST['ids'] as $id){
    $media = new ProductMedia();
    $media->load($id);
    $media->delete();
}

header('Location: ../index.php?page=product_media');
exit;
?>