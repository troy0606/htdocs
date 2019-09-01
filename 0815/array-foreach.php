<?php
    $br = ["name"=>"Ben", "age"=>20, "hi"];

    foreach($br as $value){
        // 列舉變數只有一個時，只抓陣列的value
        echo "$value <br>";
    }

    foreach($br as $key => $value){
        // 列舉變數有兩個時，依照關聯變數的格式設定兩個變數可以取得鍵跟值
        echo "$key: $value <br>";
    }

