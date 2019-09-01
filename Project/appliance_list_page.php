<?php

require __DIR__ . '/__connect_db.php';

$page_name = 'appliance_list_page';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$per_page = 10;

$t_sql = "SELECT COUNT(1) FROM `appliance_list` ";

$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$totalPages = ceil($totalRows / $per_page);

if ($page < 1) {
    header('Location: appliance_list_page.php');
    exit;
}

if ($page > $totalPages) {
    header('Location: appliance_list_page.php?page=' . $totalPages);
    exit;
}


// 抓商品狀態

$status_sql = sprintf(
    "SELECT `appliance_list`.* ,`item_status`.* FROM `appliance_list` JOIN `item_status` 
                ON `appliance_list`.`item_status_sid` = `item_status`.`status_sid` 
                LIMIT %s,%s",
    ($page - 1) * $per_page,
    $per_page
);


$status_stmt = $pdo->query($status_sql);
$status_row = $status_stmt->fetchAll();

?>


<?php include __DIR__ . '/__appliance_head.php' ?>

<?php include __DIR__ . '/__appliance_sidebar.php' ?>

<?php include __DIR__ . '/__appliance_navbar.php' ?>

<div style="margin-top:2rem;">
    <nav class="navbar navbar-expand-lg">
        <div class="collapse navbar-collapse justify-content-between align-items-center" id="navbarSupportedContent">
            <nav>
                <ul class="navbar-nav">
                    <li class="nav-item <?= $page_name == 'appliance_list_page' ? 'active' : '' ?> ">
                        <a class="nav-link" href="appliance_list_page.php"><button type="button" class="btn btn-outline-warning" style="width:100px;">批量刪除</button></a>
                    </li>
                </ul>
            </nav>
            <nav aria-label="Page navigation example">
                <ul class="pagination" style="margin:0;">
                    <li class="page-item"">
                        <a class=" page-link" href="?page=<?php echo $page - 10 ?>">
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
                            <a class="page-link" style="margin:0 auto;" href="appliance_list_page.php?page=<?php echo $i ?>"><?= $i ?></a>
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
                <input class="form-control mr-sm-2" type="search" placeholder="請輸入商品編號" aria-label="Search">
                <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
</div>

<div style="margin-top:2rem;"></div>

<table class="table table-hover table-dark" style="box-shadow: 0px 0px 80px #000000;">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">商品圖片</th>
            <th scope="col">品號</th>
            <th scope="col">名稱</th>
            <th scope="col">數量</th>
            <th scope="col">價格</th>
            <th scope="col">狀態</th>
            <th scope="col">新增時間</th>
            <th scope="col"><i class="fas fa-trash-restore-alt"></i></th>
            <th scope="col"><i class="fas fa-user-edit"></i></th>
        </tr>
    </thead>
    <tbody>

        <?php foreach ($status_row as $status_r) : ?>

            <tr>
                <td><?= $status_r['item_sid'] ?> </td>
                <td><?= htmlentities($status_r['item_image']) ?> </td>
                <td><?= htmlentities($status_r['item_number']) ?></td>
                <td><?= htmlentities($status_r['item_name']) ?></td>
                <td><?= htmlentities($status_r['item_quantity']) ?></td>
                <td><?= htmlentities($status_r['item_price']) ?></td>
                <td><?= htmlentities($status_r['status_name']) ?></td>
                <td><?= htmlentities($status_r['item_create_time']) ?></td>
                <td scope="col"><a href="javascript:delete_one(<?= $status_r['item_sid'] ?>)"><i class="fas fa-trash-alt" style="color:#fff;"></i></a></td>
                <td scope="col"><a href="appliance_list_edit.php?item_sid=<?= $status_r['item_sid'] ?>"><i class="fas fa-user-edit" style="color:#fff;"></i></a></td>
            </tr>

        <?php endforeach; ?>

    </tbody>
</table>

<script>
    function delete_one(item_sid) {
        if (confirm(`確定要刪除編號為 ${item_sid} 的資料嗎?`)) {
            location.href = 'appliance_list_delete.php?item_sid=' + item_sid;
        }
    }
</script>


<?php include __DIR__ . '/__appliance_foot.php' ?>