<?php
include '../connect.php';
include '../components/head.php';
require '../functions/isFollowing.php';
require '../functions/getUser.php';
require '../functions/getArticlesByAuthorId.php';
require '../functions/getFollowing.php';

$conn = connect();
$id = $_GET['id'];
$loggedInUserId = $_SESSION['id'];
$row = getUser($id, $conn);
$isFollowing = isFollowing($loggedInUserId, $row, $conn);
?>
<!DOCTYPE html>
<html lang="ja">
<?php
setHead('プロフィール', '../assets/style.css', '../assets/follow.js');
?>
<body>
<?php include('../components/navbar.php'); ?>
<div class="container py-4">
    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
    <h3 class="text-center">プロフィール</h3>
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-md-2">
                <div class="col-md-6 mb-2 mb-md-0">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between" >
                            <h5 class="card-title my-auto">ユーザー詳細</h5>
                            <?php if (isset($loggedInUserId)) { ?>
                                <div class="d-flex justify-content-end">
                                    <form action="update.php" method="get" class="me-2">
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <button class="btn btn-primary">更新</button>
                                    </form>
                                    <form action="delete.php" method="get">
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <button class="btn btn-danger">削除</button>
                                    </form>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="card-body">
                            <p><strong>ID:</strong> <?php echo $row['id']; ?></p>
                            <p><strong>UserID:</strong> <?php echo $row['userID']; ?></p>
                            <p><strong>Name:</strong> <?php echo $row['name']; ?></p>
                        </div>

                    </div>
                </div>
                <div class="col-md-6 mb-2 mb-md-0">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title my-auto">マイ記事</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>表題</th>
                                    <th>更新日時</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $filtered_result = getArticlesByAuthorId($id, $conn);
                                foreach ($filtered_result as $row) {
                                    echo "<tr>";
                                    echo '<td>',
                                    '<a class="link-dark" href="read.php?id=',
                                    $row['id'], '">',
                                    $row['subject'],
                                    '</a></td>';
                                    echo "<td>{$row['modified']}</td>";
                                    echo "</tr>";
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($loggedInUserId == $id) { ?>
        <div class="container-fluid mt-4">
            <div class="row row-cols-1 row-cols-md-2">
                <div class="col-md-6 mb-2 mb-md-0">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title my-auto">フォロー中のユーザー</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>表題</th>
                                    <th>更新日時</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $following = getFollowing($loggedInUserId, $conn);
                                foreach ($following as $row) {
                                    echo "<tr>";
                                    echo '<td>',
                                    '<a class="link-dark" href="read.php?id=',
                                    $row['id'], '">',
                                    $row['userID'],
                                    '</a></td>';
                                    echo "<td>{$row['name']}</td>";
                                    echo "</tr>";
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</body>
</html>
