<?php
function getArticle($id, $conn)
{
    $statement = $conn->prepare("
    SELECT articles.*, users.name 
    FROM articles, users 
    WHERE articles.author = users.id 
    AND articles.id = :id
");
    $statement -> execute(array(':id' => $id));
    return $statement->fetch();
}