<nav class="navbar navbar-expand-lg">
    <h3 style="color:#FFC107; padding: 0 50px 0 0;">食材管理介面</h3>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav mr-auto">

                <li class="nav-item <?= $page_name == 'ingredient_datalist' ? 'active' : '' ?> ">
                    <a class="nav-link" href="ingredient_datalist.php"><button type="button" class="btn btn-outline-warning" style="width:100px;">全部商品</button></a>
                </li>

                <li class="nav-item <?= $page_name == 'ingredient_datalist_onsale' ? 'active' : '' ?> ">
                    <a class="nav-link" href="ingredient_datalist_onsale.php"><button type="button" class="btn btn-outline-warning" style="width:100px;">出售中</button></a>
                </li>

                <li class="nav-item <?= $page_name == 'ingredient_datalist_offsale' ? 'active' : '' ?> ">
                    <a class="nav-link" href="ingredient_datalist_offsale.php"><button type="button" class="btn btn-outline-warning" style="width:100px;">下架中</button></a>
                </li>

                <li class="nav-item <?= $page_name == 'ingredient_datalist_lack' ? 'active' : '' ?> ">
                    <a class="nav-link" href="ingredient_datalist_lack.php"><button type="button" class="btn btn-outline-warning" style="width:100px;">庫存緊張</button></a>
                </li>

                <li class="nav-item <?= $page_name == 'ingredient_datalist_nostock' ? 'active' : '' ?> ">
                    <a class="nav-link" href="ingredient_datalist_nostock.php"><button type="button" class="btn btn-outline-warning" style="width:100px;">缺貨中</button></a>
                </li>

            </ul>
            <ul class="navbar-nav">
                <li  class="nav-item <?= $page_name == 'appliance_list_insert' ? 'active' : '' ?> ">
                    <a class="nav-link" href="appliance_list_insert.php"><button type="button" class="btn btn-outline-warning" style="width:100px;">新增商品</button></a>
                </li>
            </ul>
    </div>
</nav>