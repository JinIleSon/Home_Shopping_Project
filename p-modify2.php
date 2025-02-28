<?

if (!$name){
	echo("
		<script>
		window.alert('상품명이 없습니다. 다시 입력하세요.')
		history.go(-1)
		</script>
	");
	exit;
}

if(!$price1){
	echo("
		<script>
		window.alert('가격이 없습니다. 다시 입력하세요.')
		history.go(-1)
		</script>
	");
	exit;
}

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
	
// 기존 상품 이미지를 그대로 사용하는 경우
if (!$userfile){
	$result = mysql_query("update product set class=$class, name='$name', price1=$price1, price2=$price2, origin='$origin', point=$point where code='$code'", $con);

} else {

     // 기존 상품 이미지 파일을 삭제
	$tmp = mysql_query("select userfile, userfile2, userfile3, userfile4, userfile5 from product where code='$code'", $con);
	$fname = mysql_result($tmp, 0, "userfile");
	$fname2 = mysql_result($tmp, 0, "userfile2");
	$fname3 = mysql_result($tmp, 0, "userfile3");
	$fname4 = mysql_result($tmp, 0, "userfile4");
	$fname5 = mysql_result($tmp, 0, "userfile5");
    $savedir = "./photo";
	unlink("$savedir/$fname");
	$savedir2 = "./photo";
	unlink("$savedir2/$fname2");
	$savedir3 = "./photo";
	unlink("$savedir3/$fname3");
	$savedir4 = "./photo";
	unlink("$savedir4/$fname4");
	$savedir5 = "./photo";
	unlink("$savedir5/$fname5");
	
    // 새로이 첨부한 이미지 파일을 저장	
    $temp = $userfile_name;
	$temp2 = $userfile2_name;
	$temp3 = $userfile3_name;
	$temp4 = $userfile4_name;
	$temp5 = $userfile5_name;
    if (file_exists("$savedir/$temp")) {
         echo (" 
             <script>
             window.alert('동일한 파일 이름이 서버에 존재합니다')
             history.go(-1)
             </script>
         ");
         exit;
    } else {
         copy($userfile, "$savedir/$temp");
         unlink($userfile);
    }
	if (file_exists("$savedir2/$temp2")) {
         echo (" 
             <script>
             window.alert('동일한 파일 이름이 서버에 존재합니다')
             history.go(-1)
             </script>
         ");
         exit;
    } else {
         copy($userfile2, "$savedir2/$temp2");
         unlink($userfile2);
    }
	if (file_exists("$savedir3/$temp3")) {
         echo (" 
             <script>
             window.alert('동일한 파일 이름이 서버에 존재합니다')
             history.go(-1)
             </script>
         ");
         exit;
    } else {
         copy($userfile3, "$savedir3/$temp3");
         unlink($userfile3);
    }
	if (file_exists("$savedir4/$temp4")) {
         echo (" 
             <script>
             window.alert('동일한 파일 이름이 서버에 존재합니다')
             history.go(-1)
             </script>
         ");
         exit;
    } else {
         copy($userfile4, "$savedir4/$temp4");
         unlink($userfile4);
    }
	if (file_exists("$savedir5/$temp5")) {
         echo (" 
             <script>
             window.alert('동일한 파일 이름이 서버에 존재합니다')
             history.go(-1)
             </script>
         ");
         exit;
    } else {
         copy($userfile5, "$savedir5/$temp5");
         unlink($userfile5);
    }
	$result = mysql_query("update product set class=$class, name='$name', price1=$price1, price2=$price2, userfile='$userfile_name', userfile2='$userfile2_name', origin='$origin', point=$point, userfile3='$userfile3_name', userfile4='$userfile4_name', userfile5='$userfile5_name' where code='$code'", $con);
}

if (!$result) {
	echo("
      <script>
      window.alert('상품 수정에 실패했습니다')
      </script>
    ");
    exit;
} else {
	echo("
      <script>
      window.alert('상품 수정이 완료되었습니다')
      </script>
   ");
} 

mysql_close($con);		//데이터베이스 연결해제

echo ("<meta http-equiv='Refresh' content='0; url=p-adminlist.php'>");

?>