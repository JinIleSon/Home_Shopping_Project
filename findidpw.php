<?
echo("<center>");
include ("top.html"); 
echo("
	<table borer=1 width=900 align=center>
	<tr height=50><td></td></tr>
	</table>
	
	<table width=900 align=center border=1 style='border-right-style:none; border-top-style:none; border-collapse:collapse;'>
	<tr height=50><td width=210 onmouseover=\"this.style.backgroundColor='#FFE4E1'\" onmouseout=\"this.style.backgroundColor='white'\"><a href=#findid><center>아이디 찾기</a></td>
		<td width=210 onmouseover=\"this.style.backgroundColor='#FFE4E1'\" onmouseout=\"this.style.backgroundColor='white'\"><a href=#findpw><center>비밀번호 찾기</a></td>
		<td style='border-right-style:none; border-top-style:none; border-left-style:none;'></td>
	</tr>
	</table>
	
	<table borer=1 width=900 align=center>
	<tr height=100><td></td></tr>
	</table>

	<table border=1 width=900 align=center style='border-collapse:collapse;' id=findid><tr><td>
	<table border=0 width=900 align=center>
	<tr><td height=15></td></tr>
	<tr><td><center><font size=3><b>아이디 찾기</b></center></td</tr>
	<tr><td height=10></td></tr>
	</table>
	
	<table align=center border=0 width=900>
	<form method=post action=findid.php onsubmit=\"if(!this.uname.value ||   !this.email.value) return false;\">
	<tr><td align=right width=400><font size=2>이름&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align=left><input type=text size=20 name=uname style=\"height:25;height:25;border-top:none;border-left:none;border-right:none;border-bottom:2px solid #6C788C; width:165;\"></td></tr>
	
	<tr><td height=10></td></tr>	
	
	<tr><td align=right><font size=2>나이&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align=left><input type=text size=40 name=age style=\"height:25;height:25;border-top:none;border-left:none;border-right:none;border-bottom:2px solid #6C788C; width:165;\"></td></tr>
	
	<tr><td height=10></td></tr>
	
	<tr><td align=right><font size=2>전화번호&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align=left><input type=text size=40 name=mphone style=\"height:25;height:25;border-top:none;border-left:none;border-right:none;border-bottom:2px solid #6C788C; width:200;\"></td></tr>
	
	<tr><td height=10></td></tr>
	
	<tr><td align=center colspan=2><input type=submit value='아이디 확인' style=\"width:100px; height:40px; background-color:FFE4E1;border:1px solid #6C788C;border-radius:4px;\"></tr>
	<tr><td height=15></td></tr>
	</form>
	</table>
	</td></tr></table>

	<table borer=1 width=900 align=center>
	<tr height=100><td></td></tr>
	</table>

	<table border=1 width=900 align=center style='border-collapse:collapse;' id=findpw><tr><td>
	<table border=0 width=900 align=center>
	<tr><td height=15></td></tr>
	<tr><td><center><font size=3><b>비밀번호 찾기</b></center></td</tr>
	<tr><td height=10></td></tr>
	</table>
	
	<table align=center border=0 width=900>
	<form method=post action=findpw.php onsubmit=\"if(!this.uid.value ||   !this.uname.value || !this.email.value) return false;\">
	<tr><td align=right><font size=2>아이디&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align=left><input type=text size=20 name=uid style=\"height:25;height:25;border-top:none;border-left:none;border-right:none;border-bottom:2px solid #6C788C; width:165;\"></td></tr>
	
	<tr><td height=10></td></tr>
	
	<tr><td align=right width=400><font size=2>이름&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align=left><input type=text size=20 name=uname style=\"height:25;height:25;border-top:none;border-left:none;border-right:none;border-bottom:2px solid #6C788C; width:165;\"></td></tr>
		
	<tr><td height=10></td></tr>
	
	<tr><td align=right><font size=2>나이&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align=left><input type=text size=40 name=age style=\"height:25;height:25;border-top:none;border-left:none;border-right:none;border-bottom:2px solid #6C788C; width:165;\"></td></tr>
	
	<tr><td height=10></td></tr>
	
	<tr><td align=right><font size=2>전화번호&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align=left><input type=text size=40 name=mphone style=\"height:25;height:25;border-top:none;border-left:none;border-right:none;border-bottom:2px solid #6C788C; width:200;\"></td></tr>
	
	<tr><td height=10></td></tr>
	
	<tr><td align=center colspan=2><input type=submit value='비밀번호 확인' style=\"width:100px; height:40px; background-color:FFE4E1;border:1px solid #6C788C;border-radius:4px;\"></tr>
	<tr><td height=15></td></tr>
	</form>
	</table>
	</td></tr></table>
	
	<table borer=1 width=900 align=center>
	<tr height=200><td></td></tr>
	</table>

");
include ("bottom.html");
echo("</center>");
?>