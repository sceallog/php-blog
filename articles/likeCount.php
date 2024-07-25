<?php
function getLikeCount($article_id, $conn){
    $article_id = $_GET['article_id'];
    $statement = $conn->prepare("
    SELECT COUNT(*) 
    AS like_count 
    FROM likes 
    WHERE article_id = :article_id
    ");
    $statement->execute(array('article_id' => $article_id));
    $result = $statement->get_result();
    $row = $result->fetch_assoc();

    echo $row['like_count'];
}

