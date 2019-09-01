<?php
require __DIR__. '/__connect_db.php';
$page_name = 'data_list';
$page_title = '資料列表';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$per_page = 10; // 每一頁要顯示幾筆

$t_sql = "SELECT COUNT(1) FROM `address_book` ";

$t_stmt = $pdo->query($t_sql);
$totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數
//$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數

$totalPages = ceil($totalRows/$per_page); // 取得總頁數

if($page < 1){
    header('Location: data_list.php');
    exit;
}
if($page > $totalPages){
    header('Location: data_list.php?page='. $totalPages);
    exit;
}

$sql = sprintf("SELECT * FROM `address_book` ORDER BY `sid` DESC LIMIT %s, %s",
        ($page-1)*$per_page,
            $per_page
);
$stmt = $pdo->query($sql);

//$rows = $stmt->fetchAll();

?>
<?php include __DIR__. '/__html_head.php' ?>
<?php include __DIR__. '/__navbar.php' ?>
<div class="container">
<div style="margin-top: 2rem;">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="?page=<?= $page-1 ?>">
                    <i class="fas fa-chevron-left"></i>
                </a>
            </li>
            <?php
            $p_start = $page-5;
            $p_end = $page+5;
            for($i=$p_start; $i<=$p_end; $i++):
                if($i<1 or $i>$totalPages) continue;
                ?>
            <li class="page-item <?= $i==$page ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
            <?php endfor; ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?= $page+1 ?>">
                    <i class="fas fa-chevron-right"></i>
                </a>
            </li>
        </ul>
    </nav>


    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th scope="col"><i class="fas fa-trash-alt"></i></th>
            <th scope="col">#</th>
            <th scope="col">姓名</th>
            <th scope="col">電子郵箱</th>
            <th scope="col">手機</th>
            <th scope="col">生日</th>
            <th scope="col">地址</th>
            <th scope="col"><i class="fas fa-edit"></i></th>
        </tr>
        </thead>
        <tbody>
        <?php while($r=$stmt->fetch()){  ?>
            <tr>
                <td>
                    <a href="javascript:delete_one(<?= $r['sid'] ?>)"><i class="fas fa-trash-alt"></i></a>
                </td>
                <td><?= $r['sid'] ?></td>
                <td><?= htmlentities($r['name']) ?></td>
                <td><?= htmlentities($r['email']) ?></td>
                <td><?= htmlentities($r['mobile']) ?></td>
                <td><?= htmlentities($r['birthday']) ?></td>
                <td><?= htmlentities($r['address']) ?></td>
                <td><a href="data_edit.php?sid=<?= $r['sid'] ?>"><i class="fas fa-edit"></i></a>
                </td>
            </tr>
        <?php } ?>


        </tbody>
    </table>
</div>

    <script>
        function delete_one(sid) {
            if(confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)){
                location.href = 'data_delete.php?sid=' + sid;
            }
        }
    </script>
</div>
<?php include __DIR__. '/__html_foot.php' ?>
