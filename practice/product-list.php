<?php include __DIR__ . '/mod/initialization.php' ?>
<?php $title = "商品"; ?>

<?php
//關鍵字查詢
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

$where = ' WHERE 1 ';
$hbq = []; //http_bulid_query用的陣列
if (!empty($keyword)) {
    //$where .= " AND `name` LIKE '%{$keyword}%' " //會有漏洞
    $where .= sprintf(" AND `course_name` LIKE %s ", $pdo->quote('%' . $keyword . '%'));
    $hbq['keyword'] = $keyword;
}
//每頁顯示幾筆用的參數
$perPage = 3;

//用戶決定查看第幾頁，預設第一頁
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

//總共幾筆
$totalRows = $pdo->query("SELECT count(1) FROM product $where")->fetch(PDO::FETCH_NUM)[0];

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
    "SELECT * FROM product %s ORDER BY sid ASC LIMIT %s, %s",
    $where,
    ($page - 1) * $perPage,
    $perPage
);


$rows = $pdo->query($sql)
    ->fetchAll();

?>

<?php include __DIR__ . '/mod/html-header.php' ?>
<?php include __DIR__ . '/mod/html-navbar.php' ?>

<style>
    table tbody .fa-trash-alt {
        color: red;
    }

    .ajaxDelete {
        color: orangered !important;
        cursor: pointer;
    }

    .card-title{
        height: 50px;
    }
</style>

<div class="container">
    <!-- 查詢課程 -->
    <div class="row">
        <div class="col my-2">
            <form action="product-list.php" class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" name="keyword" placeholder="Search" aria-label="Search" value="<?= htmlentities($keyword) ?>">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </div>
    <!-- 頁碼跳轉 -->
    <div class="row">
        <div class="col my-2">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?= $page <= 1 ? 'disabled' : '' //使小於頁1時失效
                                            ?>">
                        <a class="page-link" href="?<?php $hbq['page'] = $page - 1;
                                                    echo http_build_query($hbq); ?>">
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
                        <a class="page-link" href="?<?php $hbq['page'] = $page + 1;
                                                    echo http_build_query($hbq); ?>">
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- 商品陳列 -->
    <div class="row">
            <?php foreach($rows as $r): ?>
            <div class="col-md-3 product-unit" data-sid="<?= $r['sid'] ?>">
                <div class="card" >
                    <img src="imgs/<?= $r['sid'] ?>.png" alt="">
                    <div class="card-body">
                        <h6 class="card-title"><?= $r['course_name'] ?></h6>
                        <p class="card-text"><i class="fas fa-chalkboard-teacher"></i> <?= $r['teacher_name'] ?></p>
                        <p class="card-text"><i class="fas fa-dollar-sign"></i> <?= $r['course_price'] ?></p>
                        <form>
                            <div class="form-group">
                                <select class="form-control qty" style="display: inline-block; width: auto">
                                    <?php for($i=1; $i<=10; $i++){ ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php } ?>
                                </select>
                                <button type="button" class="btn btn-primary add-to-cart-btn"><i class="fas fa-cart-plus"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary modal-del-btn">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/mod/html-script.php' ?>
<script>
    const modal = $('#exampleModal');

    // modal script
    let willDeleteID = 0;
    $('.deleteBTN').on('click', function(event) {
        willDeleteID = event.target.closest('tr').dataset.sid;
        console.log(willDeleteID);
        modal.find('.modal-body').html(`確定刪除編號${willDeleteID}嗎?`);
    });

    modal.find('.modal-del-btn').on('click', function(event) {
        console.log(`data-delete.php?sid=${willDeleteID}`);
        location.href = `data-delete.php?sid=${willDeleteID}`;
    });

    // modal.on('show.bs.modal', function(event){
    //     console.log(event.target);
    // });
</script>
<?php include __DIR__ . '/mod/html-foot.php' ?>