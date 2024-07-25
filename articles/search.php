<?php
include "../connect.php";
include "../components/head.php";
require '../functions/getArticlesByKeyword.php';

$conn = connect();
$keyword = isset($_POST['keyword']) ? $_POST['keyword'] : "";
?>

<!DOCTYPE html>
<html lang="ja">

<?php
setHead('記事一覧', '../assets/style.css', '../assets/main.js');
?>
<body>
<?php
include('../components/navbar.php');
?>
<div class="container py-4">
    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
        <h3 class="text-center">記事一覧</h3>
        <div class="container">
            <div class="d-flex justify-content-between mb-3">
                <form action="../articles/create.php">
                    <button class="btn btn-success">新規作成</button>
                </form>
                <form method="post" class="row g-2">
                    <div class="col-auto">
                        <input type="text" name="keyword" placeholder="記事の表題を検索する" class="form-control">
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-dark">検索</button>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <table class="table table-striped">
            <tr>
                <th>表題</th>
                <th>筆者</th>
                <th>更新日時</th>
            </tr>
            <?php
            $result = getArticlesByKeyword($keyword, $conn);

            foreach ($result as $row) {
                echo "<tr>";
                echo '<td>',
                '<a class="link-dark" href="read.php?id=',
                $row['id'], '">',
                $row['subject'],
                '</a></td>';
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['modified']}</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</div>
</body>
</html>