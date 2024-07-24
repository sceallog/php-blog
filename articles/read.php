<?php
include('../connect.php');
include('../components/head.php');
require '../functions/getArticle.php';

$conn = connect();
$id = $_GET['id'];
$article = getArticle($id, $conn);
$loggedInUserId = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang='ja'>
<?php
setHead('Read', '../assets/style.css', '../assets/main.js');
?>
<body>
<?php include('../components/navbar.php'); ?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title"><?php echo $article['subject']; ?></h5>
        </div>
        <div class="card-body">
            <p class="card-text"><?php echo nl2br($article['body']); ?></p>
        </div>
        <div class="card-footer text-muted">
            <div class="container d-flex gap-2 justify-content-end">
                <p>筆者: <?php echo $article['name']; ?></p>
                <p>更新日時: <?php echo $article['modified']; ?></p>
            </div>
            <?php if($loggedInUserId === $article['author']) { ?>
                <div class="d-flex justify-content-center">
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
    </div>
    <div class="mt-3">
        <form action="search.php">
            <button class="btn btn-primary">一覧へ</button>
        </form>
    </div>
</div>
</body>
</html>
