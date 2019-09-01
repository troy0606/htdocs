<?php require __DIR__ . '/PDO.php';
$perPage = 10;

$totoalSql = $pdo->query('SELECT COUNT(*) FROM `address_book`');
$totalrows = $totoalSql->fetch(PDO::FETCH_NUM)[0];
echo $totalrows. "<br>";

$totalPage = ceil($totalrows / $perPage);
echo $totalPage. "<br>";
?>

