<!DOCTYPE html>
<html lang="en">
	
	<head>
		<title>loged_ccc</title>
		<meta charset="UTF-8">
		<meta name="description" content="credit card comany">
		<meta name="keywords" content="loged_ccc, ccc, hy360">		
		<link rel="stylesheet" type="text/css" href="home.css">
		<link rel="stylesheet" type="text/css" href="side.css">
	</head>


	<body >

		<div id="mySidenav" class="sidenav">
		  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		  <a href="http://localhost/loged_merch.php">Home Page</a>
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
			<a href="http://localhost/loged_merch.php">
				<img style="width: 10%;" id=logo_image src="3.png" alt="No Image">
			</a>
			<h1 style="position: absolute; left: 40%; top:5%; color:black; font-family: sans-serif; text-align: center">Delete Account</h1>	
		</header>
		
		<?php
			require_once('connection.php');
			include 'tempId.php';
			$id = $tempId;

			$query = "SELECT name FROM customer WHERE ac_id=$id";
			$result = mysqli_query($db, $query);
			$row = mysqli_fetch_array($result);
			$name= $row['name'];

			$query = "SELECT * FROM merchant WHERE ac_id=$id";
			$result = mysqli_query($db, $query);	
			$row = mysqli_fetch_array($result);
			
			echo '<br><br><table align="center"
			cellspacing="5" cellpadding="8" border="solid">
			<tr><td align="left">' . 
			'Account ID</td><td align="left">' . 
			'Merchant name</td><td align="left">' .
			'Debt</td><td align="left">' . 
			'Profit</td><td align="left">' .
			'Supply</td>'. 
			'</tr>'.
			'<tr><td align="left">' . 
			$row['ac_id'] . '</td><td align="left">' . 
			$name . '</td><td align="left">' .
			$row['debt'] . '</td><td align="left">' . 
			$row['profit'] . '</td><td align="left">' .
			$row['supply'] . '</td>'.
			'</tr>'.'</table> <br>';

			if($row['debt']>0){
				echo '<p align="center"><br>You can not delete your account until you pay your debt';
				echo '<br>Your current debt: ' . $row['debt'] . '€ ';
				echo '<br><a href="http://localhost/pay_due_mer.php">Pay here</a></p>';
				
			}
			else{
				echo '<form method="post"><br>
	  			<input style="background-color: #d1d6a8;" type="submit" value="Delete" name="delete">
				</form>';
			}
		?>
	

		<?php
			require_once('connection.php');
			include 'tempId.php';
			$id = $tempId;

			if(isset($_POST['delete'])){
				
				$query = "UPDATE customer SET active='false' WHERE ac_id=$id";
				mysqli_query($db, $query);
				header('Location: http://localhost/home.php');
			}
			mysqli_close($db);
		?>

	</body>
</html>