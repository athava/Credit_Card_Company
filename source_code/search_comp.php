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
			<h1 style="position: absolute; left: 40%; top:5%; color:black; font-family: sans-serif; text-align: center">Search</h1>	
		</header>

		<form method="post" style="margin-right:5%" >

			<?php
				require_once('connection.php');
				include 'tempId.php';
				$cid = $tempId;

				$query = "SELECT employee_id, employee_name FROM company_cust WHERE ac_id=$cid";
				$response = @mysqli_query($db, $query);

				echo 'Select employee: <select name="empl">';

				if($response){
					while($row = mysqli_fetch_array($response)){
						echo  '<option value="' . $row['employee_id'] . '">'. 'ID: ' . $row['employee_id'] . ' name: ' . $row['employee_name'] . '</option>';
					}
					echo '</select>';
				}
				else{
					echo "Couldn't issue database query<br>";
					echo mysqli_error($db);
				}
			?>

			<br>Select all employees: <input type="checkbox" name="all_emp" value="all"> 

		  	<br><br>
		  	Select time period:<br> 
		  	From: <input id="fill_in" type="Date" name="from" value=""><br><br>
		  	Until: <input id="fill_in" type="Date" name="until" value=""><br>
		  	<br>Show all transactions: <input type="checkbox" name="all_dates" value="all"> 

			<br>
			<br>
			Order by: <select name="o_by">
			<option value="not" selected="selected"> not selected </option>
			<option value="tran_id"> transaction id </option>
			<option value="merch_name"> merchant name </option>
			<option value="tran_amount"> transaction amount </option>
			<option value="tran_date"> date </option>
			</select>

			<br>Order: ascending:<input type="radio" name="order" value="ASC"> descending:<input type="radio" name="order" value="DESC">

		  	<br><br><br><input style="background-color: #d1d6a8;" type="submit" value="Show" name="show">
		
		
			<?php
			require_once('connection.php');
				include 'tempId.php';
				$c_id = $tempId;
			
				if(isset($_POST['show']) ){

					$query = "SELECT name FROM customer WHERE ac_id=$c_id";
					$result = mysqli_query($db, $query);
					$answer = mysqli_fetch_array($result);
					$cname= $answer['name'];

					$A= "SELECT * FROM transaction WHERE cust_name='$cname' ";
					$B= "";
					$C= "";
					$D= "";

					if(! isset($_POST['all_emp'])){
						$B= "AND emp_id= '". trim($_POST['empl']. "' ");
					}


					if(! isset($_POST['all_dates'])){
						$date_from= trim($_POST['from']);
						$date_until= trim($_POST['until']);
						
						if($date_until<>NULL && $date_from<>NULL){
							$C= "AND tran_date BETWEEN '". $date_from. "' AND '". $date_until. "' ";
						}
					}


					if(isset($_POST['order'])) {
						if( $_POST['o_by']<> "not"){
							$D= " ORDER BY ". $_POST['o_by']. " ". $_POST['order'];
						}
					}


					$query= $A. $B. $C. $D;
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
				
				mysqli_close($db);
			?>
		</form>
			
	</body>
</html>