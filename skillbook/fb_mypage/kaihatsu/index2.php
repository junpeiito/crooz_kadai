<?php

require_once('config.php');

session_start();

function h($s) {
return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

	$change_category = "HTML/";
	$copyfile1 = $_FILES['my_movie'];
	$error_ = 0;	
	//$ext = substr($copyfile1['name'], -3);
	
	if(isset($_POST['submit1']) && $error_ == 0){
			$copyfilePath1 = '../Movies/' . $change_category . $copyfile1['name'];
			move_uploaded_file($copyfile1['tmp_name'], $copyfilePath1);
			
			print($copyfile1['error']);
		
	}

		

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<title>マイページ｜動画アップロード</title>
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

<!--<p class="con1">ご不明な点・ご質問等<br />お気軽にお問い合わせ下さい</p>
<p class="con2"><a href="contact.html"><img src="images/con_btn_off.gif" alt="お問い合わせ" /></a></p>-->
<!--<ul class="s_btn">
 <li><a href="#"><img src="images/facebn_off.gif" alt="" /></a></li>
 <li style="margin:0;"><a href="#"><img src="images/twibn_off.gif" alt="" /></a></li>
</ul>-->

<div id="main">
<a name="s1" id="s1"></a>
<h3>ほげほげ動画</h3>
<div class="pd3">
 <p class="lefttxt1">
 <video src="../Movies/HTML/aaaa.mov" controls width=900 height=600 />
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
	<p class="left">サンプル株式会社&nbsp;&nbsp;&nbsp;〒000-000&nbsp;見本市見本区見本1-1-11</p>
 <p class="copy">Copyright (c) Sample Co,.ltd All Rights Reserved.</p>
	</div>
</div>
</div>
<!--↑ここまでfooter -->
</body>
</html>
