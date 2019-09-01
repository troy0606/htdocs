<?php require __DIR__ . '/PDO.php';
// $page_name='datalist';
// $stmt = $pdo->query('SELECT * FROM `address_book` ORDER BY `address_book`.`sid` DESC');

$page = isset($_GET['page'])? intval($_GET['page']): 1;
$sql = sprintf('SELECT * FROM `address_book` ORDER BY `address_book`.`sid` DESC LIMIT %s,%s', ($page-1),$page);
$stmt = $pdo->query($sql);
?>
<?php include __DIR__ . '/__html_head.php' ?>
<?php include __DIR__ . '/__navbar.php' ?>
<div class="container">
    <?php $rows = $stmt->fetchAll(); ?>
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
            <?php foreach ($rows as $r):?>
            <tr>
                <td><?=$r['sid']?></td>
                <td><?=$r['name']?></td>
                <td><?=$r['email']?></td>
                <td><?=$r['mobile']?></td>
                <td><?=$r['birthday']?></td>
                <td><?=$r['address']?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/__html_foot.php' ?>