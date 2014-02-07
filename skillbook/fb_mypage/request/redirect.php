<?php

require_once('config.php');

session_start();

if (empty($_GET['code'])) {
	// $BG'>ZA0$N=hM}(B
	// $BG'>Z%@%$%"%m%0$r:n@.$7$FI=<((B
	
	$_SESSION['state'] = sha1(uniqid(mt_rand(), true));
	
	$params = array(
		'client_id' => APP_ID,
		'redirect_uri' => SITE_URL.'redirect.php',
		'state' => $_SESSION['state'],
		'scope' => 'user_website,friends_website'
		);
		
		$url = "https://www.facebook.com/dialog/oauth?".http_build_query($params);
		
		// facebook$B$XHt$P$9(B
		header('Location: '.$url);
		exit;
}else{
	// $BG'>Z$5$l$F5"$C$F$-$?;~$N=hM}(B
	// CSRF$BBP(B$B:v(B
	if($_SESSION['state'] != $_GET['state']) {
		echo "$B2?$+$,$*$+$7$$!*(B";
		exit;
	}
	// $B%f!<%6!<>pJs$N<hF@(B
	$params = array(
		'client_id' => APP_ID,
		'client_secret' => APP_SECRET,
		'code' => $_GET['code'],
		'redirect_uri' => SITE_URL.'redirect.php'
		
	);
	$url = 'https://graph.facebook.com/oauth/access_token?'.http_build_query($params);
	$body = file_get_contents($url);
	parse_str($body);
		
		$url = 'https://graph.facebook.com/me?access_token='.$access_token.'&fields=name,picture';
		$me = json_decode(file_get_contents($url));
		//var_dump($me);
		//exit;
		
			
	// DB$B$XFM$C9~$`(B
	try{
		$dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASSWORD);
	} catch (PDOException $e) {
		echo $e->getMessage();
		exit;
	}
	
	$stmt = $dbh->prepare("select * from users where facebook_user_id=:user_id limit 1");
	$stmt->execute(array(":user_id"=>$me->id));
	$user = $stmt->fetch();
	
	if (empty($user)) {
	$stmt = $dbh->prepare("insert into users (facebook_user_id, facebook_name, facebook_picture, facebook_access_token, created, modified) values (:user_id, :name, :picture, :access_token, now(), now());");
	$params = array(
		":user_id"=>$me->id,
		":name"=>$me->name,
		":picture"=>$me->picture->data->url,
		":access_token"=>$access_token
		);
		$stmt->execute($params);
		$stmt = $dbh->prepare("select * from users where id=:last_insert_id limit 1");
		$stmt->execute(array(":last_insert_id"=>$dbh->lastInsertId()));
		$user = $stmt->fetch();
		
	}
	//var_dump($user);
	//exit;
		
	// $B%m%0%$%s=hM}(B
	if (!empty($user)) {
	session_regenerate_id(true);
	$_SESSION['user'] = $user;
	}
	// index.php
	header('Location: '.SITE_URL);
}
?>








