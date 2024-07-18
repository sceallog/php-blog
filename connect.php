<?php
function connect(){
session_start();
try {
    return new PDO(
        "mysql:host=localhost;port=13306;dbname=test;charset=utf8;",
        "root",
        ""
    );
} catch (PDOException $e){
    die($e->getMessage());
}}
