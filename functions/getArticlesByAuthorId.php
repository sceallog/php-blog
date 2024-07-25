<?php
function getArticlesByAuthorId($id, $conn)
{
    $statement = $conn -> prepare(
        "SELECT *
    FROM articles
    WHERE author = :id 
    ");
    $statement -> execute(array(":id" => $id));
    return $statement -> fetchAll();
}