<?
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

$result = mysql_query("select * from member where uname='$uname' and uid='$uid'   and age=$age and mphone='$mphone'", $con);
$total = mysql_num_rows($result);
$pass=mysql_result($result, 0, "upass");
$uudecode = uudecode($pass);

if (!$total)   {
   echo("
      <script>
      window.alert('입력하신 아이디와 이름과 나이, 전화번호를 동시에 만족하는 사용자 아이디가 없습니다')
      history.go(-1)
      </script>
   ");
   exit;
} else {
	$upass = mysql_result($result, 0, "upass");
   echo("
      <script>
      window.alert('귀하의 비밀번호는 $uudecode 입니다')
      </script>
   ");
}

mysql_close($con);	
echo   ("<meta http-equiv='Refresh' content='0; url=index.html'>");
?>