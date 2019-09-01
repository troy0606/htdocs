<?php

// require '__connect_db.php';
require __DIR__. '/__connect_db.php';

$stmt = $pdo->query("SELECT * FROM `address_book`");

while($row = $stmt->fetch()) {
    echo "{$row['name']}  {$row['email']} <br>";
}


