<?php
    require __DIR__. '/PDO.php';

    $stmt = $pdo->query('SELECT * FROM `address_book`'); 
    while($row = $stmt->fetch()){
        echo "{$row['name']} {$row['email']} <br>";
    }
?>