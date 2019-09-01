<style>
    .navbar-nav .active {
        background: orange;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link <?= $page_name=='datalist'? 'active':''?>" href="datalist.php">datalist</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page_name=='insertdata'? 'active':''?>" href="insertdata.php">insertdata</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page_name=='page2'? 'active':''?>" href="page2.php">page2</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>