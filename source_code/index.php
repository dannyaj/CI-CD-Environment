<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
	<title>登入</title>
		
	<link rel="shortcut icon" href="http://www.nexcom.com.tw/images/NEXCOM.jpg"/>
	<link rel="stylesheet" href="layout.css" type="text/css"/>

	<script type="text/javascript" src="date_time.js"></script>

</head>
	
<body>
	<?php
		require 'Connect_DB.php';
	?>
	
	<header>
		<table align="left" style="font-size: 20px;"><tr><td>
			<img src="resource/images/NEXCOM_LOGO_NoSlogan.png" alt="NEXCOM Logo" align="center" width="150px">
		</td><td>&emsp;</td><td><b>新漢員工訂餐系統</b></td></tr></table>	

		<table align="right"><tr><td>
			<span id="date_time"></span>
			<script type="text/javascript">window.onload = date_time('date_time');</script>
		</td></tr></table>
	</header>

	<nav>
		<ul>
			<li class="left"><a >使用說明</a></li>
			<li class="left"><a >問題回報</a></li>

			<li class="right"><a href="http://bserver.nexcom.com.tw/bserver_new.html">返回新漢資訊站</a></li>
		</ul>		
	</nav>
	<section>
		<br>
		<br>
		<table align="center"><tr><td>
			<img src="resource/images/NEXCOM_LOGO_NoSlogan.png" alt="NEXCOM Logo" align="center" width="500px">
		</td></tr></table>
		<br>
		<br>
			<h1 align="center">歡迎使用&emsp;新漢員工訂餐系統</h1>
			<br>
			<h3 align="center">本系統目前僅供工廠同仁使用</h3>
			
			<br>
			<br>
		
	<form action="login.php" method="post">
		<table id="content" align="center" style="width: 500px;">
			<tr><td colspan="2" id="title"><b>使用者登入</b></td></tr>
			<tr><td id="subtitle"><b>使用者帳號</b></td><td><input type="text" id="input_text" class="form-control" name="UserID" required autofocus/></td></tr>
			<tr><td id="subtitle"><b>密碼</b></td><td><input type="password" id="input_text" class="form-control" name="UserPassword" required /></td></tr>
			<tr><td colspan="2" align="center">
				<input id=button_link type=submit value="確認送出" name="submit" align="center"  style="height: 40px; width: 90px; font-size: 14px; font-weight:bold;">
				<input id=button_link type=reset value="清除重填" align="center"  style="height: 40px; width: 90px; font-size: 14px; font-weight:bold;">
			</td></tr>
		</table>
	</form>
	</section>

	<footer>&copy; 2017 新漢股份有限公司 - 資訊技術部</footer>
</body>
</html>
