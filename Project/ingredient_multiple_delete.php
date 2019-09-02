<?php
$page_name = 'datalist';
$page_title = '全部商品列表';
require __DIR__ . "/ingredient_connect.php";


$sid = $_POST['checkForm'];

$str = implode("','",$sid);

$sql = "DELETE FROM `ingredient` WHERE `sid` in ('{$str}') ";

$pdo->query($sql);

header("Location:".$_SERVER['HTTP_REFERER']);

?>