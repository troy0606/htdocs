<?php
    require __DIR__ . '/PDO.php';
    $result = [
        'success' => false,
        'code' => 400,
        'info' => '沒有輸入名稱',
        'postData' => $_POST,
    ];
    if(empty($_POST['name'])) {
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
        exit;
    } 



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

    // echo "資料新增{$stmt->rowCount()}筆";

   if($stmt->rowCount()==1){
       $result['success'] = true;
       $result['code'] = 200;
       $result['info'] = '資料新增完成';
   }else{
        $result['code'] = 410;
        $result['info'] = '資料沒有新增';
   }

   echo json_encode($result, JSON_UNESCAPED_UNICODE);