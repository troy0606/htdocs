<?php
echo "<pre>";
    $br = ["name"=>"Ben", "age"=>20];

    $ar = $br;
    $br = &$cr;

    $cr["age"] = 100;

    print_r($ar);
    print_r($br);
    print_r($cr);
echo "</pre>";
?>