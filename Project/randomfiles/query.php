<?php
require __DIR__ . "/__html_head.php";
require __DIR__ . "/__navbar.php";
?>
<div class="container">
    <?php
    require __DIR__ . "/__connect.php";

    $stmt = $pdo->query('SELECT * FROM `ingredient`');
    // $row = $stmt->fetch();
    // print_r($row);
    $rows = $stmt->fetchAll();
    // echo "{$rows[0][1]}";
    foreach($rows as $r)
    echo "{$r['商品排序']} {$r['食材名稱']} {$r['大類別']} {$r['小類別']} {$r['價格']} {$r['數量']} {$r['商品狀態']} {$r['產地']} {$r['商品描述']}.<br>";
    ?>
</div>
<?php
require __DIR__ . "/__html_foot.php";
?>