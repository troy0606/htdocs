<?php
    class Person {
        var $name;
        public $mobile;
        private $sno = "secret";
    }

    $p = new Person;
    $p->name = "Benson";
    $p->mobile = "0123456789";
    // $p->sno = "123";
    // 取用私有屬性將發生錯誤
    
    print_r($p);
    echo $p->name;
?>