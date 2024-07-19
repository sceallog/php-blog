<?php
include "../connect.php";
include '../head.php';
include '../functions/isFollowing.php';
require '../functions/getUsersByKeyword.php';

$conn = connect();
$keyword = isset($_POST['keyword']) ? $_POST['keyword'] : "";

setHead('User Search', '../assets/style.css', '../assets/main.js');
?>
<body>
<?php include('../components/navbar.php'); ?>
<div class="container py-4">
<div class="p-5 mb-4 bg-body-tertiary rounded-3">
    <h3>ユーザー一覧</h3>
    <div class="container-fluid d-flex flex-row-reverse mb-3">
        <form method="post">
            <input type="text" name="keyword" placeholder="名前を検索する">
            <button class="btn btn-dark">検索</button>
        </form>
    </div>
<table class="table table-striped">
    <tr>
        <th>id</th>
        <th>ユーザー名</th>
        <th>名前</th>
        <th></th>
    </tr>
<?php

$result = getUsersByKeyword($keyword, $conn);
$loggedInUserId = $_SESSION['id'];
foreach($result as $row){
    echo "<tr>";
    echo '<td>',
    '<a href="read.php?id=',
    $row['id'], '">',
        $row['id'],
    '</a></td>';
    echo "<td>{$row['userID']}</td>";
    echo "<td>{$row['name']}</td>";
    echo "<td>";
    if($loggedInUserId != $row['id']) {
        $isFollowing = isFollowing($loggedInUserId, $row, $conn);
        include('../components/followButton.php');
    }
    echo "</td>";
    echo "</tr>";
}

?>
</table>
</div>
</div>
</body>
</html>