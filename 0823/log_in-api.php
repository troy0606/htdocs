<?php
    require __DIR__ . '/PDO.php';
    $result = [
        'success' => false,
        'code' => 400,
        'info' => '沒有輸入',
        'postData' => $_POST,
    ];
    if(empty($_POST['email']) or empty($_POST['password'])) {
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
        exit;
    } 



    $sql = "SELECT `id`, `email`, `nickname` FROM `members` WHERE `email`=? AND `password`=SHA1(?)";
    $stmt = $pdo->prepare($sql);
    // 使用$pdo的設定，prepare'準備'以($sql)的規格去取值

    $stmt->execute([
        $_POST['email'],
        $_POST['password']
    ]);
    
    $row = $stmt->fetch();

   if(! empty($row)){
       $_SESSION['loginUser'] = $row;

       $result['success'] = true;
       $result['code'] = 200;
       $result['info'] = '登入成功';
   }else{
        $result['code'] = 410;
        $result['info'] = '登入失敗';
   }

   echo json_encode($result, JSON_UNESCAPED_UNICODE);