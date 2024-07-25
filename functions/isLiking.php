<?php
function isLiking($articleId, $userId, $conn) {
    $statement = $conn->prepare("
    SELECT * FROM likes 
    WHERE article_id = :articleId
    AND user_id = :userId
    ");
    $statement->execute(array(':articleId' => $articleId, ':userId' => $userId));
    $result = $statement->fetch();

    return (bool)$result;
}
