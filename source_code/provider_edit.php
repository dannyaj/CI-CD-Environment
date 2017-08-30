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

	<title>新增供餐廠商</title>
		
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
			
			<h2 align="center">新增供餐廠商</h2>
			<hr color="#777777" width="98%">

			<form action="InsertProvider.php" method="post">

			<table id="content" cellpadding="2" align="center">
			
				<tr><td colspan="3" id="title"><b>廠商資料</b></td></tr>
				<tr><td id="subtitle"><b>代號</b></td><td id="input_block"><input type="text" id="input_text" name="v_ProviderID"></td><td>請自編廠商代號以供識別。</td></tr>
				<tr><td id="subtitle"><b>名稱</b></td><td id="input_block"><input type="text" id="input_text" name="v_ProviderName"></td><td>廠商或店家的名稱。</td></tr>
				<tr><td id="subtitle"><b>統一編號</b></td><td id="input_block"><input type="text" id="input_text" name="v_ProviderVATNumber"></td><td></td></tr>
				<tr><td id="subtitle"><b>登記證號</b></td><td id="input_block"><input type="text" id="input_text" name="v_ProviderRegistrationNumber"></td><td></td></tr>
				<tr><td id="subtitle"><b>負責人姓名</b></td><td id="input_block"><input type="text" id="input_text" name="v_ProviderPrincipalName"></td><td>請填中文全名。</td></tr>
				<tr><td id="subtitle"><b>描述</b></td><td><textarea id="input_textarea"></textarea></td><td>廠商的介紹或描述。</td></tr>
				<tr><td id="subtitle"><b>官方網站</b></td><td id="input_block"><input type="text" id="input_text" name="v_ProviderWebsite"></td><td>無網站或粉絲團者免填。</td></tr>
				<tr><td id="subtitle"><b>為指定廠商</b></td><td id="input_block">
					<input type="radio" id="ProviderIsSpecified" name="v_ProviderIsSpecified" value="TRUE">是
					<input type="radio" id="ProviderIsSpecified" name="v_ProviderIsSpecified" value="FALSE" checked>否
				</td><td>是否為公司指定供餐廠商或店家。</td></tr>
				<tr><td id="subtitle"><b>有效否</b></td><td id="input_block">
					<input type="radio" id="ProviderIsEffective" name="v_ProviderIsEffective" value="TRUE" checked>是
					<input type="radio" id="ProviderIsEffective" name="v_ProviderIsEffective" value="FALSE">否
				</td><td>有效廠商才可被放入每日菜單。</td></tr>
				
				<tr><td colspan="3" id="title"><b>聯絡資訊</b></td></tr>
				<tr><td id="subtitle"><b>地址</b></td><td id="input_block"><input type="text" id="input_text" name="v_ProviderAddress"></td><td>請填中文地址。</td></tr>
				<tr><td id="subtitle"><b>電話</b></td><td id="input_block"><input type="text" id="input_text" name="v_ProviderPhone"></td><td>格式：(XX)XXXX-XXXX ext.XXX。</td></tr>
				<tr><td id="subtitle"><b>傳真</b></td><td id="input_block"><input type="text" id="input_text" name="v_ProviderFax"></td><td>格式：(XX)XXXX-XXXX。</td></tr>
				<tr><td id="subtitle"><b>聯絡人姓名</b></td><td id="input_block"><input type="text" id="input_text" name="v_ProviderContactName"></td><td>請填中文全名。</td></tr>
				<tr><td id="subtitle"><b>聯絡人手機</b></td><td id="input_block"><input type="text" id="input_text" name="v_ProviderContactMobilePhone"></td><td>格式：XXXX-XXX-XXX。</td></tr>
				<tr><td id="subtitle"><b>聯絡電子郵件</b></td><td id="input_block"><input type="text" id="input_text" name="v_ProviderContactEmail"></td><td>無電子郵件者免填。</td></tr>
				
				<tr><td colspan="3" id="title"><b>外送條件</b></td></tr>
				<tr><td id="subtitle"><b>訂餐方式</b></td><td id="input_block">
					<select id="input_select" name="v_ProviderWayOfOrdering">
						<option selected>-請選擇-</option>
<?php
	$statement = $connection->query('SELECT * FROM "t_ListOptions" WHERE "c_ListID" = \'l_WayOfOrdering\' AND "c_ListOptionIsEffective" = TRUE;');// querying the database

	foreach($statement as $row){
		echo '<option value="' . $row['c_ListOptionValue'] . '">' . $row['c_ListOptionName'] . ' - ' . $row['c_ListOptionID'] . '</option>';
	}
?>
					</select>
				</td><td></td></tr>
				<tr><td id="subtitle"><b>取餐方式</b></td><td>
					<select id="input_select" name="v_ProviderWayOfPicking">
						<option selected>-請選擇-</option>
<?php
	$statement = $connection->query('SELECT * FROM "t_ListOptions" WHERE "c_ListID" = \'l_WayOfPicking\' AND "c_ListOptionIsEffective" = TRUE;');// querying the database

	foreach($statement as $row){
		echo '<option value="' . $row['c_ListOptionValue'] . '">' . $row['c_ListOptionName'] . ' - ' . $row['c_ListOptionID'] . '</option>';
	}
?>
					</select>
				</td><td></td></tr>
				<tr><td id="subtitle"><b>外送條件</b></td><td id="input_block">
					<select name="v_ProviderDeliveryTerms" style="height: 100%; width: 45%">
						<option selected>-請選擇-</option>
<?php
	$statement = $connection->query('SELECT * FROM "t_ListOptions" WHERE "c_ListID" = \'l_DeliveryTerms\' AND "c_ListOptionIsEffective" = TRUE;');// querying the database

	foreach($statement as $row){
		echo '<option value="' . $row['c_ListOptionValue'] . '">' . substr($row['c_ListOptionName'], 0, 6) . ' - ' . $row['c_ListOptionID'] . '</option>';
	}
?>
					</select>
					 滿 
					<input type="text" name="v_ProviderMinimumDeliveryNumber" style="height: 100%; width: 40%">

				</td><td>後者請填數值。</td></tr>
				<tr><td id="subtitle"><b>最小備餐時間</b></td><td id="input_block"><input type="text" name="v_ProviderMinimumPreparationTime" style="height: 100%; width: 80%"> 分</td><td>請填數值。</td></tr>

				
				<tr><td colspan="3" id="title"><b>財務用資訊</b></td></tr>
				
				<tr><td id="subtitle"><b>付款憑證種類</b></td><td>
					<select id="input_select" name="v_ProviderReceiptType">
						<option selected>-請選擇-</option>
<?php
	$statement = $connection->query('SELECT * FROM "t_ListOptions" WHERE "c_ListID" = \'l_ReceiptType\' AND "c_ListOptionIsEffective" = TRUE;');// querying the database

	foreach($statement as $row){
		echo '<option value="' . $row['c_ListOptionValue'] . '">' . $row['c_ListOptionName'] . ' - ' . $row['c_ListOptionID'] . '</option>';
	}
?>

					</select>
				</td><td></td></tr>
								<tr><td id="subtitle"><b>付款方式</b></td><td>
					<select id="input_select" name="v_ProviderPaymentTerms">
						<option selected>-請選擇-</option>
<?php
	$statement = $connection->query('SELECT * FROM "t_ListOptions" WHERE "c_ListID" = \'l_PaymentTerms\' AND "c_ListOptionIsEffective" = TRUE;');// querying the database

	foreach($statement as $row){
		echo '<option value="' . $row['c_ListOptionValue'] . '">' . $row['c_ListOptionName'] . ' - ' . $row['c_ListOptionID'] . '</option>';
	}
?>

					</select>
				</td><td></td></tr>
				<tr><td id="subtitle"><b>匯款帳號</b></td><td><input type="text" id="input_text" name="v_ProviderRemittingAccount"></td><td>現金交易者免填。</td></tr>
				
				<tr><td colspan="3" id="title"><b>其他說明</b></td></tr>
				<tr><td id="subtitle"><b>相關備註</b></td><td id="input_block"><textarea id="input_textarea"></textarea></td><td>供餐廠商的其他相關說明。</td></tr>

				<tr><td colspan="3" align="center">
					<input id=button_link type=submit value="確認送出" align="center"  style="height: 40px; width: 90px; font-size: 14px; font-weight:bold;">
					<input id=button_link type=reset value="清除重填" align="center"  style="height: 40px; width: 90px; font-size: 14px; font-weight:bold;">
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
