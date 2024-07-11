<?php
include '../connect.php';
include '../head.php';

if(isset($_GET['id'])){
    // 初回表示でread.phpの先頭のコードを流用
    $id = $_GET['id'];
    if(!isset($_SESSION['id'])){
        header('Location: ../login/login.html');
        exit(0); // PHPのプログラムを終了
    }
    $statement = $conn->prepare("SELECT * FROM users WHERE id=:id;");
    $statement->execute(array(':id' => $id));
    $r = $statement->fetch();
} else {
//    更新作業になるので、elseの{}で囲む
    $id = isset($_POST['id']) ? $_POST['id'] : "";

    if(!isset($_SESSION['id']) || $_SESSION['id'] != $id){
        header('Location: ../login/login.html');
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

setHead('User Update', '../assets/style.css');
?>
<body>
<?php
if(isset($count) && $count == 1) {
    echo "ユーザ情報を更新しました。id = {$id}<br>";
}
?>
<h3>ユーザ情報更新</h3>
<form method="post" action="update.php">
    <input type="hidden" name="id" value="<?php echo($id); ?>">
    <label for="name">お名前</label>
    <input type="text" name="name" id="name" value="<?php echo($r['name']); ?>"><br>
    <label for="userID">ユーザID</label>
    <input type="text" name="userID" id="userID" value="<?php echo($r['userID']); ?>"><br>
    <label for="password">パスワード</label>
    <input type="text" name="password" id="password" value="<?php echo($r['password']); ?>"><br>
    <button>更新</button>
</form>
</body>
</html>
