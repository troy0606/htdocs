<?php
    class Person {
        private $name;
        // 設定$name私有屬性，只能在類別類使用，無法取出
        function setName($n) {
            $this->name = $n;
            // 指向使用這個類別建構的物件
        }
        function getName() {
            return $this->name;
        }
    }

    $p = new Person("p");
    $p->setName("Victor");
    // 在類別內操作私有屬性
    echo $p->getName();
?>