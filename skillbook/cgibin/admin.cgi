#!/usr/bin/perl
#↑パールパス設定。サーバに合わせて必要であれば変更してください。
########################################################################################################
# スパム禁止用ファイル編集画面
########################################################################################################
#設定ファイル
require './setting.pl';
#スクリプト名
$script ="admin.cgi";


if ($ENV{'REQUEST_METHOD'} eq "POST") { read(STDIN, $buffer, $ENV{'CONTENT_LENGTH'}); }
else { $buffer = $ENV{'QUERY_STRING'}; }

if ($buffer eq "") { &html(); }

@pairs = split(/&/,$buffer);
foreach $pair (@pairs) {
	
	($name,$value) = split(/=/, $pair);
	$name2 = $name;
	$value2 = $value;
	$FORM2{$name} = $value;
	
	$value =~ tr/+/ /;
	$value =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
	$value =~ s/\r//g;
	$value =~ s/\t//g;
	#フォーム変数へ
	$FORM{$name} = $value;
}	

$id = $FORM{'id'};
$com = $FORM{'com'}; 
chomp $com;

#認証
if($adminpass eq $FORM{'password'}){
if($FORM{'id'} ne ""){
	&kanryou();
}
}

if($adminpass eq $FORM{'password'}){
	&main();
}
if($adminpass ne $FORM{'password'}){
	&err1('認証失敗');
}

sub html{

print <<"OUT_HTML";
Content-type: text/html

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=$mcode">
<style type="text/css">
.mozi1 {
	font-size: $size1;
}
.mozi2 {
	font-size: $size2;
}
.mozi3 {
font-size: $size3;
color: $collar4;
}
.mozi4 {
font-size: $size4;
color: $collar6;
}
</style>
</head>
<body background="$backimage" bgcolor="$collar1" text="$collar2" link="$collar3">
<form action="$script" method="post">
<table width="350" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="$collar5">
              <tr>
                <td align="center" valign="middle" class="mozi3" bgcolor="$collar8"><font color="$collar4">管理画面</font></td>
              </tr>
              <tr>
                <td align="center" valign="middle" class="mozi1" bgcolor="$collar8"><input name="password" type="password" size="20"></td>
              </tr>
              <tr>
            <td align="center" valign="middle" class="mozi1" bgcolor="$collar8"><input type="submit" value="ログイン"></td>
          </tr>
  <tr bgcolor="$collar8">
    <td align="right" valign="middle"  class="mozi2"><a href="http://www.kurohama.net/" target="_blank">Kurohama</a></td>
  </tr>
  </table>
</form>
</body>
</html>

OUT_HTML
exit;
}

sub main{

#連続利用禁止記録ファイル。
open(RENZOKU, "<$ngrenzoku") or &err1('エラー8');
flock(RENZOKU, 2);
@RENZOKU = <RENZOKU>;
flock(RENZOKU, 8);
close(RENZOKU);

#禁止IPリストの名称。
open(IPFILE, "<$ngip") or &err1('エラー');
flock(IPFILE, 2);
@NGIP = <IPFILE>;
flock(IPFILE, 8);
close(IPFILE);

#禁止サーバリスト完全一致。
open(HOSTFILE, "<$nghost") or &err1('エラー');
flock(HOSTFILE, 2);
@NGHOST = <HOSTFILE>;
flock(HOSTFILE, 8);
close(HOSTFILE);

#禁止サーバリスト部分一致。
open(HOSTFILE2, "<$nghost2") or &err1('エラー');
flock(HOSTFILE2, 2);
@NGHOST2 = <HOSTFILE2>;
flock(HOSTFILE2, 8);
close(HOSTFILE2);

#禁止ブラウザの名称。
open(BROWSERFILE, "<$ngbrowser") or &err1('エラー');
flock(BROWSERFILE, 2);
@NGBROWSER = <BROWSERFILE>;
flock(BROWSERFILE, 8);
close(BROWSERFILE);

#禁止メールアドレスの名称。
open(NGMAIL, "<$ngmail") or &err1('エラー');
flock(NGMAIL, 2);
@NGMAIL = <NGMAIL>;
flock(NGMAIL, 8);
close(NGMAIL);

#NGワード
open(NGWORD, "<$ngword") or &err1('エラー');
flock(NGWORD, 2);
@NGWORD = <NGWORD>;
flock(NGWORD, 8);
close(NGWORD);

#日時記録ファイル。
open(NGTIME, "<$ngtime");
flock(NGTIME, 2);
@NGTIMENOW = <NGTIME>;
flock(NGTIME, 8);
close (NGTIME);

print <<"OUT_HTML";
Content-type: text/html

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=$mcode">
<style type="text/css">
.mozi1 {
	font-size: $size1;
}
.mozi2 {
	font-size: $size2;
}
.mozi3 {
font-size: $size3;
color: $collar4;
}
.mozi4 {
font-size: $size4;
color: $collar6;
}
</style>
</head>
<body background="$backimage" bgcolor="$collar1" text="$collar2" link="$collar3">

<div class="mozi3" align="center"><font color="$collar4">スパム対策</font></div>
<hr align="center" width="520" size="1">

<form action="$script" method="post">
<table width="550" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="$collar5">
  <tr class="mozi1">
      <td width="538" align="left" valign="top" bgcolor="$collar7">■連続利用禁止記録ファイル</td>
  </tr>
  <tr class="mozi1">
      <td width="538" align="center" valign="middle" bgcolor="$collar8">
	  <textarea name="com" cols="70" rows="6" wrap="off">
OUT_HTML
foreach $RENZOKU (@RENZOKU){
print "$RENZOKU";
}
print <<"OUT_HTML";
</textarea>
	  </td>
  </tr>
<tr class="mozi1">
      <td width="538" align="right" valign="middle" bgcolor="$collar8">
      <input type="submit" value="更新">
<input type="hidden" name="id" value="1">
<input type="hidden" name="password" value="$FORM{'password'}">	
</td>
  </tr>
</table>
</form>
<hr align="center" width="520" size="1">

<form action="$script" method="post"> 
<table width="550" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="$collar5">
  <tr class="mozi1">
      <td width="538" align="left" valign="top" bgcolor="$collar7">■禁止IPリスト</td>
  </tr>
  <tr class="mozi1">
      <td width="538" align="center" valign="middle" bgcolor="$collar8">
	  <textarea name="com" cols="70" rows="6" wrap="off">
OUT_HTML
foreach $NGIP (@NGIP){
print "$NGIP";
}
print <<"OUT_HTML";
</textarea>
	  </td>
  </tr>
<tr class="mozi1">
      <td width="538" align="right" valign="middle" bgcolor="$collar8">
      <input type="submit" value="更新">
<input type="hidden" name="id" value="2">
<input type="hidden" name="password" value="$FORM{'password'}">	
</td>
  </tr>
</table>
</form>
<hr align="center" width="520" size="1">

<form action="$script" method="post"> 
<table width="550" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="$collar5">
  <tr class="mozi1">
      <td width="538" align="left" valign="top" bgcolor="$collar7">■禁止サーバリスト完全一致</td>
  </tr>
  <tr class="mozi1">
      <td width="538" align="center" valign="middle" bgcolor="$collar8">
	  <textarea name="com" cols="70" rows="6" wrap="off">
OUT_HTML
foreach $NGHOST (@NGHOST){
print "$NGHOST";
}
print <<"OUT_HTML";
</textarea>
	  </td>
  </tr>
<tr class="mozi1">
      <td width="538" align="right" valign="middle" bgcolor="$collar8">
      <input type="submit" value="更新">
<input type="hidden" name="id" value="3">
<input type="hidden" name="password" value="$FORM{'password'}">	
</td>
  </tr>
</table>
</form>
<hr align="center" width="520" size="1">

<form action="$script" method="post"> 
<table width="550" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="$collar5">
  <tr class="mozi1">
      <td width="538" align="left" valign="top" bgcolor="$collar7">■禁止サーバリスト部分一致</td>
  </tr>
  <tr class="mozi1">
      <td width="538" align="center" valign="middle" bgcolor="$collar8">
	  <textarea name="com" cols="70" rows="6" wrap="off">
OUT_HTML
foreach $NGHOST2 (@NGHOST2){
print "$NGHOST2";
}
print <<"OUT_HTML";
</textarea>
	  </td>
  </tr>
<tr class="mozi1">
      <td width="538" align="right" valign="middle" bgcolor="$collar8">
      <input type="submit" value="更新">
<input type="hidden" name="id" value="4">
<input type="hidden" name="password" value="$FORM{'password'}">	
</td>
  </tr>
</table>
</form>
<hr align="center" width="520" size="1">

<form action="$script" method="post"> 
<table width="550" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="$collar5">
  <tr class="mozi1">
      <td width="538" align="left" valign="top" bgcolor="$collar7">■禁止ブラウザ</td>
  </tr>
  <tr class="mozi1">
      <td width="538" align="center" valign="middle" bgcolor="$collar8">
	  <textarea name="com" cols="70" rows="6" wrap="off">
OUT_HTML
foreach $NGBROWSER (@NGBROWSER){
print "$NGBROWSER";
}
print <<"OUT_HTML";
</textarea>
	  </td>
  </tr>
<tr class="mozi1">
      <td width="538" align="right" valign="middle" bgcolor="$collar8">
      <input type="submit" value="更新">
<input type="hidden" name="id" value="5">
<input type="hidden" name="password" value="$FORM{'password'}">	
</td>
  </tr>
</table>
</form>
<hr align="center" width="520" size="1">

<form action="$script" method="post"> 
<table width="550" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="$collar5">
  <tr class="mozi1">
      <td width="538" align="left" valign="top" bgcolor="$collar7">■禁止メールアドレス</td>
  </tr>
  <tr class="mozi1">
      <td width="538" align="center" valign="middle" bgcolor="$collar8">
	  <textarea name="com" cols="70" rows="6" wrap="off">
OUT_HTML
foreach $NGMAIL (@NGMAIL){
print "$NGMAIL";
}
print <<"OUT_HTML";
</textarea>
	  </td>
  </tr>
<tr class="mozi1">
      <td width="538" align="right" valign="middle" bgcolor="$collar8">
      <input type="submit" value="更新">
<input type="hidden" name="id" value="8">
<input type="hidden" name="password" value="$FORM{'password'}">	
</td>
  </tr>
</table>
</form>
<hr align="center" width="520" size="1">

<form action="$script" method="post"> 
<table width="550" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="$collar5">
  <tr class="mozi1">
      <td width="538" align="left" valign="top" bgcolor="$collar7">■NGワード</td>
  </tr>
  <tr class="mozi1">
      <td width="538" align="center" valign="middle" bgcolor="$collar8">
	  <textarea name="com" cols="70" rows="6" wrap="off">
OUT_HTML
foreach $NGWORD (@NGWORD){
print "$NGWORD";
}
print <<"OUT_HTML";
</textarea>
	  </td>
  </tr>
<tr class="mozi1">
      <td width="538" align="right" valign="middle" bgcolor="$collar8">
      <input type="submit" value="更新">
<input type="hidden" name="id" value="14">
<input type="hidden" name="password" value="$FORM{'password'}">	
</td>
  </tr>
</table>
</form>
<hr align="center" width="520" size="1">

<form action="$script" method="post"> 
<table width="550" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="$collar5">
  <tr class="mozi1">
      <td width="538" align="left" valign="top" bgcolor="$collar7">■日時記録ファイル</td>
  </tr>
  <tr class="mozi1">
      <td width="538" align="center" valign="middle" bgcolor="$collar8">
	  <textarea name="com" cols="70" rows="6" wrap="off">
OUT_HTML
foreach $NGTIMENOW (@NGTIMENOW){
print "$NGTIMENOW";
}
print <<"OUT_HTML";
</textarea>
	  </td>
  </tr>
<tr class="mozi1">
      <td width="538" align="right" valign="middle" bgcolor="$collar8">
      <input type="submit" value="更新">
<input type="hidden" name="id" value="13">
<input type="hidden" name="password" value="$FORM{'password'}">	
</td>
  </tr>
</table>
</form>
<hr align="center" width="520" size="1">


    </body>
</html>

OUT_HTML
exit;
}

sub kanryou{

#連続利用禁止記録ファイル。
if($FORM{'id'} eq "1"){
open(RENZOKU, "+<$ngrenzoku");
flock(RENZOKU, 2);
seek (RENZOKU, 0, 0);
print RENZOKU "$com";
truncate(RENZOKU, tell(RENZOKU));
flock(RENZOKU, 8);
close(RENZOKU);
}

#禁止IPリストの名称。
if($FORM{'id'} eq "2"){
open(IPFILE, "+<$ngip");
flock(IPFILE, 2);
seek (IPFILE, 0, 0);
print IPFILE "$com";
truncate(IPFILE, tell(IPFILE));
flock(IPFILE, 8);
close(IPFILE);
}

#禁止サーバリスト完全一致。
if($FORM{'id'} eq "3"){
open(HOSTFILE, "+<$nghost");
flock(HOSTFILE, 2);
seek (HOSTFILE, 0, 0);
print HOSTFILE "$com";
truncate(HOSTFILE, tell(HOSTFILE));
flock(HOSTFILE, 8);
close(HOSTFILE);
}

#禁止サーバリスト部分一致。
if($FORM{'id'} eq "4"){
open(HOSTFILE2, "+<$nghost2");
flock(HOSTFILE2, 2);
seek (HOSTFILE2, 0, 0);
print HOSTFILE2 "$com";
truncate(HOSTFILE2, tell(HOSTFILE2));
flock(HOSTFILE2, 8);
close(HOSTFILE2);
}

#禁止ブラウザの名称。
if($FORM{'id'} eq "5"){
open(BROWSERFILE, "+<$ngbrowser");
flock(BROWSERFILE, 2);
seek (BROWSERFILE, 0, 0);
print BROWSERFILE "$com";
truncate(BROWSERFILE, tell(BROWSERFILE));
flock(BROWSERFILE, 8);
close(BROWSERFILE);
}

#禁止メールアドレスの名称。
if($FORM{'id'} eq "8"){
open(NGMAIL, "+<$ngmail");
flock(NGMAIL, 2);
seek (NGMAIL, 0, 0);
print NGMAIL "$com";
truncate(NGMAIL, tell(NGMAIL));
flock(NGMAIL, 8);
close(NGMAIL);
}

#日時記録ファイル。
if($FORM{'id'} eq "13"){
open(NGTIME, "+<$ngtime");
flock(NGTIME, 2);
seek (NGTIME, 0, 0);
print NGTIME "$com";
truncate(NGTIME, tell(NGTIME));
flock(NGTIME, 8);
close(NGTIME);
}

#NGワード
if($FORM{'id'} eq "14"){
open(NGWORD, "+<$ngword");
flock(NGWORD, 2);
seek (NGWORD, 0, 0);
print NGWORD "$com";
truncate(NGWORD, tell(NGWORD));
flock(NGWORD, 8);
close(NGWORD);
}

print <<"OUT_HTML";
Content-type: text/html


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>完了</title>
<meta http-equiv="Content-Type" content="text/html; charset=$mcode">
<style type="text/css">
.mozi1 {
	font-size: $size1;
}
.mozi2 {
	font-size: $size2;
}
.mozi3 {
font-size: $size3;
color: $collar4;
}
.mozi4 {
font-size: $size4;
color: $collar6;
}
</style>
</head>
<body background="$backimage" bgcolor="$collar1" text="$collar2" link="$collar3">
<form action="$script" method="post">
<table width="350" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="$collar5">
              <tr>
                <td align="center" valign="middle" class="mozi3" bgcolor="$collar8"><font color="$collar4">完了</font></td>
              </tr>
              <tr>
                <td align="left" valign="middle" class="mozi1" bgcolor="$collar8">ファイルを編集しました</td>
              </tr>
              <tr>
            <td align="center" valign="middle" class="mozi1" bgcolor="$collar8">
			<input type="submit" value="編集画面に戻る">
			<input type="hidden" name="password" value="$FORM{'password'}">
</td>
</tr>
  </table>
</form>
</body>
</html>

OUT_HTML
exit;
}

sub err1{

print <<"OUT_HTML";
Content-type: text/html

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>エラー</title>
<meta http-equiv="Content-Type" content="text/html; charset=$mcode">
<style type="text/css">
.mozi1 {
	font-size: $size1;
}
.mozi2 {
	font-size: $size2;
}
.mozi3 {
font-size: $size3;
color: $collar4;
}
.mozi4 {
font-size: $size4;
color: $collar6;
}
</style>
</head>
<body background="$backimage" bgcolor="$collar1" text="$collar2" link="$collar3">
<table width="350" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="$collar5">
              <tr>
                <td align="center" valign="middle" class="mozi3" bgcolor="$collar8"><font color="$collar4">ERROR</font></td>
              </tr>
              <tr>
                <td align="left" valign="middle" class="mozi1" bgcolor="$collar8">$_[0]</td>
              </tr>
              <tr>
            <td align="center" valign="middle" class="mozi1" bgcolor="$collar8"><INPUT name="button" type="button" onclick='history.back()' value="前の画面に戻る"></td>
          </tr>
  </table>
</body>
</html>

OUT_HTML
exit;
}
