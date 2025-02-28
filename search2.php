<center>
<? include('top.html'); ?>

<?
if (!$key) {
    echo("<script>
        window.alert('검색어를 입력하세요');
        history.go(-1);
        </script>");
    exit;
}

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
$result=mysql_query("select * from product where name like '%$key%'",$con);
$total = mysql_num_rows($result);


echo ("<table>
<tr><td height=20></td></tr></table>");
echo("
   <table border=0 width=900>
   <tr><td colspan=2><font size=6><b>검색 결과</td><tr>
   <tr><td><font size=2>검색어 $key , 찾은 개수 $total 개</font></td>
   <td align=right><a href=show.php?board=$board&id=$id&mode=0>
            <i class=\"fas fa-list\" style=\"font-size: 40px;\"></i></a></td></tr>
   </table>


");



if (!$total){
    echo("<tr><td colspan=5 align=center>검색된 글이 없습니다.</td></tr>");
} else {

    echo("
<table border=0 width=900 >
<tr  height=30>
   <td><font style=\"font-size:20pt;\"><b></b></font></td>
   <td></td>
   <td></td>
   <td></td>
   <td></td>
 
</tr>
<tr height=150>
");
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

$i = 0;
while ($i < $total):
	$code=mysql_result($result, $i, "code");
	$name=mysql_result($result, $i, "name");
	$price1=mysql_result($result, $i, "price1");
	$price2=mysql_result($result, $i, "price2");
	$userfile=mysql_result($result, $i, "userfile");
	echo("
		<td width=180><a href=p-show.php?code=$code><img src=\"image/$userfile\" width=150 height=150></a></td>
	
	");
	
	$i++;
endwhile;
echo("
</tr>
<tr>
");
$i = 0;
while ($i < $total):
	$name=mysql_result($result, $i, "name");
	$price1=mysql_result($result, $i, "price1");
	$price2=mysql_result($result, $i, "price2");
	$userfile=mysql_result($result, $i, "userfile");
	echo("
		<td>$name</td>
	
	");
	
	$i++;
endwhile;
echo("
</tr>
<tr>
");
$i=0;
while ($i < $total):
	$name=mysql_result($result, $i, "name");
	$price2=mysql_result($result, $i, "price2");
	$userfile=mysql_result($result, $i, "userfile");
	$point=mysql_result($result, $i, "point");
	echo("
		<td><font size=1pt><b>구매 시 적립포인트</b></font><font color=blue> $point</font> <font size=2pt><b>p</b></font></td>
	
	");
	
	$i++;
endwhile;
echo("
</tr>
<tr>
");
$i = 0;
while ($i < $total):
	$name=mysql_result($result, $i, "name");
	$price1=mysql_result($result, $i, "price1");
	$price2=mysql_result($result, $i, "price2");
	$userfile=mysql_result($result, $i, "userfile");
	echo("
		<td><strike>$price1</strike><font style=\"font-size:10pt;\">원</font></td>
	
	");
	
	$i++;
endwhile;
echo("
</tr>
<tr>
");
$i = 0;
while ($i < $total):
	$name=mysql_result($result, $i, "name");
	$price1=mysql_result($result, $i, "price1");
	$price2=mysql_result($result, $i, "price2");
	$userfile=mysql_result($result, $i, "userfile");
	echo("
		<td><font color=red>⇒ $price2</font><font style=\"font-size:10pt;\">원</font></td>
	
	");
	
	$i++;
endwhile;
}
echo ("<table>
<tr><td height=200></td></tr></table>");
mysql_close($con);

?>


<? include('bottom.html'); ?>