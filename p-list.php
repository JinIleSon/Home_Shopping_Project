<center>

<?						

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
	   
if (!isset($class)) $class=0;

switch($class) {
   case 0:        // 초기화면에 출력할 인기 상품 목록
?>
       <html>
<center>
<head>
<script type="text/javascript"><!--사진슬라이드-->
var img=new Array();
img[0]=new Image(); img[0].src="bg1.png";
img[1]=new Image(); img[1].src="bg3.png";
img[2]=new Image(); img[2].src="bg4.png";

var interval=1500;
var n=0;
var imgs = new Array("bg1.png","bg3.png","bg4.png");
function rotate()
{
if(navigator.appName=="Netscape" && document.getElementById)
{
document.getElementById("slide").src=imgs[n];
}
else document.images.slide.src=imgs[n];
(n==(imgs.length-1))?n=0:n++;
setTimeout("rotate()",interval);
}</script>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript">
	$(function(){
		var duration = 300;

		var $side = $('#sidebar');
		var $sidebt = $side.find('button').on('click', function(){
			$side.toggleClass('open');

			if($side.hasClass('open')) {
				$side.stop(true).animate({left:'0px'}, duration);
				$sidebt.find('span').text('CLOSE');
			}else{
				$side.stop(true).animate({left:'-300px'}, duration);
				$sidebt.find('span').text('OPEN');
			};
		});
	});
</script>

<style type="text/css">
A:link { text-decoration:none; color:black;}
A:visited { text-decoration:none; color:black;}
A:active { text-decoration:none; color:black;}

#sidebar {
		background: #333;
		width: 300px;
		height: 100%;
		top: 0;
		left: -300px;
		position: fixed;
	}
	#sidebar > ul {
		margin:0;
		padding: 0;
		top:50px;
		left:70px;
		position: absolute;
	}
	#sidebar li {
		margin: 0 0 20px;
		list-style: none;
	}
	#sidebar > button {
		background:#333;
		position: absolute;
		top: 150px;
		left: 300px;
		width: 52px;
		height: 52px;
		border: none;
		color: white;
	}

</style>
</head>
<body onload="rotate()">
<?
echo("<style>
	table {border-collapse:collapse;}
</style>");
?>
<div id="wrap">
		<aside id="sidebar">
			<ul>
				<li><img src="bg7.png" width="200" height="200"></li>
				<li><img src="bg5.png" width="200" height="200"></li>
				<li><img src="bg6.png" width="200" height="200"></li>
			</ul>
			<button><span class="btn_t">OPEN</span></button>
		</aside>
</div>
<? include ("top.html"); ?>
<table><tr><td height=1></td></tr></table>
<table width=100%  height=420 border=0 bgcolor=FFE4E1>
<tr><td><center><img src="bg1.png" id= "slide"></td></tr>
</table>
<?
echo("
<table border=0 width=900 >
<tr  height=70>
   <td colspan=4><font style=\"font-size:20pt;\"><b>인기 상품</b></font></td>
</tr>
<tr height=150>
");
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
$result = mysql_query("select * from product order by hit desc", $con);
$total = mysql_num_rows($result);
$i = 0;
while ($i < 5):
	$code=mysql_result($result, $i, "code");
	$name=mysql_result($result, $i, "name");
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
$i=0;
while ($i < 5):
	$name=mysql_result($result, $i, "name");
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
while ($i < 5):
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
$i=0;
while ($i < 5):
	$name=mysql_result($result, $i, "name");
	$price2=mysql_result($result, $i, "price2");
	$userfile=mysql_result($result, $i, "userfile");
	echo("
		<td>$price2 <font size=2pt>원</font></td>
	
	");
	
	$i++;
endwhile;
echo("
</tr>
<tr height=70>
	<td colspan=4><font style=\"font-size:20pt;\"><b>이 달의 파격할인</b></font></td>
</tr>
<tr height=150>
");
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
$result = mysql_query("select * from product order by price2", $con);
$total = mysql_num_rows($result);
$i = 0;
while ($i < 5):
	$code=mysql_result($result, $i, "code");
	$name=mysql_result($result, $i, "name");
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
while ($i < 5):
	$name=mysql_result($result, $i, "name");
	$price2=mysql_result($result, $i, "price2");
	$userfile=mysql_result($result, $i, "userfile");
	echo("
		<td>$name <font color=red>30<font style=\"font-size:10pt;\">%</font></td>
	
	");
	
	$i++;
endwhile;
echo("
</tr>
<tr>
");
$i=0;
while ($i < 5):
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
while ($i < 5):
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
while ($i < 5):
	$name=mysql_result($result, $i, "name");
	$price1=mysql_result($result, $i, "price1");
	$price2=mysql_result($result, $i, "price2");
	$userfile=mysql_result($result, $i, "userfile");
	echo("
		<td><font color=red>⇒ $price2</font><font style=\"font-size:10pt;\">원</font></td>
	
	");
	
	$i++;
endwhile;
echo("
</tr>
<tr height=70>
	<td colspan=4><font style=\"font-size:20pt;\"><b>베이커리/잼/샐러드 부류에서 현재 핫한 상품!</b></font></td>
</tr>
<tr height=150>
");
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
$result = mysql_query("select * from product where code like 'bk%' order by hit desc;", $con);
$total = mysql_num_rows($result);
$i = 0;
while ($i < 5):
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
while ($i < 5):
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
while ($i < 5):
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
while ($i < 5):
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
while ($i < 5):
	$name=mysql_result($result, $i, "name");
	$price1=mysql_result($result, $i, "price1");
	$price2=mysql_result($result, $i, "price2");
	$userfile=mysql_result($result, $i, "userfile");
	echo("
		<td><font color=red>⇒ $price2</font><font style=\"font-size:10pt;\">원</font></td>
	
	");
	
	$i++;
endwhile;
echo("
</tr>
<tr><td height=20></td></tr>
</table>
");
?>
<? include ("bottom.html"); ?>
<?
echo("</center>");
exit;
		break;
		exit;
   case 1:       // 카테고리별 메뉴 화면에 출력할 상품 목록
?>
<? include ("top.html");?>
<?
       $result = mysql_query("select * from product where class=$class order by hit desc", $con);
		echo("<table border=0 width=900><tr><td height=20></td></tr><tr><td><font size=6><b>냉장/냉동/간편식</b></font></td></tr></table>");
		break;
		
	case 2:       // 카테고리별 메뉴 화면에 출력할 상품 목록
?>
<? include ("top.html");?>
<?
       $result = mysql_query("select * from product where class=$class order by hit desc", $con);
	   echo("<table border=0 width=900><tr><td height=20></td></tr><tr><td><font size=6><b>김치/반찬/밀키트</b></font></td></tr></table>");
		break;
	case 3:       // 카테고리별 메뉴 화면에 출력할 상품 목록
?>
<? include ("top.html");?>
<?
       $result = mysql_query("select * from product where class=$class order by hit desc", $con);
	   echo("<table border=0 width=900><tr><td height=20></td></tr><tr><td><font size=6><b>베이커리/잼/샐러드</b></font></td></tr></table>");
		break;
}

$total = mysql_num_rows($result);
	
echo ("<table border=0 width=900><tr>");

if (!$total){
	echo ("<td align=center><font color=red>아직 등록된 상품이 없습니다</td>");
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

$counter = 0;
while ($counter < $total) :
	if ($counter > 0 && ($counter % 5) == 0) echo ("</tr><tr><td colspan=5><hr size=1 color=#808080 width=100%></td></tr><tr>");
	
	$code=mysql_result($result,$counter,"code");
	$name=mysql_result($result,$counter,"name");
	$userfile=mysql_result($result,$counter,"userfile");
	$price1=mysql_result($result, $counter, "price1");
	$price2=mysql_result($result,$counter,"price2");
	$point=mysql_result($result, $counter, "point");
	
	switch(strlen($price2)) {
		  case 6: 
			 $price2 = substr($price2, 0, 3) . "," . substr($price2, 3, 3);
			 break;
		  case 5:
			 $price2 = substr($price2, 0, 2) . "," . substr($price2, 2, 3);
			 break;
		  case 4:
			 $price2 = substr($price2, 0, 1) . "," . substr($price2, 1, 3);
			 break;		   
		}
	
	echo("
		<td width=180><a href=p-show.php?code=$code><img src=\"image/$userfile\" width=150 height=150></a>
		<br>$name
		<br><font size=1pt><b>구매 시 적립포인트</b></font><font color=blue> $point</font> <font size=2pt><b>p</b></font>
		<br><strike>$price1</strike><font style=\"font-size:10pt;\">원</font>
		<br><font color=red>⇒ $price2</font><font style=\"font-size:10pt;\">원</font></td>
	
	");
	
	$counter++;
endwhile;
}

echo ("<table>
<tr><td height=200></td></tr></table>");


echo ("</tr></table>");
   
mysql_close($con);

?>
<? include ("bottom.html"); ?>
</center>