<?php
require __DIR__. '/__connect_db.php';
$page_name = 'data_insert';
$page_title = '新增資料';

?>
<?php include __DIR__. '/__html_head.php' ?>
<?php include __DIR__. '/__navbar.php' ?>
<div class="container">
<div style="margin-top: 2rem;">

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">新增資料</h5>
                    <form action="data_insert_api.php" method="post">
                        <div class="form-group">
                            <label for="name">姓名</label>
                            <input type="text" class="form-control" id="name" name="name">
                            <small id="nameHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="email">電子郵箱</label>
                            <input type="text" class="form-control" id="email" name="email">
                            <small id="emailHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="mobile">手機</label>
                            <input type="text" class="form-control" id="mobile" name="mobile">
                            <small id="mobileHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="birthday">生日</label>
                            <input type="text" class="form-control" id="birthday" name="birthday" value="2000-03-03">
                            <small id="birthdayHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="address">地址</label>
                            <input type="text" class="form-control" id="address" name="address">
                            <small id="addressHelp" class="form-text"></small>
                        </div>


                        <button type="submit" class="btn btn-primary">新增</button>
                    </form>
                </div>
            </div>

        </div>
    </div>






</div>
</div>
<?php include __DIR__. '/__html_foot.php' ?>
