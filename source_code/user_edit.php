<?php session_start(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8">
		
		<title>新增使用者</title>
		
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
			
			<h2 align="center">新增使用者</h2>
			<hr color="#777777" width="98%">

			<form action="InsertUser.php" method="post">

			<table id="content" cellpadding="2" align="center">
			
				<tr><td colspan="3" id="title"><b>帳號與密碼</b></td></tr>
				<tr><td id="subtitle"><b>帳號</b></td><td id="input_block"><input type="text" id="input_text" name="v_UserID"></td><td>帳號為工號。</td></tr>
				<tr><td id="subtitle"><b>AD帳號</b></td><td id="input_block"><input type="text" id="input_text" name="v_UserAccount"></td><td>無AD帳號者免填。</td></tr>
				<tr><td id="subtitle"><b>密碼</b></td><td id="input_block"><input type="password" id="input_text" name="v_UserPassword"></td><td>不會自行登入者免填。</td></tr>
				<tr><td id="subtitle"><b>確認密碼</b></td><td id="input_block"><input type="password" id="input_text" name="v_UserPasswordConfirm"></td><td><input id="button_lin"k type="submit" value="檢查密碼" align="center" style="height: 100%; width: 30%;"></td></tr>
				<tr><td id="subtitle"><b>權限等級</b></td><td id="input_block">
					<select id="input_select" name="v_UserPermissionID">
						<option selected>-請選擇-</option>
<?php
	$statement = $connection->query('SELECT * FROM "t_ListOptions" WHERE "c_ListID" = \'l_Permissions\' AND "c_ListOptionIsEffective" = TRUE;');// querying the database

	foreach($statement as $row){
		echo '<option value="' . $row['c_ListOptionValue'] . '">' . $row['c_ListOptionName'] . ' - ' . $row['c_ListOptionID'] . '</option>';
	}
?>
					</select>
				</td><td>使用者權限種類。</td></tr>
				<tr><td id="subtitle"><b>有效否</b></td><td id="input_block">
					<input type="radio" id="UserIsEffective" name="v_UserIsEffective" value="TRUE" checked>是
					<input type="radio" id="UserIsEffective" name="v_UserIsEffective" value="FALSE">否
				</td><td>有效使用者才可訂便當。</td></tr>

				<tr><td colspan="3" id="title"><b>個人資料</b></td></tr>
				<tr><td id="subtitle"><b>中文姓名</b></td><td><input type="text" id="input_text" name="v_UserName"></td><td>請填中文全名。</td></tr>
				<tr><td id="subtitle"><b>英文姓名</b></td><td><input type="text" id="input_text" name="v_UserNameEN"></td><td>請填英文全名 ( 先名後姓 )。</td></tr>
				<tr><td id="subtitle"><b>部門</b></td><td>
					<select id="input_select" name="v_UserDepartmentID">
						<option selected>-請選擇-</option>
<?php
	$statement = $connection->query('SELECT * FROM "t_Departments" WHERE "c_DepartmentIsEffective" = TRUE;');// querying the database

	foreach($statement as $row){
		echo '<option value="' . $row['c_DepartmentID'] . '">' . $row['c_DepartmentID'] . ' - ' . $row['c_DepartmentName'] . '</option>';
	}
?>
					</select>
				</td><td>使用者所屬部門。</td></tr>
				<tr><td id="subtitle"><b>位置</b></td><td>
					<select id="input_select" name="v_UserLocationID">
						<option selected>-請選擇-</option>
<?php
	$statement = $connection->query('SELECT * FROM "t_Locations" WHERE "c_LocationIsEffective" = TRUE;');// querying the database

	foreach($statement as $row){
		echo '<option value="' . $row['c_LocationID'] . '">' . $row['c_LocationID'] . ' - ' . $row['c_LocationName'] . '</option>';
	}
?>
					</select>
				</td><td>使用者所在位置。</td></tr>
				
				<tr><td colspan="3" id="title"><b>聯絡資訊</b></td></tr>
				<tr><td id="subtitle"><b>電話</b></td><td><input type="text" id="input_text" name="v_UserPhone"></td><td></td></tr>
				<tr><td id="subtitle"><b>分機</b></td><td><input type="text" id="input_text" name="v_UserPhoneExtention"></td><td></td></tr>
				<tr><td id="subtitle"><b>傳真</b></td><td><input type="text" id="input_text" name="v_UserFax"></td><td></td></tr>
				<tr><td id="subtitle"><b>電子郵件</b></td><td><input type="text" id="input_text" name="v_UserEmail"></td><td>無電子郵件帳號者免填。</td></tr>
				<tr><td id="subtitle"><b>行動電話</b></td><td><input type="text" id="input_text" name="v_UserMobilePhone"></td><td></td></tr>
				
				<tr><td colspan="3" id="title"><b>其他說明</b></td></tr>
				<tr><td id="subtitle"><b>相關備註</b></td><td><textarea style="height:100px; width:98%"></textarea></td><td>使用者的其他相關說明。</td></tr>

				<tr><td colspan="3" align="center">
					<input id="button_link" type="submit" value="確認送出" align="center"  style="height: 40px; width: 90px; font-size: 14px; font-weight:bold;">
					<input id="button_link" type="reset" value="清除重填" align="center"  style="height: 40px; width: 90px; font-size: 14px; font-weight:bold;">
				</td></tr>
			</table>
			
			</form>
			
			<br><br>
</section>

<footer>新漢股份有限公司 - 資訊技術部</footer>
	</body>
	
</html>

