<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>3D列印討論區</title>
<script src='ckeditor/ckeditor.js'></script>
</head>
<body>
<div>
<form method="post" action="article_new_finish.php">
	<select name="Typeid" width="80" tabindex="1">
		<option value="0">選擇主題分類</option>
		<option value="1">教學</option>
		<option value="2">分享</option>
		<option value="3">討論</option>
		<option value="4">問題</option>
		<option value="5">其他</option>
		<option value="6">公告</option>
	</select>
	<input type="text" name="Subject" style="width: 25em" tabindex="2" /<br>
	<textarea class='ckeditor'  rows='15'  name='Content' tabindex="3"></textarea>
	<input type='submit' value='發表文章'>
</form>
</div>
</body>
</html>
