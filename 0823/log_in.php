<?php
$page_name = 'log_in';
$page_title = '登入';
?>
<?php require __DIR__ . '/PDO.php'; ?>
<?php include __DIR__ . '/__html_head.php' ?>
<?php include __DIR__ . '/__navbar.php' ?>
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
                        <div class="form-group">
                            <label for="email">帳號(Email address)</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" autocomplete="false">
                            <small id="emailHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" autocomplete="false">
                            <small id="passwordHelp" class="form-text text-muted"></small>
                        </div>
                        <button type="submit" class="btn btn-primary">Log In</button>
                    </form>
                </div>
            </div>
        </div>
        <script>
            let bar_info = document.querySelector("#bar_info");

            let i, s, item;

            const require_field = [
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
                    fetch("log_in-api.php", {
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
                                setTimeout(function(){
                                    location.href = 'datalist.php';
                                },1000)
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