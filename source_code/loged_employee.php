<!DOCTYPE html>
<html lang="en">
	
	<head>
		<title>customer</title>
		<meta charset="UTF-8">
		<meta name="description" content="credit card comany">
		<meta name="keywords" content="loged_employee, ccc, hy360">
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
			<h1 style="position: absolute; left: 40%; top:5%; color:black; font-family: sans-serif; text-align: center">Welcome Employee</h1>
		</header>


		<p  style="text-align: center;">choose option:</p>
		
			<form action="http://localhost/employee_transaction.php">
				<button >Buy Something</button>
			</form>

			<br><form action="make_return_empl.php" >
				<button >Return</button>
			</form>

			<br><form action="cust_tran_check.html" >
				<button>**Transactions Status**</button>
			</form>

	</body>
</html>