<?php 
$cate_sid = isset($_GET['cate_sid']) ? $_GET['cate_sid'] : "10";

$sql = sprintf("SELECT `ingredient` * FROM `ingredient` JOIN `categories` ON `ingredient`.`minor_category` = %s LIMIT %s,%s", $sequence, ($page - 1) * $perPage, $perPage);
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll();