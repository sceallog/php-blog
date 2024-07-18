<?php
include("../connect.php");
    $conn = connect();
    $u = $_POST["userID"];
    $p = $_POST["password"];
    $flag = false;

    $result = $conn->query("SELECT * FROM users WHERE userID = '{$u}'");
    $r = $result->fetch();

    if ($r) {
        if ($p === $r['password']) {
            $flag = true;
        }
    }

    if( $flag ):
        // ログイン成功
        $_SESSION['id'] = $r['id'];
        $_SESSION['name'] = $r['name'];
        header("Location:../articles/search.php");
    else:
        // ログイン失敗
        header("Location:failure.html");
    endif;
?>