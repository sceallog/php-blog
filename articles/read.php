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
<div class="p-5 mb-4 bg-body-tertiary rounded-3">
<table class="table table-striped">
    <tr>
        <th>id</th>
        <td><?php echo $article['id']; ?></td>
    </tr>
    <tr>
        <th>表題</th>
        <td><?php echo $article['subject']; ?></td>
    </tr>
    <tr>
        <th>本文</th>
        <td><pre><?php echo $article['body']; ?></pre></td>
    </tr>
    <tr>
        <th>筆者</th>
        <td><?php echo $article['name']; ?></td>
    </tr>
    <tr>
        <th>更新日時</th>
        <td><?php echo $article['modified']; ?></td>
    </tr>
    <?php if($loggedInUserId === $article['author']) { ?>
    <tr>
        <td>
            <form action="update.php" method="get">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <button class="btn btn-primary">更新</button>
            </form>
        <td>
            <form action="delete.php" method="get">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <button class="btn btn-danger">削除</button>
            </form>
        </td>
    </tr>
    <?php } ?>
</table>
<form action="search.php">
    <button class="btn btn-primary">一覧へ</button>
</form>
</body>
</html>
