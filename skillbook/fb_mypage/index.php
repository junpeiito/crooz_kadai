<?php

require_once('config.php');

session_start();

function h($s) {
return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

if (empty($_SESSION['user'])) {
	header('Location: '.SITE_URL.'login.php');
	exit;
}

$mysqli = new mysqli("localhost", "root", "poritan6479", "fb_connect_php");

/* 接続状況をチェックします */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<title>マイページ｜ホーム</title>
<link href="../css/import3.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="../js/import.js"></script>
</head>

<body>
<div id="wrapper">
<a name="top" id="top"></a>
 
<!--↓ここからhead -->
<div id="hdbox1">
<div id="hdbox2">
<div class="over">
 <div id="hdleft">
	<p id="logo"><img src="../images/skillbook.png" width="35" height="35">SkillBook</a></p>
 </div>
 <div class="facebook">
  <!--<ul id="hdright">
  <li>--><?php echo h($_SESSION['user']['facebook_name']); ?><img src="<?php echo h($_SESSION['user']['facebook_picture']); ?>" width="50" height="50">
  </div><!--</li>
  </ul>-->
</div>
 <ul id="gnavi">
  <li class="gn1"><strong><a href="../index.php"><font color="#438eb1">ホーム</font><br /><span>home</span></a></strong></li>
  <li class="gn2"><a href="greeting.html"><font color="#438eb1">ご利用案内</font><br /><span>how&nbsp;to&nbsp;use</span></a></li>
  <li class="gn3"><a href="free_resson/index.php" ><font color="#438eb1">レッスン</font><br /><span>lesson</span></a></li>
  <li class="gn4"><a href="free_kaihatsu/index.php"><font color="#438eb1">開発シリーズ</font><br /><span>series</span></a></li>
  <li class="gn5"><a href="request/request_see.php"><font color="#438eb1">リクエスト</font><br /><span>request</span></a></li>
 </ul> 
</div>
</div>
<!--↑ここまでhead -->

<!--↓ここからcontents -->
<!--<div id="visual2">
 <p>サービス概要<span>SERVICE</span></p>
</div>-->
<div id="contents">
<div id="side">
<!--<p class="con1">ご不明な点・ご質問等<br />お気軽にお問い合わせ下さい</p>
<p class="con2"><a href="contact.html"><img src="images/con_btn_off.gif" alt="お問い合わせ" /></a></p>-->
<h2>メニュー</h2>
<ul class="s_menu">
 <li><a href="My_movies/index.php">公開動画</a></li>
 <li><a href="upload/index.php">動画アップロード</a></li>
  <li><a href="kaihatsu/index.php">開発シリーズの編集</a></li>
  <li><a href="resson/index.php">レッスンの編集</a></li>
  <li><a href="request/request_see.php">リクエストを見る</a></li>
 <li><a href="logout.php">ログアウト</a></li>
</ul>
<!--<ul class="s_btn">
 <li><a href="#"><img src="images/facebn_off.gif" alt="" /></a></li>
 <li style="margin:0;"><a href="#"><img src="images/twibn_off.gif" alt="" /></a></li>
</ul>-->
</div>

<div id="main">
<a name="s1" id="s1"></a>
<h3>あなたへのオススメ</h3>
<div class="pd3">
 <p class="lefttxt1"> <table border="0" width="180" height="130">
 
<?php
$movie_rank_query = 'select category, count(category)from movies group by category order by count(category) desc limit 1'; //おすすめコンテンツを決める
if($movie_rank_result = $mysqli->query($movie_rank_query)){
$movie_rank_row = $movie_rank_result->fetch_assoc();
}

//print($movie_rank_row['category']);


$movies_query = 'select * from movies where category = "'.$movie_rank_row['category'].'" order by movie_star desc limit 6';
$count = 0;
if($movies_result = $mysqli->query($movies_query)){
	while ($movies_row = $movies_result->fetch_assoc()) {
	$count = $count + 1;
		if($count != 3){
	echo '<td>投稿日&nbsp;'.$movies_row['post_time'].'<br /><img src="'.$movies_row['thumbnail'].'" width="200" height="100"><br /><a href="free_movie/movie_see.php?ban='.$movies_row['id'].'">'.mb_strimwidth($movies_row['movie_title'], 0, 22, "...","UTF-8").'</a></td>';
		}
		if($count == 3){
	echo '<td>投稿日&nbsp;'.$movies_row['post_time'].'<br /><img src="'.$movies_row['thumbnail'].'" width="200" height="100"><br /><a href="free_movie/movie_see.php?ban='.$movies_row['id'].'">'.mb_strimwidth($movies_row['movie_title'], 0, 22, "...","UTF-8").'</a></td><tr>';
		$count = 0;
		}
	}
	$movies_result->free(); 
}
	
	?>
</table></p>
</div>

<a name="s2" id="s2"></a>
<h3>最近見た動画</h3>
<div class="pd3">
</div>

<a name="s3" id="s3"></a>
<h3>最近公開した動画</h3>
<div class="pd3">

</div>

</div>
</div><!--contents-->
</div><!--wrapper-->
<!--↑ここまでcontents -->

<!--↓ここからfooter -->

<div id="footer">
<div id="ftbox1">
 <div id="ftbox2">
 <ul>
  <li><a href="../index.php">ホーム</a></li>
  <li><a href="greeting.html">ご利用案内</a></li>
  <li><a href="free_resson/index.php">レッスン</a></li>
  <li><a href="free_kaihatsu/index.php">開発シリーズ</a></li>
  <li><a href="request/request_see.php">リクエスト</a></li>
 </ul>
 <p class="pagetop"><a href="#top"><img src="../images/pagetop.gif" alt="ページの上部へ" /></a></p>
 </div>
</div>

<div id="ftbox3">
	<div id="ftbox4">
	<p class="left"></p>
 <p class="copy">Copyright (c) skillbook Co,.ltd All Rights Reserved.</p>
	</div>
</div>
</div>
<!--↑ここまでfooter -->
</body>
</html>
