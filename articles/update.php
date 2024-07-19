<?php
include '../connect.php';
include '../components/head.php';

$conn = connect();

if(!isset($_SESSION['id'])){
    header('Location: ../login/login.php');
    exit(0);
}

if(isset($_GET['id'])){
    // 初回表示でread.phpの先頭のコードを流用
    $id = $_GET['id'];
} else {
//    更新作業になるので、elseの{}で囲む
    $id = isset($_POST['id']) ? $_POST['id'] : "";
    $subject = isset($_POST['subject'])? $_POST['subject'] : '';
    $body = isset($_POST['body'])? $_POST['body'] : '';
    //入力前の段階ではないか、入力内容に不足がないか確認。
    if($id != '' && $subject != '' && $body != ''){
        // SQL文のINSERT INTOを実行する
        $statement = $conn->prepare("
            UPDATE articles
            SET subject = :subject, body = :body
            WHERE id = :id
            AND author = :author_id
            LIMIT 1;"
        );
        $statement -> execute(array(":subject" => $subject, ":body" => $body, ":id" => $id, ":author_id" => $_SESSION['id']));
        $count = $statement->rowCount();
    }
}
$statement = $conn->prepare("SELECT * FROM articles WHERE id=:id AND author=:author_id;");
$statement -> execute(array(":id" => $id, ":author_id" => $_SESSION['id']));
$r = $statement->fetch();
if(!$r){ // fetch()が失敗する場合、更新できない。 author='{$_SESSION['id']}' が等しくない。
    header("Location: ../login/login.php");
    exit(0);
}
?>
<!DOCTYPE html>
<html lang="ja">
<?php
setHead('Article Update', '../assets/style.css', '../assets/main.js');
?>
<body>
<?php
if(isset($count) && $count == 1) {
    echo "記事を更新しました。id: ";
    echo '<a href="read.php?id=', $id, '">', $id, '</a><br>';
}
?>
<div class="container py-4">
    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
<h3 class="text-center">記事の更新</h3>
<form method="post" action="update.php" >
    <input type="hidden" name="id" value="<?php echo($id); ?>">
    <div class="mb-3">
    <label for="subject" class="form-label">件名：</label>
    <input type="text" name="subject" id="subject" class="form-control" value="<?php echo($r['subject']); ?>"><br>
    </div>
    <div class="mb-3">
    <label for="body" class="form-label">ユーザID</label>
    <textarea name="body" id="body" class="form-control"><?php echo($r['body']); ?></textarea><br>
    </div>
    <div class="d-grid gap-2 col-6 mx-auto">
    <button type="submit" class="btn btn-success">更新</button>
    </div>
</form>
    </div>
</div>
</body>
</html>
