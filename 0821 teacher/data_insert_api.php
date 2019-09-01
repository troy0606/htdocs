<?php
require __DIR__. '/__connect_db.php';

# 如果沒有輸入必要欄位, 就離開
if(empty($_POST['name'])){
    exit;
}

$sql = "INSERT INTO `address_book`(
            `name`, `email`, `mobile`, `birthday`, `address`, `created_at`
            ) VALUES (?, ?, ?, ?, ?, NOW())";

$stmt = $pdo->prepare($sql);

$stmt->execute([
        $_POST['name'],
        $_POST['email'],
        $_POST['mobile'],
        $_POST['birthday'],
        $_POST['address'],
]);

echo $stmt->rowCount();











