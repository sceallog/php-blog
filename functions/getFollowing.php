<?php
function getFollowing($userId, $conn) {
    $statement = $conn->prepare("
    SELECT u.id, u.userID, u.name FROM relationships r
    JOIN users u ON r.followed_id = u.id
    WHERE r.follower_id = :userId");

    $statement->execute(array('userId' => $userId));

    return $statement->fetchAll();
}
