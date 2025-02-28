<?

function check($message) {
	echo ("
		<script>
		window.alert(\"$message\");
		history.go(-1);
		</script>
	");
	exit;
}


if (!$wmemo) check("내용을 입력하세요");

$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("shopmall", $con);

$wdate =   date("Y-m-d-H:i:s");


mysql_query("insert into boardreply(name, wdate, content, passwd, code, star) values ('$UserID', '$wdate', '$wmemo', '$passwd', '$code', $star)", $con);

mysql_close($con);

echo ("<meta http-equiv='Refresh' content='0; url=p-show.php?code=$code'>");

?>