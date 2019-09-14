<?php
require __DIR__ . "/ingredient_connect.php";
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
// $totalPage = $totalRows / $perPage;
$tst = $pdo->query('SELECT COUNT(*) FROM `ingredient`');
$perPage = 10;
$totalRows = $tst->fetch(PDO::FETCH_NUM)[0];
$totalPages = ceil($totalRows / $perPage);
if ($page < 1) {
    header("Location:ingredient_datalist.php?page=1");
    $page = 1;
}
if ($page > $totalPages) {
    header("Location:ingredient_datalist.php?page={$totalPages}");
    $page = $totalPages;
}

$params = [];

$ingredient_column = isset($_POST['ingredient_column']) ? $_POST['ingredient_column'] : "sid";
$ingredient_up_down = isset($_POST['ingredient_up_down']) ? $_POST['ingredient_up_down'] : "ASC";
$params['ingredient_column'] = $ingredient_column;
$params['ingredient_up_down'] = $ingredient_up_down;


$sql = sprintf(
    "SELECT `ingredient`.* ,`on-sale`.* 
FROM `ingredient` 
JOIN `on-sale` 
ON `ingredient`.`sale` = `on-sale`.`sale_sid` 
ORDER BY `%s` %s
LIMIT %s,%s",
    $ingredient_column,
    $ingredient_up_down,
    ($page - 1) * $perPage,
    $perPage
);
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll();

$result = [
    'page' => $page,
    'perPage' => $perPage, 
    'totalPages' => $totalPages,
    'totalRows' => $totalRows,
    'rows' => $rows
];

if(!empty ($_GET['inputPassword2'])){
    $search = $_GET['inputPassword2'];
    $tst = $pdo->query("SELECT COUNT(*) FROM `ingredient` WHERE `ingredient`.`sid`= $search");
    $tst = $tst ->fetch();
    $tst = (intval($tst['COUNT(*)']));
    if($tst>0){
        session_start();
        $_SESSION['search'] = $search;
        header('Location: ingredient_search.php');
    }else{
        header('Location: ingredient_datalist.php');
    }
}

$sql = "SELECT `ingredient`.`sid` FROM `ingredient`";

echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>