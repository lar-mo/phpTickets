<?php

// database connect script.

//require 'db_connect.php';

if($logged_in == 1) {
	print "<html>
	<head>
	<title>Logged in already</title>
	<meta http-equiv=\"refresh\" content=\"0; url=secure.php\">
	</head>
	<body></body></html>
	"; 

}


?>

<?php

if (isset($_POST['submit'])) { // if form has been submitted


	/* check they filled in what they were supposed to and authenticate */
	if(!$_POST['uname'] | !$_POST['passwd']) {
		die('You did not fill in a required field.');
	}

	// authenticate.

	if (!get_magic_quotes_gpc()) {
		$_POST['uname'] = addslashes($_POST['uname']);
	}

	$check = $db_object->query("SELECT username, password FROM users WHERE username = '".$_POST['uname']."'");

	if (DB::isError($check)) {
		die('That username does not exist in our database.');
	}

	$info = $check->fetchRow();

	// check passwords match

	$_POST['passwd'] = stripslashes($_POST['passwd']);
	$info['password'] = stripslashes($info['password']);
	$_POST['passwd'] = md5($_POST['passwd']);

	if ($_POST['passwd'] != $info['password']) {
		die('Incorrect name and/or password, please try again.');
	}

	// if we get here username and password are correct, 
	//register session variables and set last login time.

	$date = date('m d, Y');

	$update_login = $db_object->query("UPDATE users SET last_login = '$date' WHERE username = '".$_POST['uname']."'");

	$_POST['uname'] = stripslashes($_POST['uname']);
	$_SESSION['username'] = $_POST['uname'];
	$_SESSION['password'] = $_POST['passwd'];
	$db_object->disconnect();
?>

	<html><head>
	<title>Logged in already</title>
	<meta http-equiv="refresh" content="0; url=secure.php">
	</head>
	<body>

<?php

} else {	// if form hasn't been submitted

?>
<html>
<head>
<title>Login</title>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#000000" alink="#000000" vlink="#000000" marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0 topmargin=0 bottommargin=0>
<?php
include('./includes/topframe_disabled.inc');
?>
<center>
<table border=0><tr><td align="center">
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
<img src="./images/login_logo1.jpg"></td></tr>
<tr><td>
<table border=0 cellpadding=5 width="100%" bgcolor="#CCCCCC">
<tr><th>Username</th><td bgcolor="#FFFFFF">
<input type="text" name="uname" maxlength="40">
</td></tr>
<tr><th>Password</th><td bgcolor="#FFFFFF">
<input type="password" name="passwd" maxlength="50">
</td></tr>
<tr><td colspan="2" align="right">
<input type="submit" name="submit" value="Login">
</td></tr></table>
</form>
</td></tr>
</table>
</center>
<?php
}
?>
</body>
</html>


