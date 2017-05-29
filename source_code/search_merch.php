<!DOCTYPE html>
<html lang="en">
	
	<head>
		<title>customer search</title>
		<meta charset="UTF-8">
		<meta name="description" content="fill in form for new account">
		<meta name="keywords" content="homepage, ccc, hy360">		
		<link rel="stylesheet" type="text/css" href="home.css">
		<link rel="stylesheet" type="text/css" href="side.css">

	</head>


	<body>

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
			<h1 style="position: absolute; left: 40%; top:5%; color:black; font-family: sans-serif; text-align: center">Search</h1>	
		</header>

		<form method="post" style="margin-right:5%" >

		  	<br><br>
		  	Select time period:<br> 
		  	From: <input id="fill_in" type="Date" name="from" value=""><br><br>
		  	Until: <input id="fill_in" type="Date" name="until" value=""><br><br>
		  	<input style="background-color: #d1d6a8;" type="submit" value="Search" name="search">
		
		
			<?php
			require_once('connection.php');
				include 'tempId.php';
				$cid = $tempId;
			
				if(isset($_POST['search']) ){

					$date_from= trim($_POST['from']);
					$date_until= trim($_POST['until']);
					if($date_until<>NULL && $date_from<>NULL){

						// query 4 customer name
						$query = "SELECT name FROM customer WHERE ac_id=$cid";
						$result = mysqli_query($db, $query);
						if($result -> num_rows >0 ){
							$answer = mysqli_fetch_array($result);
							$cname= $answer['name'];
						}
						// end of query

						$query = "SELECT * FROM transaction WHERE merch_name='$cname' AND tran_date BETWEEN '$date_from' AND '$date_until' ORDER BY tran_date DESC";
						$result = mysqli_query($db, $query);

						// print table
						if($result -> num_rows >0){
							echo '<br><br><table align="center"
								cellspacing="5" cellpadding="8" border="solid">
								<tr><td align="left">' . 
								'Transaction ID</td><td align="left">' . 
								'Customer Name</td><td align="left">' .
								'Merchant Name</td><td align="left">' . 
								'Transaction Date</td><td align="left">' .
								'Transaction Amount</td><td align="left">' . 
								'Kind</td>' .
								'</tr>';

							while($row = mysqli_fetch_array($result)){
								echo '<tr><td align="left">' . 
									$row['tran_id'] . '</td><td align="left">' . 
									$row['cust_name'] . '</td><td align="left">' .
									$row['merch_name'] . '</td><td align="left">' . 
									$row['tran_date'] . '</td><td align="left">' .
									$row['tran_amount'] . '</td><td align="left">' . 
									$row['kind'] . '</td></tr>';
							}

							echo '</table> <br>';
						}
					}
					else{
						echo '<br><br>Choose "from date" and "until date"';
					}
				}
//	SELECT merch_name, COUNT(*) AS numoftrans FROM transaction WHERE tran_amount>0 AND tran_date BETWEEN (CURRENT_TIMESTAMP - INTERVAL 30 DAY) AND (CURRENT_TIMESTAMP) GROUP BY merch_name ORDER BY numoftrans DESC LIMIT 1
				
				mysqli_close($db);
			?>
		</form>
			
	</body>
</html>