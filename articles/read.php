<?php
include('../connect.php');
include('../components/head.php');
require '../functions/getArticle.php';
require '../functions/isLiking.php';

$conn = connect();
$id = $_GET['id'];
$article = getArticle($id, $conn);
$loggedInUserId = $_SESSION['id'];
$isLiking = isLiking($article['id'], $loggedInUserId, $conn);
?>
<!DOCTYPE html>
<html lang='ja'>
<?php
setHead('Read', '../assets/style.css', '../assets/like.js');
?>
<body>
<?php include('../components/navbar.php'); ?>
    <div class="container mt-5">
        <div class="card article" <?php echo 'data-article-id="' . $article['id'] . '"'; ?>>
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title my-auto"><?php echo $article['subject']; ?></h5>
                <?php if($loggedInUserId === $article['author']) { ?>
                    <div class="d-flex justify-content-center">
                        <form action="update.php" method="get" class="me-2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <button class="btn btn-primary">編集</button>
                        </form>
                        <form action="delete.php" method="get">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <button class="btn btn-danger">削除</button>
                        </form>
                    </div>
                <?php } ?>
            </div>
            <div class="card-body">
                <p class="card-text"><?php echo nl2br($article['body']); ?></p>
            </div>
            <div class="card-footer text-muted">
                <?php if(isset($loggedInUserId)) { ?>
                <div class="container-fluid d-flex gap-3">
                    <?php
                    include '../components/likeButton.php';
                    echo '<span class="my-auto" id="like-count-' . $article['id'] . '" >0</span>';
                    ?>

                </div>
                <?php } ?>
                <div class="container d-flex gap-2 justify-content-end">
                <p>筆者: <?php echo $article['name']; ?></p>
                <p>更新日時: <?php echo $article['modified']; ?></p>
                </div>

            </div>
        </div>
        <div class="mt-3">
            <form action="search.php">
                <button class="btn btn-primary">一覧へ</button>
            </form>
        </div>
    </div>

<script>

</script>
</body>
</html>
