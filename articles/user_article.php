<?php
include "../connect.php";
include "../components/head.php";
require '../functions/getArticlesByAuthorId.php';

$conn = connect();
$loggedInUserId = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="ja">

<?php
setHead('User Articles', '../assets/style.css', '../assets/main.js');
?>
<body>
<?php
include('../components/navbar.php');
?>
<div class="container py-4">
    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
        <h3 class="text-center">マイ記事</h3>
        <div class="container-fluid d-flex flex-row-reverse mb-3">
        </div>
        <hr>
        <table class="table table-striped">
            <tr>
                <th>表題</th>
                <th>更新日時</th>
            </tr>
            <?php
            $filtered_result = getArticlesByAuthorId($loggedInUserId, $conn);
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
</body>
</html>