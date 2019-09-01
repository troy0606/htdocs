<?php
require __DIR__. '/__connect_db.php';
$page_name = 'data_insert';
$page_title = '新增資料';

?>
<?php include __DIR__. '/__html_head.php' ?>
<?php include __DIR__. '/__navbar.php' ?>
<style>
    small.form-text {
        color: red;
    }
</style>
<div class="container">
<div style="margin-top: 2rem;">
    <div class="row">
        <div class="col">
            <div class="alert alert-primary" role="alert" id="info-bar" style="display: none"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">新增資料</h5>
                    <form name="form1" onsubmit="return checkForm()">
                        <div class="form-group">
                            <label for="name">** 姓名</label>
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


                        <button type="submit" class="btn btn-primary" id="submit_btn">新增</button>
                    </form>
                </div>
            </div>

        </div>
    </div>






</div>
    <script>
        let info_bar = document.querySelector('#info-bar');
        const submit_btn = document.querySelector('#submit_btn');
        let i, s, item;
        const required_fields = [
            {
                id: 'name',
                pattern: /^\S{2,}/,
                info: '請填寫正確的姓名'
            },
            {
                id: 'email',
                pattern: /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i,
                info: '請填寫正確的 email 格式'
            },
            {
                id: 'mobile',
                pattern: /^09\d{2}\-?\d{3}\-?\d{3}$/,
                info: '請填寫正確的手機號碼格式'
            },
        ];

        // 拿到對應的 input element (el), 顯示訊息的 small element (infoEl)
        for(s in required_fields){
            item = required_fields[s];
            item.el = document.querySelector('#' + item.id);
            item.infoEl = document.querySelector('#' + item.id + 'Help');
        }

        //   /[A-Z]{2}\d{8}/i  統一發票

        function checkForm(){
            // 先讓所有欄位外觀回復到原本的狀態
            for(s in required_fields) {
                item = required_fields[s];
                item.el.style.border = '1px solid #CCCCCC';
                item.infoEl.innerHTML = '';
            }
            info_bar.style.display = 'none';
            info_bar.innerHTML = '';

            submit_btn.style.display = 'none';

            // 檢查必填欄位, 欄位值的格式
            let isPass = true;

            for(s in required_fields) {
                item = required_fields[s];

                if(! item.pattern.test(item.el.value)){
                    item.el.style.border = '1px solid red';
                    item.infoEl.innerHTML = item.info;
                    isPass = false;
                }
            }

            let fd = new FormData(document.form1);

            if(isPass) {
                fetch('data_insert_api.php', {
                    method: 'POST',
                    body: fd,
                })
                    .then(response => {
                        return response.json();
                    })
                    .then(json => {
                        console.log(json);
                        submit_btn.style.display = 'block';
                        info_bar.style.display = 'block';
                        info_bar.innerHTML = json.info;
                        if (json.success) {
                            info_bar.className = 'alert alert-success';
                        } else {
                            info_bar.className = 'alert alert-danger';
                        }
                    });
            } else {
                submit_btn.style.display = 'block';
            }
            return false; // 表單不出用傳統的 post 方式送出
        }



    </script>
</div>
<?php include __DIR__. '/__html_foot.php' ?>
