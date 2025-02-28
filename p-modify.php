<center>
<? include ("top.html"); ?>
<?

$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

$result = mysql_query("select * from product where code='$code'", $con);

$class=mysql_result($result,0,"class");
$name=mysql_result($result,0,"name");
$price1=mysql_result($result,0,"price1");
$price2=mysql_result($result,0,"price2");

$userfile=mysql_result($result,0,"userfile");
$userfile2=mysql_result($result,0,"userfile2");
$userfile3=mysql_result($result,0,"userfile3");
$userfile4=mysql_result($result,0,"userfile4");
$userfile5=mysql_result($result,0,"userfile5");
$origin=mysql_result($result,0,"origin");
$point=mysql_result($result,0,"point");

echo ("
    <table align=center border=0 width=900>     
	<tr height=50>
	<td colspan=4><font style=\"font-size:20pt;\">신규 판매상품 수정</font></td>
	</tr>
	<form method=post action=p-modify2.php?code=$code enctype='multipart/form-data'>
	<tr height=50><td width=100 align=center><b>코드</b></td>
	<td width=550><b>$code</b></td></tr>
	<tr height=50><td align=center><b>분류</b></td>
	<td><select name=class style='background-color:#6C788C; border:1px solid #6C788C; border-radius:4px; color:white; padding-left:15px;padding-right:15px;padding-top:8px;padding-bottom:8px;'>");

switch($class) {
    case 1:
		echo ("<option value=1 selected>냉장/냉동/간편식</option>
			<option value=2>김치/반찬/밀키트</option>
            <option value=3>베이커리/잼/샐러드</option>");
		break;
	case 2:
		echo ("<option value=1>냉장/냉동/간편식</option>
			<option value=2 selected>김치/반찬/밀키트</option>
            <option value=3>베이커리/잼/샐러드</option>");
		break;
	case 3:
       echo ("<option value=1>냉장/냉동/간편식</option>
			<option value=2>김치/반찬/밀키트</option>
            <option value=3 selected>베이커리/잼/샐러드</option>");
		break;
}

echo ("</select></td></tr>
	<tr height=50><td align=center><b>이름</b></td>
	<td><input type=text name=name size=70 value='$name' style='border-top:none;border-left:none;border-right:none;border-bottom:3px solid black; width:300; height:40; padding-top:15px;'></td></tr>
	<tr height=50><td align=center><b>원산지</b></td><td>
	<input type=text name=origin size=10 value='$origin' style='border-top:none;border-left:none;border-right:none;border-bottom:3px solid black; width:300; height:40; padding-top:15px;'></td></tr>
	<tr height=50><td align=center><b>정상가격</b></td>
	<td><input type=text name=price1 size=15 value=$price1 style='border-top:none;border-left:none;border-right:none;border-bottom:3px solid black; width:300; height:40; padding-top:15px;'><font size=4>&nbsp;<b>원</td></tr>
	<tr height=50><td align=center><b>할인가격</b></td>
	<td><input type=text name=price2 size=15 value=$price2 style='border-top:none;border-left:none;border-right:none;border-bottom:3px solid black; width:300; height:40; padding-top:15px;'><font size=4>&nbsp;<b>원</td></tr>
	<tr height=50><td align=center><b>포인트</b></td>
	<td><input type=text name=point size=15 value=$point style='border-top:none;border-left:none;border-right:none;border-bottom:3px solid black; width:300; height:40; padding-top:15px;'><font size=4>&nbsp;<b>p</td></tr>
	<tr height=50><td align=center><b>상품사진</b></td>
	<td><input type=file size=30 name=userfile style='background-color:#6C788C; border:1px solid #6C788C; color:white; padding-left:15px;padding-right:15px;padding-top:8px;padding-bottom:8px;'><-- $userfile</td></tr>
	<tr height=50><td align=center><b>설명</b></td><td>
	<input type=file size=30 name=userfile2 style='background-color:#6C788C; border:1px solid #6C788C; color:white; padding-left:15px;padding-right:15px;padding-top:8px;padding-bottom:8px;'><-- $userfile2
	<br><input type=file size=30 name=userfile3 style='background-color:#6C788C; border:1px solid #6C788C; color:white; padding-left:15px;padding-right:15px;padding-top:8px;padding-bottom:8px;'><-- $userfile3
	<br><input type=file size=30 name=userfile4 style='background-color:#6C788C; border:1px solid #6C788C; color:white; padding-left:15px;padding-right:15px;padding-top:8px;padding-bottom:8px;'><-- $userfile4
	<br><input type=file size=30 name=userfile5 style='background-color:#6C788C; border:1px solid #6C788C; color:white; padding-left:15px;padding-right:15px;padding-top:8px;padding-bottom:8px;'><-- $userfile5</td></tr>
	<tr height=50><td align=center colspan=2>
	<input type=submit value='수정' style='background-color:#6C788C; border:1px solid #6C788C; border-radius:4px; color:white; padding-left:15px;padding-right:15px;padding-top:8px;padding-bottom:8px;'>
	</tr>
	
	</form>
	</table>");

mysql_close($con);

?>
<? include ("bottom.html"); ?>
</center>
