<?php require __DIR__ . '/PDO.php';
$page_name='datalist';
$stmt = $pdo->query('SELECT * FROM `address_book` ORDER BY `address_book`.`sid` DESC');
// selectfrom最前面/where/order by 
// DESC = descending/ ASC = ascending

?>
<?php include __DIR__ . '/__html_head.php' ?>
<?php include __DIR__ . '/__navbar.php' ?>
<div class="container">
    <?php #$rows = $stmt->fetchAll(); ?>
    <!-- fetchAll()會取得索引式陣列 -->
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
            <?php while ($r = $stmt->fetch()) { ;?>
            <tr>
                <td><?= $r['sid'] ?></td>
                <td><?= $r['name'] ?></td>
                <td><?= $r['email'] ?></td>
                <td><?= $r['mobile'] ?></td>
                <td><?= $r['birthday'] ?></td>
                <td><?= $r['address'] ?></td>
            </tr>
            <?php } ;?>

            <?php /* <? <?php foreach ($rows as $r):?>
            <tr>
                <td><?=$r['sid']?></td>
                <td><?=$r['name']?></td>
                <td><?=$r['email']?></td>
                <td><?=$r['mobile']?></td>
                <td><?=$r['birthday']?></td>
                <td><?=$r['address']?></td>
            </tr>
        <?php endforeach; ?> */ ?> 
        <!-- 取得索引式陣列後，從各陣列抓出裡面的關聯式陣列 -->
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/__html_foot.php' ?>