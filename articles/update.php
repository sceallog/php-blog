<?php
include '../connect.php';
include '../head.php';

$conn = connect();

if(!isset($_SESSION['id'])){
    header('Location: ../login/login.html');
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
    header("Location: ../login/login.html");
    exit(0);
}

setHead('Article Update', '../assets/style.css');
?>
<body>
<?php
if(isset($count) && $count == 1) {
    echo "記事を更新しました。id: ";
    echo '<a href="read.php?id=', $id, '">', $id, '</a><br>';
}
?>
<h3>ユーザ情報更新</h3>
<form method="post" action="update.php">
    <input type="hidden" name="id" value="<?php echo($id); ?>">
    <label for="name">件名：</label>
    <input type="text" name="subject" id="subject" value="<?php echo($r['subject']); ?>"><br>
    <label for="body">ユーザID</label>
    <textarea name="body" id="body"><?php echo($r['body']); ?></textarea><br>
    <button>更新</button>
</form>
</body>
</html>
