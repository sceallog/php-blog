<?php
include '../connect.php';
include '../head.php';
require '../functions/isFollowing.php';
require '../functions/getUser.php';
require '../components/followButton.php';

$conn = connect();
$id = $_GET['id'];
$r = getUser($id, $conn);
$loggedInUserId = $_SESSION['id'];
$isFollowing = isFollowing($loggedInUserId, $id, $conn);


setHead('Users', '../assets/style.css');
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
}
?>
<table>
    <tr>
        <th>id</th>
        <td><?php echo $r['id']; ?></td>
    </tr>
    <tr>
        <th>userID</th>
        <td><?php echo $r['userID']; ?></td>
    </tr>
    <tr>
        <th>name</th>
        <td><?php echo $r['name']; ?></td>
    </tr>
    <tr>
        <td>
            <form action="update.php" method="get">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <button>更新</button>
            </form>
        <td>
            <form action="delete.php" method="get">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <button>削除</button>
            </form>
        </td>
    </tr>
    <?php if ($r['id'] != $loggedInUserId) { ?>
    <tr>
        <td>
                <?php createFollowButton($loggedInUserId, $r, $conn);?>
        </td>
    </tr>
    <?php }?>
</table>
<form action="search.php">
    <button>一覧へ</button>
</form>
</body>
</html>
