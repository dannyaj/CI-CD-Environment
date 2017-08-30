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
		
	<title>全部訂餐統計</title>
		
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
			<h2 align="center">全部訂餐統計</h2>
			<hr color="#777777" width="98%">

	<?php
		try
		{
		$v_ProviderName = empty($_POST["v_ProviderName"]) ? "__ALL__" :  $_POST["v_ProviderName"];
		$v_MealDate = empty($_POST["v_MealDate"]) ? date('Y-m-d',strtotime('+1 day')) :  $_POST["v_MealDate"];

//  先選擇日期 預設為明天

		echo   '<form action="view_all_order.php" method="post">
				<table id="content" align="center">
					<tr><td id="title" colspan="4"></td></tr>
					<tr><td id="subtitle">用餐日期</td><td align="center" colspan="2"><input type="text" id="input_text" name="v_MealDate" value="'.$v_MealDate.'"></td><td id="subtitle"></td></tr>';
		echo   		'<tr><td align="center" colspan="4">
					<input id=button_link type=submit value="確認" name="submit" align="center"  style="height: 40px; width: 90px; font-size: 14px; font-weight:bold;">
					<input id=button_link type=reset value="清除" align="center"  style="height: 40px; width: 90px; font-size: 14px; font-weight:bold;">
					</td></tr>
				</table>
				</form>';

//		echo '<p/>';
			
//			$sql = 'SELECT count(*) from "t_MenuHeaders" where "c_MenuDeadlineDateTime"::Date = \''.$v_MealDate.'\';';
			$sql = 'SELECT count(*) from "t_MenuHeaders" where "c_MenuDate" = \''.$v_MealDate.'\';';
			$statement = $connection->query($sql);

// 檢查該用餐日是否曾設定唯一菜單			
			if ($statement->fetchColumn() == 1) {
//				$sql = 'SELECT "c_MenuId","c_MenuDate","c_MenuDeadlineDateTime" from "t_MenuHeaders" where "c_MenuDeadlineDateTime"::Date = \''.$v_MealDate.'\';';
				$sql = 'SELECT "c_MenuId","c_MenuDate","c_MenuDeadlineDateTime" from "t_MenuHeaders" where "c_MenuDate" = \''.$v_MealDate.'\';';
				$statement = $connection->query($sql);
				$rs = $statement->fetchAll();
				$v_MenuId = $rs[0]['c_MenuId'];
				$v_MenuDate = $rs[0]['c_MenuDate'];
				$v_MenuDeadline = $rs[0]['c_MenuDeadlineDateTime'];

//  再選擇廠商 預設為全部

				echo   '<form action="view_all_order.php" method="post">
						<table id="content" align="center">
							<tr><td id="subtitle">供餐廠商</td><td align="center" colspan="2"><select name="v_ProviderName">
							<option value="__ALL__" selected>全部</option>';
				$sql = 'select distinct "c_MenuLineProviderName" as "c_ProviderName"
								from "t_MenuDetails"
								where "c_MenuId" = '.$v_MenuId.';';
				$statement = $connection->query($sql);
				foreach($statement as $row){ 
					echo '<option value="'.$row['c_ProviderName'].'">';					
					echo $row['c_ProviderName'].'</option>';
				}
				echo   		'</select></td><td id="subtitle"></td></tr>
							<tr><td align="center" colspan="4">
							<input type="hidden" name="v_MealDate" value="'.$v_MealDate.'">
							<input id=button_link type=submit value="確認" name="submit" align="center"  style="height: 40px; width: 90px; font-size: 14px; font-weight:bold;">
							<input id=button_link type=reset value="清除" align="center"  style="height: 40px; width: 90px; font-size: 14px; font-weight:bold;">
							</td></tr>
						</table>
						</form>';

				echo '<p/>';
				
				$v_All = $v_ProviderName == '__ALL__';
				$v_Vendor = $v_All ? ' ' : ' AND "c_ProviderName" = \''.$v_ProviderName.'\' ';
		
				$sql = 'SELECT "c_ProviderName", count(distinct "c_FoodItemName") as num_food, sum("c_FoodItemPrice") as total
								FROM  "t_MenuOrderRecords","t_MenuDetails"  
								WHERE "c_MenuId" = '.$v_MenuId.' and "t_MenuDetails"."id" = "t_MenuOrderRecords"."c_MenuDetailId" '.$v_Vendor.' 
								GROUP BY "c_ProviderName"
								ORDER BY "c_ProviderName";';
				$statement = $connection->query($sql);


				foreach($statement as $row){
	// Table 1 : 各餐點數量統計, 以方便向廠商訂餐			
					echo '<table id="content" cellpadding="2" align="center">';
					echo '<tr><td colspan="5" id="title"><b>用餐日期： '.$v_MenuDate.'</b></td></tr>';
					echo '<tr><td id="subtitle"><b>廠商</b></td><td id="subtitle"><b>品名</b></td><td id="subtitle"><b>數量</b></td><td id="subtitle"><b>合計</b></td><td id="subtitle"><b>總計</b></td></tr>';
					$sql1 = 'SELECT "c_FoodItemName",count(*) as num, sum("c_FoodItemPrice") as total 
									FROM  "t_MenuOrderRecords","t_MenuDetails"  
									WHERE "c_MenuId" = '.$v_MenuId.' and "t_MenuDetails"."id" = "t_MenuOrderRecords"."c_MenuDetailId"  and "c_ProviderName" = \''.$row['c_ProviderName'].'\' 
									GROUP BY "c_FoodItemName";';
					$statement1 = $connection->query($sql1);
					$rs = $statement1->fetchAll();	
					for ($i = 0; $i < $row['num_food']; $i++) {
						$row1 = $rs[$i];
						$list_row = "<td>".$row1['c_FoodItemName']."</td><td>".$row1['num']."</td><td>".$row1['total']."</td>";
						if ($i == 0) {
							echo "<tr><td rowspan=\"".$row['num_food']."\">".$row['c_ProviderName']."</td>".$list_row."<td rowspan=\"".$row['num_food']."\">".$row['total']."</td></tr>";
						}
						else {
							echo "<tr>".$list_row."</tr>";
						}
					}
					echo '</table>';
//					echo '<p/>';

	// Table 2 : 各地點數量統計, 以方便廠商送餐			
					echo '<table id="content" cellpadding="2" align="center">';
					echo '<tr><td colspan="5" id="title"><b>用餐日期： '.$v_MenuDate.'</b></td></tr>';
					echo '<tr><td id="subtitle"><b>廠商</b></td><td id="subtitle"><b>地點</b></td><td id="subtitle"><b>品名</b></td><td id="subtitle"><b>數量</b></td><td id="subtitle"><b>合計</b></td></tr>';
					$sql1 = 'SELECT "c_LocationName", "c_FoodItemName", count(*) as num, sum("c_FoodItemPrice") as total 
									FROM  "t_MenuOrderRecords","t_MenuDetails","t_Locations"
									WHERE "c_MenuId" = '.$v_MenuId.' and "t_MenuDetails"."id" = "t_MenuOrderRecords"."c_MenuDetailId"  and "c_ProviderName" = \''.$row['c_ProviderName'].'\' and "t_MenuOrderRecords"."c_LocationID" = "t_Locations"."c_LocationID"
									GROUP BY "c_LocationName","c_FoodItemName";';
					$statement1 = $connection->query($sql1);
					$rs = $statement1->fetchAll();	
		// 計算列數
					$sql2 = 'SELECT count(distinct ("c_LocationName","c_FoodItemName"))
								FROM  "t_MenuOrderRecords","t_MenuDetails","t_Locations"
								WHERE "c_MenuId" = '.$v_MenuId.' and "t_MenuDetails"."id" = "t_MenuOrderRecords"."c_MenuDetailId"  and "c_ProviderName" = \''.$row['c_ProviderName'].'\' and "t_MenuOrderRecords"."c_LocationID" = "t_Locations"."c_LocationID"
								;';
					$v_NumRows = $connection->query($sql2)->fetchColumn();
					for ($i = 0; $i < $v_NumRows; $i++) {
						$row1 = $rs[$i];
						$list_row = "<td>".$row1['c_LocationName']."</td><td>".$row1['c_FoodItemName']."</td><td>".$row1['num']."</td><td>".$row1['total']."</td>";
						if ($i == 0) {
							echo "<tr><td rowspan=\"".$v_NumRows."\">".$row['c_ProviderName']."</td>".$list_row."</tr>";
						}
						else {
							echo "<tr>".$list_row."</tr>";
						}
					}
					echo '</table>';
					echo '<p/>';
				}
				echo '<p/>';
//				foreach($statement as $row){
//					$list_row = "<td>".$row['c_ProviderName']."</td><td>".$row['c_FoodItemName']."</td><td>".$row['c_FoodItemPrice']."</td><td>".$row['num']."</td><td>".$row['total']."</td>";
//					echo "<tr>".$list_row."</tr>";
//				}

	// Table 3  : 各訂餐人餐點數量統計, 以方便取餐及收款	
				if ($v_All) { // 選"全部"時才顯示
					echo '<table id="content" cellpadding="2" align="center">';
					echo '<tr><td colspan="5" id="title"><b>用餐日期： '.$v_MenuDate.'</b></td></tr>';
					echo '<tr><td id="subtitle"><b>訂餐人</b></td><td id="subtitle"><b>廠商</b></td><td id="subtitle"><b>品名</b></td><td id="subtitle"><b>數量</b></td><td id="subtitle"><b>總計</b></td></tr>';
			
					$sql = 'SELECT "c_RecordCreatorID",count(distinct "c_MenuLineFoodItemID") as num ,sum("c_FoodItemPrice") as total
									FROM  "t_MenuOrderRecords","t_MenuDetails"  
									WHERE "c_MenuId" = '.$v_MenuId.' and "t_MenuDetails"."id" = "t_MenuOrderRecords"."c_MenuDetailId" 
									GROUP BY "c_RecordCreatorID" 
									ORDER BY "c_RecordCreatorID";';
					$statement = $connection->query($sql);

					$sql1 = 'SELECT "c_RecordCreatorID","c_ProviderName","c_FoodItemName",count(*) as num
									FROM  "t_MenuOrderRecords","t_MenuDetails"  
									WHERE "c_MenuId" = '.$v_MenuId.' and "t_MenuDetails"."id" = "t_MenuOrderRecords"."c_MenuDetailId" 
									GROUP BY "c_RecordCreatorID","c_ProviderName","c_FoodItemName" 
									ORDER BY "c_RecordCreatorID","c_ProviderName";';
					$statement1 = $connection->query($sql1);
					$rs = $statement1->fetchAll();

					$idx1 = 0;
					foreach($statement as $row){
						for ($i = 0; $i < $row['num']; $i++) {
							$row1 = $rs[$idx1];
							$list_row = "<td>".$row1['c_ProviderName']."</td><td>".$row1['c_FoodItemName']."</td><td>".$row1['num']."</td>";
							if ($i == 0) {
								echo "<tr><td rowspan=\"".$row['num']."\">".$row['c_RecordCreatorID']."</td>".$list_row."<td rowspan=\"".$row['num']."\">".$row['total']."</td></tr>";
							}
							else {
								echo "<tr>".$list_row."</tr>";
							}
							$idx1++;	
						}
					}
					echo '</table>';
					echo '<p/>';
					
					$sql = 'SELECT sum("c_FoodItemPrice") as total
									FROM  "t_MenuOrderRecords","t_MenuDetails"  
									WHERE "c_MenuId" = '.$v_MenuId.' and "t_MenuDetails"."id" = "t_MenuOrderRecords"."c_MenuDetailId" 
									GROUP BY "c_MenuId";';
					echo '總金額 ： '.$connection->query($sql)->fetchColumn().'元';
				}
			}
			else {
				echo '無餐點.';
			}
		}
		catch (PDOException $e)
		{
			echo 'There was a problem viewing personal orders: ' . $e->getMessage();
		}

	?>
	</section>

	<footer>
			&copy; 2017 新漢股份有限公司 - 資訊技術部
		</footer>

	</body>
</html>
