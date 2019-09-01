<?php
    // echo $_GET['a'] + $_GET['b'];
    // 沒給a/b值時 a/b = undefined 結果為0
    // 在網頁url輸入 ?a=10 & b=20;

    $a = isset($_GET['a'])?(int)($_GET['a']):0;
    // 設三元運算判斷式，如果$a 已經設定過 $_GET['a'] ，則返回轉為整數的$_GET['a']，如還沒則為false，返回0
    // intval / int 可以將參數轉為數值，如無法轉換則為0
    $b = isset($_GET['b'])?intval($_GET['b']):0;

    echo $a + $b;
    
?>