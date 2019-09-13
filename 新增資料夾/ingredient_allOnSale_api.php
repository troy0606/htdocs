<?php

require __DIR__ . '/ingredient_connect.php';

print_r($_POST);

$allOnSale_sid = $_POST['checkOne'];
$allOnSale_str = implode("','", $allOnSale_sid );
$allOnSale_sql = "UPDATE `ingredient` 
                SET `sale`=1  
                WHERE `sid` in ('{$allOnSale_str}') ";

$pdo->query($allOnSale_sql);
header('Location:'.$_SERVER['HTTP_REFERER']);


?>