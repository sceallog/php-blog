<?php
include '../connect.php';
include '../components/head.php';
require '../functions/isFollowing.php';
require '../functions/getUser.php';
require '../functions/getArticlesByAuthorId.php';

$conn = connect();
$id = $_GET['id'];
$user = getUser($id, $conn);
$loggedInUserId = $_SESSION['id'];
$isFollowing = isFollowing($loggedInUserId, $user, $conn);
?>
<!DOCTYPE html>
<html lang="ja">
<?php
setHead('Users', '../assets/style.css', '../assets/follow.js');
?>
<body>
<?php include('../components/navbar.php'); ?>
<div class="container py-4">
    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-md-2">
                <div class="col-md-6 mb-2 mb-md-0">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="card-title my-auto">ユーザー詳細</h5>
                            <?php if ($loggedInUserId == $id) { ?>
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
                            <p><strong>ID:</strong> <?php echo $user['id']; ?></p>
                            <p><strong>UserID:</strong> <?php echo $user['userID']; ?></p>
                            <p><strong>Name:</strong> <?php echo $user['name']; ?></p>
                            <?php if ($user['id'] != $loggedInUserId) { ?>
                                <div class="mb-4">
                                    <?php include('../components/followButton.php'); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2 mb-md-0">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title my-auto"><?php echo $user['name']; ?>さんの記事</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <tr>
                                    <th>表題</th>
                                    <th>更新日時</th>
                                </tr>
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
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form action="search.php">
            <button class="btn btn-primary mt-4">一覧へ</button>
        </form>
    </div>
</body>
</html>
