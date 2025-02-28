<center>
<?include ("top.html");?>
<? 
$con =   mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("shopmall",   $con);
	
$result = mysql_query("select * from member where uid='$UserID'", $con);
	
$uname = mysql_result($result, 0, "uname");

$zip = mysql_result($result, 0, "zipcode");
$addr1 = mysql_result($result, 0,  "addr1");
$addr2 = mysql_result($result, 0,  "addr2");
$mphone = mysql_result($result, 0, "mphone");
$favorite = mysql_result($result, 0, "favorite");
$age = mysql_result($result, 0, "age");
echo ("
	<script language='Javascript'>
	function go_zip(){
		window.open('zipcode.php','ZIP','width=470, height=180, scrollbars=yes');
	}
	</script>
	<style>
		table {border-collapse:collapse;}
	</style>
	<form action=register2.php method=post name=comma>
	<table width=900 border=0 cellpadding=0 cellspacing=5>
	<tr><td height=20></td></tr>
	<tr><td height=40><font size=6><b>회원정보 수정</b></td></tr>
	<tr><td height=20></td></tr>
	</table>
	<table border=0 width=670>
	<tr><td>
		<table width=900 border=1 align=center style=\"border-right:none;border-left:none;\">
			<tr style=\"border-right:none;border-left:none;\"><td style=\"border-right:none;border-left:none;\" width=5% align=right bgcolor=FAF0E6></td>
			<td width=15% height=30 bgcolor=FAF0E6 style=\"border-right:none;border-left:none;\"><font size=2>이 름</font></td>
			<td width=80%><input type=text size=10   name=uname value=$uname style=\"height:25;height:25;border-top:none;border-left:none;border-right:none;border-bottom:2px solid #6C788C; width:150; \"></td></tr>
			<td bgcolor=FFE4E1></td><td height=30 bgcolor=FFE4E1><font size=2>아이디</td>
			<td><font   size=2><b>$UserID</b></td></tr>
			<tr><td align=right bgcolor=FAF0E6></td>
			<td height=30 bgcolor=FAF0E6><font size=2>비밀번호</font></td>
			<td><input type=password   maxlength=15  size=20 name=upass1 style=\"height:25;height:25;border-top:none;border-left:none;border-right:none;border-bottom:2px solid #6C788C; width:150; \"></td></tr>
			<tr><td   align=right bgcolor=FFE4E1></td>
			<td height=30 bgcolor=FFE4E1><font size=2>비밀번호확인</font></td>
			<td><input type=password   maxlength=15  size=20 name=upass2 style=\"height:25;height:25;border-top:none;border-left:none;border-right:none;border-bottom:2px solid #6C788C; width:150; \"></td></tr>
			<tr><td align=right bgcolor=FAF0E6></td>
			
			
			<td height=30 bgcolor=FAF0E6><font size=2>휴대전화</font></td>
			<td ><input type=text size=20 name=mphone value=$mphone style=\"height:25;height:25;border-top:none;border-left:none;border-right:none;border-bottom:2px solid #6C788C; width:150; \"></td> </tr>
			<tr><td align=right bgcolor=FFE4E1></td>
		    <td height=30 bgcolor=FFE4E1><font size=2>나이</td>
		    <td><input type=text size=30 name=age value=$age style=\"height:25;height:25;border-top:none;border-left:none;border-right:none;border-bottom:2px solid #6C788C; width:150; \"></td></tr>
			<tr><td align=right bgcolor=FAF0E6></td>
		    <td height=30 bgcolor=FAF0E6><font size=2>좋아하는 음식</td>
		    <td><input type=text size=30 name=favorite value=$favorite style=\"height:25;height:25;border-top:none;border-left:none;border-right:none;border-bottom:2px solid #6C788C; width:150; \"></td></tr>
			<tr><td align=right bgcolor=FFE4E1></td>
		    <td height=30 bgcolor=FFE4E1><font size=2>집주소</td>
		    <td><input type=text size=7   name=zip value=$zip style=\"height:25;height:25;border-top:none;border-left:none;border-right:none;border-bottom:2px solid #6C788C; width:50; \" readonly=readonly> <font size=2><a href='javascript:go_zip()'><input type=button value='우편번호검색' style=\"height:25; border-radius:3px;background-color:FAF0E6;border:1px solid #6C788C;border-radius:4px;\"></a></font><br>
			<input type=text size=50 name=addr1 value='$addr1' readonly=readonly style=\"height:25;height:25;border-top:none;border-left:none;border-right:none;border-bottom:2px solid #6C788C; width:355; \"><br>
			<input type=text size=35 name=addr2 value='$addr2' style=\"height:25;height:25;border-top:none;border-left:none;border-right:none;border-bottom:2px solid #6C788C; width:355; \"> 
			</td></tr>
		</table>
    </td></tr>
	</table>
  
	<table width=900 border=0 cellpadding=0 cellspacing=5>
	<tr height=20><td></td></tr>
	<tr><td height=40 align=center><input type=submit value='수정하기' style=\"width:100px; height:40px; background-color:FAF0E6;border:1px solid #6C788C;border-radius:4px;\"> </td></tr>
	</table>
	</form>
");

?>
<?include ("bottom.html");?>
</center>