<nav class="navbar navbar-expand-lg" id="navController">
    <h3 style="color:#FFC107; padding: 0 50px 0 0;">食材管理介面</h3>
    <div class="collapse navbar-collapse transition" id="navbarSupportedContent">

        <ul class="navbar-nav mr-auto" id="ulSlide" class="d-flex">

            <li class="nav-item">
                <!-- <button class="nav-link" href="ingredient_datalist.php"><button type="button" class="btn btn-outline-warning" style="width:100px;">全部商品</button></a> -->
                <a class="nav-link" href="#" data-status="all"><button type="button" class="btn btn-outline-warning" style="width:100px;">全部商品</button></a>
            </li>
            <div id="conditionSlide" class="animated invisible d-flex">
                <li class="nav-item">
                    <!-- <a class="nav-link" href="ingredient_datalist_onsale.php"><button type="button" class="btn btn-outline-warning" style="width:100px;">出售中</button></a> -->
                    <a class="nav-link" href="#" data-status="on_sale"><button type="button" class="btn btn-outline-warning" style="width:100px;">出售中</button></a>
                </li>

                <li class="nav-item">
                    <!-- <a class="nav-link" href="ingredient_datalist_offsale.php"><button type="button" class="btn btn-outline-warning" style="width:100px;">下架中</button></a> -->
                    <a class="nav-link" href="#" data-status="off_sale"><button type="button" class="btn btn-outline-warning" style="width:100px;">下架中</button></a>
                </li>

                <li class="nav-item">
                    <!-- <a class="nav-link" href="ingredient_datalist_lack.php"><button type="button" class="btn btn-outline-warning" style="width:100px;">庫存緊張</button></a> -->
                    <a class="nav-link" href="#" data-status="lack_stock"><button type="button" class="btn btn-outline-warning" style="width:100px;">庫存緊張</button></a>
                </li>

                <li class="nav-item">
                    <!-- <button class="nav-link" href="ingredient_datalist_nostock.php"><button type="button" class="btn btn-outline-warning" style="width:100px;">缺貨中</button></a> -->
                    <a class="nav-link" href="#" data-status="no_stock"><button type="button" class="btn btn-outline-warning" style="width:100px;">缺貨中</button></a>
                </li>
            </div>

        </ul>
        <ul class="navbar-nav">
            <li class="nav-item <?= $page_name == 'ingredient_insertData' ? 'active' : '' ?> ">
                <a class="nav-link" href="ingredient_insertData.php"><button type="button" class="btn btn-outline-warning" style="width:100px;">新增商品</button></a>
            </li>
        </ul>
    </div>
</nav>