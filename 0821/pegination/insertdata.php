<?php
    $page_name='insertdata';
    $page_title = '新增資料';
?>
<!-- 必須在__html_head.php之前插入變數否則不會作用 -->
<?php require __DIR__ . '/PDO.php'; ?>
<?php include __DIR__ . '/__html_head.php' ?>
<?php include __DIR__ . '/__navbar.php' ?>
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class=" card-title">Card title</h5>
                    <form action="insert-api.php" method="post">
                        <!-- action指定目標檔案 method設定方法 -->
                    <div class="form-group">
                            <label for="name">name</label>
                            <input type="name" class="form-control" id="name" name="name" placeholder="Enter name">
                            <small id="nameHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter mobile">
                            <small id="mobileHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="birthday">Birthday</label>
                            <input type="text" class="form-control" id="birthday" name="birthday" placeholder="birthday" value="2015-08-02">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="address">
                        </div>
                        <button type="submit" class="btn btn-primary">送出</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/__html_foot.php' ?>