<?php
include '../connect.php';
function getFollowing($userId) {
    $statement = $conn->prepare("
    SELECT u.id, u.userID, u.name FROM relationships r
    JOIN users u ON r.followed_id = u.id
    WHERE r.follower_id = :userId");

    $statement->execute(array('userId' => $userId));
    $result = $statement->fetchAll();

    $following = [];
    while ($row = $result->fetch_assoc()) {
        $following[] = $row;
    }
    $statement->close();

    return $following;
}
