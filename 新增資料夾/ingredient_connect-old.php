<?php
    $db_host = 'localhost';
    $db_name = 'ingredient';
    $db_user = 'root';
    $db_password = 'root';
    $db_charset = 'utf8';
    $db_collate = 'utf8_unicode_ci';

    $dsn = "mysql:host={$db_host};dbname={$db_name};charset={$db_charset}";

    $pdo_option = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_PERSISTENT => false,
        PDO::ATTR_DEFAULT_FETCH_MODE =>PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES {$db_charset}"
    ];

    $pdo = new PDO($dsn, $db_user, $db_password, $pdo_option);