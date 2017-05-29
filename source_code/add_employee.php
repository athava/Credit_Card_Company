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
		  <a href="http://localhost/loged_company.php">Home Page</a>
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
			<h1 style="position: absolute; left: 40%; top:5%; color:black; font-family: sans-serif; text-align: center">New Company Account</h1>	
		</header>


		
		<form method="post"  style="margin-right:30%" >
  			Employee Id:*<input id="fill_in" type="text" name="Employee_id" placeholder="π.χ. AT1254"><br><br>
  			Employee Name:*<input id="fill_in" type="text" name="Employee_name" placeholder="π.χ. Giannis"><br><br>
  			
  			<input style="background-color: #d1d6a8;" type="submit" value="Add" name="add">
		</form>

		
		<?php

			include 'tempId.php';
    		$ac_id = $tempId;

    		if(isset($_POST['add'])){
    			require_once('connection.php');
    		 	
    		 	$query = "INSERT INTO company_cust (ac_id, employee_id, employee_name) VALUES (?,?,?)";
				
				$stmt= mysqli_prepare($db, $query);
				
				$id= trim( $_POST['Employee_id']);
				$name = trim($_POST['Employee_name']);
				mysqli_stmt_bind_param($stmt, "iss",$ac_id, $id, $name);

				mysqli_stmt_execute($stmt);

				$rows= mysqli_stmt_affected_rows($stmt);

				if($rows > 0 ){
					echo 'employee added <br/>';
		        	mysqli_stmt_close($stmt);
		        	mysqli_close($db);
			            
		        } else {
					echo 'employee not added <br/>';
					mysqli_stmt_close($stmt);
					mysqli_close($db);
		        }
			}
    		

		?>

		
			
			
		
	</body>
</html>