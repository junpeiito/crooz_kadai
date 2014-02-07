<?php
require_once('config.php');

session_start();

function h($s) {
return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

if (empty($_SESSION['user'])) {
	header('Location: '.SITE_URL.'logout.php');
	exit;
}

$db_link = mysql_connect('localhost', 'root', 'poritan6479');
if (!$db_link) {
    die('データベース接続失敗'.mysql_error());
}

//print($_SESSION['application_id']);
$db_selected = mysql_select_db('fb_connect_php', $db_link);
	if (!$db_selected){
    die('データベース選択失敗です。'.mysql_error());
	}
//$bangou = $_GET['number'];
//$query = mysql_query('select * from kaihatsu wh/Users/itoujunpei/Desktop/スクリーンショット 2013-12-20 1.17.05.pngere user = "'.$_SESSION['user']['id'].'" and id = "'.$bangou.'"');
//$row_id = mysql_fetch_assoc($query);

	$bangou = $_GET['number'];
	//print($bangou);
	$query = mysql_query('select * from resson where user = "'.$_SESSION['user']['id'].'" and id = "'.$bangou.'"');
	$ressonrow = mysql_fetch_assoc($query);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<title>マイページ｜開発シリーズの編集</title>
<link href="../../css/import.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="../../js/import.js"></script>
</head>

<body>
<div id="wrapper">
<a name="top" id="top"></a>
 
<!--↓ここからhead -->
<div id="hdbox1">
<div id="hdbox2">
<div class="over">
 <div id="hdleft">
	<p id="logo"><img src="../../images/skillbook.png" width="35" height="35">SkillBook</a></p>
 </div>
 <div class="facebook">
  <!--<ul id="hdright">
  <li>--><?php echo h($_SESSION['user']['facebook_name']); ?><img src="<?php echo h($_SESSION['user']['facebook_picture']); ?>" width="50" height="50">
  </div><!--</li>
  </ul>-->
</div>
 <ul id="gnavi">
  <li class="gn1"><strong><a href="../../index.php"><font color="#438eb1">ホーム</font><br /><span>home</span></a></strong></li>
  <li class="gn2"><a href="greeting.html"><font color="#438eb1">ご利用案内</font><br /><span>how&nbsp;to&nbsp;use</span></a></li>
  <li class="gn3"><a href="../free_resson/index.php" ><font color="#438eb1">レッスン</font><br /><span>lesson</span></a></li>
  <li class="gn4"><a href="../free_kaihatsu/index.php"><font color="#438eb1">開発シリーズ</font><br /><span>series</span></a></li>
  <li class="gn5"><a href="../request/request_see.php"><font color="#438eb1">リクエスト</font><br /><span>request</span></a></li>
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
 <li><a href="../My_movies/index.php">公開動画</a></li>
 <li><a href="../upload/index.php">動画アップロード</a></li>
  <li><a href="../kaihatsu/index.php">開発シリーズの編集</a></li>
  <li><a href="../resson/index.php">レッスンの編集</a></li>
  <li><a href="../request/request_see.php">リクエストを見る</a></li>
 <li><a href="../logout.php">ログアウト</a></li>
</ul>
<!--<ul class="s_btn">
 <li><a href="#"><img src="images/facebn_off.gif" alt="" /></a></li>
 <li style="margin:0;"><a href="#"><img src="images/twibn_off.gif" alt="" /></a></li>
</ul>-->
</div>

<div id="main">
<a name="s1" id="s1"></a>
<h3>新規開発シリーズ作成</h3>
<div class="pd3">
<?php print($ressonrow['movie_title']);
?>この項目を削除してもよろしいですか？
<?php
print('<a href="');
	print('delete_comp.php?number=');
	print($ressonrow['id']);
	print('">');
	print("はい");
	print('</a>');
	
?>
</div>
<!--<p class="right"><img src="../../images/img4.jpg" alt="" /></p>-->
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
  <li><a href="../free_resson/index.php">レッスン</a></li>
  <li><a href="../free_kaihatsu/index.php">開発シリーズ</a></li>
  <li><a href="../request/request_see.php">リクエスト</a></li>
 </ul>
 <p class="pagetop"><a href="#top"><img src="images/pagetop.gif" alt="ページの上部へ" /></a></p>
 </div>
</div>

<div id="ftbox3">
	<div id="ftbox4">
	<p class="left">サンプル株式会社&nbsp;&nbsp;&nbsp;〒000-000&nbsp;見本市見本区見本1-1-11</p>
 <p class="copy">Copyright (c) Sample Co,.ltd All Rights Reserved.</p>
	</div>
</div>
</div>
<!--↑ここまでfooter -->
</body>
</html>
