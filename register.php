<?



if (!$uid) {
	echo ("<script>
		window.alert('사용자 ID를 입력하세요');
		history.go(-1);
		</script>");
	exit;
}
if (!$upass1) {
	echo ("<script>
		window.alert('비밀번호를 입력해 주세요');
		history.go(-1);
		</script>");
	exit;
}
if ($upass1 != $upass2) {
	echo ("<script>
		window.alert('비밀번호와 비밀번호 확인이 일치하지 않습니다');
		history.go(-1);
		</script>");
	exit;
}
if (!$uname) {
	echo ("<script>
		window.alert('이름을 입력해 주세요');
		history.go(-1);
		</script>");
	exit;
}	
	
$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("shopmall", $con);
$newpass = hash(md5, "$upass1");
$result = mysql_query("insert into member(uid, upass,uname, mphone, zipcode, addr1, addr2, favorite, age) values ('$uid', '$newpass', '$uname', '$mphone', '$zip', '$addr1', '$addr2', '$favorite', $age)", $con);
	
if ($result) {
    echo ("<script>
		window.alert('Cookery 회원 가입을 축하드립니다.');
		history.go(1);
		</script>
   ");
} else {
    echo ("<script>
		window.alert('회원가입에 실패했습니다. 다시 한 번 시도해 주세요');
		history.go(-1);
		</script>
	");	   
}
	
mysql_close($con);
echo   ("<meta http-equiv='Refresh' content='0; url=index.html'>");


?>