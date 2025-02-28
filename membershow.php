<center>
<?include ("top.html");?>
<?

if ($UserID != 'admin') {
	echo ("<script>
		window.alert('관리자만 접근 가능한 기능입니다')
		history.go(-1)
		</script>");
    exit;
} 

echo("<style>
	table {border-collapse:collapse;}

</style>");

$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("shopmall",   $con);
	
$result = mysql_query("select * from member order by uname", $con);
$total = mysql_num_rows($result);

echo ("
<table>
<tr><td height=20></td></tr>
</table>
	<table border=0 width=900>
    <tr><td><font size=6><b>회원 목록</b></td></tr>
	<tr><td align=right>
	<form method=post action=admin.php>
	<input type=submit value='돌아가기' style='background-color:#6C788C; border:1px solid #6C788C; border-radius:20%; color:white; padding-left:15px;padding-right:15px;padding-top:4px;padding-bottom:4px;'></form>
	</td>
	</tr></table> ");
	   
$i = 0;	

echo ("
	<table border=1 width=900 style='border-left:none; border-right:none;'>
	<tr  bgcolor=#6C788C style='padding:10px;border-left:none; border-right:none;'>
	<td align=center width=60 bgcolor=#6C788C style='padding:10px;border-left:none; border-right:none;'><font size=2 color=white><b>ID</b></td>
	<td align=center width=50 style='border-left:none; border-right:none;'><font size=2 color=white><b>이름</b></td>
	<td align=center width=340 style='border-left:none; border-right:none;'><font size=2 color=white><b>주소</b></td>
	<td align=center width=100 style='border-left:none; border-right:none;'><font size=2 color=white><b>전화번호</b></td>
	<td align=center width=70 style='border-left:none; border-right:none;' ><font size=2 color=white><b>포인트</b></td>
	<td align=center width=100 style='border-left:none; border-right:none;'><font size=2 color=white><b>나이</b></td>
	<td align=center width=120 style='border-left:none; border-right:none;'><font size=2 color=white><b>좋아하는 음식</b></td>
	</tr>
");	

while($i < $total):
	$uid = mysql_result($result, $i, "UID");
	$uname = mysql_result($result, $i, "UNAME");
	$zip = mysql_result($result, $i, "ZIPCODE");
	$addr1 = mysql_result($result, $i, "ADDR1");
	$addr2 = mysql_result($result, $i, "ADDR2");
	$mphone = mysql_result($result, $i, "MPHONE");
	$favorite = mysql_result($result, $i, "favorite");
	$age = mysql_result($result, $i, "age");
	$point = mysql_result($result, $i, "point");
	$address = "(" . $zip .   ")" . "&nbsp;" . $addr1 . "&nbsp;" .   $addr2;
	
    echo ("<tr height=50 style='border-left:none; border-right:none;' onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\">
		<td align=center style='border-left:none; border-right:none;'><font size=2>$uid</td>
		<td align=center style='border-left:none; border-right:none;'><font size=2>$uname</td>
		<td style='border-left:none; border-right:none;'><font size=2>$address</td>
		<td style='border-left:none; border-right:none;' align=center><font size=2>$mphone</td>
		");
		if (!$point) {
			echo("<td  style='border-left:none; border-right:none;' align=center><font size=2 color=blue>$point</font> <font size=2><b></td>
			");
		} else {
			echo("<td  style='border-left:none; border-right:none;' align=center><font size=2 color=blue>$point</font> <font size=2><b>p</td>
			");
		}
		echo("
		
		<td style='border-left:none; border-right:none;' align=center><font size=2>$age</td>
		<td style='border-left:none; border-right:none;' align=center><font size=2>$favorite</td>");
		
	
	      
	$i++;
endwhile;

echo ("</tr>
</table>
<table>
<tr><td height=200></td></tr>
</table>

");
mysql_close($con);

?>
<?include ("bottom.html");?>
</center>