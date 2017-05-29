<!DOCTYPE html>
<html lang="en">
	
	<head>
		<title>loged_ccc</title>
		<meta charset="UTF-8">
		<meta name="description" content="credit card comany">
		<meta name="keywords" content="loged_ccc, ccc, hy360">
		<meta name="author" content="Vaggi-Leo-Kate">
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
			<h1 style="position: absolute; left: 40%; top:5%; color:black; font-family: sans-serif; text-align: center">Merchant of the Month</h1>	
		</header>
<form method="post" >


		<?php
			require_once('connection.php');

			
			echo '<table align="center"
				cellspacing ="5" cellpadding="8" border="2">

				<tr><td align= "left"><b>Account ID</b></td>
				<td align = "left"><b>Name</b></td>
				<td align = "left"><b>Supply</b></td>
				<td align = "left"><b>Profit</b></td>
				<td align = "left"><b>Debt</b></td></tr>';

			$sql="SELECT merch_name, COUNT(*) AS numoftrans FROM transaction WHERE tran_amount>0 AND tran_date BETWEEN (CURRENT_TIMESTAMP - INTERVAL 30 DAY) AND (CURRENT_TIMESTAMP) GROUP BY merch_name ORDER BY numoftrans DESC LIMIT 1";

			$res = @mysqli_query($db, $sql);
			if( $res -> num_rows >0) {
				while ($row = mysqli_fetch_array($res)){
					$merch_name=$row['merch_name'];
				}
			}

			$sql="SELECT * FROM merchant INNER JOIN customer ON customer.ac_id=merchant.ac_id WHERE customer.name='$merch_name'";
			$res = @mysqli_query($db, $sql);
			if( $res -> num_rows >0) {
				$row = mysqli_fetch_array($res);
				echo '<tr><td align ="left">'.
				$row['ac_id'] . '</td><td align = "left">'.
				$row['name'] . '</td><td align = "left">'.
				$row['supply'] . '</td><td align = "left">'.
				$row['profit'] . '</td><td align = "left">'.
				$row['debt'] . '</td></tr>';
			}	
			echo '</table>';

			if(isset($_POST['disc'])){
				$a= $row['ac_id'];
				$b= $row['debt'] - ($row['debt']* 5 / 100);
				$sql = "UPDATE merchant SET debt=$b WHERE ac_id=$a";
				mysqli_query($db, $sql);
				echo "<meta http-equiv='refresh' content='0'>";
			}


			mysqli_close($db);
		?>

		
			<br><br><input style="width: 200px; height: 25px; border: none;border-radius: 4px;background-color: #ccbe9f; color: black; margin-left: 2%;" type="submit" name="disc" value="Make Discount 5%">
		</form>




	</body>

</html>