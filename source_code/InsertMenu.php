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
		
		<title>新增菜單</title>
		
		<link rel="shortcut icon" href="http://www.nexcom.com.tw/images/NEXCOM.jpg">
		<link rel="stylesheet" href="layout.css" type="text/css"/>
	</head>
	
	<body>
<?php

	require 'Connect_DB.php';
	require 'ValueDelimit.php';

	//$IP = getHostByName(getHostName());
	//echo $IP;

	$v_MealDate = $_POST["v_MealDate"];
	$v_Deadline = $_POST["v_Deadline"];
	
	if(!empty($_POST['check_list'])) {
		try
		{
		// set autocommit off
		//begin transaction
			
			$sql = 'INSERT INTO "t_MenuHeaders"("c_MenuDate", "c_MenuDeadlineDateTime") VALUES (\''.$v_MealDate.'\', \''.$v_Deadline.'\');';

		//echo $sql;

			$statement = $connection->exec($sql);
			
		//Get Last Insert Id
			$sql = 'SELECT MAX("c_MenuId") from "t_MenuHeaders"';
			$statement = $connection->query($sql);
			$v_MenuId = $statement->fetchColumn();
			
		// Counting number of checked checkboxes.
			$checked_count = count($_POST['check_list']);
		// Prepare statement for insert	
//			$sql = 'INSERT INTO "t_MenuDetails"(
//					"c_MenuId", "c_MenuLineFoodItemId")
//					VALUES ('.$v_MenuId.',:FoodId);';
//			$statement = $connection->prepare($sql);
//			$statement->bindParam(1, $selected);
//			echo "您已設定".$checked_count."種餐點: <br/>";

			echo '<table id="content" cellpadding="2" align="center">';
			echo '<tr><td colspan="3" id="title"><b>用餐日期： '.$v_MealDate.'</b></td></tr>';
			echo '<tr><td colspan="3" id="title"><b>您已設定以下'.$checked_count.'種餐點</b></td></tr>';
			echo '<tr><td id="subtitle"><b>廠商</b></td><td id="subtitle"><b>品名</b></td><td id="subtitle"><b>單價</b></td></tr>';

		// Loop to store and display values of individual checked checkbox.
			foreach($_POST['check_list'] as $selected) {
				$v_Values = explode($ValueDelimit,$selected);
				$v_FoodId = $v_Values[0];
				$v_ProviderName = $v_Values[1];
				$v_FoodName = $v_Values[2];
				$v_FoodPrice = $v_Values[3];
				$sql = 'INSERT INTO "t_MenuDetails"(
						"c_MenuId", "c_MenuLineFoodItemID", "c_MenuLineProviderName", "c_MenuLineFoodItemName", "c_MenuLineItemPrice")
						VALUES ('.$v_MenuId.', '.$v_FoodId.', \''.$v_ProviderName.'\', \''.$v_FoodName.'\', '.$v_FoodPrice.');';
//				echo $sql;
//				$statement->execute(array(':FoodId' => $selected));
				$statement = $connection->exec($sql);
				$list_row = "<td>".$v_ProviderName."</td><td>".$v_FoodName."</td><td>".$v_FoodPrice."</td>";
				echo "<tr>".$list_row."</tr>";
			}
		// commit
			echo '</table>';
			echo '<p/>';
		}
		catch (PDOException $e)
		{
			echo 'INSERT MENU FAILED: ' . $e->getMessage();
// Abort
		}
	}
	else{
		echo '<br/><h2 align="center"><b>請至少選擇一種餐點.</b></h2>';
	}

?>

<table align="center" id=container><tr><td>
			<table id=button_link align="center" width="100px" height="35px" onclick="location.href='view_menu.php'"><tr><td align="center">
				<b>回首頁</b>
			</td></tr></table>
			<br><br><br>

</td></tr></table>
	</body>
</html>
