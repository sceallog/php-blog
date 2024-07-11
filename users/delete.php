<?php
include '../connect.php';
include '../head.php';
// http://localhost/M23W0012/0613/users/delete.php?id=<id>

$id = $_GET['id'];
// ログインしていなければ、ログイン画面へ転送
if(!isset($_SESSION['id']) || $_SESSION['id'] != $id){
    header('Location: ../login/login.html');
    exit(0);
}

if($id != ''){
    // SQL文のDELETEを実行する
    $statement = $conn->prepare(
        "DELETE FROM `users` WHERE id = :id LIMIT 1;"
    );
    $statement->execute(array(':id' => $id));
    $count = $statement->rowCount();

    if(isset($count) && $count == 1){
        echo "ユーザを削除しました。id = {$id}";
        session_destroy();
    }
}

setHead('User Delete', '../assets/style.css');
?>
<body>

</body>
</html>