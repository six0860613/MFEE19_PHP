<?php
include __DIR__ . '/partials/init.php';

$sql = "SELECT * FROM `categories` ORDER BY `parent_sid`, `sequence`";

$rows = $pdo->query($sql)->fetchALL();

$dictionary = [];

//取得三層

foreach ($rows as &$r) {
    $dictionary[$r['sid']] = $r;
}

$tree = [];
foreach ($dictionary as $sid => $item) {
    if ($item['parent_sid'] == 0) {
        //判斷是否為首層
        $tree[] = &$dictionary[$sid];
    } else {
        //非首層的就一定有上層
        $dictionary[$item['parent_sid']]['nodes'][] = &$dictionary[$sid];
    }
}
?>
<?php include __DIR__ . '/partials/html-header.php'; ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php foreach ($tree as $c1) : ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#<?= $c1['sid'] ?>"  id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?= $c1['name'] ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php foreach ($c1['nodes'] as $c2) : ?>
                            <a class="dropdown-item" href="#<?= $c2['sid'] ?>">
                                <?= $c2['name']; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</nav>


<h2>Hello Index</h2>
<?php include __DIR__ . '/partials/script.php'; ?>
<?php include __DIR__ . '/partials/html-footer.php'; ?>