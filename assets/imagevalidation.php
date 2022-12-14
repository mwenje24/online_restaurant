<?php
$imagePath ='';

if(!is_dir(__DIR__.'images')){
    mkdir(__DIR__.'images');
}
if($_SERVER['REQUEST_METHOD'] ==='POST'){

    $image =$_FILES['image'];
    $imagePath = $product['image'];


    if($image && $image['tmp_name']){
        if($product['image']){
            unlink(__DIR__.'../'.$product['image']);
        }
        $imagePath = 'images/'.randomString(8).'/'.$image['name'];
        mkdir(dirname(__DIR__.'../'.$imagePath));
        move_uploaded_file($image['tmp_name'], __DIR__.'../'.$imagePath);
    }

}

?>