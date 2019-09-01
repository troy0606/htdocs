<?php
echo "<pre>";
    $a = 10;
    $b = $a;
    // 複製:複製實體

    $c = 30;
    $d = &$c;
    // 傳址:會指向相同變數(變更其中一個值會一起更動)

    $d = 50;
    $b = 40;

    print_r($a);
    // $a 10
    print_r($b);
    // $b 40
    print_r($c);
    // $c 50
    print_r($d);
    // $d 50
echo "</pre>";
?>