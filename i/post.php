<!DOCTYPE html>
<html>
<head lang='zh_CN'>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Message</title>
<style type="text/css">
	.basic-grey {
		margin-left:auto;
		margin-right:auto;
		max-width: 700px;
		background: #F7F7F7;
		padding: 50px 30px 40px 25px;
		font: 12px Georgia, "Times New Roman", Times, serif;
		color: #888;
		text-shadow: 1px 1px 1px #FFF;
	border:1px solid #E4E4E4;
	}
	.basic-grey h1 {
		font-size: 30px;
		padding: 0px 0px 10px 40px;
		display: block;
		border-bottom:1px solid #E4E4E4;
		margin: -10px -15px 30px -10px;;
		color: #888;
	}
	.basic-grey h1>span {
		display: block;
		font-size: 11px;
	}
	.basic-grey label {
		display: block;
		margin: 0px;
	}
	.basic-grey label>span {
		float: left;
		width: 20%;
		text-align: right;
		padding-right: 10px;
		margin-top: 10px;
		color: #888;
	}
	.basic-grey input[type="text"], .basic-grey input[type="email"], .basic-grey textarea, .basic-grey select {
		border: 1px solid #DADADA;
		color: #888;
		height: 30px;
		margin-bottom: 16px;
		margin-right: 6px;
		margin-top: 2px;
		outline: 0 none;
		padding: 3px 3px 3px 5px;
		width: 70%;
		font-size: 12px;
		line-height:15px;
		box-shadow: inset 0px 1px 4px #ECECEC;
		-moz-box-shadow: inset 0px 1px 4px #ECECEC;
		-webkit-box-shadow: inset 0px 1px 4px #ECECEC;
	}
	.basic-grey textarea{
		padding: 5px 3px 3px 5px;
	}
	.basic-grey select {
		background: #FFF url('down-arrow.png') no-repeat right;
		background: #FFF url('down-arrow.png') no-repeat right;
		appearance:none;
		-webkit-appearance:none;
		-moz-appearance: none;
		text-indent: 0.01px;
		text-overflow: '';
		width: 70%;
		height: 35px;
		line-height: 25px;
	}
	.basic-grey textarea{
		font-size: 15px;
		font-family: sans-serif;
		height:100px;
	}
	.basic-grey .button {
		background: #E27575;
		border: none;
		padding: 10px 25px 10px 25px;
		color: #FFF;
		box-shadow: 1px 1px 5px #B6B6B6;
		border-radius: 3px;
		text-shadow: 1px 1px 1px #9E3F3F;
		cursor: pointer;
	}
	.basic-grey .button:hover {
		background: #CF7A7A
	}
</style>
</head>
<body>

<?php

    require 'db.php';

    if(!empty($_POST)){
        $message=explode("\r\n",$_POST['message']); //textarea转换成数组
        $message = json_encode($message); //数组转换成json数据
        $db = new dbsql;
		$db->save($message);  //存储
		?>
		<script>
			alert("提交成功");
			window.location.href="index.php";
		</script>
	<?php
	
    }else{
        ?>
        <form action="post.php" method="post" class="basic-grey">
		<h3>提交的文本</h3>
		<br>
		<textarea autofocus id="message" name="message" style="margin: 2px 6px 16px 0px; width: 637px; height: 230px;"></textarea>
		<input type="submit" value="提交"  class="button" />
	</form>
<?php

    }
?>

</body>
</html>
