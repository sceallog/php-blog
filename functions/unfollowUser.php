<?php
function unfollowUser($userId, $followingId, $conn){
    $statement = $conn->prepare("
    DELETE FROM relationships 
    WHERE follower_id = :user_id 
    AND followed_id = :followedId
    LIMIT 1;"
    );
    $statement->execute(array(":user_id" => $userId, ":followedId" => $followingId));
    $count = $statement->rowCount();

    if($count == 1){
        return ['success' => true, 'message' => "フォローを解除しました。"];
    } else {
        return ['success' => false, 'message' => "フォローを解除できませんでした。"];
    }
}