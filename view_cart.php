<?php
session_start();
include_once("config.php");
?>
<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="res/logousaha.png" sizes="16x16">
<title>Keranja Belanja | GasOnline</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
<style type="text/css">
	#logo{
			padding-top: 0.7%;						
			width: 14%;
			height: 9.65%;
			float: left;
			position: fixed;
			margin-left: 2px;
		}
</style>
<!-- PAYPAL -->
 <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Ensures optimal rendering on mobile devices. -->
 <meta http-equiv="X-UA-Compatible" content="IE=edge" /> <!-- Optimal Internet Explorer compatibility -->
<!-- PAYPAL -->

<script type="text/javascript">
	function checkoutFunction(){
		
		
		alert("Your Order Has Been Placed!");
		window.location.assign("mainmenu.php");

	}
</script>
</head>
<body>

<div id="logo">
	<a href="menu.php">
		<img src="res/logousaha.png" width="100%">
	</a>
</div>

<h1 align="center" style="color:white;">Shopping Cart</h1>
<div class="cart-view-table-back">

<form method="post" action="cart_update.php">
<table width="100%"  cellpadding="6" cellspacing="0"><thead><tr><th>Quantity</th><th>Fandom</th><th>Category</th><th>Name</th><th>Price</th><th>Subtotal</th><th>Remove</th></tr></thead>
  <tbody>
 	<?php
	if(isset($_SESSION["cart_products"])) //check session var
    {
		$total = 0; //set initial total value
		$b = 0; //var for zebra stripe table 
		foreach ($_SESSION["cart_products"] as $cart_itm)
        {
			//set variables to use in content below
			$fandom = $cart_itm["fandom"];
			$category = $cart_itm["category"];
			$product_name = $cart_itm["product_name"];			
			$product_price = $cart_itm["product_price"];
			$product_code = $cart_itm["product_code"];		
			$product_qty = $cart_itm["product_qty"];	
			$subtotal = ($product_price * $product_qty); //calculate Price x Qty
			
		   	$bg_color = ($b++%2==1) ? 'odd' : 'even'; //class for zebra stripe 
		    echo '<tr class="'.$bg_color.'">';
		    echo '<td><input type="text" size="2" maxlength="2" name="product_qty['.$product_code.']" value="'.$product_qty.'" /></td>';
			echo '<td>'.$fandom.'</td>';
			echo '<td>'.$category.'</td>';
			echo '<td>'.$product_name.'</td>';			
			echo '<td>'.$currency.$product_price.'</td>';
			echo '<td>'.$currency.$subtotal.'</td>';
			echo '<td><input type="checkbox" name="remove_code[]" value="'.$product_code.'" /></td>';
            echo '</tr>';
			$total = ($total + $subtotal); //add subtotal to total var
        }
		
		
	}
    ?>
    <tr><td colspan="7">&nbsp;</td></tr>
    <tr><td colspan="6"><span style="float:right;text-align: right;">Total: Rp. <?php echo sprintf( $total);?></span></td></tr>

    <tr>
    	<td colspan="4"><a href="fandom.php" class="button">Add More Items</a></td>
    	<td><button type="submit">Update</button></td>
	
    	
    	<td><input type="button" onclick="checkoutFunction();" value="Checkout" id="checkoutButton"/></td>
    

    </tr>
	<input type="hidden" class="total" value="<?php echo sprintf($total);?>">

  </tbody>
</table>
<!-- PAYPAL -->
	<script src="https://www.paypal.com/sdk/js?client-id=AdoeBPQiTVtHkZzUxZkAh3jg-RL3vZrjDyO2acDFQ5OwJR1h7v_fCDLdFoRaLULFOg3xaHocriE1D4z3&currency=USD"></script>

	<div id="paypal-button-container"></div>

	<script>
		var total = document.getElementsByClassName("total")[0].value;
		paypal.Buttons({
			createOrder: function(data, actions) {
			  // This function sets up the details of the transaction, including the amount and line item details.
			  return actions.order.create({
				purchase_units: [{
				  amount: {
					value: total
				  }
				}]
			  });
			}
		}).render('#paypal-button-container');
	</script>

	<!-- PAYPAL -->
<input type="hidden" name="return_url" value="<?php 
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
echo $current_url; ?>" />
</form>
</div>

</body>
</html>
