<?php
    $ar = [3,5,7,9,10];
    // 索引式陣列
    $br = ["name"=>"Ben", "age"=>20, "hi"];

    $cr = [];
    for($i=1;$i<10;$i++){
        $cr[] = $i*$i;
        echo count($cr)."\n";
    };

    echo "<pre>";
        print_r($cr);

    echo "</pre>";
