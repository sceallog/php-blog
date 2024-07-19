<?php
function getArticlesByKeyword($keyword, $conn)
{
    $statement = $conn -> prepare(
        "SELECT articles.*, users.name 
    FROM articles, users 
    WHERE articles.author = users.id 
    AND articles.subject LIKE :keyword;"
    );
    $keyword = '%'.$keyword.'%';
    $statement -> execute(array(":keyword" => $keyword));
    return $statement -> fetchAll();
}