<?php
include "../connect.php";
include '../components/head.php';
include '../functions/isFollowing.php';
require '../functions/getUsersByKeyword.php';

$conn = connect();
$keyword = isset($_POST['keyword']) ? $_POST['keyword'] : "";
?>
<!DOCTYPE html>
<html lang="ja">
<?php
setHead('User Search', '../assets/style.css', '../assets/follow.js');
if (!isset($_SESSION['id'])) {
    header('Location: ../login/login.php');
    exit();
}
?>
<body>
<?php include('../components/navbar.php'); ?>
<div class="container py-4">
    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
        <h3 class="text-center">ユーザー 一覧</h3>
        <div class="container-fluid d-flex flex-row-reverse mb-3">
            <form method="post" class="row g-2">
                <div class="col-auto">
                    <input type="text" name="keyword" placeholder="名前を検索する" class="form-control">
                </div>
                <div class="col-auto">
                    <button class="btn btn-dark">検索</button>
                </div>
            </form>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ユーザー名</th>
                <th>名前</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $result = getUsersByKeyword($keyword, $conn);
            $loggedInUserId = $_SESSION['id'];
            foreach ($result as $user) {
                echo "<tr>";
                    echo '<td>',
                    '<a class="link-dark" href="profile.php?id=',
                    $user['id'], '">',
                    $user['name'],
                    '</a></td>';
                echo "<td>{$user['name']}</td>";
                echo "<td>";
                if ($loggedInUserId != $user['id']) {
                    $isFollowing = isFollowing($loggedInUserId, $user, $conn);
                    include('../components/followButton.php');
                }
                echo "</td>";
                echo "</tr>";
            }

            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>