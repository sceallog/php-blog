<?php
function followUser($userId, $followedId, $conn){
    $statement = $conn->prepare("
    INSERT INTO relationships (follower_id, followed_id)
    VALUES (:userID, :followedId)");
    $statement->execute(array(':userID' => $userId, ':followedId' => $followedId));
    $count = $statement->rowCount();

    if($count > 0){
        return ['success' => true, 'message' => "フォローしました。"];
    } else {
        return ['success' => false, 'message' => "フォローに失敗しました。"];
    }

}
