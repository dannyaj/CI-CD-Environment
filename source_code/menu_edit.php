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
		
	<title>新增菜單</title>
		
	<link rel="shortcut icon" href="http://www.nexcom.com.tw/images/NEXCOM.jpg">
	<link rel="stylesheet" href="layout.css" type="text/css"/>

	<script type="text/javascript" src="date_time.js"></script>
</head>

<body>
	<script> 
		function check_all(obj,cName) 
		{ 
			var checkboxs = document.getElementsByName(cName); 
			for(var i=0;i<checkboxs.length;i++){checkboxs[i].checked = obj.checked;} 
		} 
	</script>
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
			<li class="right"><u>使用者： <?php echo $_SESSION['user'];?> </u></li>
		</ul>
	</nav>
	<section>
		<br>
		<h2 align="center">新增菜單</h2>
		<hr color="#777777" width="98%">
<?php
	try
	{
		$v_MealDate = empty($_POST["v_MealDate"]) ? date('Y-m-d',strtotime('+1 day')) :  $_POST["v_MealDate"];
		$v_Deadline = empty($_POST["v_Deadline"]) ? date('Y-m-d H:i:s',time()+3	*60*60) : $_POST["v_Deadline"];

//  先選擇廠商
		echo   '<form action="menu_edit.php" method="post">
				<table id="content" align="center">
					<tr><td id="title" colspan="4"></td></tr>
					<tr><td id="subtitle">用餐日期</td><td><input type="text" id="input_text" name="v_MealDate" value="'.$v_MealDate.'"></td><td id="subtitle" colspan="2"></td></tr>
					<tr><td id="subtitle">訂餐期限</td><td><input type="text" id="input_text" name="v_Deadline" value="'.$v_Deadline.'"></td><td id="subtitle" colspan="2"></td></tr>
					<tr><td id="title" colspan="4"></td></tr>';
		$sql0 = 'select "c_ProviderID","c_ProviderName"
						from "t_Providers"
						order by "c_ProviderName";';
		$statement0 = $connection->query($sql0);// querying the database
		foreach($statement0 as $row0){
			echo '<tr><td  colspan="4"><input type="checkbox" name = "vendors[]" value = "'.$row0['c_ProviderID'].'"/>'.$row0['c_ProviderName'].'</td></tr>';
		}
		echo   		'<tr><td align="center" colspan="4">
					<input id=button_link type=submit value="選擇廠商" name="submit" align="center"  style="height: 40px; width: 90px; font-size: 14px; font-weight:bold;">
					<input id=button_link type=reset value="清除重填" align="center"  style="height: 40px; width: 90px; font-size: 14px; font-weight:bold;">
					</td></tr>
				</table>
				</form>';

		echo '<p/>';

//	再選擇餐點		
		if (!empty($_POST['vendors'])) {
			$sql = 'SELECT count(*) from "t_MenuHeaders" where "c_MenuDate" = \''.$v_MealDate.'\'';
			$statement = $connection->query($sql);
			if ($statement->fetchColumn() > 0) {
				echo '<br/><h2 align="center">'.$v_MealDate.'已設定菜單</h2>';
			}
			else {
				echo   '<form action="InsertMenu.php" method="post">
						<table id="content" align="center">
						<tr><td id="title" colspan="3"/><td id="title"><input type="checkbox" onclick="check_all(this,\'check_list[]\')" /></td></tr>';
				$v_vendors = implode("','", $_POST['vendors']);
				$sql = 'select "c_FoodItemId","c_FoodItemName","c_FoodItemPrice","c_ProviderName"
								from "t_FoodItems","t_Providers"
								where "c_FoodItemIsEffective" = TRUE and 
									  "t_FoodItems"."c_ProviderID" = "t_Providers"."c_ProviderID" and 
									  "t_Providers"."c_ProviderID" in (\''.$v_vendors.'\') 
								order by "c_ProviderName";';
				$statement = $connection->query($sql);// querying the database
				foreach($statement as $row){
					$list_row = "<td>".$row['c_ProviderName']."</td><td>".$row['c_FoodItemName']."</td><td>".$row['c_FoodItemPrice']."</td>";
					$list_value = $row['c_FoodItemId'].$ValueDelimit.$row['c_ProviderName'].$ValueDelimit.$row['c_FoodItemName'].$ValueDelimit.$row['c_FoodItemPrice'];
					echo "<tr>".$list_row."<td><input type='checkbox'  name='check_list[]' value='".$list_value."'/></td></tr>";
				}
				echo   	'<tr><td align="center" colspan="4">
						<input type="hidden" name="v_MealDate" value="'.$v_MealDate.'">
						<input type="hidden" name="v_Deadline" value="'.$v_Deadline.'">
						<input id=button_link type=submit value="確認送出" name="submit" align="center"  style="height: 40px; width: 90px; font-size: 14px; font-weight:bold;">
						<input id=button_link type=reset value="清除重填" align="center"  style="height: 40px; width: 90px; font-size: 14px; font-weight:bold;">
						</td></tr>
						</table>
						</form>';
			}
		}
		else {
			echo '<br/><h2 align="center">請先選擇廠商</h2>';
		}
	}
	catch (PDOException $e)
	{
		echo 'QUERY MENU FAILED: ' . $e->getMessage();
	}
			


?>

			<br><br>

	</section>

	<footer>
			&copy; 2017 新漢股份有限公司 - 資訊技術部
		</footer>

	</body>
</html>
