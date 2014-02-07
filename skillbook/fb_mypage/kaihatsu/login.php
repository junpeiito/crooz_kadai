<?php
//session_start();	
	//$db_link = mysql_connect('localhost', 'root', 'root');
//if (!$db_link) {
//    die('データベース接続失敗'.mysql_error());
//}
//print('<p>データベースの接続に成功しました。</p>');
//$db_selected = mysql_select_db('user_info', $db_link);
//	if (!$db_selected){
  //  die('データベース選択失敗です。'.mysql_error());
	//}
//$result = mysql_query('SELECT *  FROM user');
//	if (!$result) {
  //  die('クエリーが失敗しました。'.mysql_error());
//	}
  //	$set_id = $_POST["set_id"];
  	//$set_pw = $_POST["set_pw"];
  	//$set_code = ($set_id.$set_pw);
	//$query = mysql_query('select * from user where success_code = "'.$set_code.'"');
	//$row = mysql_fetch_assoc($query);
  // エラーメッセージ
  //$errorMessage = "";
  // 画面に表示するため特殊文字をエスケープする
  //$viewUserId = htmlspecialchars($_POST["userid"], ENT_QUOTES);
  // ログインボタンが押された場合      
  //if (isset($_POST["submit2"])) {
    // 認証成功
    //if ($set_code == $row['success_code']) {
      // セッションIDを新規に発行する
      //session_regenerate_id(TRUE);
      //$_SESSION["USERID"] = $row["client_id"];
      //$_SESSION["USERPW"] = $row["client_pw"];
      //header("Location: main.php");
      //exit;
    //}
    //else {
      //header("Location: error/error3.php");
    //}
  //}
  
  
  
	
?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>SkillBook-Login</title>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
<meta name="format-detection" content="telephone=no">
<style type="text/css">

.box1{ -webkit-box-sizing: border-box;　/* Safari,Google Chrome用 */  
    -moz-box-sizing: border-box;　/* Firefox用 */  
    -ms-box-sizing: border-box;　/* Internet Explorer 8用 */  
    box-sizing: border-box;　/* Opera用 */  }
</style>
</head>
<body>
<header>
<div id="page_top">
</div>
</header>
<article>
<section>
<center><img src="image/tope.jpg"></p></center>
</section>
<section>
 <h2><center><font color="#438eb1"><img src="images/skillbook.png" width="35" height="35">SkillBookにログイン</font></center></h2>
 <center><div class="box1">
 <form method="post" action="login.php" enctype="multipart/form-data">
 <p>ユーザーID:<input type="text" id="set_id" name="set_id" value="" size="20" maxlength="100"></p>
 パスワード:<input type="password" id="set_pw" name="set_pw" value="" size="20" maxlength="100">
 <br><input type="submit" name="submit2" value="ログイン">
 </form>
 <br><a href="redirect.php">Facebookでログイン</a></p>
 </div>
 </center>
</section>
</article>

</body>
</html>