<?php
function getUser($id, $conn)
{
    $statement = $conn->prepare(
        "SELECT * FROM `users` WHERE id = :id"
    );
    $statement->execute(array(':id' => $id));
    $r = $statement->fetch();

    return $r;
}