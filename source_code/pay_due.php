<!DOCTYPE html>
<html lang="en">
	
	<head>
		<title>CCC</title>
		<meta charset="UTF-8">
		<meta name="description" content="credit card comany">
		<meta name="keywords" content="homepage, ccc, hy360">
		<link rel="stylesheet" type="text/css" href="home.css">
		<link rel="stylesheet" type="text/css" href="side.css">
	</head>

	

	<body >
		<div id="mySidenav" class="sidenav">
			  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
			  <a href="http://localhost/loged_customer.php">Home Page</a>
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
			<a href="http://localhost/loged_customer.php">
				<img style="width: 10%;" id=logo_image src="3.png" alt="No Image">
			</a>
			<h1 style="position: absolute; left: 40%; top:5%; color:black; font-family: sans-serif; text-align: center">Make Payment</h1>	
		</header>

		<?php
			require_once('connection.php');
			include 'tempId.php';
			$cid = $tempId;
			
			$query = "SELECT cur_due_amount FROM simple_cust WHERE ac_id=$cid";
			$result = mysqli_query($db, $query);
			$answer = mysqli_fetch_array($result);
			$money = $answer['cur_due_amount'];

			echo "<p align='center'>Your current due amount: ". $money. "€<br></p>";
		?>

		<form method="post" >
			<br> <br>  
			<input  type="number"  step=0.000001 name="payment_amount" placeholder="payment amount">
			<input style="background-color: #ccbe9f; margin-left: 2%;"  type="submit" name="pay" value="Pay">
			&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp or
			<input style="width: 200px; height: 25px; border: none;border-radius: 4px;background-color: #ccbe9f; color: black; margin-left: 2%;" type="submit" name="pay_com" value="Pay Complete Amount">
		

		<?php
			require_once('connection.php');

			include 'tempId.php';
			$cust_id = $tempId;
			//bring due amount from table
			$query = "SELECT cur_due_amount FROM simple_cust WHERE ac_id=$cust_id;";
			$result = mysqli_query($db, $query);
				if($result -> num_rows >0 ){										
					$answer = mysqli_fetch_array($result);
					$due = $answer['cur_due_amount'];
				}


			if(isset($_POST['pay'])){
				$am=trim($_POST['payment_amount']);
				if($am>$due){
					echo "<br><br><br>Inserted amount is bigger than your curent due amount. No payment made.";
				}else{
					
					$query = "UPDATE simple_cust SET cur_due_amount=($due-$am) WHERE ac_id=$cust_id";
					mysqli_query($db, $query);
					echo "<br><br><br>Payment made. Thank you!<br>";
					echo "Paid amount: ".$am."€<br>";
					$query = "SELECT cur_due_amount FROM simple_cust WHERE ac_id=$cust_id;";
					$result = mysqli_query($db, $query);
						if($result -> num_rows >0 ){										
							$answer = mysqli_fetch_array($result);
							$due = $answer['cur_due_amount'];
					}
					echo "remaining due amount: ".$due."€<br>";
				}
			}

			if(isset($_POST['pay_com'])){
				$query = "UPDATE simple_cust SET cur_due_amount=0 WHERE ac_id=$cust_id";
				mysqli_query($db, $query);
				echo "<br><br><br>Payment made. Thank you!<br>";
				echo "Paid amount: ".$due."€<br>";
				echo "remaining due amount: 0€<br>";

			}


			mysqli_close($db);
		?>

		
		</form>		
	</body>
</html>