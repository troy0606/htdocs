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
                        <button id="allDelete" type="submit" class="btn btn-outline-warning" style="width:100px;  margin-right:20px;">批量刪除</button>
                    </li>
                    <div id="statusSlide" class="invisible animated d-flex">
                        <li class="nav-item">
                            <button id='allOnSale' type="submit" class="btn btn-outline-warning" style="width:100px; margin-right:20px;">批量上架</button>
                        </li>
                        <li class="nav-item">
                            <button id='allOffSale' type="submit" class="btn btn-outline-warning" style="width:100px; margin-right:20px;">批量下架</button>
                        </li>
                    </div>
                </ul>
            </nav>
            <nav aria-label="Page navigation example" style="color: #15141A;">
                <ul class="pagination" style="margin:0;" id="pageContainer">
                </ul>
            </nav>
            <form class="form-inline">
                <div class="form-group mx-sm-3 mb-2" style="margin:8px;">
                    <label for="search" class="sr-only"></label>
                    <input type="text" class="form-control" placeholder="請輸入商品編號" id="product_num">
                </div>
                <button id="form_search" type="submit" class="btn btn-outline-warning mb-2" style="margin:8px;"><i class="fas fa-search"></i> Search</button>
            </form>
        </div>
    </nav>
</div>
<div style="margin-top:2rem;"></div>

<h6 id="totalCount" style="color: #fff;">資料總筆數：<?= $totalRows ?></h6>

<form method="post" id="all_form" enctype="application/x-www-form-urlencoded">
    <table class="table table-hover table-dark" style="box-shadow: 0px 0px 80px #000000;">
        <thead>
            <tr>
                <th scope="col"><input type="checkbox" onclick="checkAll()" id="check_all"><label for="check_all" style="margin:0;"><span></span></label>全選</th>
                <th scope="col">品號</th>
                <!-- <th scope="col">圖片</th> -->
                <th scope="col">名稱</th>
                <th scope="col">數量
                    <a href="#" data-order="quantity-up"><i class="fas fa-long-arrow-alt-up"></i></a>
                    <a href="#" data-order="quantity-down"><i class="fas fa-long-arrow-alt-down"></i></a>
                </th>
                <th scope="col">價格
                    <a href="#" data-order="price-up"><i class="fas fa-long-arrow-alt-up"></i></a>
                    <a href="#" data-order="price-down"><i class="fas fa-long-arrow-alt-down"></i></a>
                </th>
                <th scope="col">狀態</th>
                <th scope="col">新增時間
                    <a href="#" data-order="create-up"><i class="fas fa-long-arrow-alt-up"></i></a>
                    <a href="#" data-order="create-down"><i class="fas fa-long-arrow-alt-down"></i></a>
                </th>
                <th scope="col">功能列表</th>
            </tr>
        </thead>
        <tbody id=tdContainer>
        </tbody>
    </table>
</form>
<script>
    let stockStatus = ["", "上架中", "下架中"];

    // ----loading product list---------------
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
                    <td>${stockStatus[a[12]]}</td>
                    <td>${a[13]}</td>
                    <td scope="col" data-sid="${a[0]}"><a href=""><i class="fas fa-trash-alt del" style="color:#fff; margin-right:20px;"></i></a>
                        <a href="ingredient_edit.php?sid=${a[0]}"><i class="fas fa-edit" style="color:#fff;"></i></a></td></tr>`;
            i++;
            console.log(a[12]);
        })
        $("#tdContainer").html(str);
        $("#totalCount").text(`資料總比數: ${pageVar.totalRows}`);
    };

    // ----product list end---------------

    // ----loading product page---------------

    let lastPage;
    let pageChange = function(pageVar) {
        let page = pageVar.page;
        let perPage = pageVar.perPage;
        let totalPages = pageVar.totalPages;
        let str = `<li class="page-item" id="previousAll">
                        <a class=" page-link" href="#">
                            <i class="fas fa-angle-double-left" style="color: #15141A;"></i>
                        </a>
                    </li>
                    <li class="page-item" id="previous">
                        <a class="page-link" href="#">
                            <i class="fas fa-angle-left" style="color: #15141A;"></i>
                        </a>
                    </li>`;
        for (i = 1; i <= totalPages; i++) {
            let a = i == page ? "active" : "";
            str += ` <li class="page-item data-page="${i}" "${a}">
                            <a class="page-link d-flex justify-content-center" style="width:55px; margin:0 auto; color: #15141A;" href="#">${i}</a>
                        </li>`;
        }
        str += `<li class="page-item" id="next">
                        <a class="page-link" href="#">
                            <i class="fas fa-angle-right" style="color: #15141A;"></i>
                        </a>
                    </li>
                    <li class="page-item" id="nextAll">
                        <a class="page-link" href="#">
                            <i class="fas fa-angle-double-right" style="color: #15141A;"></i>
                        </a>
                    </li>`;
        $("#pageContainer").html(str);
    };

    // ----product page end---------------
    let status;
    let order;
    let page;
    let pageOption;
    let pageStatus;
    let pageContent = function() {
        $.ajax({
            type: "post",
            url: "ingredient_datalist_api.php",
            data: {
                status: status,
                order: order,
                page: page,
            },
            dataType: "json",
        }).done(function(pageVar) {
            columnList(pageVar);
            pageChange(pageVar);
            totalPages = pageVar.totalPages;
            order = pageVar.order;
            // ----product page previous next---------------
            $("#pageContainer").on("click", "#pageContainer li", function(e) {
                lastPage = pageVar.page;
                pageOption = {
                    previous: (lastPage) => {
                        return page = lastPage - 1 ? lastPage - 1 : 1;
                    },
                    previousAll: (lastPage) => {
                        return page = (lastPage - 3) ? lastPage - 3 : 1;
                    },
                    next: (lastPage) => {
                        return page = (lastPage < totalPages) ? lastPage + 1 : totalPages;
                    },
                    nextAll: (lastPage) => {
                        return page = (lastPage >= totalPages) ? totalPages : lastPage + 3;
                    }
                }
                e.stopPropagation();
                pageId = $(this).attr("id");
                if (pageId) {
                    pageOption[pageId](page);
                } else {
                    page = $(this).text();
                }
                $.ajax({
                    type: "POST",
                    url: "ingredient_datalist_api.php",
                    data: {
                        status: status,
                        order: order,
                        page: page,
                    },
                    dataType: "json"
                }).done(function(pageVar) {
                    columnList(pageVar);
                    pageChange(pageVar);
                    lastPage = pageVar.page;
                    totalPages = pageVar.totalPages;
                })
            })
            // ----product page previous next end---------------
            // ----product order---------------
            $("#all_form a").click(function() {
                order = $(this).data("order");
                $.post("ingredient_datalist_api.php", {
                    status: status,
                    order: order,
                    page: page
                }, function(pageVar) {
                    // $("#tdContainer").empty();
                    columnList(pageVar);
                    pageChange(pageVar);
                }, 'json')
            });
            // ----product order end---------------
        });
    }
    pageContent();

    // ----product status---------------
    $("#navbarSupportedContent a").click(function() {
        status = $(this).data("status");
        $("#navbarSupportedContent").find("button").removeClass("active");
        $(this).find("button").addClass("active");
        switch (status) {
            case "all":
                $("#allDelete").css("display", "block");
                $("#allOnSale").css("display", "block");
                $("#allOffSale").css("display", "block");
                break;
            case "on_sale":
                $("#allDelete").css("display", "block");
                $("#allOnSale").css("display", "none");
                $("#allOffSale").css("display", "block");
                break;
            case "off_sale":
                $("#allDelete").css("display", "block");
                $("#allOnSale").css("display", "block");
                $("#allOffSale").css("display", "none");
                break;
            case "lack_stock":
                $("#allDelete").css("display", "block");
                $("#allOffSale").css("display", "block");
                $("#allOffSale").css("display", "block");
                break;
            case "no_stock":
                $("#allDelete").css("display", "block");
                $("#allOnSale").css("display", "none");
                $("#allOffSale").css("display", "none");
                break;
        }
        $.ajax({
            type: "post",
            url: "ingredient_datalist_api.php",
            data: {
                status: status
            },
            dataType: "json",
        }).done(function(pageVar) {
            columnList(pageVar);
            pageChange(pageVar);
            pageStatus = pageVar.condition;
        })
    })
    // ----product status end---------------

    // ----product delete---------------
    $("#tdContainer").on("click", ".del", function(e) {
        e.stopPropagation();
        let delete_sid = $(this).attr("data-sid");
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
                    pageChange(pageVar);
                });

            }).fail(function(jqXHR, textStatus, errorThrown) {
                //失敗的時候
                alert("有錯誤產生，請看 console log");
                console.log(jqXHR.responseText);
            });
        }
        return false;
    })

    // ----product delete end---------------


    // ----product search---------------
    $("#form_search").click(function(e) {
        e.preventDefault();
        let search = $("#product_num").val();
        $.ajax({
            type: "post",
            url: 'ingredient_search_api.php',
            data: {
                search: search
            },
            dataType: 'json',
        }).done(function(data) {
            if (data) {
                $("#tdContainer").empty();
                $("#tdContainer").append(`<tr><td><input type="checkbox" id="check1" class="checkbox" name="checkOne[]" value="${data[0]}"><label for="check1"><span></span></label></td>
            <td>${data[0]}</td>
            <td>${data[2]}</td> 
                    <td>${data[7]}</td>
                    <td>${data[6]}</td>
                    <td>${data[12]}</td>
                    <td>${data[13]}</td>
                    <td scope="col" data-sid="${data[0]}" class="del"><a href=""><i class="fas fa-trash-alt" style="color:#fff; margin-right:20px;"></i></a>
                        <a href="ingredient_edit.php?sid=${data[0]}"><i class="fas fa-edit" style="color:#fff;"></i></a></td></tr>`);
            } else {
                alert("沒有搜尋結果");
            }
        })
    })

    // ----product search end---------------
</script>

<!-- 批量操作 start -->
<script>
    $("#allDelete").click(function() {
        if (confirm("確定批量刪除嗎?")) {
            $("#all_form").attr("action", 'ingredient_allDelete_api.php');
            $("#all_form").submit();
        } else {
            alert("取消刪除");
        }
    })

    $("#allOnSale").click(function() {
        if (confirm("確定批量上架嗎?")) {
            $("#all_form").attr("action", 'ingredient_allOnSale_api.php');
            $("#all_form").submit();
        } else {
            alert("取消上架");
        }
    })

    $("#allOffSale").click(function() {
        if (confirm("確定批量下架嗎?")) {
            $("#all_form").attr("action", 'ingredient_allOffSale_api.php');
            $("#all_form").submit();
        } else {
            alert("取消下架");
        }
    })

</script>
<script>
    //  JQ slide-In status bar 
    $("#ulSlide").hover(function() {
        $("#conditionSlide").toggleClass("fadeInLeft").removeClass("fadeOutLeft").removeClass("invisible");
    }, function() {
        $("#conditionSlide").removeClass("fadeInLeft").addClass("fadeOutLeft");
    })
    // JQ slide-In status bar end 

    // JQ checkBox

    let totalCheckBox = $("#tdContainer  :checkbox").length;
    let checkCount = $("#tdContainer  :checked").length;
    $("#tdContainer :checkbox").click(function() {
        checkCount = $("tdContainer :checked").length;
        if (checkCount == totalCheckBox) {
            $("#check_all").prop("checked", true);
        } else {
            $("#check_all").prop("checked", false);
        }

        if ($(this).attr("checked")) {
            $("this").closest("tr").css("background", "#FF8800");
        } else {
            $("tr").css("background", "none");
        }

    });

    $("#check_all").click(function() {
        let ifCheck = $(this).prop("checked");
        if (ifCheck) {
            $("#tdContainer :checkbox").prop("checked", true);
        } else {
            $("#tdContainer :checkbox").prop("checked", false);
        }
    });

    $("#allDelete").closest("ul").hover(function(){
        $("#statusSlide").addClass("fadeInLeft").removeClass("fadeOutLeft").removeClass("invisible");
    },function(){
        $("#statusSlide").removeClass("fadeInLeft").addClass("fadeOutLeft").add("invisible");
    })
    // JQ  checkbox end
</script>
<?php
require __DIR__ . "/footer_in.php";
?>