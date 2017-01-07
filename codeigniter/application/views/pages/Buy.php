<html>
<html>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/style.css">
<head>
 <title>Shopping Basket</title>
 </head>
<body>
	<?php
	$totprice = 0;
	if(sizeof($_SESSION['shoppingbasketFin'])>0){
		?>
	<div align="center">
	</br></br><h2>Shopping Basket</h2>
		<form method = "get" action="<?php echo base_url(); ?>Pages/transaction">
 		<table id="table1">
 			<tr><th>ISBN</th>
      		<th>Title</th>
      		<th>Author</th>
      		<th>Quantity</th>
      		<th>Price</th>
	<?php
	foreach ($_SESSION['shoppingbasketFin'] as $var ) 
	{?>
   			<tr><td><?php echo $var['isbn'] ; ?></td>
      		<td><?php echo $var['title'] ; ?></td>
      		<td><?php echo $var['authorname'] ; ?></td>
      		<td><?php echo $var['quantity'] ; ?></td>
      		<td><?php echo "$".$var['price'] * $var['quantity'] ; ?></td>	
	<?php
	$totprice = $totprice + ($var['price'] * $var['quantity']);
	}
	echo "</table></br></br>";
	}
	else
	{
		echo "</br><h2>No Items in Shopping Basket</h2>";
	}
	
	?>
	<label>Total Price: </label>
	<input type="text" name="price" value="$<?=$totprice?>" disabled>&nbsp&nbsp&nbsp
	<input type="submit" name="buy" value="Buy">
	</form>
</body>
</html>