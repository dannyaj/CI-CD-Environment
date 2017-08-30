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
		
	<title>新增餐點</title>
		
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
			<h2 align="center">新增餐點</h2>
			<hr color="#777777" width="98%">

			<form action="InsertFooditem.php" method="post">

			<table id="content" cellpadding="2" align="center">
				
				<tr><td colspan="3" id="title"><b>餐點資料</b></td></tr>	
				<tr><td id="subtitle"><b>名稱</b></td><td id="input_block"><input type="text" id="input_text" name="v_FoodItemName"></td><td>請以原始名稱為主。</td></tr>
				<tr><td id="subtitle"><b>供餐廠商</b></td><td id="input_block"><select name="v_ProviderID">
<?php
				require 'Connect_DB.php';
				$sql = 'select "c_ProviderID", "c_ProviderName" from "t_Providers";';
				$statement = $connection->query($sql);
				foreach($statement as $row){ 
					echo '<option value="'.$row['c_ProviderID'].'">';					
					echo $row['c_ProviderName'].'</option>';
				}
?>			
				</select></td><td>請填供餐廠商。</td></tr>
				<tr><td id="subtitle"><b>有效否</b></td><td id="input_block">
					<input type="radio" id="UserIsEffective" name="v_FoodItemIsEffective" value="TRUE" checked>是
					<input type="radio" id="UserIsEffective" name="v_FoodItemIsEffective" value="FALSE">否
				</td><td>有效餐點才可被放入每日菜單。</td></tr>
				<tr><td id="subtitle"><b>餐點描述</b></td><td id="input_block"><textarea id="input_textarea"></textarea></td><td>餐點的介紹或說明。</td></tr>
				<tr><td id="subtitle"><b>餐點單價</b></td><td id="input_block"><input type="text" name="v_FoodItemPrice" style="height: 100%; width: 85%;"> 元</td><td>請填金額數字。</td></tr>
				
				<tr><td colspan="3" id="title"><b>其他說明</b></td></tr>
				<tr><td id="subtitle"><b>相關備註</b></td><td><textarea id="input_textarea"></textarea></td><td>餐點的其他相關說明。</td></tr>
				<tr><td colspan="3" align="center">
					<input id=button_link type="submit" value="確認送出" align="center"  style="height: 40px; width: 90px; font-size: 14px; font-weight:bold;">
					<input id=button_link type="reset" value="清除重填" align="center"  style="height: 40px; width: 90px; font-size: 14px; font-weight:bold;">
				</td></tr>
			</table>
			
			</form>
			
			<br><br>
		</section>

		<footer>
			&copy; 2017 新漢股份有限公司 - 資訊技術部
		</footer>

	</body>
</html>
