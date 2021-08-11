<?php

include __DIR__ . '/partials/init.php';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$sql = "SELECT * FROM `address_book` WHERE sid=$sid";

$r = $pdo->query($sql)->fetch();

if(empty($r)){
    header('Location: data-list.php');
    exit;
}

// echo json_encode($row, JSON_UNESCAPED_UNICODE);
?>

<?php include __DIR__ . '/partials/html-header.php'; ?>
<?php include __DIR__ . '/partials/navbar.php'; ?>

<style>
    .form-text{
        color: red;
        font-weight: bold;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">修改資料</h5>
                    <form name="insertForm" onsubmit="checkForm(); return false;">
                        <!-- 隱藏的欄位自動填入sid -->
                        <input type="hidden" name="sid" value="<?= $r['sid'] ?>">
                        <div class="form-group">
                            <label for="name">姓名</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= htmlentities($r['name']) //特殊字元跳脫方法 ?>">
                            <small class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="email">信箱</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?= $r['email'] ?>">
                            <small class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="mobile">手機</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" value="<?= $r['mobile'] ?>">
                            <small class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="birthday">生日</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" value="<?= $r['birthday'] ?>">
                            <small class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="address">地址</label>
                            <!-- textarea也可以顯示特殊字元 -->
                            <textarea class="form-control" id="address" name="address" cols="30" rows="3"><?= $r['address'] ?></textarea>
                            <small class="form-text"></small>
                        </div>

                        <button type="submit" class="btn btn-primary">修改</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

</div>
<?php include __DIR__ . '/partials/script.php'; ?>
<script>
    const email_re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    const mobile_re = /^09\d{2}-?\d{3}-?\d{3}$/;

    const email = document.querySelector('#email');
    const name = document.querySelector('#name');

    name.nextElementSibling.innerHTML = '';
    name.style.border = '1px #ced4da solid';
    email.nextElementSibling.innerHTML = '';
    email.style.border = '1px #ced4da solid';

    function checkForm() {
        let isPass = true;

        if (name.value.length < 2) {
            isPass = false;
            name.nextElementSibling.innerHTML = '請填寫正確姓名';
            name.style.border = '1px red solid';
        }
        if (!email_re.test(email.value)) {
            isPass = false;
            email.nextElementSibling.innerHTML = '請填寫正確信箱格式';
            email.style.border = '1px red solid';
        }


        if (isPass) {
            const fd = new FormData(document.insertForm);

            fetch('data-edit-api.php', {
                    method: 'POST',
                    body: fd
                })
                .then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if(obj.success){
                        alert('修改成功');
                    }else{
                        alert(obj.error);
                    }
                })
                .catch(error => {
                    console.log('error:', error);
                });
        }
    }
</script>
<?php include __DIR__ . '/partials/html-footer.php'; ?>