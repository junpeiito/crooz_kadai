<?php

require_once('config.php');
session_start();
$mysqli = new mysqli("localhost", "root", "root", "fb_connect_php");

/* 接続状況をチェックします */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$copy_id = "11111111";
$copy_name = "22222222";
$copy_picture = "33333333";
$copy_access_token = "4444444444";
$now = "55555555";
	$post_star_query = 'INSERT INTO users (facebook_user_id, facebook_name, facebook_picture, facebook_access_token, created, modified) VALUES ("'.$copy_id.'", "'.$copy_name.'", "'.$copy_picture.'", "'.$copy_access_token.'", "'.$now.'", "'.$now.'")';
	$mysqli->query($post_star_query);
	
	$user = $post_star_query->fetch();
	// ログイン処理
	session_regenerate_id(true);
	$_SESSION['user'] = $user;
	// index.php
	header('Location: '.SITE_URL);
?>








