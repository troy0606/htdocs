<?php
require __DIR__. '/__connect_db.php';

$result = [
    'success' => false,
    'code' => 400,
    'info' => '資料欄位不足',
    'post' => $_POST,
];


# 如果沒有輸入必要欄位
if(empty($_POST['email']) or empty($_POST['password'])){
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "SELECT `id`, `email`, `nickname` FROM `members` WHERE `email`=? AND `password`=SHA1(?)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
        $_POST['email'],
        $_POST['password'],
]);
$row = $stmt->fetch();
if(! empty($row)){
    $_SESSION['loginUser'] = $row;

    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '登入成功';
} else {
    $result['code'] = 420;
    $result['info'] = '登入失敗';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);








