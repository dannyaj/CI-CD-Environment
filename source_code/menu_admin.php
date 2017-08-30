<?php 
 session_start();
	if (empty($_SESSION['user'])) {
		header("Location: index.php");
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
	<title>菜單管理</title>
		
	<link rel="shortcut icon" href="http://www.nexcom.com.tw/images/NEXCOM.jpg">
	<link rel="stylesheet" href="layout.css" type="text/css"/>

	<script type="text/javascript" src="date_time.js"></script>
</head>
	
<body>
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
			<li class="left"><a href="view_menu.php">今日菜單</a></li>
			<li class="left"><a href="history.php">紀錄查詢</a></li>
			<li class="left"><a href="menu_admin.php">菜單管理</a></li>
			<li class="left"><a href="system_admin.php">系統管理</a></li>
			<li class="left"><a>使用說明</a></li>
		
			
			<li class="right"><a href="logout.php">登出</a></li>
			<li class="right"><u>使用者：
<?php
echo $_SESSION['user'];
?>
			</u></li>
		</ul>
	</nav>
			
		<section>
			<br>
			<h2 align="center">菜單管理</h2>
			<hr color="#777777" width="98%">

			<!--<table id="content">
				<tr>
					<td>
						<buttom type="button" class="btn">編輯菜單</buttom>
					</td>
					<td>
						<buttom type="button" class="btn">編輯餐點</buttom>
					</td>
				</tr>
			</table>

			<br>
			管理店家與餐點-->

<table align="center" cellpadding="10"><tr><td>
				

<a style="text-decoration: none;" href="menu_edit.php">
			<table id="button_link" align="center" width="300px" height="100px" style="background-color: #777777;"><tr>
				<td onclick="location.href='menu_edit.php';">
				
					<h3 align="center">新增菜單</h3>

				</td>


			</tr></table>
</a>

			</td><td>

<a style="text-decoration: none;" href="provider_edit.php">
			<table id="button_link" align="center" width="300px" height="100px" style="background-color: #777777;"><tr>
				<td onclick="location.href='provider_edit.php';">
				
					<h3 align="center">新增廠商</h3>

				</td>


			</tr></table>
</a>

			</td></tr><tr><td>

<a style="text-decoration: none;" href="fooditem_edit.php">
				<table id="button_link" align="center" width="300px" height="100px" style="background-color: #777777;"><tr>
				<td onclick="location.href='fooditem_edit.php';">
				
					<h3 align="center">新增餐點</h3>

				</td>
</a>

			</tr></table>

			</td><td>
			<a style="text-decoration: none;" href="view_my_order.php">
			<table id="button_link" align="center" width="300px" height="100px" style="background-color: #777777;"><tr>
				<td onclick="location.href='view_my_order.php';">
				
					<h3 align="center">個人統計</h3>

				</td>


			</tr></table>
			</a>
			</td>
			</tr>
			<tr>
			<td>
			<a style="text-decoration: none;" href="view_all_order.php">
			<table id="button_link" align="center" width="300px" height="100px" style="background-color: #777777;"><tr>
				<td onclick="location.href='view_all_order.php';">
				
					<h3 align="center">全部統計</h3>

				</td>


			</tr></table>
			</a>
			</td>



			</tr></table>

<br><br>
		</section>

		<footer>
			&copy; 2017 新漢股份有限公司 - 資訊技術部
		</footer>

	</body>
</html>
