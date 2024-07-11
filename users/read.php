<?php
include '../connect.php';
include '../head.php';

$id = $_GET['id'];
$statement = $conn->prepare(
        "SELECT * FROM `users` WHERE id = :id"
);
$statement->execute(array(':id' => $id));
$r = $statement->fetch();

setHead('Users', '../assets/style.css');
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
}
?>
<table>
    <tr>
        <th>id</th>
        <td><?php echo $r['id']; ?></td>
    </tr>
    <tr>
        <th>userID</th>
        <td><?php echo $r['userID']; ?></td>
    </tr>
    <tr>
        <th>name</th>
        <td><?php echo $r['name']; ?></td>
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
</body>
</html>
