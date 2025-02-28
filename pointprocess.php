<?
$con =   mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
$result = mysql_query("select * from member where uid='$id'", $con);
$point = mysql_result($result, 0, "point");

$npoint = $point - $subpoint;
mysql_query("update member set point=$npoint where uid='$id'", $con);

echo ("<meta http-equiv='Refresh' content='0; url=buy.php?subpoint=$subpoint&mode=$mode'>");


?>