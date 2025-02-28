<?

setcookie("cookie",0, time()+3600,"/");
if (!isset($UserID)) {
	$UserID = 'hello';
}


if (!isset($quantity)) $quantity = 1;

$con =   mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

// 이미 쇼핑백에 담은 물건이면 수량만 보탬 
$result = mysql_query("select * from heart where session='$Session' and pcode='$code'", $con);
$total = mysql_num_rows($result);

if ($total) $oldnum = mysql_result($result, 0, "quantity");

if ($oldnum) {
     $quantity = $oldnum + $quantity;
     mysql_query("update heart set quantity=$quantity where   session='$Session' and pcode='$code'", $con);
} else {
     mysql_query("insert into heart(id, session, pcode, quantity) values ('$UserID','$Session', '$code', $quantity)", $con);
}

mysql_close($con);	//데이터베이스 연결해제

echo ("<meta http-equiv='Refresh' content='0; url=showheart.php?code=$code'>");

?>
