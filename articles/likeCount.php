<?php
include '../connect.php';

$conn = connect();
    $article_id = $_GET['articleId'];
    $statement = $conn->prepare("
    SELECT COUNT(*) 
    AS like_count 
    FROM likes 
    WHERE article_id = :article_id
    ");
    $statement->bindParam(':article_id', $article_id);
    $statement->execute();
//    $result = $statement->get_result();
    $row = $statement->fetch(PDO::FETCH_ASSOC);

//    echo $row['like_count'];
//    $row = $statement->fetch(PDO::FETCH_ASSOC);
    echo $row['like_count'];

