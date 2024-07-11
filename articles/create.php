<?php
include '../connect.php';

$subject = isset($_POST['subject'])? $_POST['subject'] : '';
$body = isset($_POST['body'])? $_POST['body'] : '';
$author = isset($_SESSION['id'])? $_SESSION['id'] : '';
//入力前の段階ではないか、入力内容に不足がないか確認。
if($subject != '' && $body != ''){
    // SQL文のINSERT INTOを実行する
   $created = $conn->exec(
            "INSERT INTO articles (subject, body, author) 
            VALUES ('{$subject}', '{$body}', '{$author}')");
   if($created == 1){
       // ユーザ追加に成功
       $id = $conn->lastInsertId(); // 自動採番されたidの番号を取得する
   }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>create</title>
</head>
<body>
<?php
if(isset($id)) {
    echo "記事を追加しました。id = ";
    echo '<a href="read.php?id=',
    $id, '">',
    $id,
    '</a><br>';
}
?>
<h3>記事の新規作成</h3>
<form method="post">
    <label for="subject">表題</label>
    <input type="text" name="subject" id="subject"><br>
    <label for="body">本文</label>
    <textarea name="body" id="body" rows="5" cols="33"></textarea><br>
    <button>作成</button>
</form>
</body>
</html>
