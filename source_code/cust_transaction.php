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
			<h1 style="position: absolute; left: 40%; top:5%; color:black; font-family: sans-serif; text-align: center">New Transaction</h1>	
		</header>

		<form method="post"  style="margin-right:5%" >
	
			<?php
				require_once('connection.php');
				$query = "SELECT customer.name FROM customer INNER JOIN merchant ON customer.ac_id=merchant.ac_id WHERE customer.active='true'";
				// Get a response from the database by sending the connection
				// and the query
				$response = @mysqli_query($db, $query);
				echo 'Select merchant: <select name="merch">' ;

				if($response){
					while($row = mysqli_fetch_array($response)){
						echo  '<option value="' . $row['name'] . '">'.  $row['name'] . '</option>';
					}
					echo '</select>';
				}
				else{
					echo "Couldn't issue database query<br />";
					echo mysqli_error($db);
				}
			?>

		
		  	<br><br><br>choose kind : 	<input type="radio" name="kind" value="credit"> Credit 
		  	<input type="radio" name="kind" value="charge"> Charge <br>
		  	<br><br>Transaction amount:<input style="width: 70px; " id="fill_in" type="text" name="trans_amount" placeholder="π.χ. 49.99"><br><br><br><br>
		  	<input style="background-color: #d1d6a8;" type="submit" value="Conduct" name="conduct">
		
			<?php
				//cid, cname -> customer id, name
				//mid, mname -> merchant id, name
				include 'tempId.php';
				$cid = $tempId;
			
				if(isset($_POST['conduct']) ){
					require_once('connection.php');

					// query 4 customer name
					$query = "SELECT name FROM customer WHERE ac_id=$cid";
					$result = mysqli_query($db, $query);
					if($result -> num_rows >0 ){
						$answer = mysqli_fetch_array($result);
						$cname= $answer['name'];
					}
					// end of query

					// query 4 customer info
					$query = "SELECT * FROM simple_cust WHERE ac_id=$cid";
					$result = mysqli_query($db, $query);
					if($result -> num_rows >0 ){
						$answer = mysqli_fetch_array($result);
						$c_d_amount= $answer['cur_due_amount'];
						$cr_limit= $answer['credit_limit'];
						$av_amount= $answer['avail_amount'];
					}
					// end of query

					$merch= trim( $_POST['merch']);
					$trans_am= trim( $_POST['trans_amount']);
					$kind= trim($_POST['kind']);
					$flag= 0;

					// query 4 merchant info
					$query = "SELECT * FROM merchant WHERE ac_id= (SELECT ac_id FROM customer WHERE name='$merch')";
					$result = mysqli_query($db, $query);
					if($result -> num_rows >0){
						$answer = mysqli_fetch_array($result);
						$debt= $answer['debt'];
						$profit= $answer['profit'];
						$supply= $answer['supply'];
						$mid= $answer['ac_id'];
					}
					// end of query

					if($_POST['kind']=="charge"){
						if($trans_am > $av_amount){
							echo "<br>No Money, No honey honey!";
						}
						else{
							$flag=1;
							// update customer's available amount
							$av_amount= $av_amount-$trans_am;
							$query = "UPDATE simple_cust SET avail_amount=$av_amount WHERE ac_id=$cid";
							$result = mysqli_query($db, $query);
							// update merchant's profit n debt
							$profit= $profit + $trans_am - ($trans_am * $supply / 100);
							$debt= $debt + ($trans_am * $supply / 100);
							$query = "UPDATE merchant SET profit=$profit, debt=$debt WHERE ac_id=$mid";

							$result = mysqli_query($db, $query);
						}
					}
					else{
						if($cr_limit < $c_d_amount + $trans_am){
							echo "<br>opoios xrostaei, peinaei!";
						}
						else{
							$flag=1;
							// update customer's current due amount
							$c_d_amount= $c_d_amount+$trans_am;
							$query = "UPDATE simple_cust SET cur_due_amount=$c_d_amount WHERE ac_id=$cid";
							$result = mysqli_query($db, $query);
							// update merchant's profit n debt
							$profit= $profit + $trans_am - ($trans_am * $supply / 100);
							$debt= $debt + ($trans_am * $supply / 100);
							$query = "UPDATE merchant SET profit=$profit, debt=$debt WHERE ac_id=$mid";
							$result = mysqli_query($db, $query);
						}
					}

					if($flag==1){
						$query = "INSERT INTO transaction (tran_id, cust_name, merch_name, tran_date, tran_amount, kind, c_tran, emp_id) VALUES (NULL, ?, ?, NOW(), ?, ?,'false','')";
						$stmt= mysqli_prepare($db, $query);
						mysqli_stmt_bind_param($stmt, "ssds", $cname, $merch, $trans_am, $kind);
						mysqli_stmt_execute($stmt);

						$query = "SELECT * FROM transaction ORDER BY tran_date DESC LIMIT 1";
						$result = mysqli_query($db, $query);
						
						if($result -> num_rows >0 ){
							$row = mysqli_fetch_array($result);
							echo '<br><br><table align="center"
							cellspacing="5" cellpadding="8" border="solid">
							<tr><td align="left">' . 
							'Transaction ID</td><td align="left">' . 
							'Customer Name</td><td align="left">' .
							'Merchant Name</td><td align="left">' . 
							'Transaction Date</td><td align="left">' .
							'Transaction Amount</td><td align="left">' . 
							'Kind</td>' .
							'</tr>'.
							'<tr><td align="left">' . 
							$row['tran_id'] . '</td><td align="left">' . 
							$row['cust_name'] . '</td><td align="left">' .
							$row['merch_name'] . '</td><td align="left">' . 
							$row['tran_date'] . '</td><td align="left">' .
							$row['tran_amount'] . '</td><td align="left">' . 
							$row['kind'] . '</td>' .
							'</tr>'.'</table> <br/>';
				      
			        	}else echo "ERROR";
			    	}
				}
				mysqli_close($db);
			?>

			</form>
					
	</body>
</html>