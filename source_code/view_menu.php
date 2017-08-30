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
		
	<title>今日菜單</title>
		
	<link rel="shortcut icon" href="http://www.nexcom.com.tw/images/NEXCOM.jpg">
	<link rel="stylesheet" href="layout.css" type="text/css"/>

	<script type="text/javascript" src="date_time.js"></script>
</head>

<body>
	<?php
		require 'Connect_DB.php';
		require 'ValueDelimit.php';
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
			<h2 align="center">今日菜單</h2>
			<hr color="#777777" width="98%">

	<?php

		try
		{
			$sql = 'SELECT count(*) from "t_MenuHeaders" where "c_MenuDeadlineDateTime"::Date >= current_date and "c_MenuDeadlineDateTime" >= now();';
			$statement = $connection->query($sql);
			
			if ($statement->fetchColumn() > 0) {
	// 列出時間最接近之有效菜單
				$sql = 'SELECT MIN("c_MenuId") as "MenuId", MIN("c_MenuDate") as "MenuDate", MIN("c_MenuDeadlineDateTime") as "MenuDeadlineDateTime" from "t_MenuHeaders" where "c_MenuDeadlineDateTime"::Date >= current_date and "c_MenuDeadlineDateTime" >= now();';
				$statement = $connection->query($sql);
				foreach($statement as $row){  // loop only once...
					$v_MenuId = $row['MenuId'];
					$v_MenuDate = $row['MenuDate'];
					$v_MenuDeadline = $row['MenuDeadlineDateTime'];
				}	
				echo '<form action="InsertOrder.php" method="post">';
				echo '<table id="content" cellpadding="2" align="center">';
				echo '<tr><td colspan="4" id="title"><b>用餐日期： '.$v_MenuDate.'<br>訂餐截止時間： '.$v_MenuDeadline.'</b></td></tr>';
				echo '<tr><td id="subtitle"><b>用餐者</b></td><td colspan=2"><input type="text" id="input_text" name="v_Person" required autofocus></td><td>如非代訂，請填自己。</td></tr>';
				echo '<tr><td id="subtitle"><b>地點</b></td><td colspan=3">
						<select name = "v_Location" required>';
				$sql = 'select (select "c_UserLocationID" from "t_Users" where "c_UserAccount" = \''.$_SESSION['user'].'\'), "c_LocationID", "c_LocationName" from "t_Locations";';
				$statement = $connection->query($sql);
				foreach($statement as $row){ 
					if ($row['c_UserLocationID'] == $row['c_LocationID']) {
						echo '<option value="'.$row['c_LocationID'].'" selected>';
					}
					else {
						echo '<option value="'.$row['c_LocationID'].'">';					
					}
					echo $row['c_LocationName'].'</option>';
					
				}
				echo '</select></td></tr>';
					
				echo '<tr><td colspan="4" id="title"><b>可選餐點</b></td></tr>';
				echo '<tr><td id="subtitle"><b>廠商</b></td><td id="subtitle"><b>品名</b></td><td id="subtitle"><b>單價</b></td><td id="subtitle"><b>選擇</b></td></tr>';
		
				$sql = 'select "t_MenuDetails"."id","t_Providers"."c_ProviderID","t_Providers"."c_ProviderName", "t_FoodItems"."c_FoodItemName", "t_FoodItems"."c_FoodItemPrice" 
								from "t_Providers","t_MenuDetails","t_FoodItems" 
								where "t_MenuDetails"."c_MenuId" = '.$v_MenuId.' and "t_MenuDetails"."c_MenuLineFoodItemID" = "t_FoodItems"."c_FoodItemId" and "t_FoodItems"."c_ProviderID" = "t_Providers"."c_ProviderID"
								order by "t_Providers"."c_ProviderName";';

//echo $sql;
				$statement = $connection->query($sql);

				foreach($statement as $row){
//					print_r($row);
					$list_row = "<td>".$row['c_ProviderName']."</td><td>".$row['c_FoodItemName']."</td><td>".$row['c_FoodItemPrice']."</td>";
					$list_value = $row['id'].$ValueDelimit.$row['c_ProviderName'].$ValueDelimit.$row['c_FoodItemName'].$ValueDelimit.$row['c_FoodItemPrice'];
					echo "<tr>".$list_row."<td><input type='radio' name='new_list' value='".$list_value."'/></td></tr>";
				}
				echo '<tr><td colspan="4" align="center">';
				echo '<input id=button_link type=submit value="確認送出" align="center"  style="height: 40px; width: 90px; font-size: 14px; font-weight:bold;">';
				echo '<input id=button_link type=reset value="清除重填" align="center"  style="height: 40px; width: 90px; font-size: 14px; font-weight:bold;">';
				echo '</td></tr>';
				echo '</table>';
				echo '</form>';
			}
			else {
				echo '無可訂餐點.';
			}
		}
		catch (PDOException $e)
		{
			echo 'VIEW MENU FAILED: ' . $e->getMessage();
		}
	?>
	</section>

	<footer>
			&copy; 2017 新漢股份有限公司 - 資訊技術部
		</footer>

	</body>
</html>
