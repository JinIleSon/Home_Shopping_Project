<center>
<? include ("top.html"); ?>
<?
echo("<style>
	table {border-collapse:collapse;}
</style>");
?>

<table border=0 width=900>
<tr height=600>
	<td width=900 valign=top>
<table border=0 width=650 >
<form method=post action=p-process.php enctype='multipart/form-data'>
<tr height=50>
	<td colspan=4><font style="font-size:20pt;">신규 판매상품 등록</font></td>
</tr>
<tr height=50>
<td width=100 align=center><b>분류</b></td>
<td width=550>
	<select name=class style='background-color:#6C788C; border:1px solid #6C788C; border-radius:4px; color:white; padding-left:15px;padding-right:15px;padding-top:8px;padding-bottom:8px;'>
	<option value=1>냉장/냉동/간편식</option>
	<option value=2>김치/반찬/밀키트</option>
	<option value=3>베이커리/잼/샐러드</option>
	</select>
</td>
<td ></td>
</tr>
<tr height=50>
<td align=center><b>코드</b></td>
<td><input type=text name=code size=20 style='border-top:none;border-left:none;border-right:none;border-bottom:3px solid black; width:300; height:40;'></td><td></td>

</tr>
<tr height=50>
<td align=center><b>이름</b></td>
<td><input type=text name=name size=70 style='border-top:none;border-left:none;border-right:none;border-bottom:3px solid black; width:300; height:40;'></td>
</tr>
<tr height=50>
<td align=center><b>원산지</b></td>
<td><input type=text name=origin size=20 style='border-top:none;border-left:none;border-right:none;border-bottom:3px solid black; width:300; height:40;'></td>
</tr>
<tr height=50>
<td align=center><b>정상가격</b></td>
<td><table border=0><tr><td>
<input type=text name=price1 size=15 style='border-top:none;border-left:none;border-right:none;border-bottom:3px solid black; width:300; height:40;'></td><td valign=bottom><font size=4>&nbsp;<b>원
</td></tr></table>
</td>
</tr>
<tr height=50>
<td align=center><b>할인가격</b></td>
<td><table border=0><tr><td>
<input type=text name=price2 size=15 style='border-top:none;border-left:none;border-right:none;border-bottom:3px solid black; width:300; height:40;'></td><td valign=bottom><font size=4>&nbsp;<b>원
</td></tr></table>
</td>
</tr>
<tr height=50>
<td align=center><b>상품사진</b></td>
<td>
<input type=file name=userfile style='background-color:#6C788C; border:1px solid #6C788C; color:white; padding-left:15px;padding-right:15px;padding-top:8px;padding-bottom:8px;'>
</td>
</tr>
<tr height=50>
<td align=center><b>설명</b></td>
<td>
<input type=file name=userfile2 style='background-color:#6C788C; border:1px solid #6C788C; color:white; padding-left:15px;padding-right:15px;padding-top:8px;padding-bottom:8px;'><br>
<input type=file name=userfile3 style='background-color:#6C788C; border:1px solid #6C788C; color:white; padding-left:15px;padding-right:15px;padding-top:8px;padding-bottom:8px;'><br>
<input type=file name=userfile4 style='background-color:#6C788C; border:1px solid #6C788C; color:white; padding-left:15px;padding-right:15px;padding-top:8px;padding-bottom:8px;'><br>
<input type=file name=userfile5 style='background-color:#6C788C; border:1px solid #6C788C; color:white; padding-left:15px;padding-right:15px;padding-top:8px;padding-bottom:8px;'>
</td>
</tr>
<tr><td height=20></td></tr>
<tr height=10>
<td align=center colspan=10>
<input type=submit value='등록' style='background-color:#6C788C; border:1px solid #6C788C; border-radius:4px; color:white; padding-left:15px;padding-right:15px;padding-top:8px;padding-bottom:8px;'>
</td>
</tr>
</form>
<tr><td height=20></td></tr>
</table>
</td></tr>
</table>

<? include ("bottom.html"); ?>
</center>