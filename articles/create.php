<?php
include '../connect.php';
include '../components/head.php';

$conn = connect();

$subject = isset($_POST['subject']) ? $_POST['subject'] : '';
$body = isset($_POST['body']) ? $_POST['body'] : '';
$author = isset($_SESSION['id']) ? $_SESSION['id'] : '';
//入力前の段階ではないか、入力内容に不足がないか確認。
if ($subject != '' && $body != '') {
    // SQL文のINSERT INTOを実行する
    $statement = $conn->prepare(
        "INSERT INTO articles (subject, body, author) 
            VALUES (:subject, :body, :author)"
    );
    $statement->execute(array(":subject" => $subject, ":body" => $body, ":author" => $author));
    $count = $statement->rowCount();
    if ($count == 1) {
        // ユーザ追加に成功
        $id = $conn->lastInsertId(); // 自動採番されたidの番号を取得する
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<?php setHead('記事の作成', '../assets/style.css', '../assets/main.js'); ?>
<body>
<?php
include '../components/navbar.php';
if (isset($id)) {
    header("Location: read.php?id=" . $id);
}
?>
<div class="container py-4">
    <div class="p-5 mb-4 bg-body-tertiary rounded-3">

        <h3 class="text-center">記事の新規作成</h3>
        <form method="post">
            <div class="mb-3">
                <label for="subject" class="form-label">表題</label>
                <input type="text" name="subject" id="subject" class="form-control"><br>
            </div>
            <div class="mb-3">
                <label for="body" class="form-label">本文</label>
                <textarea name="body" id="body" rows="10" class="form-control"></textarea><br>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button type="submit" class="btn btn-success">作成</button>
            </div>
        </form>
        <form action="search.php">
            <div class="d-grid gap-2 col-6 mx-auto">
                <button type="submit" class="btn btn-outline-danger mt-4">キャンセル</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
