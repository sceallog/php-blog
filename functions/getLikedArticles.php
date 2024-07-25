<?php
function getLikedArticles($userId, $conn) {
    $statement = $conn->prepare("
    SELECT a.* FROM likes l
    JOIN articles a ON l.article_id = a.id
    WHERE l.user_id = :userId");

    $statement->execute(array('userId' => $userId));

    return $statement->fetchAll();
}
