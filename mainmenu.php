<?php
session_start();
if(!isset($_SESSION['username'])){
	$_SESSION['msg'] = "Please login to continue";
	header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="res/logousaha.png" sizes="16x16">
<link rel="stylesheet" type="text/css" href="css/fandom.css">
<link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
<title>GasOnline</title>
	<style type="text/css">
		#logo{			
			width: 20.1%;
			float: left;
		}
		body{
			margin-top: 3em;
			margin-left: 3em;
		}
		.myDiv {
		border: 3px outset red;
		background-color: white;
		}
		h2 {
		  color: black;
		}
	</style>
</head>
<body bgcolor=black>
<div id="logo">
	<img src="res/logousaha.png" width="100%">
</div>

<div id=login>
	<a href="destroy.php"><span id="logoutButton">Log Out</span></a><br><br>
	<?php echo $_SESSION['username'];?>
</div>
<br>

<div id="header"> <strong>PT. Anugrah Usaha Mita Mandiri</strong></div>

<table cellspacing="30px" cellpadding="100px">
<tr>

<td><div id="got"> 
<a href="menu.php" style="text-decoration: none;">
<img class="circle" src="res/main/belisekarang.png">
<p><strong>Beli Sekarang !</strong></p>
</a>
</div></td>

<td>
<div class="myDiv">
<h2>Lokasi Kami!</h2>
<div class="mapouter"><div class="gmap_canvas"><iframe width="350" height="350" id="gmap_canvas" src="https://maps.google.com/maps?ll=-7.203034199999998,107.9035269&q=PT ANUGRAH USAHA MITA MANDIRI&t=&z=14&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>undefined<a href="undefined">undefined</a>undefined</div><style>.mapouter{position:relative;text-align:right;height:350px;width:350px;}.gmap_canvas {overflow:hidden;background:none!important;height:350px;width:350px;}</style></div>
</div>
</td>

</tr>

</table>

</body>
</html>