<?php
require_once("twitteroauth/twitteroauth.php");

$consumerKey = "";
$consumerSecret = "";
$accessToken = "";
$accessTokenSecret = "";

$twObj = new TwitterOAuth($consumerKey,$consumerSecret,$accessToken,$accessTokenSecret);

$request = $twObj->OAuthRequest('https://api.twitter.com/1.1/statuses/user_timeline.json','GET',
    array(
        'count'=>'200',
        'screen_name' => 'echizenya_yota',
        ));
$results = json_decode($request);

if(isset($results) && empty($results->errors)){
    foreach($results as $tweet){
		// データベースの接続
		try {
		 	$dbh = new PDO('mysql:host=localhost;dbname=DBNAME;charset=utf8', 'USERNAME','PASSWORD');
		} catch(PDOException $e) {
		 	var_dump($e->getMessage());
		 	exit;
		}
		// 処理
		// $stmt = $dbh->prepare("insert into tweet (screenname,tw) values (?,?)");
		// $stmt->execute(array($tweet->user->screen_name, $tweet->text));
		$stmt = $dbh->prepare("insert into tweet (tw_screen, tw_date, tw_txt) values (:tw_screen, :tw_date, :tw_txt)");
		// $stmt->execute(array(":screenname"=>$tweet->user->screen_name,":tw"=>$tweet->text));
		$stmt->bindParam(":tw_screen", $tw_screen);
		$stmt->bindParam(":tw_date", $tw_date);
		$stmt->bindParam(":tw_txt", $tw_txt);

		$tw_screen = $tweet->user->screen_name;
		$tw_date = date('Y-m-d H:i:s', strtotime($tweet->created_at));
		$tw_txt = $tweet->text;

		$stmt->execute();
		// 切断
		$dbh = null;
	}
  }else{
	echo "関連したつぶやきがありません。";
 }
 echo "done!";
 ?>



