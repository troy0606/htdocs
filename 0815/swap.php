<?php
    function swap(&$a, &$b){
        $c = $a;
        $a = $b;
        $b = $c;
    }
    $m = 100;
    $n = 'abc';
    swap($m,$n);
    echo "$m $n";
?>