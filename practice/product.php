<?php include __DIR__ . '/mod/initialization.php' ?>
<?php $title = "商品"; ?>

<?php include __DIR__ . '/mod/html-header.php' ?>
<?php include __DIR__ . '/mod/html-navbar.php' ?>
<style>
    .form-control{
        width: 50%;
    }
</style>

<?php $j = 'Jeffrey 🔥國內外知名企業指定美國教師💼'; ?>

<div class="container">
    <div class="row">
        <div class="col-4">
            <form name="form1" action="addToCart-api.php" method="POST">
                <div class="card" style="width: 18rem;">
                    <img src="imgs/01.png" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">英文</h5>
                        <p class="card-text" name="court_name" value="<?= $j?>"><?= $j?></p>
                        <p class="card-text">售價：$ <span>7040</span></p>
                        <div class="form-group d-flex align-items-end justify-content-between">
                            <label for="count_qty">數量</label>
                            <select class="form-control" id="count_qty" name="court_qty">
                                <option value="" disabled selected>請選擇...</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Add To Cart</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- <div class="col-4">
            <form>
                <div class="card" style="width: 18rem;">
                    <img src="imgs/02.png" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Ai老師的日語課🌸商務日語專家🐰</h5>
                        <p class="card-text">Ai老師</p>
                        <p class="card-text">售價：$ <span>2755</span></p>
                        <a href="#" class="btn btn-primary">Add To Cart</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-4">
            <form>
                <div class="card" style="width: 18rem;">
                    <img src="imgs/03.png" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">中文</h5>
                        <p class="card-text">Eva🧡中文會話專家🧡兒童中文｜中文會話｜零到中高階學習者</p>
                        <p class="card-text">售價：$ <span>6420</span></p>
                        <a href="#" class="btn btn-primary">Add To Cart</a>
                    </div>
                </div>
            </form>
        </div> -->
    </div>
</div>

<?php include __DIR__ . '/mod/html-script.php' ?>
<?php include __DIR__ . '/mod/html-foot.php' ?>