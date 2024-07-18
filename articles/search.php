<?php
include "../connect.php";
include "../head.php";

$conn = connect();
$keyword = isset($_POST['keyword']) ? $_POST['keyword'] : "";

setHead('Article Search', '../assets/style.css');
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
} else {
    $message = "ゲストさん";
    echo "
    <form action='../login/login.html'>
     <button>ログイン</button>
    </form>";
}
?>
<div><?php echo $message ?></div>
<button><a href="create.php">新規登録</a></button>
<form method="post">
    <input type="text" name="keyword">
    <button>検索</button>
</form>
<hr>
<table>
    <tr>
        <th>id</th>
        <th>表題</th>
        <th>筆者</th>
        <th>更新日時</th>
    </tr>
<?php
$statement = $conn -> prepare(
"SELECT articles.*, users.name 
    FROM articles, users 
    WHERE articles.author = users.id 
    AND articles.subject LIKE :keyword;"
);
 $keyword = '%'.$keyword.'%';
 $statement -> execute(array(":keyword" => $keyword));

foreach($statement as $row){
    echo "<tr>";
    echo '<td>',
    '<a href="read.php?id=',
    $row['id'], '">',
        $row['id'],
    '</a></td>';
    echo "<td>{$row['subject']}</td>";
    echo "<td>{$row['name']}</td>";
    echo "<td>{$row['modified']}</td>";
    echo "</tr>";
}
?>
</table>
</body>
</html>