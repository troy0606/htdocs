<?php require __DIR__ . '/PDO.php';
$page_name = 'datalist';
$page_title = '資料表';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$perPage = 10;

$totoalSql = $pdo->query('SELECT COUNT(*) FROM `address_book`');
$totalrows = $totoalSql->fetch(PDO::FETCH_NUM)[0];

$totalPage = ceil($totalrows / $perPage);

if ($page < 1) {
    header('Location: datalist.php?page=1');
    $page = 1;
    exit;
}

if ($page > $totalPage) {
    header('Location: datalist.php?page=' . $totalPage);
    $page = $totalPage;
    exit;
}

$sql = sprintf("SELECT * FROM `address_book` ORDER BY `sid` DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
$stmt = $pdo->query($sql);

?>
<?php include __DIR__ . '/__html_head.php' ?>
<?php include __DIR__ . '/__navbar.php' ?>
<div class="container">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php

            $start_page = $page - 3;
            $end_page = $page + 3;
            for ($i = $start_page; $i < $end_page; $i++) :
                if ($i < 1 or $i > $totalPage) continue;
                ?>
            <li class="page-item <?= $i == $page ? 'active' : '' ?> ">
                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
            <?php endfor; ?>
        </ul>
    </nav>
    <table class="table">
        <thead>
            <tr>
                <th scope="col"><i class="fas fa-trash"></i></th>
                <th scope="col">sid</th>
                <th scope="col">name</th>
                <th scope="col">email</th>
                <th scope="col">mobile</th>
                <th scope="col">birthday</th>
                <th scope="col">address</th>
                <th scope="col"><i class="fas fa-book"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php while ($r = $stmt->fetch()) {; ?>
            <tr>
                <td>
                    <a href="javascript:delete2(<?= $r['sid'] ?>)">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
                <td><?= $r['sid'] ?></td>
                <td><?= $r['name'] ?></td>
                <td><?= $r['email'] ?></td>
                <td><?= $r['mobile'] ?></td>
                <td><?= $r['birthday'] ?></td>
                <td><?= $r['address'] ?></td>
                <td><a href="edit.php?sid=<?= $r['sid'] ?>"><i class="fas fa-book"></i></a></td>
            </tr>
            <?php }; ?>
        </tbody>
    </table>
</div>
<!-- <script>
    function delete(sid) {
        if (confirm(`刪除編號為${sid}的資料`)) {
            location.href = "delete.php?sid=" + sid;
        }
    }
</script> -->
<script>
    function delete2(sid) {
        if (confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)) {
            location.href = 'delete.php?sid=' + sid;
        }
    }
</script>
<?php include __DIR__ . '/__html_foot.php' ?>