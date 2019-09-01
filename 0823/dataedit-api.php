<?php
    require __DIR__ . '/PDO.php';
    $result = [
        'success' => false,
        'code' => 400,
        'info' => '沒有輸入名稱',
        'postData' => $_POST,
    ];
    if(empty($_POST['name']) or empty($_POST['sid'])) {
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
        exit;
    } 



    $sql = $sql = "UPDATE `address_book` 
    SET
     `name`=?,
     `email`=?,
     `mobile`=?,
     `birthday`=?,
     `address`=?
     WHERE `sid`=?";
    // 設定欄位的值(條件`sid` 等於取得的前端sid) 

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $_POST['name'],
        $_POST['email'],
        $_POST['mobile'],
        $_POST['birthday'],
        $_POST['address'],
        $_POST['sid']
    ]);

    // echo "資料新增{$stmt->rowCount()}筆";

   if($stmt->rowCount()==1){
       $result['success'] = true;
       $result['code'] = 200;
       $result['info'] = '資料修改完成';
   }else{
        $result['code'] = 410;
        $result['info'] = '資料沒有修改';
   }

   echo json_encode($result, JSON_UNESCAPED_UNICODE);