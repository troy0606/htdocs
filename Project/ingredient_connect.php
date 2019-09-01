<?php
// 建立資料庫連線
try {
    $userDir = getenv('HOME');
    $config = parse_ini_file("$userDir" . DIRECTORY_SEPARATOR . "__connect.ini");
    $pdo = New PDO($config['dsn'],$config['username'],$config['password']);
} catch (PDOException $e) {
    error_log("PDO 連接資料庫失敗: " . $e->getMessage());
    die("PDO 連接資料庫失敗: " . $e->getMessage());
}
error_log("PDO 連接資料庫成功");
unset($userDir, $config);
?>