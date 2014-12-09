<?php
// mysql
// cake_twitter.php→データベーステーブルからPHPでデータの内容を表示
// cake_twitter2.php→TwitterAPIに接続し、データベースに格納
// 上記PHPファイルのcake_twitter.sql→データベースの作成とテーブルの構造

// データベースの接続
 try {
 	$dbh = new PDO('mysql:host=localhost;dbname=DBNAME', 'USERNAME','PASSWORD');
 } catch(PDOException $e) {
 	var_dump($e->getMessage());
 	exit;
 }

// $sql　= "select * from users";
$stmt = $dbh->query("select * from users");
foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $user) {
	var_dump($user['name']);
}

echo $dbh->query("select count(*) from users")->fetchColumn() . "records found";

// 切断
 $dbh = null;

