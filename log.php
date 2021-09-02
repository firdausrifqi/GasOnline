
<?php
session_start();

if($_SERVER['REQUEST_METHOD']=='POST')
{
	$username=filter($_POST['username']);
	$password=filter($_POST['password']);
	$password=md5($password);
	

	$dbc=mysqli_connect('localhost','root','','gasonline') or die("Cannot connect to Database ");
	$query="SELECT * FROM users WHERE email='".$username."' AND password='".$password."' ";
	$result=mysqli_query($dbc,$query);
	if(mysqli_num_rows($result)==1)                         
	{
		$row=mysqli_fetch_array($result);
		$_SESSION['username']=$username;	
	}
	else
	{

		$_SESSION['msg'] = "Please login to continue";
		echo '<h1><center><img src="res/logousaha.png"></center></h1>';
		echo '<table class="tborder" cellpadding="6" cellspacing="1" border="1" width="70%" align="center">';
		echo'<tbody><tr>';
		echo'<td class="tcat">Message</td>';
		echo'</tr>';
		echo'<tr>';
		echo'<td class="panelsurround" align="center">';
		echo'<div class="panel">';
		echo'<div align="left">';

		echo'<div style="margin: 10px">You have entered an invalid username or password. Please press the back button, enter the correct details and try again. Dont forget that the password is case sensitive.<br><br>';
		echo'<font color="red">Go back please click <a href="index.php">here</a>!</font><br><br>';

		echo'</div>';
		echo'</div>';

		echo'</td>';
		echo'</tr>';
		echo'</tbody></table>';
	}
}

if(isset($_SESSION['username'])){

	$uname=$_SESSION['username'];
	if($uname=='admin@example.com'){
	header("Location: admin.php");
	}
	else
	header("Location: mainmenu.php");
}
function filter($str)
{
	trim($str);
	htmlspecialchars($str);
	
	return($str);
}
?>


