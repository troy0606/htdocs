<?php
require __DIR__ . "/ingredient_connect.php";

$order = isset($_POST['order'])?$_POST['order']:'create-down';
$ingredient_column;
$ingredient_up_down;

switch($order){
    case 'quantity-up':
    $ingredient_column = 'quantity';
    $ingredient_up_down = 'ASC';
    break;
    case 'quantity-down':
    $ingredient_column = 'quantity';
    $ingredient_up_down = 'DESC';
    break;
    case 'price-up':
    $ingredient_column = 'price';
    $ingredient_up_down = 'ASC';
    break;
    case 'price-down':
    $ingredient_column = 'price';
    $ingredient_up_down = 'DESC';
    break;
    case 'create-up':
    $ingredient_column = 'create_at';
    $ingredient_up_down = 'ASC';
    break;
    case 'create-down':
    $ingredient_column = 'create_at';
    $ingredient_up_down = 'DESC';
    break;
}

$status = isset($_POST['status'])?($_POST['status']):'all';
$condition;

switch($status){
    case 'all':
    $condition = '1';
    break;
    case 'on_sale':
    $condition = 'sale = 1';
    break;
    case 'off_sale':
    $condition = 'sale = 2';
    break;
    case 'lack_stock':
    $condition = 'quantity <= 11';
    break;
    case 'no_stock':
    $condition = 'quantity = 0';
    break;
}

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
// $totalPage = $totalRows / $perPage;
$tst = $pdo->query("SELECT COUNT(*) FROM `ingredient` WHERE $condition");
$perPage = 10;
$totalRows = $tst->fetch(PDO::FETCH_NUM)[0];
$totalPages = ceil($totalRows / $perPage);




$sql = sprintf(
    "SELECT `ingredient`.* ,`on-sale`.* 
FROM `ingredient` 
JOIN `on-sale` 
ON `ingredient`.`sale` = `on-sale`.`sale_sid`
WHERE %s
ORDER BY `%s` %s
LIMIT %s,%s",
    $condition,
    $ingredient_column,
    $ingredient_up_down,
    ($page - 1) * $perPage,
    $perPage
);
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll();

$result = [
    'order' => $order,
    'condition' => $condition,
    'page' => $page,
    'perPage' => $perPage, 
    'totalPages' => $totalPages,
    'totalRows' => $totalRows,
    'rows' => $rows
];


// $sql = "SELECT `ingredient`.`sid` FROM `ingredient`";

echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>