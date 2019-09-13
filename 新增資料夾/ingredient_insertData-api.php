<?php
require __DIR__. '/ingredient_connect.php';

$result = [
    'success' => false,
    'code' => 400,
    'info' => '沒有輸入姓名'
];

if(empty($_POST['product_name'])){
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

$upload_dir = __DIR__ . '/uploads/';

$allowed_types = [
    'image/png',
    'image/jpeg',
];

$exts = [
    'image/png' => '.png',
    'image/jpeg' => '.jpg',
];


if (!empty($_FILES['pic_name'])) {
    foreach($_FILES['pic_name']['name'] as $k => $v){
        $new_filename = $_FILES['pic_name']['name'][$k];
        $new_ext = $exts[$_FILES['pic_name']['type'][$k]];
        move_uploaded_file($_FILES['pic_name']['tmp_name'][$k],$upload_dir.$new_filename.$new_ext);
        $pic_array[] = $new_filename.$new_ext;
    }
}


$array_pic = json_encode($pic_array, JSON_UNESCAPED_UNICODE);

$tag_str = (!empty($_POST['tag']))?json_encode($_POST['tag'], JSON_UNESCAPED_UNICODE):'[]';


$sql = "INSERT INTO `ingredient`(
    `pic_name`,
    `product_name`,
    `primary_category`, 
    `minor_category`, 
    `tag`, 
    `price`,
    `quantity`,
    `made_in`,
    `weight`,
    `ingredient`,
    `create_at`
    ) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,NOW())";

$stmt = $pdo->prepare($sql);

$stmt->execute([
        $array_pic,
        $_POST['product_name'],
        $_POST['primary_category'],
        $_POST['minor_category'],
        $tag_str,
        $_POST['price'],
        $_POST['quantity'],
        $_POST['made_in'],
        $_POST['weight'],
        $_POST['ingredient']
]);

if($stmt->rowCount()> 0){
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '新增成功';
} else {
    $result['code'] = 420;
    $result['info'] = '新增失敗';
    $result['error'] = $stmt;
}

header("Location:".$_SERVER['HTTP_REFERER']);
