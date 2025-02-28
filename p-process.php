<?

if (!$code){
	echo("
		<script>
		window.alert('상품코드명이 없습니다. 다시 입력하세요.')
		history.go(-1)
		</script>
	");
	exit;
}

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

if (!$userfile){
	echo("
		<script>
        window.alert('상품 사진을 선택해 주세요')
        history.go(-1)
        </script>
    ");
    exit;
} else {
    $savedir = "./photo";
    $temp = $userfile_name;
    if (file_exists("$savedir/$temp")) {
         echo (" 
             <script>
             window.alert('동일한 파일 이름이 이미 서버에 존재합니다')
             history.go(-1)
             </script>
         ");
         exit;
    } else {
         copy($userfile, "$savedir/$temp");
         unlink($userfile);
    }
	
	$savedir2 = "./photo";
    $temp2 = $userfile2_name;
    if (file_exists("$savedir2/$temp2")) {
         echo (" 
             <script>
             window.alert('동일한 파일 이름이 이미 서버에 존재합니다')
             history.go(-1)
             </script>
         ");
         exit;
    } else {
         copy($userfile2, "$savedir2/$temp2");
         unlink($userfile2);
    }
	
	$savedir3 = "./photo";
    $temp3 = $userfile3_name;
    if (file_exists("$savedir3/$temp3")) {
         echo (" 
             <script>
             window.alert('동일한 파일 이름이 이미 서버에 존재합니다')
             history.go(-1)
             </script>
         ");
         exit;
    } else {
         copy($userfile3, "$savedir3/$temp3");
         unlink($userfile3);
    }
	
	$savedir4 = "./photo";
    $temp4 = $userfile4_name;
    if (file_exists("$savedir4/$temp4")) {
         echo (" 
             <script>
             window.alert('동일한 파일 이름이 이미 서버에 존재합니다')
             history.go(-1)
             </script>
         ");
         exit;
    } else {
         copy($userfile4, "$savedir4/$temp4");
         unlink($userfile4);
    }
	
	$savedir5 = "./photo";
    $temp5 = $userfile5_name;
    if (file_exists("$savedir5/$temp5")) {
         echo (" 
             <script>
             window.alert('동일한 파일 이름이 이미 서버에 존재합니다')
             history.go(-1)
             </script>
         ");
         exit;
    } else {
         copy($userfile5, "$savedir5/$temp5");
         unlink($userfile5);
    }
}

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

$point = $price2 * 0.01;

$result = mysql_query("insert into product(class, code, name, price1, price2, userfile, userfile2, hit, origin, point, userfile3, userfile4, userfile5) values ($class, '$code', '$name', '$price1', '$price2', '$userfile_name', '$userfile2_name', 0, '$origin', $point, '$userfile3_name', '$userfile4_name', '$userfile5_name')", $con);

mysql_close($con);		

if (!$result) {
   echo("
      <script>
      window.alert('이미 사용중인 상품 코드입니다')
      history.go(-1)
      </script>
   ");
   exit;
} else {
   echo("
      <script>
      window.alert('상품 등록이 완료되었습니다')
      </script>
   ");
}
echo ("<meta http-equiv='Refresh' content='0; url=p-adminlist.php'>");

?>