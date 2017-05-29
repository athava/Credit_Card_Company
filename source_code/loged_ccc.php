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
			<h1 style="position: absolute; left: 40%; top:5%; color:black; font-family: sans-serif; text-align: center">Welcome Administrator</h1>	
		</header>

		<p  style="text-align: center;">choose option:</p>
		<form action="new_account.php" >
			<button>New Account</button>
		</form>
		
		<br>
		<form action="http://localhost/good_customer.php" target="_blank">
			<button>Good Customer Status</button>
		</form>
		
		<br>
		<form action="http://localhost/bad_customer.php" target="_blank">
			<button>Bad Customer Status</button>
		</form>
		
		<br>
		<form action="http://localhost/month_merchant.php" >
			<button >Merchant Of The Month</button>
		</form>
	
	</body>





</html>