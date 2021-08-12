<?php
include __DIR__ . '/partials/init.php';
$title = "表單元素"; // 透過在把每個頁面可能不同的文字模組化，設定參數再改變每個頁面的title
?>

<?php include __DIR__ . '/partials/html-header.php'; ?>
<?php include __DIR__ . '/partials/navbar.php'; ?>
<h2>Form Element</h2>
<div class="container">
    <div class="row">
        <div class="col">

            <form name="form1" action="form-elements-api.php" method="post">
                <!-- combobox -->
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Example select</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="combo1">
                        <option value="" disabled selected>請選擇...</option>
                        <option value="1">甲</option>
                        <option value="2">乙</option>
                        <option value="3">丙</option>
                        <option value="4">丁</option>
                    </select>
                </div>

                <!-- radio button -->
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1">
                        <label class="form-check-label" for="exampleRadios1">
                            跑步
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2" checked>
                        <label class="form-check-label" for="exampleRadios2">
                            游泳
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3">
                        <label class="form-check-label" for="exampleRadios3">
                            爬山
                        </label>
                    </div>
                </div>

                <!-- checkbox -->
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="cb[]" id="inlineCheckbox1" value="option1">
                        <label class="form-check-label" for="inlineCheckbox1">1</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="cb[]" id="inlineCheckbox2" value="option2">
                        <label class="form-check-label" for="inlineCheckbox2">2</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="cb[]" id="inlineCheckbox3" value="option3">
                        <label class="form-check-label" for="inlineCheckbox3">3</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>

</div>
<?php include __DIR__ . '/partials/script.php'; ?>
<?php include __DIR__ . '/partials/html-footer.php'; ?>