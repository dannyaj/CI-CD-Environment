<?php session_start(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
	<title>紀錄查詢</title>
		
	<link rel="shortcut icon" href="http://www.nexcom.com.tw/images/NEXCOM.jpg">
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
			<h2 align="center">紀錄查詢</h2>
			<hr color="#777777" width="98%">
			
			
			<table id="content" cellpadding="2" align="center">
				<tr><td colspan="6" id="title"><b>個人訂餐紀錄</b></td></tr>
				<tr><td id="subtitle"><b>日期</b></td><td id="subtitle"><b>廠商</b></td><td id="subtitle"><b>品名</b></td><td id="subtitle"><b>數量</b></td><td id="subtitle"><b>金額</b></td><td id="subtitle"><b>訂餐者</b></td></tr>

	<?php

		$sql = 'select "c_MenuID", (select "c_ProviderName" from "t_Providers" where "t_Providers"."c_ProviderID" = "t_MenuOrderRecords"."c_ProviderID") as "c_ProviderID", "c_FoodItemName", "c_RecordOrderedQuantity", "c_RecordTotalPrice", "c_RecordCreatorID" from "t_MenuOrderRecords"';
		$statement = $connection->query($sql);

foreach($statement as $row){
	$list_row = "<td>".$row['c_MenuID']."</td><td>".$row['c_ProviderID']."</td><td>".$row['c_FoodItemName']."</td><td>".$row['c_RecordOrderedQuantity']."</td><td>".$row['c_RecordTotalPrice']."</td><td>".$row['c_RecordCreatorID']."</td>";
    		echo "<tr>".$list_row."</tr>";
}
	?>

			</table>

	</section>

	<footer>
			&copy; 2017 新漢股份有限公司 - 資訊技術部
		</footer>

	</body>
</html>
