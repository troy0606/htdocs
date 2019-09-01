<?php
session_start();
// php預設session 為off，使用session讀取或設定都必須session_start()
    if(! isset($_SESSION['mySession'])){
        // 如果 $_SESSION['mySession'] 還沒設定，則先給初始值1
        $_SESSION['mySession'] = 1;
    }else{
        $_SESSION['mySession'] ++;
        // 如果 $_SESSION['mySession'] 已設定，則$_SESSION['mySession']值++
    };

    echo $_SESSION['mySession'];
?>