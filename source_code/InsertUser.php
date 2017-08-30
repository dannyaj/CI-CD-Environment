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
		
		<title>新增使用者</title>
		
		<link rel="shortcut icon" href="http://www.nexcom.com.tw/images/NEXCOM.jpg"/>
		<link rel="stylesheet" href="layout.css" type="text/css"/>

	</head>
	
	<body>
<?php

	require 'Connect_DB.php';

	//$IP = getHostByName(getHostName());

	//echo $IP;

	$v_UserID = $_POST["v_UserID"];
	$v_UserAccount = $_POST["v_UserAccount"];
	$v_UserPassword = $_POST["v_UserPassword"];
	$v_UserPasswordConfirm = $_POST["v_UserPasswordConfirm"];

	$v_UserPermissionID = $_POST["v_UserPermissionID"];
	$v_UserIsEffective = $_POST["v_UserIsEffective"];


	$v_UserName = $_POST["v_UserName"];
	$v_UserNameEN = $_POST["v_UserNameEN"];
	$v_UserDepartmentID = $_POST["v_UserDepartmentID"];
	$v_UserLocationID = $_POST["v_UserLocationID"];


	$v_UserPhone = $_POST["v_UserPhone"];
	$v_UserPhoneExtention = $_POST["v_UserPhoneExtention"];
	$v_UserFax = $_POST["v_UserFax"];
	$v_UserEmail = $_POST["v_UserEmail"];
	$v_UserMobilePhone = $_POST["UserMobilePhone"];
	

	$v_UserRemark = $_POST["v_UserRemark"];
	


	if($v_UserPassword != $v_UserPasswordConfirm){
		echo 'Password Error!';
	}else{
		
	//if($v_UserAccount==""){
	//	$v_UserAccountb = "NULL"
	//}


$sql = 'INSERT INTO "t_Users"("c_UserID", "c_UserAccount", "c_UserName", "c_UserNameEN", "c_UserPassword", "c_UserDepartmentID", "c_UserLocationID", "c_UserPhone", "c_UserPhoneExtension", "c_UserFax","c_UserMobilePhone", "c_UserEmail", "c_UserRemark", "c_UserIsEffective", "c_UserCreationDateTime", "c_UserLatestModifyDateTime", "c_UserLatestEditorID", "c_UserPermissionID")
    VALUES (\''.$v_UserID.'\', \''.$v_UserAccount.'\', \''.$v_UserName.'\', \''.$v_UserNameEN.'\', \''.$v_UserPassword.'\', 
           \''.$v_UserDepartmentID.'\', \''.$v_UserLocationID.'\', \''.$v_UserPhone.'\', \''.$v_UserPhoneExtention.'\', 
           \''.$v_UserFax.'\', \''.$v_UserMobilePhone.'\', \''.$v_UserEmail.'\', \''.$v_UserRemark.'\', 
           '.$v_UserIsEffective.', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP,
            \'3263\', \''.$v_UserPermissionID.'\');';

//echo $sql;

try
{
	$statement = $connection->exec($sql);
}
catch (PDOException $e)
{
    echo 'INSERT PROVIDER FAILED: ' . $e->getMessage();
}

//echo 'Finish';

	}


?>

<?php
			echo '<table id=content cellpadding="2" align="center">
			
				<tr><td colspan="3" id=title><b>帳號與密碼</b></td></tr>
				<tr><td id=subtitle><b>帳號</b></td><td id=input_block>'.$v_UserID.'</td></tr>
				<tr><td id=subtitle><b>AD帳號</b></td><td id=input_block>'.$v_UserAccount.'</td></tr>
				<tr><td id=subtitle><b>密碼</b></td><td id=input_block>'.$v_UserPassword.'</td></tr>
				<tr><td id=subtitle><b>權限等級</b></td><td id=input_block>'.$v_UserPermissionID.'</td></tr>
				<tr><td id=subtitle><b>有效否</b></td><td id=input_block>'.$v_UserIsEffective.'</td></tr>

				<tr><td colspan="3" id=title><b>個人資料</b></td></tr>
				<tr><td id=subtitle><b>中文姓名</b></td><td id=input_block>'.$v_UserName.'</td></tr>
				<tr><td id=subtitle><b>英文姓名</b></td><td id=input_block>'.$v_UserNameEN.'</td></tr>
				<tr><td id=subtitle><b>部門</b></td><td id=input_block>'.$v_UserDepartmentID.'</td></tr>
				<tr><td id=subtitle><b>位置</b></td><td id=input_block>'.$v_UserLocationID.'</td></tr>
				
				<tr><td colspan="3" id=title><b>聯絡資訊</b></td></tr>
				<tr><td id=subtitle><b>電話</b></td><td id=input_block>'.$v_UserPhone.'</td></tr>
				<tr><td id=subtitle><b>分機</b></td><td id=input_block>'.$v_UserPhoneExtention.'</td></tr>
				<tr><td id=subtitle><b>傳真</b></td><td id=input_block>'.$v_UserFax.'</td></tr>
				<tr><td id=subtitle><b>電子郵件</b></td><td id=input_block>'.$v_UserEmail.'</td></tr>
				<tr><td id=subtitle><b>行動電話</b></td><td id=input_block>'.$v_UserMobilePhone.'</td></tr>
				
				<tr><td colspan="3" id=title><b>其他說明</b></td></tr>
				<tr><td id=subtitle><b>相關備註</b></td><td id=input_block>'.$v_UserRemark.'</td></tr>
			</table>';
?>
			<br><br>
			<table id=button_link align="center" width="100px" height="35px" onclick="location.href='http://10.10.1.96/meal/fooditem_edit.php';"><tr><td align="center">
				<b>回前頁</b>
			</td></tr></table>
			<br><br><br>
	</body>
	
</html>
