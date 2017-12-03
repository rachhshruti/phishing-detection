<?php
session_start();
$url=$_GET['link'];
$_SESSION['seed_link']=$url; 
?>

<!-- Popup window that asks the user to click Yes button on seedset extension, if they trust the site -->
<body>
<p align="center" > <font face="Calibri" size="5" leftmargin="30px"><b>Do you trust this site?</b></font></p>
<p align="center"><font face="Calibri" size="3" color="#FF0000"><i><?php echo $url ?></i></font></p>
<form name="form1" method="get" action="add_seedset_url.php" > 
	<input type="hidden" id="myvalue" value=<?php echo $url?>>
	<input type="submit" class="styled-button-8" name="submit" value="Yes" />
	<style type="text/css">
	.styled-button-8 
	{
		margin-top:10px;
		margin-left:100px;
		background:#25A6E1;
		background:-moz-linear-gradient(top,#25A6E1 0%,#188BC0 100%);
		background:-webkit-gradient(linear,left top,left bottom,color-stop(0%,#25A6E1),color-stop(100%,#188BC0));
		background:-webkit-linear-gradient(top,#25A6E1 0%,#188BC0 100%);
		background:-o-linear-gradient(top,#25A6E1 0%,#188BC0 100%);
		background:-ms-linear-gradient(top,#25A6E1 0%,#188BC0 100%);
		background:linear-gradient(top,#25A6E1 0%,#188BC0 100%);
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#25A6E1',endColorstr='#188BC0',GradientType=0);
		padding:8px 25px;
		color:#fff;
		font-family:'Helvetica Neue',sans-serif;
		font-size:17px;
		border-radius:4px;
		-moz-border-radius:4px;
		-webkit-border-radius:4px;
		border:1px solid #1A87B9
	}
	</style>
</form>
</body>