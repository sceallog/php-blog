<?php
function getFollowers($userId, $conn) {
    $statement = $conn->prepare("
        SELECT u.id, u.userID, u.name FROM relationships r
        JOIN users u ON u.id = r.follower_id
        WHERE r.followed_id = :userId        
    ");
    $statement->execute(array("userId" => $userId));
    $result = $statement->fetchAll();

    $followers = array();
    foreach ($result as $follower) {
        $followers[] = $follower;
    }

    return $followers;
}
