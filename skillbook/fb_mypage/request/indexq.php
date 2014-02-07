<?php
require_once('config.php');

session_start();

function h($s) {
return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
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
//$query = mysql_query('select * from kaihatsu where user = "'.$_SESSION['user']['id'].'" and id = "'.$bangou.'"');
//$row_id = mysql_fetch_assoc($query);

	//$change_category = "HTML/";
	$copy_title = $_POST['title'];
	$copy_info = $_POST['text'];
	$copy_user = $_SESSION['user']['id'];
	$error_ = 0;	
	//$ext = substr($copyfile1['name'], -3);
	$today = date("Y/m/d");
	//$copy_no = 1;
	if(isset($_POST['submit1']) && $error_ == 0){		
		mysql_query('insert into request (
 		post_time,
 		text,
 		name) values ("'.$today.'",
 		"'.$copy_text.'",
 		"'.$copy_name.'")');
 		//header('Location: upload_comp.php') ;
 		print("新規にシリーズを作成しました。");
	}
	print("エラー数".$error_);

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
  <li class="gn1"><strong><a href="../index.php"><font color="#438eb1">ホーム</font><br /><span>home</span></a></strong></li>
  <li class="gn2"><a href="greeting.html"><font color="#438eb1">ご利用案内</font><br /><span>how&nbsp;to&nbsp;use</span></a></li>
  <li class="gn3"><a href="service.html" ><font color="#438eb1">レッスン</font><br /><span>lesson</span></a></li>
  <li class="gn4"><a href="company.html"><font color="#438eb1">開発シリーズ</font><br /><span>series</span></a></li>
  <li class="gn5"><a href="contact.html"><font color="#438eb1">リクエスト</font><br /><span>request</span></a></li>
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
 <li><a href="greeting.html">チャンネル</a></li>
 <li><a href="../My_movies/index.php">公開動画</a></li>
 <li><a href="company.html">ソーシャル</a></li>
 <li><a href="index.php">動画アップロード</a></li>
 <li><a href="logout.php">ログアウト</a></li>
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
 <p class="lefttxt1">
 <?php
 if(isset($_POST['submit1']) && $error_ == 0){
 	print("<p><br>リクエストを投稿しました。<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></p>");
 	} 
 ?>
 <form method="post" action="create.php" enctype="multipart/form-data">
<br>
<br>開発シリーズのタイトル<input type="text" id="title" name="title" value="" size="50" maxlength="100">
 <?php
 if(isset($_POST['submit1'])){
				
	if($_POST['title'] == is_null()){
		$error_ = $error_ + 1;
		print('<font color="#FF0000">');
		print('<br>エラー:説明を入力して下さい。');
		print('</font>');
	}		
 }
 ?>
 <br>シリーズの説明：<br><textarea name="text" rows="9" cols="60"></textarea>
<?php
 if(isset($_POST['submit1'])){
		
		
	if($_POST['text'] == is_null()){
		$error_ = $error_ + 1;
		print('<font color="#FF0000">');
		print('<br>エラー:説明を入力して下さい。');
		print('</font>');
	}		
 }
 ?>
<br><input type="submit" name="submit1" value="この内容で作成する">
</form></p>
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
  <li><a href="./">ホーム</a></li>
  <li><a href="greeting.html">ご利用案内</a></li>
  <li><a href="service.html">レッスン</a></li>
  <li><a href="company.html">開発シリーズ</a></li>
  <li><a href="contact.html">リクエスト</a></li>
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
