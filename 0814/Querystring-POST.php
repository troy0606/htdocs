<?php
    $a = isset($_POST['a'])?(int)($_POST['a']):0;
    // 設三元運算判斷式，如果$a 已經設定過 $_POST['a'] ，則返回轉為整數的$_POST['a']，如還沒則為false，返回0
    // intval / int 可以將參數轉為數值，如無法轉換則為0
    $b = isset($_POST['b'])?intval($_POST['b']):0;

    echo $a + $b;
    
?>