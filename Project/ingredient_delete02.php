<?php
    require __DIR__. "/ingredient_connect.php";
    $sid = isset($_POST['sid'])? intval($_POST['sid']):0;
    if(!empty($sid)){
        $sql = "DELETE FROM `ingredient` WHERE `sid`=$sid";
        $pdo->query($sql);
        echo 'success';
    }else{
        echo "failed";
    }
    // }header("Location:".$_SERVER['HTTP_REFERER']);

    
?>
