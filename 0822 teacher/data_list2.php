<?php
require __DIR__. '/__connect_db.php';
$page_name = 'data_list2';
$page_title = '資料列表';


?>
<?php include __DIR__. '/__html_head.php' ?>
<?php include __DIR__. '/__navbar.php' ?>
<div class="container">
<div style="margin-top: 2rem;">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
        </ul>
    </nav>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">姓名</th>
            <th scope="col">電子郵箱</th>
            <th scope="col">手機</th>
            <th scope="col">生日</th>
            <th scope="col">地址</th>
        </tr>
        </thead>
        <tbody id="t_content">

        </tbody>
    </table>
</div>
    <script>
        const pagination = document.querySelector('.pagination');
        const t_content = document.querySelector('#t_content');
        const pagination_str = `
            <li class="page-item <%= active %>">
                <a class="page-link" href="javascript:loadData(<%= i %>)"><%= i %></a>
            </li>
        `;
        const table_row_str = `
        <tr>
                <td><%= sid %></td>
                <td><%= name %></td>
                <td><%= email %></td>
                <td><%= mobile %></td>
                <td><%= birthday %></td>
                <td><%= address %></td>
            </tr>
        `;

        const pagination_fn = _.template(pagination_str);
        const table_row_fn = _.template(table_row_str);

        function loadData(page=1){

            fetch('data_list2_api.php?page=' + page)
                .then(response=>{
                    return response.json();
                })
                .then(json=>{
                    console.log(json);
                    let i, s, item;
                    let t_str = '';
                    for(s in json.rows){
                        item = json.rows[s];

                        t_str += table_row_fn(item)

                    }
                    t_content.innerHTML = t_str;

                    let p_str = '';
                    for(i=1; i<=json.totalPages; i++){
                        let active = i===json.page ? 'active' : '';
                        p_str += pagination_fn({i:i, active:active});
                    }
                    pagination.innerHTML = p_str;
                });
        }

        loadData();
    </script>
</div>
<?php include __DIR__. '/__html_foot.php' ?>
