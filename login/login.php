<?php
include '../components/head.php';
?>
<!doctype html>
<html lang="ja">
<?php
setHead('ログイン', '../assets/style.css', '../assets/main.js');
?>
<body>
<div class="container py-4">
    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
        <h3 class="text-center">ログイン</h3>
<form method="POST" action="check.php">
<div class="mb-3">
<label for="userID" class="form-label">ユーザー名</label>
<input name="userID" type="text" class="form-control" id="userID"/>
</div>
    <div class="mb-3">
<label for="password" class="form-label">パスワード</label>
<input name="password" type="password" class="form-control" id="password"/>
    </div>
<div class="d-grid gap-2 col-6 mx-auto">
<button type="submit" class="btn btn-success">ログイン</button>
<a href="../users/create.php" class="mx-auto">アカウントをお持ちでない方はこちら</a>
</div>
</form>
    </div>
</div>
</body>
</html>