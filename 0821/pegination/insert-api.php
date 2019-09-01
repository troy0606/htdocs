<?php
    require __DIR__ . '/PDO.php';
    // 連上
    $result = [
        'success' => false,
        'code' => 400,
        'info' => '參數不足',
        'postData' => [],
    ];
    if(empty($_POST['name'])) exit; 

    $sql = "INSERT INTO `address_book`
    (`name`, `email`, `mobile`, `address`, `birthday`, `create_at`) 
    VALUES (?,?,?,?,?,NOW())";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['name'],
        $_POST['email'],
        $_POST['mobile'],
        $_POST['address'],
        $_POST['birthday']
    ]);

   if($stmt->rowCount()>1){
       $result['success'] = true;
       $result['code'] = 200;
       $result['info'] = '資料新增完成';
   }else{
        $result['code'] = 410;
        $result['info'] = '資料沒有新增';
   }

   echo json_encode($result, JSON_UNESCAPED_UNICODE);