<?php require __DIR__ . '/PDO.php';
$page_name = 'datalist';
$page_title = '資料表';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
// 使用者傳入的數值?(true)返回整數的值:(false)返回整數1
$perPage = 10;

$totoalSql = $pdo->query('SELECT COUNT(*) FROM `address_book`');
$totalrows = $totoalSql->fetch(PDO::FETCH_NUM)[0];

$totalPage = ceil($totalrows / $perPage);
// 頁數 = 總筆數/每頁的筆數

if ($page < 1) {
    header('Location: datalist.php?page=1');
    $page = 1;
    exit;
    // 如果$GET取得頁數的值<1，網頁轉到datalist.php(第一頁)，結束
}

if ($page > $totalPage) {
    header('Location: datalist.php?page=' . $totalPage);
    $page = $totalPage;
    exit;
    // 如果$GET取得頁數的值>總頁數，網頁轉到datalist.php?page= 接第幾頁，結束
}

$sql = sprintf("SELECT * FROM `address_book` ORDER BY `sid` DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
// 每次隨著page變數改值，重抓資料
$stmt = $pdo->query($sql);
// query($sql) 取得資料傳進$stmt
print_r($stmt);

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
                // for迴圈 作頁碼
                if ($i < 1 or $i > $totalPage) continue;
                // 如果頁碼超出總頁數或小於1則迴圈跳出，自動往下1個迴圈
                ?>
            <li class="page-item <?= $i == $page ? 'active' : '' ?> ">
                <!-- 如果頁碼 = $i，則增加class=active，沒有則空字串-->
                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
            <?php endfor; ?>
        </ul>
    </nav>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">sid</th>
                <th scope="col">name</th>
                <th scope="col">email</th>
                <th scope="col">mobile</th>
                <th scope="col">birthday</th>
                <th scope="col">address</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($r = $stmt->fetch()) {; ?>
            <!-- 將當前頁面的所有$stmt使用fetch() 變成多個$r關聯陣列 -->
            <tr>
                <?php print_r($r); ?>
                <!-- 將關聯陣列的每個內容值印出 -->
                <td><?= $r['sid'] ?></td>
                <td><?= $r['name'] ?></td>
                <td><?= $r['email'] ?></td>
                <td><?= $r['mobile'] ?></td>
                <td><?= $r['birthday'] ?></td>
                <td><?= $r['address'] ?></td>
            </tr>
            <?php }; ?>
        </tbody>
    </table>
</div>
<?php include __DIR__ . '/__html_foot.php' ?>