<?php
$page_name = 'insertdata';
$page_title = '新增資料';
?>
<?php    
    require __DIR__ . '/PDO.php'; 
    include __DIR__ . '/__html_head.php'; 
    include __DIR__ . '/__navbar.php'; 
    ?>
<style>
    .form-group small {
        color: red;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="alert alert-primary" role="alert" style="display:none" id="bar_info"></div>
            <div class="card">
                <div class="card-body">
                    <h5 class=" card-title">Card title</h5>
                    <form name="form1" onsubmit="return check()">
                        <!-- 資料送出時返回函式check的值 -->
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
        <script>
            let bar_info = document.querySelector("#bar_info");

            let i, s, item;

            const require_field = [{
                    id: "name",
                    pattern: /^\S{2,}/,
                    info: "請輸入正確名稱"
                    // 將要判斷的欄位放進陣列require_field
                },
                {
                    id: "mobile",
                    pattern: /^09\d{2}\-?\d{3}\-?\d{3}$/,
                    info: "請輸入正確手機格式"
                },
                {
                    id: "email",
                    pattern: /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i,
                    info: "請輸入正確信箱格式"
                }
            ]

            for (s in require_field) {
                item = require_field[s]
                item.el = document.querySelector("#" + item.id);
                item.info = document.querySelector("#" + item.id + "Help");
            }


            

            function check() {
                
                for (s in require_field) {
                    item = require_field[s];
                    item.el.style.border = "1px solid #CCCCCC";
                    item.info.innerHTML = "";
                }
                let isPass = true;
                for (s in require_field) {
                    item = require_field[s];
                    if (!item.pattern.test(item.el.value)) {
                        item.el.style.border = "1 px solid red";
                        item.info.innerHTML = item.info;
                        isPass = false;
                    }
                }
                
                let fd = new FormData(document.form1);

                if (isPass) {
                    fetch("insert-api.php", {
                            method: 'POST',
                            body: fd
                        })
                        .then(response => {
                            return response.json();
                        })
                        .then(jsonObj => {
                            console.log(jsonObj);
                            bar_info.style.display = "block";
                            bar_info.innerHTML = jsonObj.info;
                            if (jsonObj.success) {
                                bar_info.className = "alert alert-success";
                            } else {
                                bar_info.className = "alert alert-danger";
                            }
                        })
                }
                return false;
            }
        </script>
    </div>
</div>
<?php include __DIR__ . '/__html_foot.php' ?>