<?php
include('../connect.php');
include('../head.php');

$conn = connect();
$id = $_GET['id'];
$statement = $conn->prepare("
    SELECT articles.*, users.name 
    FROM articles, users 
    WHERE articles.author = users.id 
    AND articles.id = :id
");
$statement -> execute(array(':id' => $id));
$r = $statement->fetch();

setHead('Read', '../assets/style.css');
?>
<body>
<table>
    <tr>
        <th>id</th>
        <td><?php echo $r['id']; ?></td>
    </tr>
    <tr>
        <th>表題</th>
        <td><?php echo $r['subject']; ?></td>
    </tr>
    <tr>
        <th>本文</th>
        <td><pre><?php echo $r['body']; ?></pre></td>
    </tr>
    <tr>
        <th>筆者</th>
        <td><?php echo $r['name']; ?></td>
    </tr>
    <tr>
        <th>更新日時</th>
        <td><?php echo $r['modified']; ?></td>
    </tr>
    <tr>
        <td>
            <form action="update.php" method="get">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <button>更新</button>
            </form>
        <td>
            <form action="delete.php" method="get">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <button>削除</button>
            </form>
        </td>
    </tr>
</table>
<form action="search.php">
    <button>一覧へ</button>
</form>
</body>
</html>
