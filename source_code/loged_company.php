<!DOCTYPE html>
<html lang="en">
	
	<head>
		<title>Loged Company</title>
		<meta charset="UTF-8">
		<meta name="description" content="credit card comany">
		<meta name="keywords" content="loged_company, ccc, hy360">		
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
			<h1 style="position: absolute; left: 40%; top:5%; color:black; font-family: sans-serif; text-align: center">Welcome Company</h1>	
		</header>
		
		<?php 
			include 'tempId.php';
    		$ac_id = $tempId;

			require_once('connection.php');
				
			$sql = "SELECT * FROM simple_cust WHERE ac_id =$ac_id";
			$result = mysqli_query($db, $sql);

			$sql1 = "SELECT name FROM customer WHERE ac_id =$ac_id";
			$result1 = mysqli_query($db, $sql1);
			
			echo '<table align="center"
				cellspacing="5" cellpadding="8" border="solid">

				<tr><td align="left"><b>Accound ID</b></td>
				<td align="left"><b>Name</b></td>
				<td align="left"><b>Credit Limit</b></td>
				<td align="left"><b>Current Due Amount</b></td>
				<td align="left"><b>Availiable Amount</b></td>
				<td align="left"><b>Expiration Date</b></td>
				</tr>';

			if( $result -> num_rows >0 && $result1 -> num_rows >0) {
				$row = mysqli_fetch_array($result);
				$row1 = mysqli_fetch_array($result1);
				echo '<tr><td align="left">' . 
				$row['ac_id'] . '</td><td align="left">' . 
				$row1['name'] . '</td><td align="left">' .
				$row['credit_limit'] . '</td><td align="left">' .
				$row['cur_due_amount'] . '</td><td align="left">' . 
				$row['avail_amount'] . '</td><td align="left">' .
				$row['exp_date'] . '</td>' ;
				echo '</tr>';
				
			}
			echo '</table>';
			
			mysqli_close($db);
		?>

		<p  style="text-align: center;  margin-right: 20%;">choose option:</p>

			<br><form style=" margin-right: 20%;" action=" http://localhost/pay_due_com.php" >
				<button >Pay Due</button>
			</form>
			
			<br><form style=" margin-right: 20%;" action=" http://localhost/make_return.html" >
				<button >Return</button>
			</form>

			<br><form style=" margin-right: 20%;" action=" http://localhost/search_comp.php" >
				<button>Transactions Status</button>
			</form>

			<br><form style=" margin-right: 20%;" action=" http://localhost/add_employee.php" method="post" >
				<button >Add Employee</button>
			</form>

			<br><form style=" margin-right: 20%;" action="http://localhost/delete_customer.php" >
				<button>Delete Acount</button>
			</form>
	</body>
</html>