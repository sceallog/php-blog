<?php
function isFollowing($followerId, $followingId, $conn) {
    $statement = $conn->prepare("
    SELECT * FROM relationships 
    WHERE follower_id = :followerId
    AND followed_id = :followingId
    ");
    $statement->execute(array(':followerId' => $followerId, ':followingId' => $followingId['id']));
    $result = $statement->fetch();

    return (bool)$result;
}
