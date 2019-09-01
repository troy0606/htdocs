<?php
session_start();
// session_destroy();

unset($_SESSION['user']);
if(! empty($_SERVER['HTTP_REFERER'])){
    header('Location: '. $_SERVER['HTTP_REFERER']);
} else {
    header('Location: a20190816_06_login.php');
}


