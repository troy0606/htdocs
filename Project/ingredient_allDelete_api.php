<?php

require __DIR__ . '/ingredient_connect.php';

print_r($_POST);

$allDelete_sid = $_POST['checkOne'];
$allDelete_str = implode("','", $allDelete_sid );
$allDelete_sql = "DELETE FROM `ingredient` 
                WHERE `sid` in ('{$allDelete_str}') ";
$pdo->query($allDelete_sql);
header('Location:'.$_SERVER['HTTP_REFERER']);


?>