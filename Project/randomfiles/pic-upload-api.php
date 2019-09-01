<?php

$upload_dir = __DIR__. '/uploads/';

$allowed_types = [
    'image/png',
    'image/jpeg',
];

$exts = [
    'image/png' => '.png',
    'image/jpeg' => '.jpg',
];


if(!empty($_FILES['pic_name'])){ // 有沒有上傳
    if(in_array($_FILES['pic_name']['type'], $allowed_types)) { // 檔案類型是否允許

        $new_filename = sha1(uniqid(). $_FILES['pic_name']['name']);
        $new_ext = $exts[$_FILES['pic_name']['type']];


        move_uploaded_file($_FILES['pic_name']['tmp_name'], $upload_dir. $new_filename. $new_ext);
    }
}


?>