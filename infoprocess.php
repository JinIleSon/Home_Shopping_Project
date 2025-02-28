<?
$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
$result = mysql_query("select * from member where uid='$id'",$con);


if ($check == 1) {
	$xid = $id;
} else if(!$check) {
	$xid = 0;
}


echo ("<meta http-equiv='Refresh' content='0; url=buy.php?subpoint=$subpoint&mode=$mode&xid=\"$xid\"'>");
mysql_close($con);
?>