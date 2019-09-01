<?php
    require __DIR__. "/admin.php";
    // 除非$session['loginUser']裡有值否則不往下執行
    require __DIR__. "/PDO.php";

    $sid = isset($_GET['sid'])? intval($_GET['sid']):0;
    // 如果有get到client端傳來的sid值回傳給變數$sid，否則回傳0
    if(!empty($sid)){
        // 如果變數$sid的值不為0
        $sql = "DELETE FROM `address_book` WHERE `sid`=$sid";
        $pdo->query($sql);
        // 到資料表刪除該變數$sid的所有欄位
    }
    header("Location: ".$_SERVER['HTTP_REFERER']);
    // 跳回來源網址
?>
