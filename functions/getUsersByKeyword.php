<?php
function getUsersByKeyword($keyword, $conn)
{
    $statement = $conn->prepare(
        "SELECT * FROM `users` WHERE name LIKE :keyword"
    );
    $keyword = "%$keyword%";
    $statement->execute(array(':keyword' => $keyword));
    return $statement->fetchAll();
}