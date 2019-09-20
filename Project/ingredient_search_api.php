<?php
require __DIR__ . "/ingredient_connect.php";
    $search = $_POST['search'];
    $tst = $pdo->query("SELECT * FROM `ingredient` WHERE `ingredient`.`sid`= $search");
    $row = $tst ->fetch();
    $data = json_encode($row ,JSON_UNESCAPED_UNICODE);
    if($row){
        echo $data;
    }else{
        echo false;
    }
?>
