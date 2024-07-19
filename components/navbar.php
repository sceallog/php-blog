<?php
$loggedInUser = $_SESSION['name'];
if (isset($loggedInUser)) {
    $message = "
    <div class='nav-item dropdown'>
        <a href='#' class='nav-link dropdown-toggle' role='button' data-bs-toggle='dropdown' data-bs-display='static'>${loggedInUser}</a>
        <ul class='dropdown-menu dropdown-menu-lg-end'>
            <li><a href='#' class='dropdown-item'>プロフィール</a></li>
            <li><a href='#' class='dropdown-item'>マイ記事</a></li>
            <li><hr class='dropdown-divider'></li>
            <li><a href='../login/logout.php' class='dropdown-item text-danger'>ログアウト</a></li>
        </ul>
    </div>
    ";
    } else {
    $message = "
    <form action='../login/login.php'>
        <button class='btn btn-primary'>ログイン</button>
    </form>
    ";
}
?>
<nav class="navbar navbar-expand-lg text-bg-primary">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav nav-underline me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link text-bg-primary" aria-current="page" href="../users/search.php">ユーザー</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-bg-primary" href="../articles/search.php">記事</a>
        </li>
      </ul>
        <div class="d-flex">
            <?php echo $message ?>
        </div>
    </div>
  </div>
</nav>