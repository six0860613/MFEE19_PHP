<nav class="navbar navbar-expand-md navbar-light bg-light">
  <a class="navbar-brand" href="#">Wandering</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index_.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="product.php">Product</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Cart</a>
      </li>
    </ul>
    <ul class="navbar-nav">
      <?php if(isset($_SESSION['user'])) : //確認session暫存是否存在 ?>
      <li class="nav-item">
        <a class="nav-link active" href=""><?= $_SESSION['user']['nickname'].',你好' ?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
        <?php else :?>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Regist</a>
      </li>
      <?php endif; ?>
    </ul>
  </div>
</nav>