<?php
include "../connect.php";
include '../head.php';
include '../functions/isFollowing.php';
require '../functions/getUsersByKeyword.php';
require '../components/followButton.php';

$conn = connect();
$keyword = isset($_POST['keyword']) ? $_POST['keyword'] : "";

setHead('User Search', '../assets/style.css', '../assets/main.js');
?>
<body>
<?php
$loggedInUser = $_SESSION['name'];
if (isset($loggedInUser)) {
    $message = "{$loggedInUser}さんログイン中";
    echo "
    <form action='../login/logout.php'>
     <button>ログアウト</button>
    </form>";
} else {
    $message = "ゲストさん";
    echo "
    <form action='../login/login.html'>
     <button>ログイン</button>
    </form>";
}
?>
<div><?php echo $message ?></div>
<button><a href="create.php">新規登録</a></button>
<form method="post">
    <input type="text" name="keyword">
    <button>検索</button>
</form>
<hr>
<table>
    <tr>
        <th>id</th>
        <th>userID</th>
        <th>name</th>
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
        createFollowButton($loggedInUserId, $row, $conn);
    }
    echo "</td>";
    echo "</tr>";
}

?>
</table>
</body>
</html>