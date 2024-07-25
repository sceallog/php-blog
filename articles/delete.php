<?php
include('../connect.php');
include('../components/head.php');
// http://localhost/M23W0012/0613/users/delete.php?id=<id>

$conn = connect();
$id = $_GET['id']; // 記事のID
$authorID = $_SESSION['id']; // ログイン中のユーザのID
// ログインしていなければ、ログイン画面へ転送
if(!isset($authorID)){
    header('Location: ../login/login.php');
    exit(0); // PHPのプログラム終了
}

if($id != ''){
    // SQL文のDELETEを実行する
    $statement = $conn->prepare(
        "DELETE FROM articles 
        WHERE id = :id 
        AND author = :authorID
        LIMIT 1;");
    $statement -> execute(
            array(":id" => $id, ":authorID" => $authorID)
    );
    $count = $statement -> rowCount();
    if(isset($count) && $count == 1){
        header('Location: ../articles/search.php');
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<?php
setHead('Article Delete', '../assets/style.css', '../assets/main.js');
?>
<body>

</body>
</html>