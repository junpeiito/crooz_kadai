<?php

require_once('config.php');

session_start();

function h($s) {
return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}



$mysqli = new mysqli("localhost", "root", "poritan6479", "fb_connect_php");

/* 接続状況をチェックします */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$bangou = $_GET['ban'];
$movie_query = 'select * from movies where id = "'.$bangou.'"';
if($movie_result = $mysqli->query($movie_query)){
$movie_row = $movie_result->fetch_assoc();
}
//$row = mysql_fetch_assoc($query);






$copy_host = $bangou;
$copy_user = $_SESSION['user']['id'];
$copy_star = $_POST['star'];

$copy_username = $_POST['username'];
$copy_comment = $_POST['comment'];
//$query2 = mysql_query('select * from star where host = "'.$bangou.'" and user = "'.$copy_user.'"');
//$row2 = mysql_fetch_assoc($query2);

$star_query = 'select * from star where host = "'.$bangou.'" and user = "'.$copy_user.'"';
if($star_result = $mysqli->query($star_query)){
$star_row = $star_result->fetch_assoc();
}

//$sum_star_query = 'SELECT SUM( star ) FROM star where host = "'.$bangou.'"'; 
//$sum_star_query = 'SELECT SUM( star ) FROM star where host = "'.$bangou.'"';
//if($sum_star_result = $mysqli->query($sum_star_query)){
//$sum_star_$row = $sum_star_result->fetch_assoc();
//}

$sum_star_query = 'SELECT SUM(star) FROM star where host = "'.$bangou.'"'; //総合評価(分母)
if($sum_star_result = $mysqli->query($sum_star_query)){
$sum_star_row = $sum_star_result->fetch_assoc();
}
$sum_star_query2 = 'select count(*) as cnt from star where host = "'.$bangou.'"'; //総合評価(分子)
if($sum_star_result2 = $mysqli->query($sum_star_query2)){
$sum_star_row2 = $sum_star_result2->fetch_assoc();
}

$sum_star_query3 = 'select count(*) as cnt from star where host = "'.$bangou.'" and star = "5"'; //「すごく良い」と評価した人数
if($sum_star_result3 = $mysqli->query($sum_star_query3)){
$sum_star_row3 = $sum_star_result3->fetch_assoc();
}
$sum_star_query4 = 'select count(*) as cnt from star where host = "'.$bangou.'"'; // 評価した人数(動画投稿者に対して)
if($sum_star_result4 = $mysqli->query($sum_star_query4)){
$sum_star_row4 = $sum_star_result4->fetch_assoc();
}
//$post_star_query = 'insert into star (host,user,star) values ("'.$copy_host.'","'.$copy_user.'","'.$copy_star.'")';



	if(isset($_POST['submit1'])){
		$update_star = $movie_row['movie_star'] + 1;
		
	$post_star_query = 'INSERT INTO star (host,user,star) VALUES ("'.$copy_host.'", "'.$copy_user.'", "'.$copy_star.'")';
	$mysqli->query($post_star_query);
	
	$update_movies_star_query = 'UPDATE movies set movie_star = "'.$update_star.'" where id = "'.$bangou.'"';
	$mysqli->query($update_movies_star_query);
	}
	
	if(isset($_POST['submit2'])){

	$post_comment_query = 'INSERT INTO comment (name,movie_id,text) VALUES ("'.$copy_username.'", "'.$bangou.'", "'.$copy_comment.'")';
	$mysqli->query($post_comment_query);
	}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<title><?php print($movie_row['movie_title']); ?>｜視聴</title>
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
 
<?php
	if (!empty($_SESSION['user'])) {
		echo h($_SESSION['user']['facebook_name']); 
	print('<img src="'.h($_SESSION['user']['facebook_picture']).'" width="50" height="50">');
	}
?>
  <!--<ul id="hdright">
  <li>-->
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
<h2>おすすめ動画</h2>
<ul class="s_menu"> 
<?php 
	$rank_star_query = 'select * from movies where category = "'.$movie_row['category'].'" order by movie_star desc limit 5'; // 評価した人数(ランキング表示用)
	if($rank_star_result = $mysqli->query($rank_star_query)){
		while($rank_star_row = $rank_star_result->fetch_assoc()) {
		print('<li><a href="movie_see.php?ban='.$rank_star_row['id'].'">'.$rank_star_row['movie_title'].'</a></li>');
		
		
		}
		$rank_star_result->free();
	}
	
?>
</ul>
<!--<ul class="s_btn">
 <li><a href="#"><img src="images/facebn_off.gif" alt="" /></a></li>
 <li style="margin:0;"><a href="#"><img src="images/twibn_off.gif" alt="" /></a></li>
</ul>-->
</div>

<div id="main">
<a name="s1" id="s1"></a>
<h3><?php print($movie_row['movie_title']); ?></h3>
<p class="lefttxt1">
<video src="../<?php print($movie_row['movie_pass']); ?>" controls width=680 height=500 />
</p>
<div class="pd3">
</div>

<a name="s2" id="s2"></a>
<h3>解説</h3>
<div class="pd3">
 <p class="lefttxt1"><?php print($movie_row['info']); ?></p>
</div>

<a name="s3" id="s3"></a>
<h3>資料</h3>
<div class="pd3">
 <p class="lefttxt1"><br>・資料1：<?php print($movie_row['file_name1']); ?><a href="../<?php print($movie_row['file_pass1']); ?>">ダウンロード</a>
 <br>・資料2：<?php print($movie_row['file_name2']); ?><a href="../<?php print($movie_row['file_pass2']); ?>">ダウンロード</a>
 <br>・資料3：<?php print($movie_row['file_name3']); ?><a href="../<?php print($movie_row['file_pass3']); ?>">ダウンロード</a></p>
</div>

<a name="s4" id="s4"></a>
<h3>評価</h3>
<div class="pd4">
 <p class="lefttxt1">
 <br>
 <br>&nbsp;&nbsp;&nbsp;この動画の評価。(5段階評価)
<br>&nbsp;&nbsp;&nbsp;総合平均【
<?php if($_POST['star'] == is_null()){
	print('<font color="#0000ff">');
	print(bcdiv( $sum_star_row['SUM(star)'], $sum_star_row2['cnt'] , 2 ));
	print('</font>');
		}
	  	else{
	  		print('<font color="#0000ff">');
	  		print(bcdiv( $sum_star_row['SUM(star)'] + $_POST['star'], $sum_star_row2['cnt'] + 1 , 2 ));
	  		print('</font>');}
?>
/5】
<br>&nbsp;&nbsp;&nbsp;<?php if($_POST['star'] == is_null()){
	print('<font color="#ff0000">');
	print($sum_star_row4['cnt']);
	print('</font>');
						}
						else{print('<font color="#ff0000">');
							print($sum_star_row4['cnt'] + 1);}
							print('</font>');?>
							人中
						<?php if($_POST['star'] == is_null()){
							print('<font color="#ff0000">');
							print($sum_star_row3['cnt']);
							print('</font>');
						}
						elseif($_POST['star'] == "5"){print('<font color="#ff0000">');
							print($sum_star_row3['cnt'] + 1);
							print('</font>');
						}
						elseif($_POST['star'] != "5"){
							print($sum_star_row3['cnt'] + 0);
							print('</font>');
						};
						
						
						?>

人の方がこの動画を「とても良い」と評価しています。
<br>
<?php
	if($star_row['user'] != is_null()){
		print('&nbsp;&nbsp;&nbsp;あなたはこの動画を評価しました。<br>&nbsp;&nbsp;&nbsp;あなたの付けた評価【'.$star_row['star'].'】<br />');	
	}
	elseif($_POST['star'] == is_null() && !empty($_SESSION['user'])){
		print('<form method="post" action="movie_see.php?ban='.$bangou.'" enctype="multipart/form-data">');
		print('<br>&nbsp;&nbsp;&nbsp;この動画を評価する。');
		print('<br>');
		print('&nbsp;&nbsp;&nbsp;<input type="radio" name="star" value="1">&nbsp;わるい&nbsp;&nbsp;');
		print('<input type="radio" name="star" value="2">&nbsp;少しわるい&nbsp;&nbsp;');
		print('<input type="radio" name="star" value="3" checked>&nbsp;普通&nbsp;&nbsp;');
		print('<input type="radio" name="star" value="4">&nbsp;良い&nbsp;&nbsp;');
		print('<input type="radio" name="star" value="5">&nbsp;とても良い&nbsp;&nbsp;');
		print('<br>&nbsp;&nbsp;&nbsp;<input type="submit" name="submit1" value="評価する">');
		print('</form>');
	}
	if($_SESSION['user'] == is_null()){print('&nbsp;&nbsp;&nbsp;動画の評価は会員メンバーが行えます。<a href="../login.php">ログイン、または新規会員登録をする。</a>');}
	if($_POST['star'] != is_null()){print('&nbsp;&nbsp;&nbsp;あなたはこの動画を評価しました。<br>あなたの付けた評価【'.$_POST['star'].'】<br />');	}	
?>
</p>
</div>

<a name="s5" id="s5"></a>
<h3>コメント</h3>
<div class="pd5">
 <p class="lefttxt1">

<?php
print('<form method="post" action="movie_see.php?ban='.$bangou.'" enctype="multipart/form-data">');
?>
<br>
<br>name:<input type="text" id="username" name="username" value="" size="25" maxlength="100">
<br>
コメント：<br>
<textarea name="comment" rows="4" cols="40"></textarea><br>
<input type="submit" name="submit2" value="送信">
</form>
<?php 
	$rank_comment_query = 'select * from comment where movie_id = "'.$bangou.'"'; // 評価した人数(ランキング表示用)
	if($rank_comment_result = $mysqli->query($rank_comment_query)){
		while($rank_comment_row = $rank_comment_result->fetch_assoc()) {
		print('<li>'.$rank_comment_row['name'].'：'.$rank_comment_row['text'].'</li><br>');
		
		
		}
		$rank_comment_result->free();
	}
	
?>
</p>
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
 <p class="pagetop"><a href="#top"><img src="../images/pagetop.gif" alt="ページの上部へ" /></a></p>
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
