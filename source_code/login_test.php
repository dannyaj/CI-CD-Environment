<head>
    <meta charset="UTF-8">
    <title>NEX BenDon</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/jumbotron-narrow.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="shortcut icon" href="../assets/images/icon_128.ico" />
</head>


<?php

 //echo "1";
// check to see if user is logging out
if(isset($_GET['out'])) {
	// destroy session
	session_unset();
	$_SESSION = array();
	unset($_SESSION['user'],$_SESSION['access']);
	session_destroy();
}
//echo "2";
// check to see if login form has been submitted

session_start();
include("authenticate.php");

if(isset($_POST['userLogin'])){
	
	// run information through authenticator
	if(authenticate($_POST['userLogin'],$_POST['userPassword']))
	{
		$_SESSION['user'] = $_POST['userLogin'];
		//echo $_SESSION['user'];
		//echo "authentication passed";
		// authentication passed //
		
		//判斷權限//
		//菜單管理者//
		if($_SESSION['user']=="oscarlu"){
		header("Location: menu_editer_view.php");
		}
		//一般使用者//
		else{
		header("Location: test_menu.php");
		}
		die();
	} else {
		// authentication failed
		$error = 1;
	}
}
 
// output error to user
if(isset($error)) echo "Login failed: Incorrect user name, password, or rights<br /-->";
// output logout success
if(isset($_GET['out'])) echo "Logout successful";
?>


<body>
<div class="container">
    <h2>login</h2>
	<form action="login.php" method="post">
	<h2 class="form-signin-heading"></h2>
		User: <input type="text" class="form-control" name="userLogin" required autofocus/><br />
		Password: <input type="password" class="form-control" name="userPassword" required /><br />
		<input type="submit" name="submit" value="Submit" />
	</form>
</div>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
