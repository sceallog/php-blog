<?php
include '../connect.php';

$followUser = isset($_POST['followUser']) ? $_POST['followUser'] : '';
$userID = isset($_SESSION['id']) ? $_SESSION['id'] : '';

if($userID != '' && $followUser != ''){
    $statement = $conn-> prepare(
        "INSERT INTO relationships (follower_id, followed_id)
        VALUES (:userID, :followUser)"
    );
    $statement->execute(array(":userID" => $userID, ":followUser" => $followUser));
    $count = $statement->rowCount();
    if($count == 1){
        $id = $conn->lastInsertId();
    }
}

$messageText = isset($id) ? 'フォローしました。' : 'フォローに失敗しました。';