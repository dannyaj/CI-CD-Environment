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
		
		<title>新增訂單</title>
		
		<link rel="shortcut icon" href="http://www.nexcom.com.tw/images/NEXCOM.jpg">
		<link rel="stylesheet" href="layout.css" type="text/css"/>
	</head>
	
	<body>
	<table align="center" id=container><tr><td>

	<h2 align="center">新增訂單</h2>
	<hr color="#777777" width="98%">

<?php

	require 'Connect_DB.php';
	require 'ValueDelimit.php';

	//$IP = getHostByName(getHostName());
	//echo $IP;

	$v_Person = $_POST["v_Person"];
	$v_Location = $_POST["v_Location"];
	
// set autocommit off
//begin transaction
	
	echo '';
	if(isset($_POST['new_list'])) {
	// Counting number of checked checkboxes.
		$v_Values = explode($ValueDelimit,$_POST["new_list"]);
		$v_MenuDetailId = $v_Values[0];
		$v_ProviderName = $v_Values[1];
		$v_FoodName = $v_Values[2];
		$v_FoodPrice = $v_Values[3];
		
		$sql = 'INSERT INTO "t_MenuOrderRecords"(
				"c_LocationID","c_MenuDetailId", "c_ProviderName", "c_FoodItemName", "c_FoodItemPrice", "c_UserID", "c_RecordCreatorID", "c_RecordLatestEditorID")
				VALUES (\''.$v_Location.'\', '.$v_MenuDetailId.', \''.$v_ProviderName.'\', \''.$v_FoodName.'\', \''.$v_FoodPrice.'\', \''.$v_Person.'\', \''.$_SESSION['user'].'\', \''.$_SESSION['user'].'\');';
// echo $sql;
	try
	{
		$statement = $connection->exec($sql);
// commit
		echo '<table id=content cellpadding="2" align="center">';			
		echo '<tr><td colspan="3" id=title><b>新增訂餐資料</b></td></tr>';	
		echo '<tr><td id=subtitle><b>訂餐人</b></td><td>'.$_SESSION['user'].'</td></tr>';
		echo '<tr><td id=subtitle><b>用餐人</b></td><td>'.$v_Person.'</td></tr>';
		echo '<tr><td id=subtitle><b>名稱</b></td><td>'.$v_FoodName.'</td></tr>';
		echo '<tr><td id=subtitle><b>供餐廠商</b></td><td>'.$v_ProviderName.'</td></tr>';
		echo '<tr><td id=subtitle><b>餐點單價</b></td><td>'.$v_FoodPrice.' 元</td></tr>';
		echo '</table>';
	}
	catch (PDOException $e)
	{
		echo 'INSERT ORDER FAILED: ' . $e->getMessage();
	}

	}
	else{
		echo "<b>請選擇一種餐點.</b>";
// Abort
	}

?>



<br><br>

			<table id=button_link align="center" width="100px" height="35px" onclick="history.back()"><tr><td align="center">
				<b>回前頁</b>
			</td></tr></table>
			<br><br><br>

</td></tr></table>
	</body>
</html>
