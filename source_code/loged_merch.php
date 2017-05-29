<!DOCTYPE html>
<html lang="en">
	
	<head>
		<title>loged merchant</title>
		<meta charset="UTF-8">
		<meta name="description" content="credit card comany">
		<meta name="keywords" content="loged_merchant, ccc, hy360">		
		<link rel="stylesheet" type="text/css" href="home.css">
		<link rel="stylesheet" type="text/css" href="side.css">
	</head>


	<body >

		<div id="mySidenav" class="sidenav">
		  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
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
			<img style="width: 10%;" id=logo_image src="3.png" alt="No Image">
			<h1 style="position: absolute; left: 40%; top:5%; color:black; font-family: sans-serif; text-align: center">Welcome Merchant</h1>	
		</header>

		<?php 
			include 'tempId.php';
    		$ac_id = $tempId;

			require_once('connection.php');
				
			$sql = "SELECT * FROM merchant WHERE ac_id =$ac_id";
			$result = mysqli_query($db, $sql);

			$sql1 = "SELECT name FROM customer WHERE ac_id =$ac_id";
			$result1 = mysqli_query($db, $sql1);
			
			echo '<table align="center"
				cellspacing="5" cellpadding="8" border="solid">

				<tr><td align="left"><b>Accound ID</b></td>
				<td align="left"><b>Name</b></td>
				<td align="left"><b>Supply</b></td>
				<td align="left"><b>Profit</b></td>
				<td align="left"><b>Debt</b></td>
				</tr>';





			if( $result -> num_rows >0 && $result1 -> num_rows >0) {
				$row = mysqli_fetch_array($result);
				$row1 = mysqli_fetch_array($result1);
				echo '<tr><td align="left">' . 
				$row['ac_id'] . '</td><td align="left">' . 
				$row1['name'] . '</td><td align="left">' .
				$row['supply'] . '</td><td align="left">' .
				$row['profit'] . '</td><td align="left">' . 
				$row['debt'] . '</td>' ;
				echo '</tr>';
				
			}
			echo '</table>';
			
			mysqli_close($db);
		?>


		<br><br><p  style="text-align: center; margin-right: 10%;">choose option:</p>

		<br>
		<form style=" margin-right: 10%;" action="pay_due_mer.php" >
			<button >Pay Dept</button>
		</form>
		
		<br>
		<form style=" margin-right: 10%;" action="http://localhost/search_merch.php" >
			<button>Transactions Status</button>
		</form>

		<br><form style=" margin-right: 10%;" action="http://localhost/delete_merchant.php" >
				<button>Delete Acount</button>
			</form>

	</body>
</html>