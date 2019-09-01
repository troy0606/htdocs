<?php
    require __DIR__. "/ingredient_datalist.php";
    ob_start();
    $sid = isset($_GET['sid'])? intval($_GET['sid']):0;
    if(!empty($sid)){
        $sql = "DELETE FROM `ingredient` WHERE `sid`=$sid";
        $pdo->query($sql);
    }header("Location:".$_SERVER['HTTP_REFERER']);
    ob_end_flush();
?>
