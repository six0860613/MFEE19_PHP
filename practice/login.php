<?php include __DIR__ . '/mod/initialization.php' ?>
<?php
$title = "登入";
if (isset($_SESSION['user'])) {
    header('Location: index_.php'); //如果是登入狀態時就直接跳轉(採用302轉址)
    exit;
}

?>


<?php include __DIR__ . '/mod/html-header.php' ?>
<?php include __DIR__ . '/mod/html-navbar.php' ?>
<style>
    .login-box {
        border: 2px solid gray;
        padding: 10px;
    }

    .form-text {
        color: red;
        display: none;
    }
</style>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-6 login-box">
            <form name="form1" onsubmit="sendForm(); return false;">
                <div class="form-group">
                    <label for="exampleInputEmail1">帳號</label>
                    <input type="text" class="form-control" name="account" id="account" placeholder="輸入帳號">
                    <small class="form-text">帳號不可為空</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">密碼</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="輸入密碼">
                    <small class="form-text">密碼不可為空</small>
                </div>
                <button type="submit" class="btn btn-primary">登入</button>
            </form>
        </div>
    </div>
</div>

<?php include __DIR__ . '/mod/html-script.php' ?>

<script>
    function sendForm() {
        let isPass = true;
        document.querySelector("#account").nextElementSibling.style.display = 'none';
        document.querySelector("#password").nextElementSibling.style.display = 'none';
        if (!document.querySelector("#account").value) {
            document.querySelector("#account").nextElementSibling.style.display = 'block';
            isPass = false;
        }
        if (!document.querySelector("#password").value) {
            document.querySelector("#password").nextElementSibling.style.display = 'block';
            isPass = false;
        }

        if (isPass) {
            const fd = new FormData(document.form1);

            fetch('login-api.php', {
                    method: 'POST',
                    body: fd,
                })
                .then(r => r.json())
                .then(obj => {
                    console.log('result:', obj);
                    if (obj.login_success) {
                        location.href = 'index_.php';
                    } else {
                        alert(obj.error);
                    }
                });
        }
    }
</script>

<?php include __DIR__ . '/mod/html-foot.php' ?>