#!/usr/bin/perl
#↑パールパス設定。サーバに合わせて必要であれば変更してください。
########################################################################################################
# 著作権の表示
# パソコン用メール送信フォーム(2009.10)
# 作者 中野智丹
########################################################################################################
#設定ファイル
require './setting.pl';
require './title.pl';

#日本語変換ライブラリの設定
require './mimew.pl';
#日時の取得
$nowtime = time;

#■デコード
if ($ENV{'REQUEST_METHOD'} eq "POST") { read(STDIN, $buffer, $ENV{'CONTENT_LENGTH'}); }
else { $buffer = $ENV{'QUERY_STRING'}; }

if ($buffer eq "") { &err1('エラーです。'); }

@pairs = split(/&/,$buffer);
foreach $pair (@pairs) {
 
 ($name,$value) = split(/=/, $pair);
 $name2 = $name;
 $value2 = $value;
 $FORM2{$name} = $value;
 
 $value =~ tr/+/ /;
 $value =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
 $value =~ s/</&lt;/g;
 $value =~ s/>/&gt;/g;
 $value =~ s/\n/<br>/g; 
 $value =~ s/\r//g;
 $value =~ s/\t//g;
 $value =~ s/"/'/g;
 #フォーム変数へ
 $FORM{$name} = $value;
}
 
 $name = $FORM{'name'};
 $huri = $FORM{'huri'};
 $yubin = $FORM{'yubin'};
 $address = $FORM{'address'};
 $name = $FORM{'name'};
 $mail = $FORM{'mail'};
 $tel = $FORM{'tel'};
 $situmon = $FORM{'situmon'};

 $hensin = $FORM{'hensin'};
 $kakunin = $FORM{'kakunin'};
  

#日時取得
sub time1{
 $ENV{'TZ'} = "JST-9";
 $time = time;
 local($sec,$min,$hour,$mday,$mon,$year) = localtime($time);

 # 日時のフォーマット
 $data_now1 = sprintf("%04d %02d/%02d %02d:%02d",
   $year+1900,$mon+1,$mday,$hour,$min);

}

#日時取得4
sub time4{
 $ENV{'TZ'} = "JST-9";
 $time = time;
 local($sec,$min,$hour,$mday,$mon,$year) = localtime($time);

 # 日時のフォーマット
 $data_now4 = sprintf("%04d%02d%02d",
   $year+1900,$mon+1,$mday);
}

#必須入力チェック

if($FORM{'name'} eq "" )
{
  &err1('お名前が記入されていません。お手数ですが、前の画面に戻って入力しなおしてください。');
}

if($FORM{'huri'} eq "" )
{
  &err1('ふりがなが記入されていません。お手数ですが、前の画面に戻って入力しなおしてください。');
}

if($FORM{'tel'} eq "" )
{
  &err1('電話番号が記入されていません。お手数ですが、前の画面に戻って入力しなおしてください。');
}

if($FORM{'mail'} eq "" )
{
  &err1('メールアドレスが記入されていません。お手数ですが、前の画面に戻って入力しなおしてください。');
}

if($FORM{'situmon'} eq "" )
{
  &err1('お問い合わせ内容・お見積り内容が記入されていません。お手数ですが、前の画面に戻って入力しなおしてください。');
}

#送信完了画面の出力
if($kakunin eq "1"){
 &kakunin();
}else{
 &kanryou();
} 

#確認画面のレイアウトを改造するには↓を変更します。
sub kakunin{

print <<"OUT_HTML";
Content-type: text/html

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<title>お問い合わせ｜サンプル株式会社</title>
<link href="../css/import.css" rel="stylesheet" type="text/css" media="all" />
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
		<h1>見本市のサンプル株式会社</h1>
  <p id="logo"><a href="./">サンプル株式会社</a></p>
 </div>
  <ul id="hdright">
   <li><img src="../images/tel.gif" alt="お電話でのお問い合わせ" /></li>
   <li class="blue">00-1234-5678</li>
   <li class="hdtxt" style="margin:0">受付時間 9:30～18:30(月～金)</li>
  </ul>
</div>
 <ul id="gnavi">
  <li class="gn1"><a href="./">ホーム<br /><span>top</span></a></li>
  <li class="gn2"><a href="../greeting.html">ごあいさつ<br /><span>greeting</span></a></li>
  <li class="gn3"><a href="../service.html" >サービス概要<br /><span>service</span></a></li>
  <li class="gn4"><a href="../company.html">会社概要<br /><span>company</span></a></li>
  <li class="gn5"><strong><a href="../contact.html">お問い合わせ<br /><span>contact</span></a></strong></li>
 </ul> 
</div>
</div>
<!--↑ここまでhead -->

<!--↓ここからcontents -->
<div id="visual2">
 <p>会社概要<span>COMPANY</span></p>
</div>
<div id="contents">
<div id="side">
<p class="con1">ご不明な点・ご質問等<br />お気軽にお問い合わせ下さい</p>
<p class="con2"><a href="../contact.html"><img src="../images/con_btn_off.gif" alt="お問い合わせ" /></a></p>
<h2>メニュー</h2>
<ul class="s_menu">
 <li><a href="../greeting.html">ごあいさつ</a></li>
 <li><a href="../service.html">サービス概要</a></li>
 <li><a href="../company.html">会社概要</a></li>
</ul>
<ul class="s_btn">
 <li><a href="#"><img src="../images/facebn_off.gif" alt="" /></a></li>
 <li style="margin:0;"><a href="#"><img src="../images/twibn_off.gif" alt="" /></a></li>
</ul>
</div>

<div id="main">
<h2>お問い合わせフォーム</h2>
<p class="pd2">下記フォームに必要事項をご記入の上、送信ボタンを押してください。<br />メール確認後、担当者より折り返しご連絡させて頂きます。 </p>
        <form name="form1" method="post" action="contact.cgi">
	<input name="hensin" type="hidden" value="1" />
	<input type="hidden" name="name" value="$name" />
	<input type="hidden" name="mail" value="$mail" />
	<input type="hidden" name="tel" value="$tel" />
	<input type="hidden" name="situmon" value="$situmon" />
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbbox2">
            <tr>
 	      <th width="25%">お名前</th>
              <td width="75%">$name</td>
            </tr>
            <tr>
              <th>ふりがな</th>
              <td>$huri</td>
            </tr>
            <tr>
              <th>郵便番号</th>
              <td>$yubin</td>
            </tr>
            <tr>
              <th>住所</th>
              <td>$address</td>
            </tr>
            <tr>
              <th>電話番号</th>
              <td>$tel</td>
            </tr>
            <tr>
              <th>メールアドレス</th>
              <td>$mail</td>
            </tr>
            <tr>
              <th>お問い合わせ内容</th>
              <td>$situmon</td>
            </tr>
  <tr>
  <td class="form_btn" colspan="2"  style="text-align:center"><input type="button" value="入力画面に戻る" onclick="history.back();" />&nbsp;&nbsp;&nbsp;
<input type="submit" value="この内容で送信する" class="iimg" /></td>
 </tr>
 </table>
        </form>
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
  <li><a href="../greeting.html">ごあいさつ</a></li>
  <li><a href="../service.html">サービス概要</a></li>
  <li><a href="../company.html">アクセス</a></li>
  <li><a href="../contact.html">お問い合わせ</a></li>
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

OUT_HTML
exit;
}

#送信完了画面のレイアウトを改造するには↓を変更します。
sub kanryou{

&time1;
&time4;

#IPアドレス
$ip = $ENV{'REMOTE_ADDR'};
#ユーザーホスト
$user = gethostbyaddr(pack("C4" ,split(/\./, $ip)), 2);
#ブラウザ
$browser = $ENV{'HTTP_USER_AGENT'};

if($alphabetng eq "1" )
{

if($FORM{'situmon'} !~ /([\x81-\xfc].){2,}/){
  &err1('お問い合わせ内容がアルファベットのみです。日本語でご入力お願いします。');
}
}

if($ng eq "1" )
{

open(BROWSERFILE, "<$ngbrowser") or &err1('このブラウザでの閲覧は禁止されております。');
flock(BROWSERFILE, 2);
@NGBROWSER = <BROWSERFILE>;
flock(BROWSERFILE, 8);
close(BROWSERFILE);

foreach $ngbrowser9 (@NGBROWSER)
{
($ngbrowser99) = split(/<>/,$ngbrowser9);
if($browser eq $ngbrowser99)
{
  &err1('このブラウザでの閲覧は禁止されております。');
}
}

open(IPFILE, "<$ngip") or &err1('恐れ入りますが現在送信不可となっております。');
flock(IPFILE, 2);
@NGIP = <IPFILE>;
flock(IPFILE, 8);
close(IPFILE);

foreach $ngip9 (@NGIP)
{
($ngip99) = split(/<>/,$ngip9);
if($ip eq $ngip99)
{
  &err1('恐れ入りますが現在送信不可となっております。');
}
}
open(HOSTFILE, "<$nghost") or &err1('ご利用サーバーからの投函は禁止されております');
flock(HOSTFILE, 2);
@NGHOST = <HOSTFILE>;
flock(HOSTFILE, 8);
close(HOSTFILE);

foreach $nghost9 (@NGHOST)
{
($nghost99) = split(/<>/,$nghost9);
if($user eq $nghost99)
{
  &err1('ご利用サーバーからの投函は禁止されております');
}
}

open(NGMAIL, "<$ngmail") or &err1('このメールアドレスでのお問い合わせは受付しておりません。');
flock(NGMAIL, 2);
@NGMAIL = <NGMAIL>;
flock(NGMAIL, 8);
close(NGMAIL);

foreach $ngmail9 (@NGMAIL)
{
($ngmail99) = split(/<>/,$ngmail9);
if($mail eq $ngmail99)
{
  &err1('このメールアドレスでのお問い合わせは受付しておりません。');
}
}

open(HOSTFILE2, "<$nghost2") or &err1('このサーバーで一部送信が禁止されている可能性があります。');
flock(HOSTFILE2, 2);
@NGHOST2 = <HOSTFILE2>;
flock(HOSTFILE2, 8);
close(HOSTFILE2);

foreach $nghost92 (@NGHOST2)
{
($nghost992) = split(/<>/,$nghost92);
if($user =~ $nghost992)
{
  &err1('このサーバーで一部送信が禁止されている可能性があります。');
}
}

open(NGWORD, "<$ngword") or &err1('受付されていない文字を含んでいる可能性があります。');
flock(NGWORD, 2);
@NGWORD = <NGWORD>;
flock(NGWORD, 8);
close(NGWORD);

foreach $ngword9 (@NGWORD)
{
($ngword99) = split(/<>/,$ngword9);
if($situmon =~ $ngword99)
{
  &err1('受付されていない文字を含んでいる可能性があります。');
}
}

}

#日時の処理
open(NGTIME, "<$ngtime");
flock(NGTIME, 2);
$NGTIMENOW = <NGTIME>;
flock(NGTIME, 8);
close (NGTIME);

if($NGTIMENOW < $data_now4){
unlink  "$ngtime";
unlink  "$ngrenzoku";

open(NGTIME,"+>$ngtime") or &err1('タイムアップエラー画発生しました。');
open(RENZOKU,"+>$ngrenzoku") or &err1('連続投函は禁止されております。');

chmod 0606, $ngtime;
chmod 0606, $ngrenzoku;

open(NGTIME, "+<$ngtime");
flock(NGTIME, 2);
seek (NGTIME, 0, 0);
print NGTIME "$data_now4\n";
flock(NGTIME, 8);
close (NGTIME);
}

#連続投稿のチェック
open(RENZOKU, "<$ngrenzoku") or &err1('エラー8');
flock(RENZOKU, 2);
@RENZOKU = <RENZOKU>;
flock(RENZOKU, 8);
close(RENZOKU);

foreach $tdata (@RENZOKU)
{
 ($A1,$B1,$C1,$D1,$E1) = split (/<>/,$tdata);
 $A1 += $ngrk;
 if($ip eq $D1){
 if($A1 > $nowtime){
  &err1('すでにお問合わせをなされています。');
}
}
}

#連続投稿記録
open(NGRENZOKU1, "<$ngrenzoku") or &err1('エラー7');
flock(NGRENZOKU1, 2);
@NGRENZOKU1 = <NGRENZOKU1>;
flock(NGRENZOKU1, 8);
close(NGRENZOKU1);

unshift(@NGRENZOKU1,"$nowtime<>$data_now1<>$user<>$ip<>$browser<>\n");
open(NGRENZOKU1,"+<$ngrenzoku") or &err1("エラー7");
flock(NGRENZOKU1, 2);
print NGRENZOKU1 @NGRENZOKU1;
flock(NGRENZOKU1, 8);
close(NGRENZOKU1);

print <<"OUT_HTML";
Content-type: text/html

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<title>お問い合わせ｜サンプル株式会社</title>
<link href="../css/import.css" rel="stylesheet" type="text/css" media="all" />
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
		<h1>見本市のサンプル株式会社</h1>
  <p id="logo"><a href="./">サンプル株式会社</a></p>
 </div>
  <ul id="hdright">
   <li><img src="../images/tel.gif" alt="お電話でのお問い合わせ" /></li>
   <li class="blue">00-1234-5678</li>
   <li class="hdtxt" style="margin:0">受付時間 9:30～18:30(月～金)</li>
  </ul>
</div>
 <ul id="gnavi">
  <li class="gn1"><a href="./">ホーム<br /><span>top</span></a></li>
  <li class="gn2"><a href="../greeting.html">ごあいさつ<br /><span>greeting</span></a></li>
  <li class="gn3"><a href="../service.html" >サービス概要<br /><span>service</span></a></li>
  <li class="gn4"><a href="../company.html">会社概要<br /><span>company</span></a></li>
  <li class="gn5"><strong><a href="../contact.html">お問い合わせ<br /><span>contact</span></a></strong></li>
 </ul> 
</div>
</div>
<!--↑ここまでhead -->

<!--↓ここからcontents -->
<div id="visual2">
 <p>会社概要<span>COMPANY</span></p>
</div>
<div id="contents">
<div id="side">
<p class="con1">ご不明な点・ご質問等<br />お気軽にお問い合わせ下さい</p>
<p class="con2"><a href="../contact.html"><img src="../images/con_btn_off.gif" alt="お問い合わせ" /></a></p>
<h2>メニュー</h2>
<ul class="s_menu">
 <li><a href="../greeting.html">ごあいさつ</a></li>
 <li><a href="../service.html">サービス概要</a></li>
 <li><a href="../company.html">会社概要</a></li>
</ul>
<ul class="s_btn">
 <li><a href="#"><img src="../images/facebn_off.gif" alt="" /></a></li>
 <li style="margin:0;"><a href="#"><img src="../images/twibn_off.gif" alt="" /></a></li>
</ul>
</div>

<div id="main">
<h2>お問い合わせフォーム</h2>
      <p>正常に送信されました。</p>
        <p>この度は、お問い合わせ頂き、誠にありがとうございました。<br><br>
	ご記入いただきましたメールアドレスの方へ、ご入力内容の確認メールを送信させて頂きましたので、そちらも合わせてご確認下さい。<br><br>
	万が一、確認メールが届かない場合、ご入力いただいたメールアドレスが間違っている恐れがありますので、お手数ではございますが、再度ご入力頂きます様よろしくお願い致します。<br>
	 折り返し、担当者よりご連絡をさせて頂きます。<br>何卒よろしくお願い致します。<br><br>
	【サンプル株式会社】</p>
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
  <li><a href="../greeting.html">ごあいさつ</a></li>
  <li><a href="../service.html">サービス概要</a></li>
  <li><a href="../company.html">アクセス</a></li>
  <li><a href="../contact.html">お問い合わせ</a></li>
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


OUT_HTML

  $subject = &mimeencode($kenmei);
  $subject2 = &mimeencode($kenmei2);
  $mail = &mimeencode($mail);
  $sendAddress = &mimeencode($sendAddress);

$DATA = "送信日時";
$USER = "ホスト";
$IP = "IPアドレス";
$BROWSER = "ブラウザ";

#改行
$situmon =~ s/&lt;br&gt;/\n/g;

#自分に送信されるメールです。改造するには↓を変更します。

  open (MAIL, "|$mailprog $sendAddress") || die "Can't open $mailprog!\n";
  print MAIL "From: $mail\n";
  print MAIL "To: $sendAddress\n";
  print MAIL "Subject: $subject\n";
  print MAIL "MIME-Version: 1.0\n";
  print MAIL "Content-type: text/plain; charset=utf-8\n";
  print MAIL "\n";
  print MAIL "【 お問い合わせフォームよりお問合わせがありました。 】\n\n";
  print MAIL "[お名前]\n";
  print MAIL "$name\n\n";
  print MAIL "[ふりがな]\n";
  print MAIL "$name\n\n";
  print MAIL "[郵便番号]\n";
  print MAIL "$yubin\n\n";
  print MAIL "[住所]\n";
  print MAIL "$address\n\n";
  print MAIL "[電話番号]\n";
  print MAIL "$tel\n\n";
  print MAIL "[メールアドレス]\n";
  print MAIL "$mail\n\n";
  print MAIL "[お問い合わせ内容]\n";
  print MAIL "$situmon\n\n";
  print MAIL "■■■■■■■■\n";
  print MAIL "[$DATA]\n";
  print MAIL "$data_now\n";
  print MAIL "[$USER]\n";
  print MAIL "$user\n";
  print MAIL "[$IP]\n";
  print MAIL "$ip\n";
  print MAIL "[$BROWSER]\n";
  print MAIL "$browser\n";
  print MAIL "■■■■■■■■\n";
  close (MAIL);

if($FORM{'hensin'} eq "1" ){
#閲覧者に送信される控えメールです。
  open (MAIL, "|$mailprog $mail") || die "Can't open $mailprog!\n";
  print MAIL "From: $sendAddress\n";
  print MAIL "To: $mail\n";
  print MAIL "Subject: $subject2\n";
  print MAIL "MIME-Version: 1.0\n";
  print MAIL "Content-type: text/plain; charset=utf-8\n";
  print MAIL "\n";
  print MAIL "$name 様\n\n";
  print MAIL "この度はお問い合わせいただき誠にありがとうございました。\n\n";
  print MAIL "--------------------------------------------\n\n";
  print MAIL "お客様が送信されました情報は以下の通りになります。\n\n";
  print MAIL "[お名前]\n";
  print MAIL "$name\n\n";
  print MAIL "[ふりがな]\n";
  print MAIL "$name\n\n";
  print MAIL "[郵便番号]\n";
  print MAIL "$yubin\n\n";
  print MAIL "[住所]\n";
  print MAIL "$address\n\n";
  print MAIL "[電話番号]\n";
  print MAIL "$tel\n\n";
  print MAIL "[メールアドレス]\n";
  print MAIL "$mail\n\n";
  print MAIL "[お問い合わせ内容]\n";
  print MAIL "$situmon\n\n";
  print MAIL "-----------------------------------------------\n";
  print MAIL "後程上記内容を確認し、担当者よりご連絡させていただきます。\n";
  print MAIL "ご連絡をさせていただくまで、いましばらくお待ちいただきます様、宜しくお願い致します。\n";
  print MAIL "◇◇◇◇◇◇◇◇◇◇◇◇◇◇◇◇◇◇◇◇◇◇\n";
  print MAIL "サンプル株式会社\n";
  print MAIL "サンプル県サンプル市サンプル町\n";
  print MAIL "TEL.00-1234-5678 \n";
  print MAIL "http://www.sample.co.jp/\n";
  print MAIL "$sendAddress\n";
  print MAIL "◇◇◇◇◇◇◇◇◇◇◇◇◇◇◇◇◇◇◇◇◇◇\n";
  close (MAIL);
} 
exit;  
}

#エラーメッセージ画面です。改造するには↓を変更します。
sub err1
{ 
print <<"OUT_HTML";
Content-type: text/html

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<title>お問い合わせ｜サンプル株式会社</title>
<link href="../css/import.css" rel="stylesheet" type="text/css" media="all" />
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
		<h1>見本市のサンプル株式会社</h1>
  <p id="logo"><a href="./">サンプル株式会社</a></p>
 </div>
  <ul id="hdright">
   <li><img src="../images/tel.gif" alt="お電話でのお問い合わせ" /></li>
   <li class="blue">00-1234-5678</li>
   <li class="hdtxt" style="margin:0">受付時間 9:30～18:30(月～金)</li>
  </ul>
</div>
 <ul id="gnavi">
  <li class="gn1"><a href="./">ホーム<br /><span>top</span></a></li>
  <li class="gn2"><a href="../greeting.html">ごあいさつ<br /><span>greeting</span></a></li>
  <li class="gn3"><a href="../service.html" >サービス概要<br /><span>service</span></a></li>
  <li class="gn4"><a href="../company.html">会社概要<br /><span>company</span></a></li>
  <li class="gn5"><strong><a href="../contact.html">お問い合わせ<br /><span>contact</span></a></strong></li>
 </ul> 
</div>
</div>
<!--↑ここまでhead -->

<!--↓ここからcontents -->
<div id="visual2">
 <p>会社概要<span>COMPANY</span></p>
</div>
<div id="contents">
<div id="side">
<p class="con1">ご不明な点・ご質問等<br />お気軽にお問い合わせ下さい</p>
<p class="con2"><a href="../contact.html"><img src="../images/con_btn_off.gif" alt="お問い合わせ" /></a></p>
<h2>メニュー</h2>
<ul class="s_menu">
 <li><a href="../greeting.html">ごあいさつ</a></li>
 <li><a href="../service.html">サービス概要</a></li>
 <li><a href="../company.html">会社概要</a></li>
</ul>
<ul class="s_btn">
 <li><a href="#"><img src="../images/facebn_off.gif" alt="" /></a></li>
 <li style="margin:0;"><a href="#"><img src="../images/twibn_off.gif" alt="" /></a></li>
</ul>
</div>

<div id="main">
<h2>お問い合わせフォーム</h2>
      <p>エラーが発生しました</p>
        <p>【エラー内容】<br>
        $_[0] $_[1] $_[2]</p>
 <p>&nbsp;</p>
 <p class="input"><input type="button" value="入力画面に戻る" onclick="history.back();" /></p>
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
  <li><a href="../greeting.html">ごあいさつ</a></li>
  <li><a href="../service.html">サービス概要</a></li>
  <li><a href="../company.html">アクセス</a></li>
  <li><a href="../contact.html">お問い合わせ</a></li>
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


OUT_HTML
exit;
}