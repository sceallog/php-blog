<?php
include '../connect.php';

$conn = connect();

$articleId = $_POST['articleId'];
$userId = $_POST['userId'];

// ユーザーがすでに記事を「いいね」したか確認
$statement = $conn->prepare("SELECT * FROM likes 
    WHERE article_id = :article_id 
    AND user_id = :user_id;");
$statement->execute(array('article_id' => $articleId, 'user_id' => $userId));
$result = $statement->rowCount();

if ($result == 0) {
    // いいねを追加
    $like_statement = $conn->prepare("
        INSERT INTO likes (article_id, user_id) 
        VALUES (:article_id, :user_id);
        ");
    $like_statement->execute(array('article_id' => $articleId, 'user_id' => $userId));
} else {
    // いいねを削除
    $unlike_statement = $conn->prepare("
        DELETE FROM likes 
        WHERE article_id = :article_id 
        AND user_id = :user_id;
        ");
    $unlike_statement->execute(array('article_id' => $articleId, 'user_id' => $userId));
}
