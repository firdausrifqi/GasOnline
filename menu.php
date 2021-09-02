<?php
session_start();
include_once("config.php");

if(!isset($_SESSION['username'])){
	$_SESSION['msg'] = "Please login to continue";
	header("Location: index.php");
}
//current URL of the Page. cart_update.php redirects back to this URL
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Menu | GasOnline</title>
	<link rel="icon" href="res/logousaha.png" sizes="16x16">
	<link rel="stylesheet" type="text/css" href="css/sidebar.css">
	<link rel="stylesheet" type="text/css" href="css/navbar.css">

	<link rel="stylesheet" type="text/css" href="css/content.css">
	<!--BOOTSTRAP-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>

	<style type="text/css">
		body{
			margin: 0;						
		}
		#logo{
			padding-top: 0.7%;			
			background-color: #333;
			width: 15%;
			height: 9.99%;
			float: left;
			position: fixed;
		}
		li:not(:last-child) {
			margin-right: 5px;
		}
	</style>
	
</head>

<body>

<div id="logo">
	<a href="mainmenu.php">
		<img src="res/logousaha.png" width="100%">
	</a>
</div>


<div id="sidebar">
	<ul>
		<li>Welcome <?php echo $_SESSION['username'];?></li>
		
		<li><a href="view_cart.php"><table><tr><td><img src="res/icons/cart.png" /></td>
		<td>&nbsp;Shopping Cart</td></tr></table></a></li>
		
		<li><a href="#clothing"><table><tr><td><img src="res/icons/gas.png" /></td>
		<td>&nbsp;GAS</td></tr></table></a></li>
	<!-- 
		<li><a href="#acc"><table><tr><td><img src="res/icons/accessories.png" /></td>
		<td>&nbsp;Accessories</td></tr></table></a></li>

		<li><a href="#sou"><table><tr><td><img src="res/icons/souvenir.png" /></td>
		<td>&nbsp;Souvenir</td></tr></table></a></li>		
	-->
		<li>&nbsp;</li>

		<li><a href="view_cart.php"><table><tr><td><img src="res/icons/checkout.png" /></td>
		<td>&nbsp;Checkout&nbsp;</td><td><img src="res/icons/new_page.png" /></td></tr></table></a></li>

		<li>
			<a href="destroy.php"> 
			<table><tr><td><img src="res/icons/logout.png" /></td>
			<td>&nbsp;Logout</td></tr></table></a>
		</li>

		<li>&nbsp;</li>		
		
		<li><a href="https://goo.gl/forms/jhAHet2TLLPIOQff1" target="_blank"><table><tr><td><img src="res/icons/request.png" /></td>
		<td>&nbsp;Request Here&nbsp;</td><td><img src="res/icons/new_page.png" /></td></tr></table></a></li>
	</ul>
</div>

<div id="navbar">
	<ul>
		<li><a class="active" href="got.php">Gas Elpiji</a></li>
		<li><a class="active" href="got.php">Gas Elpiji</a></li>
	</ul>
</div>


<!-- BACK TO TOP-->
<a href="#" class="back-to-top">Back To Top </a>

<!--CONTENT-->

<div class="content">
	<section class="container">


<!-- View Cart Box Start -->

<div id="cart">
<?php
if(isset($_SESSION["cart_products"]) && count($_SESSION["cart_products"])>0)
{
	
	echo '<h3>Your Shopping Cart</h3>';
	echo '<form method="post" action="cart_update.php">';
	echo '<table width="100%"  cellpadding="6" cellspacing="0">';
	echo '<thead><tr><th>Quantity</th><th>Fandom</th><th>Name</th><th>Remove</th></tr></thead>';
	echo '<tbody>';


	$total =0;
	$b = 0;


	foreach ($_SESSION["cart_products"] as $cart_itm)
	{
		$fandom = $cart_itm["fandom"];
		$category = $cart_itm["category"];
		$product_name = $cart_itm["product_name"];
		$product_qty = $cart_itm["product_qty"];
		$product_price = $cart_itm["product_price"];
		$product_code = $cart_itm["product_code"];
		
		$bg_color = ($b++%2==1) ? 'odd' : 'even'; //zebra stripe



		echo '<tr class="'.$bg_color.'">';
		echo '<td><input type="text" size="2" maxlength="2" name="product_qty['.$product_code.']" value="'.$product_qty.'" /></td>';
		echo '<td>'.$fandom.'</td>';
		echo '<td>'.$product_name.'</td>';
		echo '<td><input type="checkbox" name="remove_code[]" value="'.$product_code.'" /> Remove</td>';
		echo '</tr>';
		$subtotal = ($product_price * $product_qty);
		$total = ($total + $subtotal);
	}

	echo '<tr><td>&nbsp;</td></tr>';
	echo '<tr>';
	
	echo '<td>&nbsp;</td>';
	echo '<td>';
	echo '<button type="submit" id="myButton">Update</button></td>';


	echo '<td><a href="view_cart.php" id="myButton" style="width: 25%; padding-left: 8px;">Checkout</a>';
	echo '</td>';
	echo '</tr>';
	echo '</tbody>';
	echo '</table>';
	
	$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	echo '<input type="hidden" name="return_url" value="'.$current_url.'" />';
	echo '</form>';
	

}
?>
</div>
<!-- View Cart Box End -->

<!-- Products List Start CLOTHING -->
<h3>GAS</h3>
<div class="row" id="clothing">
<?php
$results = $mysqli->query("SELECT product_code, product_name, product_img_name, price FROM products WHERE category='Gas' AND fandom='Elpiji' ORDER BY id ASC");
if($results){ 
$products_item = '<ul style="list-style-type: none;">';
//fetch results set as object and output HTML

while($obj = $results->fetch_object())
{
$products_item .= <<<EOT
	
	<div class="col-sm-4">
	<div class="box">
	<li class="product">
	<form method="post" action="cart_update.php">	
	<img src="res/got/{$obj->product_img_name}">
	<p align="center">{$obj->product_name}</p>
	<p align="center" style="font-size: 1.2em;">{$currency}{$obj->price} </p>
	
	
	<input type="hidden" name="product_code" value="{$obj->product_code}" />
	
	<input type="hidden" name="type" value="add" />
	<input type="hidden" name="return_url" value="{$current_url}" />

	<div align="center">
		<label>Quantity: </label>
		<input type="text" size="2" maxlength="2" name="product_qty" value="1"/>&nbsp;&nbsp;
		<button type="submit" class="add_to_cart" id="myButton">Add to Cart</button>
	</div>
	
	</form>
	</li>
	</div>
	</div>
	
EOT;
}
$products_item .= '</ul>';
echo $products_item;
}
?>    
</div>
<!-- Products List End CLOTHING -->



<!-- Products List Start ACC -->
<!-- <h3>ACCESSORIES</h3> -->
<div class="row" id="acc">
<?php
$results = $mysqli->query("SELECT product_code, product_name, product_img_name, price FROM products WHERE category='Accessories' AND fandom='Game of Thrones' ORDER BY id ASC");
if($results){ 
$products_item = '<ul style="list-style-type: none;">';
//fetch results set as object and output HTML

while($obj = $results->fetch_object())
{
$products_item .= <<<EOT
	
	<div class="col-sm-4">
	<div class="box">
	<li class="product">
	<form method="post" action="cart_update.php">	
	<img src="res/got/{$obj->product_img_name}">
	<p align="center">{$obj->product_name}</p>
	<p align="center" style="font-size: 1.2em;">{$currency}{$obj->price} </p>
	
	
	<input type="hidden" name="product_code" value="{$obj->product_code}" />
	
	<input type="hidden" name="type" value="add" />
	<input type="hidden" name="return_url" value="{$current_url}" />

	<div align="center">
		<label>Quantity: </label>
		<input type="text" size="2" maxlength="2" name="product_qty" value="1"/>&nbsp;&nbsp;
		<button type="submit" class="add_to_cart" id="myButton">Add to Cart</button>
	</div>
	
	</form>
	</li>
	</div>
	</div>
	
EOT;
}
$products_item .= '</ul>';
echo $products_item;
}
?>    
</div>
<!-- Products List End Acc-->



<!-- Products List Start SOUVENIR -->
<!-- <h3>SOUVENIR</h3> -->
<div class="row" id="sou">
<?php
$results = $mysqli->query("SELECT product_code, product_name, product_img_name, price FROM products WHERE category='Souvenir' AND fandom='Game of Thrones' ORDER BY id ASC");
if($results){ 
$products_item = '<ul style="list-style-type: none;">';
//fetch results set as object and output HTML

while($obj = $results->fetch_object())
{
$products_item .= <<<EOT
	
	<div class="col-sm-4">
	<div class="box">
	<li class="product">
	<form method="post" action="cart_update.php">	
	<img src="res/got/{$obj->product_img_name}">
	<p align="center">{$obj->product_name}</p>
	<p align="center" style="font-size: 1.2em;">{$currency}{$obj->price} </p>
	
	
	<input type="hidden" name="product_code" value="{$obj->product_code}" />
	
	<input type="hidden" name="type" value="add" />
	<input type="hidden" name="return_url" value="{$current_url}" />
	
	<div align="center">
		<label>Quantity: </label>
		<input type="text" size="2" maxlength="2" name="product_qty" value="1"/>&nbsp;&nbsp;
		<button type="submit" class="add_to_cart" id="myButton">Add to Cart</button>
	</div>
	
	</form>
	</li>
	</div>
	</div>
	
EOT;
}
$products_item .= '</ul>';
echo $products_item;
}
?>    
</div>
<!-- Products List End SOUVNEIR -->


</section>
</div>



<!--FOOTER-->

<footer class="container">
	<div class="row">	
		<p class="col-sm-6">
			&copy; 2020 0MRX0 | Made with<i style="color: #fd4b4b;">&nbsp; X &nbsp;</i>in Banten
		</p>

		<ul class="col-sm-6">
			<li class="col-sm-1">
				<a href="mailto:firdausrifqi123@gmail.com" target="_blank">
					<img src="res/social media/help.png">
				</a>
			</li>
			<li class="col-sm-1">
				<a href="https://twitter.com/MRifqi_99" target="_blank">
					<img src="res/social media/twitter.png">
				</a>
			</li>
			<li class="col-sm-1">
				<a href="https://www.facebook.com/rifqifirdaus123/" target="_blank">
					<img src="res/social media/facebook.png">
				</a>
			</li>
			<li class="col-sm-1">
				<a href="https://www.instagram.com/mrifqi_99/" target="_blank">
					<img src="res/social media/instagram.png">
				</a>
			</li>
			<li class="col-sm-1"> 
				<a href="https://www.youtube.com/channel/UCKDmz3tV6h5nibMisRDL4iw" target="_blank">
				<img src="res/social media/youtube.png">
			</li>
		</ul>
	</div>
</footer>


</body>
</html>