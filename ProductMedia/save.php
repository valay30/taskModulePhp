<?php
require_once __DIR__ . '/product_media.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $media = new ProductMedia();
    $id = $_POST['product_media_id'] ?? '';

    if($id === ''){
        $media->load($id); 
    }

    $skip = ['product_media_id'];
    foreach($_POST as $key => $value){
        if(!in_array($key,$skip)){
            $media->$key = $value;
        }
    }

    if($id === ''){
        $media -> created_date = date('Y-m-d H:i:s');
    }else{
        $media -> updated_date = date('Y-m-d H:i:s');
    }

    $media->save();
}

header('Location: ../index.php?page=product_media');
exit;
?>