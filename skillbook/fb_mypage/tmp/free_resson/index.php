<?php

$mysqli = new mysqli("localhost", "root", "poritan6479", "fb_connect_php");

/* 接続状況をチェックします */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
	
	//$bangou = $_GET['number'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<title>スキルブック：開発シリーズ<?php print($bangou);?></title>
<link href="../../css/import2.css" rel="stylesheet" type="text/css" media="all" />
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

<!--<p class="con1">ご不明な点・ご質問等<br />お気軽にお問い合わせ下さい</p>
<p class="con2"><a href="contact.html"><img src="images/con_btn_off.gif" alt="お問い合わせ" /></a></p>-->
<!--<ul class="s_btn">
 <li><a href="#"><img src="images/facebn_off.gif" alt="" /></a></li>
 <li style="margin:0;"><a href="#"><img src="images/twibn_off.gif" alt="" /></a></li>
</ul>-->

<div id="main">
<a name="s1" id="s1"></a>
<h3><?php print($bangou);?>開発シリーズ</h3>
<div class="pd3">
 <p class="lefttxt1">
 <table border="0" width="180" height="130">
 
<?php
$movies_query = 'select * from resson';
$count = 0;
if($movies_result = $mysqli->query($movies_query)){
	while ($movies_row = $movies_result->fetch_assoc()) {
	$count = $count + 1;
		if($count != 5){
	echo '<td>投稿日&nbsp;'.$movies_row['post_time'].'<br /><img src="../fb_mypage/'.$movies_row['image'].'" width="150" height="75"><br /><a href="info.php?number='.$movies_row['id'].'">'.mb_strimwidth($movies_row['title'], 0, 22, "...","UTF-8").'</a></td>';
		}
		if($count == 5){
	echo '<td>投稿日&nbsp;'.$movies_row['post_time'].'<br /><img src="../fb_mypage/'.$movies_row['image'].'" width="150" height="75"><br /><a href="info.php?number='.$movies_row['id'].'">'.mb_strimwidth($movies_row['title'], 0, 22, "...","UTF-8").'</a></td><tr>';
		$count = 0;
		}
	}
	$movies_result->free(); 
}
	
	?>
</table>
</p>
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
 <p class="copy">Copyright (c) Sample Co,.ltd All Rights Reserved.</p>
	</div>
</div>
</div>
<!--↑ここまでfooter -->
</body>
</html>
