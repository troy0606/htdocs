<?php
    $ar = array(3,5,7,9,10);
    // 索引式陣列
    $br = array("name"=>"Ben", "age"=>20, "hi");
    // 關聯式陣列(可以與索引式陣列混用，但不推薦) /hi索引值為0
    echo "<pre>";
        print_r($ar);
        var_dump($ar);

        print_r($br);
        var_dump($br);
    echo "</pre>";
?>