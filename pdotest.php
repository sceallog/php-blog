<?php
$conn = null;
try {
	$conn = new PDO(
		"mysql:host=localhost;dbname=test;charset=utf8",	// または  "mysql:host=localhost;port=13306;dbname=test;charset=utf8"
		"root",	// MySQLサーバへの接続ユーザID
		""		// MySQLサーバへの接続パスワード
	);
	/*
	//MySQLサーバへの接続ポートを 13306へ変更した方はこちら。
	$conn = new PDO(
		"mysql:host=localhost;port=13306;dbname=test;charset=utf8"
		"root",	// MySQLサーバへの接続ユーザID
		""		// MySQLサーバへの接続パスワード
	);
	*/

	/*
	$updated = $conn->exec(
		// "UPDATE users SET password = 'xxxxx' WHERE id = 1"
		// "DELETE FROM users WHERE id = 4"
		"INSERT INTO users VALUES (NULL, 'tcha518', 'yamazaki', '山嵜 聡')"
	);

	echo("{$updated}件更新しました。");
	*/
	$name = $_POST['name'];
	$result = $conn->query(
		"SELECT * FROM users WHERE name LIKE '%{$name}%'"
	);

	//$r = $result->fetch();
	//print_r($r);

	echo ("<dl>");
	foreach ($result as $r) {
		echo ("<dt>{$r['userID']}</dt>");
		echo ("<dd>{$r['name']}</dd>");
	}
	echo ("</dl>");
} catch (PDOException $e) {
	die($e->getMessage());
}
