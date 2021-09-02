<?php
	session_start();

	$db=mysqli_connect("localhost","root", "","gasonline");
	if(isset($_POST['signup'])) {

		$fname = ($_POST['fname']);
		$lname = ($_POST['lname']);
		$password = ($_POST['password']);
		$email = ($_POST['email']);
		$phone = ($_POST['phone']);
		$sql;
		$check = 0;
		$password=md5($password);
		
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
     $dat = "SELECT email FROM users WHERE email = '".mysqli_real_escape_string($db,$email )."'";
	$r = @mysqli_query ($db, $dat);
		
		if (mysqli_num_rows($r) >= 1) { // already in use?
			$error[] ='The email is already in use please try another email.';
		}else{
			$sql = "INSERT INTO users(fname,lname,phone,email,password) values ('$fname','$lname','$phone','$email','$password')";
			$h = mysqli_query($db, $sql);
			$check = 1;
		} 


if ($check == 1) 
{
		echo '<h1><center><img src="res/logousaha.png"></center></h1>';
		echo '<table class="tborder" cellpadding="6" cellspacing="1" border="1" width="70%" align="center">';
		echo'<tbody><tr>';
		echo'<td class="tcat">Message</td>';
		echo'</tr>';
		echo'<tr>';
		echo'<td class="panelsurround" align="center">';
		echo'<div class="panel">';
		echo'<div align="left">';

		echo'<div style="margin: 10px">Your account was successfully created.<br><br>';
		echo'<font color="red">Go back to login please click <a href="index.php">here</a>!</font><br><br>';

		echo'</div>';
		echo'</div>';

		echo'</td>';
		echo'</tr>';
		echo'</tbody></table>';
} 
else 
{
		echo '<h1><center><img src="res/logousaha.png"></center></h1>';
		echo '<table class="tborder" cellpadding="6" cellspacing="1" border="1" width="70%" align="center">';
		echo'<tbody><tr>';
		echo'<td class="tcat">Message</td>';
		echo'</tr>';
		echo'<tr>';
		echo'<td class="panelsurround" align="center">';
		echo'<div class="panel">';
		echo'<div align="left">';

		echo'<div style="margin: 10px">Your email has been registered, please use another email to create a new account or please login.<br><br>';
		echo'<font color="red">Go back to login please click <a href="index.php">here</a>!</font><br><br>';

		echo'</div>';
		echo'</div>';

		echo'</td>';
		echo'</tr>';
		echo'</tbody></table>';
}

	}
?>
		