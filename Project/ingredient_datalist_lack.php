<?php
$page_name = 'ingredient_datalist_lack';
$page_title = '上架商品列表';
require __DIR__ . "/ingredient_connect.php";
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
// $totalPage = $totalRows / $perPage;
$tst = $pdo->query('SELECT COUNT(*) FROM `ingredient` WHERE `ingredient`.`quantity` < 11 ');

$perPage = 10;
$totalRows = $tst->fetch(PDO::FETCH_NUM)[0];
$totalPages = ceil($totalRows / $perPage);

if ($page < 1) {
    header("Location:ingredient_datalist_lack.php?page=1");
    $page = 1;
}
if ($page > $totalPages) {
    header("Location:ingredient_datalist_lack.php?page={$totalPages}");
    $page = $totalPages;
}

$sequence = isset($_GET['sequence']) ? $_GET['sequence'] : "sid";
// $sort = "ASC";

$sql = sprintf(
    "SELECT `ingredient`.* ,`on-sale`.* 
FROM `ingredient` 
JOIN `on-sale` 
ON `ingredient`.`sale` = `on-sale`.`sale_sid` 
WHERE `ingredient`.`quantity` < 11 
ORDER BY `%s` %s 
LIMIT %s,%s",
    $sequence,
    "DESC",
    ($page - 1) * $perPage,
    $perPage
);

$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll();

?>
<?php
require __DIR__ . "/html_head_in.php";
require __DIR__ . "/navbar_in.php";
require __DIR__ . "/ingredient_navbar.php";
?>
<style>
    .main-section {
        width: 90%;
        margin: auto;
    }

    .form-group small {
        color: red;
    }
</style>
<div style="margin-top:2rem;">
    <nav class="navbar navbar-expand-lg">
        <div class="collapse navbar-collapse justify-content-between align-items-center" id="navbarSupportedContent">
            <nav>
                <ul class="navbar-nav">
                    <li class="nav-item <?= $page_name == 'datalist' ? 'active' : '' ?> ">
                        <a class="nav-link" href="ingredient_datalist_lack.php"><button type="button" class="btn btn-outline-warning" style="width:100px;">批量刪除</button></a>
                    </li>
                </ul>
            </nav>
            <nav aria-label="Page navigation example">
                <ul class="pagination" style="margin:0;">
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page - 10 ?>">
                            <i class="fas fa-angle-double-left"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page - 1 ?>">
                            <i class="fas fa-angle-left"></i>
                        </a>
                    </li>
                    <?php
                    if ($totalPages < 10) {
                        $p_start = 1;
                        $p_end = $totalPages;
                    } else if ($page - 4 < 1) {
                        $p_start = 1;
                        $p_end = 9;
                    } else if ($page + 4 > $totalPages) {
                        $p_start = $totalPages - 9;
                        $p_end = $totalPages;
                    } else {
                        $p_start = $page - 4;
                        $p_end = $page + 4;
                    }
                    for ($i = $p_start; $i < $p_end + 1; $i++) :
                        ?>
                        <li class="page-item  <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link" style="margin:0 auto;" href="ingredient_datalist_lack.php?page=<?php echo $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page + 1 ?>">
                            <i class="fas fa-angle-right"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page + 10 ?>">
                            <i class="fas fa-angle-double-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <form class="form-inline">
                <div class="form-group mx-sm-3 mb-2" style="margin:8px;">
                    <label for="inputPassword2" class="sr-only"></label>
                    <input type="text" class="form-control" id="inputPassword2" placeholder="請輸入商品編號">
                </div>
                <button type="submit" class="btn btn-primary mb-2" style="margin:8px;"><i class="fas fa-search"></i> Search</button>
            </form>
        </div>
    </nav>
</div>
<div style="margin-top:2rem;"></div>
<div class="main-section">
    <table class="table table-hover table-dark">
        <thead>
            <tr>
                <th scope="col">商品圖</th>
                <th scope="col"><a href="?sequence=sid">商品品號</a></th>
                <th scope="col">食材名稱</th>
                <th scope="col"><a href="?sequence=price">價格</a></th>
                <th scope="col">數量</th>
                <th scope="col">商品狀態</th>
                <th scope="col"><a href="?sequence=create_at">新增時間</th>
                <th scope="col"><i class="fas fa-trash"></i></th>
                <th scope="col"><i class="fas fa-book"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $r) : ?>
                <tr>
                    <td><img src="<?= 'uploads/' . json_decode($r['pic_name'])[0] ?>" height='100px'></td>
                    <td><?= htmlentities("{$r['sid']}") ?></td>
                    <td><?= htmlentities("{$r['product_name']}") ?></td>
                    <td><?= htmlentities("{$r['price']}") ?></td>
                    <td><?= htmlentities("{$r['quantity']}") ?></td>
                    <td><?= htmlentities("{$r['on_sale_status']}") ?></td>
                    <td><?= htmlentities("{$r['create_at']}") ?></td>
                    <td>
                        <a href="javascript:delete2(<?= $r['sid'] ?>)">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                    <td><a href="ingredient_edit.php?sid=<?= $r['sid'] ?>"><i class="fas fa-book"></i></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    function delete2(sid) {
        if (confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)) {
            location.href = 'ingredient_delete.php?sid=' + sid;
        }
    }
</script>
<?php
require __DIR__ . "/footer_in.php";
?>