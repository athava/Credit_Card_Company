<!DOCTYPE html>
<html lang="en">
	
	<head>
		<title>loged_ccc</title>
		<meta charset="UTF-8">
		<meta name="description" content="credit card comany">
		<meta name="keywords" content="bad_customer, ccc, hy360">		
		<link rel="stylesheet" type="text/css" href="home.css">
		<link rel="stylesheet" type="text/css" href="side.css">
	</head>

	<body >
		<div id="mySidenav" class="sidenav">
		  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		  <a href="http://localhost/loged_ccc.php">Home Page</a>
		  <a href="http://localhost/home.php">Log out</a>
		</div>

		
		<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>

		<script>
			function openNav() {
			    document.getElementById("mySidenav").style.width = "250px";
			}

			function closeNav() {
			    document.getElementById("mySidenav").style.width = "0";
			}
		</script>

		<header>
			<a href="http://localhost/loged_ccc.php">
				<img style="width: 10%;" id=logo_image src="3.png" alt="No Image">
			</a>
			<h1 style="position: absolute; left: 40%; top:5%; color:black; font-family: sans-serif; text-align: center">Bad Customer Status</h1>	
		</header>

		<?php
		
			require_once('connection.php');

			echo '<table align="center"
				cellspacing="5" cellpadding="8" border="solid">
				<tr><td align="left"><b>Accound ID</b></td>
				<td align="left"><b>Name</b></td>
				<td align="left"><b>Due Amount</b></td></tr>
				<td align="left" border="none"><b>Customers</b></td>
				
				';

				$query = "SELECT customer.name, customer.ac_id, simple_cust.cur_due_amount FROM customer INNER JOIN simple_cust ON customer.ac_id=simple_cust.ac_id WHERE customer.active='true' AND simple_cust.cur_due_amount>0 ORDER BY simple_cust.cur_due_amount DESC";
				$res = @mysqli_query($db, $query);
				if( $res -> num_rows >0) {
					while ($row = mysqli_fetch_array($res)){
						echo '<tr><td align="left">' .
						$row['ac_id'] . '</td><td align="left">' .
						$row['name'] . '</td><td align="left">'.
						$row['cur_due_amount']. '</td>';
						echo '</tr>';
					}
				}		

			echo '<td align="left"  ><b border="none">Merchants</b></td>';

			$query ="SELECT customer.name, customer.ac_id, merchant.debt FROM customer INNER JOIN merchant ON customer.ac_id=merchant.ac_id WHERE customer.active='true' AND merchant.debt>0 ORDER BY  merchant.debt DESC";
			$res = @mysqli_query($db, $query);
			if( $res -> num_rows >0) {
				while ($row = mysqli_fetch_array($res)){
					echo '<tr><td align="left">' .
					$row['ac_id'] . '</td><td align="left">' .
					$row['name'] . '</td><td align="left">'.
					$row['debt']. '</td>';
					echo '</tr>';
				}
			}	
			
			
			echo "</table>";
			mysqli_close($db);
		?>
	</body>



</html>



