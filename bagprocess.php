<?
$con =   mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

// 전체 쇼핑백 테이블에서 특정 사용자의 구매 정보만을 읽어낸다
$result = mysql_query("select * from shoppingbag where pcode='$pcode'", $con);
$total = mysql_num_rows($result);

$id = mysql_result($result, 0, "id");
$session = mysql_result($result, 0, "session");
$pcode = mysql_result($result, 0, "pcode");
$quantity = mysql_result($result, 0, "quantity");

mysql_query("delete from shoppingbag where pcode='$pcode'",$con);
mysql_query("insert into heart (id, session, pcode, quantity)   values ('$id', '$session', '$pcode', $quantity) ",$con);

echo ("<meta http-equiv='Refresh' content='0; url=showbag.php'>"); 
?>