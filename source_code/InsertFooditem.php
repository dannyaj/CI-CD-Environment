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
		
		<title>新增餐點</title>
		
		<link rel="shortcut icon" href="http://www.nexcom.com.tw/images/NEXCOM.jpg">
		<link rel="stylesheet" href="layout.css" type="text/css"/>
	</head>
	
	<body>
<?php

	require 'Connect_DB.php';

	//$IP = getHostByName(getHostName());
	//echo $IP;

	//$v_FoodItemID = $_POST["v_FoodItemID"];
	$v_ProviderID = $_POST["v_ProviderID"];
	$v_FoodItemName = $_POST["v_FoodItemName"];
	$v_FoodItemDescription = $_POST["v_FoodItemDescription"];

	$v_FoodItemPrice = $_POST["v_FoodItemPrice"];
	//$v_FoodItemImagePath = $_POST["v_FoodItemImagePath"];


	$v_FoodItemRemark = $_POST["v_FoodItemRemark"];
	$v_FoodItemIsEffective = $_POST["v_FoodItemIsEffective"];

	
$sql = 'INSERT INTO "t_FoodItems"(
            "c_ProviderID", "c_FoodItemName", "c_FoodItemDescription", 
            "c_FoodItemPrice", "c_FoodItemImagePath", "c_FoodItemRemark", 
            "c_FoodItemIsEffective", "c_FoodItemCreationDateTime", "c_FoodItemLatestModifyDateTime")
    VALUES (\''.$v_ProviderID.'\', \''.$v_FoodItemName.'\', NULL, 
            '.$v_FoodItemPrice.', NULL, NULL, 
            '.$v_FoodItemIsEffective.', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);';

//echo $sql;
try
{
	$statement = $connection->exec($sql);
}
catch (PDOException $e)
{
    echo 'INSERT FOOD ITEM FAILED: ' . $e->getMessage();
}


?>

<table align="center" id=container><tr><td>

<h2 align="center">新增餐點完畢</h2>
			<hr color="#777777" width="98%">

<?php
echo '<table id=content cellpadding="2" align="center">
				
				<tr><td colspan="3" id=title><b>餐點資料</b></td></tr>	
				<tr><td id=subtitle><b>名稱</b></td><td>'.$v_FoodItemName.'</td></tr>
				<tr><td id=subtitle><b>供餐廠商</b></td><td>'.$v_ProviderID.'</td></tr>
				<tr><td id=subtitle><b>有效否</b></td><td>'.$v_FoodItemIsEffective.'</td></tr>
				<tr><td id=subtitle><b>餐點描述</b></td><td>'.$v_FoodItemDescription.'</td></tr>
				<tr><td id=subtitle><b>餐點單價</b></td><td>'.$v_FoodItemPrice.' 元</td></tr>
				
				<tr><td colspan="3" id=title><b>其他說明</b></td></tr>
				<tr><td id=subtitle><b>相關備註</b></td><td>'.$v_FoodItemRemark.'</td></tr>
				
			</table>';

?>

<br><br>

			<table id=button_link align="center" width="100px" height="35px" onclick="history.back()"><tr><td align="center">
				<b>回前頁</b>
			</td></tr></table>
			<br><br><br>
</td></tr></table>
	</body>
</html>
