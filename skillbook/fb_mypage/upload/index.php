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

	//$change_category = "HTML/";
	$copyMovie = $_FILES['my_movie'];
	$copyFile1 = $_FILES['my_file1'];
	$copyFile2 = $_FILES['my_file2'];
	$copyFile3 = $_FILES['my_file3'];
	$copyThumbnail = $_FILES['thumbnail'];
	$copy_title = $_POST['title'];
	$copy_file_name1 = $_POST['file_name1'];
	$copy_file_name2 = $_POST['file_name2'];
	$copy_file_name3 = $_POST['file_name3'];
	$copy_info = $_POST['text'];
	$copy_category = $_POST['category'];
	$copy_user = $_SESSION['user']['id'];
	$error_ = 0;
	$file_name_rand1 = mt_rand();
	$file_name_rand2 = mt_rand();
	$file_name_rand3 = mt_rand();
	$file_name_rand4 = mt_rand();
	$file_name_rand5 = mt_rand();
	//$ext = substr($copyfile1['name'], -3);
	$today = date("Y/m/d");
	
	if($_POST['text'] == is_null()){
		$error_ = $error_ + 1;
	}
	if($_POST['title'] == is_null()){
		$error_ = $error_ + 1;
	}
	if($_POST['category'] == "category_is_null"){
		$error_ = $error_ + 1;
	}
	if($_FILES['my_movie']["name"] == is_null()){
		$error_ = $error_ + 1;
	}
	if(isset($_POST['submit1']) && $error_ == 0){
		
			$copyMoviePath = 'Movies/' . $_POST['category']. "/" . $file_name_rand1 . $copyMovie['name']; //DBの書き込み用
			$Movie_uploadPath = '../Movies/' . $_POST['category']. "/" . $file_name_rand1 . $copyMovie['name'];//アップロード先を指定
			move_uploaded_file($copyMovie['tmp_name'], $Movie_uploadPath);
			print($copMovie['error']);
			
			$copyFilePath1 = 'user_file/' . $file_name_rand2 . $copyFile1['name'];
			$File1_uploadPath = '../user_file/' . $file_name_rand2 . $copyFile1['name'];
			move_uploaded_file($copyFile1['tmp_name'], $File1_uploadPath);
			print($copyFile1['error']);
			
			$copyFilePath2 = 'user_file/' . $file_name_rand3 . $copyFile2['name'];
			$File2_uploadPath = '../user_file/' . $file_name_rand3 . $copyFile2['name'];
			move_uploaded_file($copyFile2['tmp_name'], $File2_uploadPath);
			print($copyFile2['error']);
			
			$copyFilePath3 = 'user_file/' . $file_name_rand4 . $copyFile3['name'];
			$File3_uploadPath = '../user_file/' . $file_name_rand4 . $copyFile3['name'];
			move_uploaded_file($copyFile3['tmp_name'], $File3_uploadPath);
			print($copyFile3['error']);
						
			
			$copyThumbnailPath = 'thumbnail/' . $file_name_rand5 . $copyThumbnail['name'];
			$Thumbnail_uploadPath = '../thumbnail/' . $file_name_rand5 . $copyThumbnail['name'];
			move_uploaded_file($copyThumbnail['tmp_name'], $Thumbnail_uploadPath);
			print($copyThumbnail['error']);
			
			print('<audio id="info" src="'.$copyMoviePath.'" autobuffer></audio>');			
			mysql_query('insert into movies (
 		post_time,
 		movie_title,
 		info,
 		category,
 		movie_pass,
 		thumbnail,
 		file_pass1,
 		file_pass2,
 		file_pass3,
 		file_name1,
 		file_name2,
 		file_name3,
 		user) values ("'.$today.'",
 		"'.$copy_title.'",
 		"'.$copy_info.'",
 		"'.$copy_category.'",
 		"'.$copyMoviePath.'",
 		"'.$copyThumbnailPath.'",
 		"'.$copyFilePath1.'",
 		"'.$copyFilePath2.'",
 		"'.$copyFilePath3.'",
 		"'.$copy_file_name1.'",
 		"'.$copy_file_name2.'",
 		"'.$copy_file_name3.'",
 		"'.$copy_user.'")');
 		
 		header('Location: upload_comp.php') ;
		

	}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<title>マイページ｜動画アップロード</title>
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
<h3>動画アップロード</h3>
<div class="pd3">
 <p class="lefttxt1"><?php
 if(isset($_POST['submit1']) && $error_ == 0){
 	print("<p><br>動画をアップロードしました<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></p>");
 	} 
 ?>
 <form method="post" action="index.php" enctype="multipart/form-data">
 <br>動画のタイトル：<input type="text" id="title" name="title" value="" size="50" maxlength="100">
 <?php
 if(isset($_POST['submit1'])){
		
		
	if($_POST['title'] == is_null()){
		$error_ = $error_ + 1;
		print('<font color="#FF0000">');
		print('エラー:タイトルを入力して下さい。<br />');
		print('</font>');
	}		
 }
 ?>
 <br>カテゴリー：<select name="category">
<option value="category_is_null">選択して下さい</option>
<option value="HTML">HTML</option>
<option value="PHP">PHP</option>
<option value="MySQL">MySQL</option>
<option value="Flash">Flash</option>
<option value="Flash">PhotoShop</option>
<option value="Illustrator">Illustrator</option>
<option value="Unity">Unity</option>
<option value="Android">Android</option>
<option value="iOS">iOS</option>
<option value="Other">その他</option>
</select>
<?php
 if(isset($_POST['submit1'])){
		
		
	if($_POST['category'] == "category_is_null"){
		$error_ = $error_ + 1;
		print('<font color="#FF0000">');
		print('<br>エラー:カテゴリーを選択して下さい<br />');
		print('</font>');
	}		
 }
 ?>
<br>動画の説明：<br><textarea name="text" rows="9" cols="60"></textarea>
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
<br>
<input type="hidden" name="MAX_FILE_SIZE" value="536870912" />
<br>
<d1>
<dt>動画を選択</dt>
<dd>
<input name="my_movie" type="file" id="my_movie" size="50" /></dd>
</d1>
<d1>
<dt>添付ファイル1</dt>
<dd>
<input name="my_file1" type="file" id="my_file1" size="50" /></dd>
</d1>
：ファイルの内容<input type="text" id="file_name1" name="file_name1" value="" size="50" maxlength="100">
<br>
<d1>
<dt>添付ファイル2</dt>
<dd>
<input name="my_file2" type="file" id="my_file2" size="50" /></dd>
</d1>
：ファイルの内容<input type="text" id="file_name2" name="file_name2" value="" size="50" maxlength="100">
<br>
<d1>
<dt>添付ファイル3</dt>
<dd>
<input name="my_file3" type="file" id="my_file3" size="50" /></dd>
</d1>
：ファイルの内容<input type="text" id="file_name3" name="file_name3" value="" size="50" maxlength="100">
<br>
<d1>
<dt>サムネイル画像</dt>
<dd>
<input name="thumbnail" type="file" id="thumbnail" size="50" /></dd>
</d1>
<?php
 if(isset($_POST['submit1'])){
		
		
	if($_FILES['my_movie']["name"] == is_null()){
		$error_ = $error_ + 1;
		print('<font color="#FF0000">');
		print('エラー:動画が選択されていません。<br />');
		print('</font>');
	}		
 }
 ?>
 <br><input type="submit" name="submit1" value="動画を投稿する">
 </form>
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
 <p class="copy">Copyright (c) Sample Co,.ltd All Rights Reserved.</p>
	</div>
</div>
</div>
<!--↑ここまでfooter -->
</body>
</html>
