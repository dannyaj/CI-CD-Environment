<?php session_start(); ?>

<?php
//連接資料庫

//include("mysql_connect.inc.php");

include("authenticate.php");

$v_UserID = $_POST['UserID'];
$v_UserPassword = $_POST['UserPassword'];

//echo $v_UserID; 
//echo $v_UserPassword; 

if(isset($v_UserID)){
	if(authenticate($v_UserID, $v_UserPassword)){
	//if($v_UserID=="liweichen"){
		// authentication passed
		$_SESSION['user'] = $v_UserID;
		//echo $_SESSION['user'];
		//echo "authentication passed";
		
		
		header("Location: view_menu.php");

		die();
	} else {
		// authentication failed
		//$error = 1;
		//echo "authentication failed";
		header("Location: index.php");
	}
}


//判斷帳號與密碼是否為空白
//以及MySQL資料庫裡是否有這個會員
//if($id != null && $pw != null && $row[1] == $id && $row[2] == $pw)
//{
        //將帳號寫入session，方便驗證使用者身份
//        $_SESSION['username'] = $id;
//        echo '登入成功!';
//        echo '<meta http-equiv=REFRESH CONTENT=1;url=member.php>';
//}
//else
//{
//        echo '登入失敗!';
//        echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
//}
?>
