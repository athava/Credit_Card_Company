<!DOCTYPE html>
<html lang="en">
	
	<head>
		<title>create account</title>
		<meta charset="UTF-8">
		<meta name="description" content="fill in form for new account">
		<meta name="keywords" content="homepage, ccc, hy360">		
		<link rel="stylesheet" type="text/css" href="home.css">
		<link rel="stylesheet" type="text/css" href="side.css">
	</head>

	

	<body >
		<div id="mySidenav" class="sidenav">
			  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
			  <a href="http://localhost/loged_ccc.php">Home Page</a>
			  <a href="http://localhost/new_account.php">New Account</a>
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
			<h1 style="position: absolute; left: 40%; top:5%; color:black; font-family: sans-serif; text-align: center">New Merchant Account</h1>	
		</header>


		<form  style="margin-right:30%"  method="post">
  			Acount Id:*<input id="fill_in" type="number" name="account_id" placeholder="π.χ. 12345"><br><br>
  			Name:*<input id="fill_in" type="text" name="name" placeholder="π.χ. babis"><br><br>
  			Supply For CCC( Percentage )*<input id="fill_in" type="number" step=0.000001 name="supply"  placeholder="π.χ. 15"><br><br>
  			
  			
  			<br><br><input style="background-color: #d1d6a8;" type="submit" name="submit" value="Submit">
		</form>
		
		<?php

			if(isset($_POST["submit"])){

				require_once('connection.php');

				$query = "INSERT INTO customer (ac_id, name, active) VALUES (?,?,'true')";
				$query2 = "INSERT INTO merchant (ac_id, supply, profit , debt) VALUES (?,?,0,0)";
				
				$stmt= mysqli_prepare($db, $query);
				$stmt2= mysqli_prepare($db, $query2);

				$ac_id = trim( $_POST['account_id']);
				$name = trim($_POST['name']);

				$supply = trim( $_POST['supply']);

				mysqli_stmt_bind_param($stmt, "is", $ac_id, $name);
				mysqli_stmt_bind_param($stmt2, "id",$ac_id, $supply);

				mysqli_stmt_execute($stmt);
				mysqli_stmt_execute($stmt2);

				$rows= mysqli_stmt_affected_rows($stmt);
				$rows2= mysqli_stmt_affected_rows($stmt2);

				if($rows >0  && $rows2 >0){	
					echo 'New Merchant Entered <br/>'; 
				}
				else{
					echo 'Account already exists <br/>';
				}
				
				mysqli_stmt_close($stmt);
				mysqli_stmt_close($stmt2);		
				mysqli_close($db);

			}
			
		?>
		
		
		
	</body>
</html>