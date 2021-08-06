<?php
include __DIR__ . '/partials/init.php';
$title = "資料列表"; // 透過在把每個頁面可能不同的文字模組化，設定參數再改變每個頁面的title

//每頁顯示幾筆用的參數
$perPage = 5;

//用戶決定查看第幾頁，預設第一頁
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

//總共幾筆
$totalRows = $pdo->query("SELECT count(1) FROM address_book")->fetch(PDO::FETCH_NUM)[0];

//總共幾頁
$totalPages = ceil($totalRows / $perPage); //ceil函數 無條件進位
//echo "$totalRows, $totalPages"; exit; 測試用

$sql = sprintf("SELECT * FROM address_book ORDER BY sid DESC LIMIT %s, %s", ($page-1)*$perPage, $perPage);


$rows = $pdo->query($sql)
            ->fetchAll();

?>

<?php include __DIR__ . '/partials/html-header.php'; ?>
<?php include __DIR__ . '/partials/navbar.php'; ?>
<div class="container">

    <div class="row">
        <div class="col">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">sid</th>
                        <th scope="col">name</th>
                        <th scope="col">email</th>
                        <th scope="col">mobile</th>
                        <th scope="col">birthday</th>
                        <th scope="col">address</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($rows as $r) : ?>
                    <tr>
                        <td><?= $r['sid'] ?></td>
                        <td><?= $r['name'] ?></td>
                        <td><?= $r['email'] ?></td>
                        <td><?= $r['mobile'] ?></td>
                        <td><?= $r['birthday'] ?></td>
                        <td><?= $r['address'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>


    <h2>Hello List</h2>

</div>
<?php include __DIR__ . '/partials/script.php'; ?>
<?php include __DIR__ . '/partials/html-footer.php'; ?>