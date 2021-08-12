<?php
//https://developer.mozilla.org/en-US/docs/Web/API/FileReader/readAsDataURL 圖片預覽
include __DIR__ . '/partials/init.php';
$title = '修改個人資料';

//未登入時跳至data-list
if (!isset($_SESSION['user'])) {
    header('Location: data-list.php');
    exit;
}

//SQL選擇語法：選擇members表，以ID選擇
$sql = "SELECT * FROM `members` WHERE id=" . intval($_SESSION['user']['id']);

$r = $pdo->query($sql)->fetch();

if (empty($r)) {
    header('Location: index_.php');
    exit;
}

// echo json_encode($row, JSON_UNESCAPED_UNICODE);
?>

<?php include __DIR__ . '/partials/html-header.php'; ?>
<?php include __DIR__ . '/partials/navbar.php'; ?>

<style>
    .form-text {
        color: red;
        font-weight: bold;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">修改個人資料</h5>
                    <form name="insertForm" onsubmit="checkForm(); return false;">
                        <!-- 隱藏的欄位自動填入sid -->
                        <input type="hidden" name="id" value="<?= $r['id'] ?>">
                        <div class="form-group">
                            <label for="avatar">大頭貼</label>
                            <input type="file" class="form-control" id="avatar" name="avatar"  accept="image/*">
                            <?php if(empty($r['avatar'])) : ?>
                                <!-- 預設圖片 -->
                            <?php else : ?>
                                <!-- 使用者圖片 -->
                                <img src="imgs/<?= $r['avatar'] ?>" alt="" width="300px">
                            <?php endif; ?>
                            <!-- 圖片路徑存在avatar中 -->
                            
                        </div>
                        <div class="form-group">
                            <label for="email">信箱(帳號無法修改)</label>
                            <input type="text" class="form-control" disabled value="<?= $r['email'] ?>">
                            <small class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="nickname">暱稱</label>
                            <input type="text" class="form-control" id="nickname" name="nickname" value="<?= $r['nickname'] ?>">
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
    function checkForm() {
         
        const fd = new FormData(document.insertForm);

        fetch('profile-edit-api.php', {
                method: 'POST',
                body: fd
            })
            .then(r => r.json())
            .then(obj => {
                console.log(obj);
                if (obj.success) {
                    alert('修改成功');
                } else {
                    alert(obj.error);
                }
            })
            .catch(error => {
                console.log('error:', error);
            });
           
    }
</script>
<?php include __DIR__ . '/partials/html-footer.php'; ?>