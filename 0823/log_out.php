<?php
session_start();

unset($_SESSION['loginUser']);
// 清空$_SESSION['loginUser'] id 內的值
if(! empty($_SERVER['HTTP_REFERER'])){
    header("Location:".$_SERVER['HTTP_REFERER']);
    // 如果有過來的網址，自動轉回來源網址
}else{
    header("Location:datalist.php");
    // 否則前往datalist.php
}