<?php
include __DIR__ . '/partials/init.php';
$title = "資料列表"; // 透過在把每個頁面可能不同的文字模組化，設定參數再改變每個頁面的title

//關鍵字查詢
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

$where = ' WHERE 1 ';
$hbq = []; //http_bulid_query用的陣列
if (!empty($keyword)) {
    //$where .= " AND `name` LIKE '%{$keyword}%' " //會有漏洞
    $where .= sprintf(" AND `name` LIKE %s ", $pdo->quote('%' . $keyword . '%'));
    $hbq['keyword'] = $keyword;
}
//每頁顯示幾筆用的參數
$perPage = 5;

//用戶決定查看第幾頁，預設第一頁
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

//總共幾筆
$totalRows = $pdo->query("SELECT count(1) FROM address_book $where")->fetch(PDO::FETCH_NUM)[0];

//總共幾頁
$totalPages = ceil($totalRows / $perPage); //ceil函數 無條件進位
//echo "$totalRows, $totalPages"; exit; 測試用

//如果硬修改?page的值時的跳轉保護
if ($totalRows != 0) {
    if ($page < 1) {
        exit;
    }
}

$sql = sprintf(
    "SELECT * FROM address_book %s ORDER BY sid ASC LIMIT %s, %s",
    $where,
    ($page - 1) * $perPage,
    $perPage
);


$rows = $pdo->query($sql)
    ->fetchAll();

?>

<?php include __DIR__ . '/partials/html-header.php'; ?>
<?php include __DIR__ . '/partials/navbar.php'; ?>

<style>
    table tbody .fa-trash-alt {
        color: red;
    }

    .ajaxDelete {
        color: orangered !important;
        cursor: pointer;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col my-2">
            <form action="data-list.php" class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" name="keyword" placeholder="Search" aria-label="Search" value="<?= htmlentities($keyword) ?>">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col my-2">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?= $page <= 1 ? 'disabled' : '' //使小於頁1時失效
                                            ?>">
                        <a class="page-link" href="?<?php $hbq['page'] = $page - 1;  echo http_build_query($hbq); ?>">
                            <i class="fas fa-arrow-circle-left"></i>
                        </a>
                    </li>

                    <?php for ($i = $page - 3; $i <= $page + 3; $i++) :
                        if ($i >= 1 and $i <= $totalPages) :
                            $hbq['page'] = $i; //使hbq陣列等等印出來時多一個page=N的echo 
                    ?>
                            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                <a class="page-link" href="?<?= http_build_query($hbq); ?>">
                                    <?= $i ?>
                                </a>
                            </li>
                    <?php endif;
                    endfor; ?>

                    <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?<?php $hbq['page'] = $page + 1;  echo http_build_query($hbq); ?>">
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col"><i class="fas fa-trash-alt"></i></th>
                        <th scope="col"><i class="fas fa-trash-alt">ajax</i></th>
                        <th scope="col">sid</th>
                        <th scope="col">name</th>
                        <th scope="col">email</th>
                        <th scope="col">mobile</th>
                        <th scope="col">birthday</th>
                        <th scope="col">address</th>
                        <th scope="col"><i class="fas fa-edit"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $r) : ?>
                        <tr data-sid="<?= $r['sid'] ?>">
                            <td>
                                <a href="data-delete.php?sid=<?= $r['sid'] ?>" onclick="return confirm('確定要刪除<?= $r['sid'] ?>的資料嗎？');">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                            <td>
                                <i class="fas fa-trash-alt ajaxDelete"></i>
                            </td>
                            <td><?= $r['sid'] ?></td>
                            <td><?= $r['name'] ?></td>
                            <td><?= $r['email'] ?></td>
                            <td><?= $r['mobile'] ?></td>
                            <td><?= $r['birthday'] ?></td>
                            <td><?= $r['address'] ?></td>
                            <td>
                                <a href="data-edit.php?sid=<?= $r['sid'] ?>">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>


    <h2>Hello List</h2>

</div>
<?php include __DIR__ . '/partials/script.php'; ?>
<script>
    const myTable = document.querySelector('table');
    myTable.addEventListener('click', function(event) {
        console.log(event.target);
        //判斷是否有點擊到含有ajaxDelete這個class的物件
        if (event.target.classList.contains('ajaxDelete')) {
            console.log("trash click");

            const sid = event.target.closest('tr').getAttribute('data-sid'); //closest往上層查找符合的標籤
            const tr = event.target.closest('tr'); //抓取event目標的tr等等用來刪除

            console.log(sid);

            if (confirm(`確定要刪除${sid}的資料嗎？`)) {
                fetch('data-delete-api.php?sid=' + sid) //?sid= 的形式就是GET 因此不需設定method
                    .then(r => r.json())
                    .then(obj => {
                        if (obj.success) {
                            tr.remove(); //直接移除DOM物件
                        } else {
                            alert(obj.error);
                        }
                    });
            }
        }
    });
</script>
<?php include __DIR__ . '/partials/html-footer.php'; ?>