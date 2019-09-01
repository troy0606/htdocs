<?php
require __DIR__ . '/__connect.php';
$sql = " SELECT * FROM `categories`";

$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll();

$level1 = [];

foreach ($rows as $r) {
    if ($r['parent_sid'] == 0) {
        $level1[] = $r;
    }
}

foreach ($level1 as $k => $v) {
    foreach ($rows as $r)
        if ($r['parent_sid'] == $v['sid']) {
            $level1[$k]['nodes'][] = $r;
        }
}

require __DIR__ . '/PG-up.php';
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand">商品分類</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <?php foreach($level1 as $a1): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?= $a1['name'] ?>
                    </a>
                    <?php if(! empty($a1['nodes'])) : ?>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php foreach($a1['nodes'] as $n): ?>
                        <a class="dropdown-item" href="?cate_sid=<?= $n['sid'] ?>"><?= $n['name'] ?></a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </li>
                <?php endforeach; ?>

            </ul>

        </div>
    </div>
</nav>
<div>
    
</div>
<?php require __DIR__ . '/PG-down.php'; ?>