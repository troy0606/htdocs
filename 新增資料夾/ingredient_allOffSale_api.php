<?php

require __DIR__ . '/ingredient_connect.php';

print_r($_POST);

$allOffSale_sid = $_POST['checkOne'];
$allOffSale_str = implode("','", $allOffSale_sid );
$allOffSale_sql = "UPDATE `ingredient` 
                SET `sale`=2  
                WHERE `sid` in ('{$allOffSale_str}') ";

$pdo->query($allOffSale_sql);
header('Location:'.$_SERVER['HTTP_REFERER']);


?>