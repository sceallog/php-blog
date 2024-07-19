<?php
include '../connect.php';
include '../components/head.php';
require '../functions/isFollowing.php';
require '../functions/getUser.php';

$conn = connect();
$id = $_GET['id'];
$row = getUser($id, $conn);
$loggedInUserId = $_SESSION['id'];
$isFollowing = isFollowing($loggedInUserId, $row, $conn);
?>
<!DOCTYPE html>
<html lang="ja">
<?php
setHead('Users', '../assets/style.css', '../assets/main.js');
?>
<body>
<?php include('../components/navbar.php'); ?>
<div class="container py-4">
<div class="p-5 mb-4 bg-body-tertiary rounded-3">
<table class="table table-striped">
    <tr>
        <th>id</th>
        <td><?php echo $row['id']; ?></td>
    </tr>
    <tr>
        <th>userID</th>
        <td><?php echo $row['userID']; ?></td>
    </tr>
    <tr>
        <th>name</th>
        <td><?php echo $row['name']; ?></td>
    </tr>
    <tr>
        <?php if ($loggedInUserId == $id) { ?>
        <td>
            <form action="update.php" method="get">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <button class="btn btn-primary">更新</button>
            </form>
        </td>
        <td>
            <form action="delete.php" method="get">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <button class="btn btn-danger">削除</button>
            </form>
        </td>
        <?php } ?>
    </tr>
    <?php if ($row['id'] != $loggedInUserId) { ?>
    <tr>
        <td>
            <div class="ml-9">
                <?php include('../components/followButton.php');?>
            </div>
        </td>
    </tr>
    <?php }?>
</table>
<form action="search.php">
    <button class="btn btn-primary">一覧へ</button>
</form>
</div>
</div>
</body>
</html>
