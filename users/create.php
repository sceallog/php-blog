<?php
include '../connect.php';
include '../components/head.php';

$conn = connect();
$userID = isset($_POST['userID'])? $_POST['userID'] : '';
$name = isset($_POST['name'])? $_POST['name'] : '';
$password = isset($_POST['password'])? $_POST['password'] : '';
//入力前の段階ではないか、入力内容に不足がないか確認。
if($userID != '' && $name != '' && $password != ''){
    // SQL文のINSERT INTOを実行する
   $statement = $conn->prepare(
            "INSERT INTO users (userID, name, password) 
            VALUES (:userID, :name, :password)"
   );
   $statement -> execute(array(":userID" => $userID, ":name" => $name, ":password" => $password));
   $count = $statement->rowCount();
   if($count == 1){
       // ユーザ追加に成功
       $id = $conn->lastInsertId(); // 自動採番されたidの番号を取得する
   }
}
?>
<!DOCTYPE html>
<html lang="ja">
<?php
setHead('User Create', '../assets/style.css', '../assets/main.js');
?>
<body>
<?php
if(isset($id)) {
    echo "ユーザを追加しました。id = ";
    echo '<a href="read.php?id=',
    $id, '">',
    $id,
    '</a><br>';
}
?>
<div class="container py-4">
    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
<h3 class="text-center">ユーザーの新規登録</h3>
<form  method="post">
    <div class="mb-3">
            <label for="name" class="form-label">お名前</label>
            <input type="text" class="form-control" name="name" id="name">
    </div>
    <div class="mb-3">
            <label for="userID" class="form-label">ユーザ名</label>
            <input type="text" class="form-control" name="userID" id="userID">
    </div>
    <div class="mb-3">
            <label for="password" class="form-label">パスワード</label>
            <input type="text" class="form-control" name="password" id="password">
    </div>
    <div class="d-grid gap-2 col-6 mx-auto">
                <button type="submit" class="btn btn-success">登録</button>
    </div>
</form>
</div>
</div>
</body>
</html>
