<center>
<?include ("top.html");?>
<!DOCTYPE html>

  <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>


<?
echo ("
	<link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
	<link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin>
	<link href=\"https://fonts.googleapis.com/css2?family=Hi+Melody&family=Sunflower:wght@300&display=swap\" rel=\"stylesheet\">
	<style type='text/css'>
		table {
			
			font-family: 'Hi Melody', cursive;
			font-family: 'Sunflower', sans-serif;
			font-size:17px;
		}
		h1 {
			font-family: 'Hi Melody', cursive;
			font-family: 'Sunflower', sans-serif;
			
		}
		input {
			font-family: 'Hi Melody', cursive;
			font-family: 'Sunflower', sans-serif;
		}
	</style>
");
 

$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

$result=mysql_query("select * from $board where id=$id",$con);

// 수정하고자 하는 원본 게시물에서 수정 가능한 항목을 추출함
$writer=mysql_result($result,0,"writer");
$topic=mysql_result($result,0,"topic");
$content=mysql_result($result,0,"content");


echo("<center><h1>자주 묻는 질문, 답변</h1></center><center>
	<form method=post action=mprocess5.php?board=$board&id=$id enctype='multipart/form-data'>
	<table width=700 border=0>
	<tr>
	<td width=100 align=center style='vertical-align:top'>이름 </td>
	<td width=600 style='padding-right:5px;padding-bottom:12px;'><input type=text name=writer size=20 value='$writer'></td>
	</tr>
	<tr>
	<tr>
	<td align=center style='vertical-align:top'>제목 </td>
	<td style='padding-right:5px;padding-bottom:12px;'><input type=text name=topic size=60 value='$topic'></td>
	</tr>
	<tr>
	<td align=center></td>
	<td><textarea id=summernote name=content rows=12 cols=60>$content</textarea></td>
	</tr>
	<tr></tr>
	<tr>
	<td align=center style='vertical-align:top'><font size=2>첨부파일 </font></td>
    <td style='padding-right:5px;padding-bottom:12px;'><input type=file name=userfile size=45 maxlength=80></td>
    </tr>
	<tr>
	<td align=center style='vertical-align:top'>암호 </td>
	<td style='padding-right:5px;padding-bottom:12px;'><input type=password name=passwd size=15></td>
	</tr>
	<tr>
	<td align=right colspan=2>
	<input type=submit value=수정완료>
	<input type=reset value=지우기></td>
	</tr>
	</table>
	</form></center>");

mysql_close($con);

?>
   <div id="summernote"></div>
  <script>
	$(function(){
		$('#summernote').summernote({
			height: 400,
			fontNames : [ 'Sunflower', '함초롬바탕', '휴먼편지체', '맑은고딕', '궁서체',  'Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
			fontNamesIgnoreCheck : [ '맑은고딕' ],
			focus: true,
			
			callbacks: {
				onImageUpload: function(files, editor, welEditable) {
		            for (var i = files.length - 1; i >= 0; i--) {
		            	sendFile(files[i], this);
		            }
		        }
			}
			
		});

	})
	
	function sendFile(file, el) {
		var form_data = new FormData();
      	form_data.append('file', file);
      	$.ajax({
        	data: form_data,
        	type: "POST",
        	url: './profileImage.mpf',
        	cache: false,
        	contentType: false,
        	enctype: 'multipart/form-data',
        	processData: false,
        	success: function(img_name) {
          		$(el).summernote('editor.insertImage', img_name);
        	}
      	});
    }

</script>
<?include ("bottom.html");?>
</center>