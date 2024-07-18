<?php
include '../connect.php';
include '../head.php';

$conn = connect();
$userID = isset($_POST['userID'])? $_POST['userID'] : '';
$name = isset($_POST['name'])? $_POST['name'] : '';
$password = isset($_POST['password'])? $_POST['password'] : '';
//入力前の段階ではないか、入力内容に不足がないか確認。
if($userID != '' && $name != '' && $password != ''){
    // SQL文のINSERT INTOを実行する
   $statement = $conn->prepare(
            "INSERT INTO users (userID, name, password) 
            VALUES (:userID, :name, :password)"
   );
   $statement -> execute(array(":userID" => $userID, ":name" => $name, ":password" => $password));
   $count = $statement->rowCount();
   if($count == 1){
       // ユーザ追加に成功
       $id = $conn->lastInsertId(); // 自動採番されたidの番号を取得する
   }
}

setHead('User Create', '../assets/style.css');
?>
<body>
<?php
if(isset($id)) {
    echo "ユーザを追加しました。id = ";
    echo '<a href="read.php?id=',
    $id, '">',
    $id,
    '</a><br>';
}
?>
<h3>ユーザ登録</h3>
<form method="post">
    <table>
        <tr>
            <td><label for="name">お名前</label></td>
            <td><input type="text" name="name" id="name"><br></td>
        </tr>
        <tr>
            <td><label for="userID">ユーザID</label></td>
            <td><input type="text" name="userID" id="userID"><br></td>
        </tr>
        <tr>
            <td><label for="password">パスワード</label></td>
            <td><input type="text" name="password" id="password"><br></td>
        </tr>
        <tr>
            <td class="right" colspan="2">
                <button>登録</button>
            </td>
        </tr>
    </table>
</form>
</body>
</html>
