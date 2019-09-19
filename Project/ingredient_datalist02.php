<?php
$page_name = 'datalist';
$page_title = '全部商品列表';
require __DIR__ . "/ingredient_connect.php";
?>
<?php
require __DIR__ . "/html_head_in.php";
require __DIR__ . "/ingredient_navbar_in.php";
require __DIR__ . "/ingredient_navbar.php";
?>
<style>
    .main-section {
        width: 90%;
        margin: auto;
    }

    .form-group small {
        color: red;
    }
</style>
<div style="margin-top:2rem;">
    <nav class="navbar navbar-expand-lg">
        <div class="collapse navbar-collapse justify-content-between align-items-center" id="navbarSupportedContent">
            <nav style="width: 250px;">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <button id="allDelete" type="submit" class="btn btn-outline-warning" style="width:100px;  margin-right:20px;" onclick="return confirm('確定刪除嗎？')">批量刪除</button>
                    </li>
                </ul>
            </nav>
            <nav aria-label="Page navigation example" style="color: #15141A;">
                <ul class="pagination" style="margin:0;" id="pageContainer">

                </ul>
            </nav>
            <form class="form-inline" name="form_search" action="" method="get">
                <div class="form-group mx-sm-3 mb-2" style="margin:8px;">
                    <label for="inputPassword2" class="sr-only"></label>
                    <input type="text" class="form-control" id="inputPassword2" placeholder="請輸入商品編號" name="inputPassword2">

                </div>
                <button type="submit" class="btn btn-outline-warning mb-2" style="margin:8px;"><i class="fas fa-search"></i> Search</button>
            </form>
        </div>
    </nav>
</div>

<div style="margin-top:2rem;"></div>

<!-- <h6 style="color: #fff;">資料總筆數：<?= $totalRows ?></h6> -->

<form method="post" id="all_form" enctype="application/x-www-form-urlencoded">
    <table class="table table-hover table-dark" style="box-shadow: 0px 0px 80px #000000;">
        <thead>
            <tr>
                <th scope="col"><input type="checkbox" onclick="checkAll()" id="check_all"><label for="check_all" style="margin:0;"><span></span></label>全選</th>
                <th scope="col">品號</th>
                <th scope="col">名稱</th>
                <th scope="col">數量
                    <!-- <a href="?ingredient_column=quantity&ingredient_up_down=ASC"><i class="fas fa-long-arrow-alt-up"></i></a>
                    <a href="?ingredient_column=quantity&ingredient_up_down=DESC"><i class="fas fa-long-arrow-alt-down"></i></a> -->
                </th>
                <th scope="col">價格
                    <!-- <a href="?ingredient_column=price&ingredient_up_down=ASC"><i class="fas fa-long-arrow-alt-up"></i></a>
                    <a href="?ingredient_column=price&ingredient_up_down=DESC"><i class="fas fa-long-arrow-alt-down"></i></a> -->
                </th>
                <th scope="col">狀態</th>
                <th scope="col">新增時間
                    <!-- <a href="?ingredient_column=create_at&ingredient_up_down=ASC"><i class="fas fa-long-arrow-alt-up"></i></a>
                    <a href="?ingredient_column=create_at&ingredient_up_down=DESC"><i class="fas fa-long-arrow-alt-down"></i></a> -->
                </th>
                <th scope="col">功能列表</th>
            </tr>
        </thead>
        <tbody id=tdContainer>
        </tbody>
    </table>
</form>
<script>
    let columnList = function(pageVar) {
        let str = "";
        let i = 0;
        let thArray = pageVar.rows;
        thArray.forEach(function(a) {
            str += `<tr><td><input type="checkbox" id="check${i}" class="checkbox" name="checkOne[]" value="${a[0]}"><label for="check${i}"><span></span></label></td>
            <td>${a[0]}</td>
            <td>${a[2]}</td> 
                    <td>${a[7]}</td>
                    <td>${a[6]}</td>
                    <td>${a[12]}</td>
                    <td>${a[13]}</td>
                    <td scope="col" data-sid="${a[0]}" class="del"><a href=""><i class="fas fa-trash-alt" style="color:#fff; margin-right:20px;"></i></a>
                        <a href="ingredient_edit.php?sid=${a[0]}"><i class="fas fa-edit" style="color:#fff;"></i></a></td></tr>`;
            i++;
        })
        $("#tdContainer").html(str);
    };

    let page = function(pageVar) {
        let page = pageVar.page;
        let perPage = pageVar.perPage;
        let totalPages = pageVar.totalPages;
        let str = `<li class="page-item" data-page="${page-10}">
                        <a class=" page-link">
                            <i class="fas fa-angle-double-left" style="color: #15141A;"></i>
                        </a>
                    </li>
                    <li class="page-item" data-page="${page-1}">
                        <a class="page-link">
                            <i class="fas fa-angle-left" style="color: #15141A;"></i>
                        </a>
                    </li>`;
        for (i =1; i <= totalPages; i++) {
            let a = i == page ? "active" : "";
            str += ` <li class="page-item data-page="${i}" "${a}">
                            <a class="page-link d-flex justify-content-center" style="width:55px; margin:0 auto; color: #15141A;">${i}</a>
                        </li>`;
        }
        str += `<li class="page-item" data-page="${page+1}">
                        <a class="page-link">
                            <i class="fas fa-angle-right" style="color: #15141A;"></i>
                        </a>
                    </li>
                    <li class="page-item" data-page="${page+10}">
                        <a class="page-link">
                            <i class="fas fa-angle-double-right" style="color: #15141A;"></i>
                        </a>
                    </li>`;
        $("#pageContainer").html(str);
    };
    $.ajax({
        // type: "POST",
        url: "ingredient_datalist_api.php",
        dataType: "json",
    }).done(function(pageVar) {
        columnList(pageVar);
        page(pageVar);
    });

    $("#pageContainer").on("click", "#pageContainer li", function(e) {
        e.stopPropagation();
        page = $(this).text();
        $.ajax({
            type: "POST",
            url: "ingredient_datalist_api.php",
            data: {
                page: page,
            },
            dataType: "json"
        }).done(function(pageVar) {
            console.log(pageVar);
            columnList(pageVar);
            page(pageVar);
        })
    })

    $("#tdContainer").on("click", ".del", function() {
        let delete_sid = $(this).attr("data-sid");
        console.log(delete_sid);
        if (confirm(`確定要刪除編號為 ${delete_sid} 的資料嗎?`)) {
            $.ajax({
                type: "POST",
                url: "ingredient_delete02.php",
                data: {
                    sid: delete_sid,
                },
            }).done(function(result) {
                if (result == "success") {
                    $(this).closest('tr').fadeOut(500);
                    alert(`${delete_sid} 成功刪除`);
                };
                $.ajax({
                    url: "ingredient_datalist_api.php",
                    dataType: "json",
                }).done(function(pageVar) {
                    columnList(pageVar);
                    page(pageVar);
                });

            }).fail(function(jqXHR, textStatus, errorThrown) {
                //失敗的時候
                alert("有錯誤產生，請看 console log");
                console.log(jqXHR.responseText);
            });
        }
        return false;
    })
</script>
<!-- <script>
    function delete_one(sid) {
        if (confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)) {
            location.href = 'ingredient_delete.php?sid=' + sid;
        }
    }
</script> -->

<!-- 全選 checkbox start -->

<script>
    function checkAll() {
        var checkAllEl = document.getElementById("check_all");
        if (checkAllEl.checked == true) {
            var checkOnes = document.getElementsByName("checkOne[]");
            for (var i = 0; i < checkOnes.length; i++) {
                checkOnes[i].checked = true;
            }
        } else {
            var checkOnes = document.getElementsByName("checkOne[]");
            for (var i = 0; i < checkOnes.length; i++) {
                checkOnes[i].checked = false;
            }
        }
    }
</script>

<!-- 全選 checkbox end -->

<!-- 批量操作 start -->
<script>
    var form_submit = document.getElementById('all_form');
    var go = document.getElementById('allDelete');
    go.addEventListener('click', () => {
        form_submit.action = 'ingredient_allDelete_api.php';
        form_submit.submit();
    });
</script>
<?php
require __DIR__ . "/footer_in.php";
?>