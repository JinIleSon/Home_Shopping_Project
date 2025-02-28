<?

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

// 상품 이미지 파일을 photo 폴더 내에서 삭제
$tmp = mysql_query("select userfile, userfile2, userfile3, userfile4, userfile5 from product where code='$code'", $con);
$fname = mysql_result($tmp, 0, "userfile");
$fname2 = mysql_result($tmp, 0, "userfile2");
$fname3 = mysql_result($tmp, 0, "userfile3");
$fname4 = mysql_result($tmp, 0, "userfile4");
$fname5 = mysql_result($tmp, 0, "userfile5");
$savedir = "./photo";
unlink("$savedir/$fname");
unlink("$savedir/$fname2");
unlink("$savedir/$fname3");
unlink("$savedir/$fname4");
unlink("$savedir/$fname5");

$result = mysql_query("delete from product where code='$code'", $con);

if (!$result) {
   echo("
      <script>
      window.alert('상품 삭제에 실패했습니다')
      history.go(-1)
      </script>
   ");
   exit;
} else {
   echo("
      <script>
      window.alert('상품이 정상적으로 삭제되었습니다')
      </script>
   ");
}

mysql_close($con);

echo ("<meta http-equiv='Refresh' content='0; url=p-adminlist.php'>");

?>