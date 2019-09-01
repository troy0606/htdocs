<?php
    session_start();
    // 開啟session
    if(! isset($_SESSION['loginUser'])){
        header("Location: datalist.php");
        exit;
        // 如果$_SESSION['loginUser'] ID 沒有設定，自動跳轉回datalist.php，結束程式執行
    }