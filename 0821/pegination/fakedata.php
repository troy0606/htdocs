<?php 
    exit;
    require __DIR__ . '/PDO.php';
    for($i = 1; $i < 100; $i++){
        $pdo->query("INSERT INTO `address_book`
        (`name`, `email`, `mobile`, `address`, `birthday`, `create_at`) 
        VALUES 
        ('王小華{$i}','abc@gmail.com','091234567','你家','2012-08-09','2019-08-20');");
    }