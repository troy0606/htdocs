<?php
if(! isset($_SESSION)){
    session_start();
}
$page_name = 'page2';

?>
<?php include __DIR__. '/__html_head.php' ?>
<?php include __DIR__. '/__navbar.php' ?>
<div class="container">
<h2>Page 2</h2>

</div>
<?php include __DIR__. '/__html_foot.php' ?>
