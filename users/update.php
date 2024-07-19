<?php
include '../connect.php';
include '../components/head.php';

$conn = connect();
if(isset($_GET['id'])){
    // 初回表示でread.phpの先頭のコードを流用
    $id = $_GET['id'];
    if(!isset($_SESSION['id'])){
        header('Location: ../login/login.php');
        exit(0); // PHPのプログラムを終了
    }
    $statement = $conn->prepare("SELECT * FROM users WHERE id=:id;");
    $statement->execute(array(':id' => $id));
    $r = $statement->fetch();
} else {
//    更新作業になるので、elseの{}で囲む
    $id = isset($_POST['id']) ? $_POST['id'] : "";

    if(!isset($_SESSION['id']) || $_SESSION['id'] != $id){
        header('Location: ../login/login.php');
        exit(0);
    }
    
    $userID = isset($_POST['userID'])? $_POST['userID'] : '';
    $name = isset($_POST['name'])? $_POST['name'] : '';
    $password = isset($_POST['password'])? $_POST['password'] : '';
    //入力前の段階ではないか、入力内容に不足がないか確認。
    if($id != '' && $userID != '' && $name != '' && $password != ''){
        // SQL文のINSERT INTOを実行する
        $statement = $conn->prepare("
            UPDATE users
            SET userID = :userID, name = :name, password = :password
            WHERE id = :id
            LIMIT 1;"
        );
        $statement->execute(array(":userID" => $userID, ":name" => $name, ":password" => $password, ":id" => $id));
        $count = $statement->rowCount();
    }
}
?>
<!DOCTYPE html>
<html lang="ja">

<?php
setHead('User Update', '../assets/style.css', '../assets/main.js');
?>
<body>
<?php
if(isset($count) && $count == 1) {
    echo "ユーザ情報を更新しました。id = {$id}<br>";
}
?>
<div class="container py-4">
    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
<h3 class="text-center">ユーザ情報更新</h3>
<form method="post" action="update.php">
    <input type="hidden" name="id" value="<?php echo($id); ?>">
    <div class="mb-3">
    <label for="name" class="form-label">お名前</label>
    <input type="text" name="name" id="name" class="form-control" value="<?php echo($r['name']); ?>"><br>
    </div>
    <div class="mb-3">
    <label for="userID" class="form-label">ユーザID</label>
    <input type="text" name="userID" id="userID" class="form-control" value="<?php echo($r['userID']); ?>"><br>
    </div>
    <div class="mb-3">
    <label for="password" class="form-label">パスワード</label>
    <input type="text" name="password" id="password" class="form-control" value="<?php echo($r['password']); ?>"><br>
    </div>
    <div class="d-grid gap-2 col-6 mx-auto">
    <button type="submit" class="btn btn-success">更新</button>
    </div>
</form>
    </div>
</div>
</body>
</html>
