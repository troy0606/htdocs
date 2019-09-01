<?php
date_default_timezone_set('Asia/Taipei');

echo time(). '<br>';

echo date("Y-m-d H:i:s"). '<br>';
echo date("Y-m-d", time()+30*24*60*60). '<br>';
echo date("Y-m-d", strtotime('+30 days')). '<br>';
echo date("Y-m-d", strtotime('2019/8/2')). '<br>';



