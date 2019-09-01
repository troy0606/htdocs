<?php

session_start();

if(! isset($_SESSION['my_sess'])) {
    $_SESSION['my_sess'] = 1;
} else {
    $_SESSION['my_sess'] ++;
}

echo $_SESSION['my_sess'];









