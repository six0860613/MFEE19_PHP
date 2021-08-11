<?php
include __DIR__ . '/partials/init.php';
$title = "輸入資料"; // 透過在把每個頁面可能不同的文字模組化，設定參數再改變每個頁面的title

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
                    <h5 class="card-title">新增資料</h5>
                    <form name="insertForm" onsubmit="checkForm(); return false;">
                        <div class="form-group">
                            <label for="name">姓名</label>
                            <input type="text" class="form-control" id="name" name="name">
                            <small class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="email">信箱</label>
                            <input type="text" class="form-control" id="email" name="email">
                            <small class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="mobile">手機</label>
                            <input type="text" class="form-control" id="mobile" name="mobile">
                            <small class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="birthday">生日</label>
                            <input type="date" class="form-control" id="birthday" name="birthday">
                            <small class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="address">地址</label>
                            <input type="text" class="form-control" id="address" name="address">
                            <small class="form-text"></small>
                        </div>

                        <button type="submit" class="btn btn-primary">送出</button>
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

            fetch('data-insert-api.php', {
                    method: 'POST',
                    body: fd,
                })
                .then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if(obj.success){
                        location.href = 'data-list.php';
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