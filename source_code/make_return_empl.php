<!DOCTYPE html>
<html lang="en">
	
	<head>
		<title>make return</title>
		<meta charset="UTF-8">
		<meta name="description" content="credit card comany">
		<meta name="keywords" content="make_return, ccc, hy360">		
		<link rel="stylesheet" type="text/css" href="home.css">
		<link rel="stylesheet" type="text/css" href="side.css">

	</head>


	<body >

		<div id="mySidenav" class="sidenav">
		  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		  <a href="http://localhost/loged_employee">Home Page</a>
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
			<a href="http://localhost/loged_employee.php">
				<img style="width: 10%;" id=logo_image src="3.png" alt="No Image">
			</a>
			<h1 style="position: absolute; left: 40%; top:5%; color:black; font-family: sans-serif; text-align: center">Return Product</h1>	
		</header>

		
		<form method="post" >
			<?php
				require_once('connection.php');
				include 'tempId.php';
				$em_id = $tempId;

				$query = "SELECT ac_id FROM company_cust WHERE employee_id='$em_id'";
				$result = mysqli_query($db, $query);
				$answer = mysqli_fetch_array($result);
				$c_id= $answer['ac_id'];

				$query = "SELECT name FROM customer WHERE ac_id=$c_id";
				$result = mysqli_query($db, $query);
				
				if($result -> num_rows >0 ){
					$answer = mysqli_fetch_array($result);
					$cname= $answer['name'];
					$query = "SELECT * FROM transaction WHERE cust_name='$cname' AND tran_amount>0";
					$response = @mysqli_query($db, $query);
					echo 'Select transaction: <select name="trans"><option selected value=0>' .
							'not selected</option>';

					if($response -> num_rows >0 ){
						while($row = mysqli_fetch_array($response)){
							echo '<option value="' . $row['tran_id'] . '">'.  
							$row['tran_amount'] . "€ --> " .
							$row['merch_name'] . " : " .
							$row['tran_date'] . '</option>';
						}
						echo '</select>';
					}
					else{
						echo "No previous transactions<br>";
						echo mysqli_error($db);
					}
				}
					
				
			?>

  			<input style="background-color: #d1d6a8;" type="submit" value="Return" name="return_btn" >

  			<?php
				//cid, cname -> customer id, name
				//mid, mname -> merchant id, name
				include 'tempId.php';
				$emp_id = $tempId;
				require_once('connection.php');
				

			//	if($chosen_trans>0){
					

					if(isset($_POST['return_btn']) ){

						
						$chosen_trans= trim( $_POST['trans']);

						// query 4 company id
						$query = "SELECT ac_id FROM company_cust WHERE employee_id='$emp_id'";
						$result = mysqli_query($db, $query);
						$answer = mysqli_fetch_array($result);
						$cid= $answer['ac_id'];

						// query 4 customer info
						$query = "SELECT * FROM simple_cust WHERE ac_id=$cid";
						$result = mysqli_query($db, $query);
						if($result -> num_rows >0 ){
							$answer = mysqli_fetch_array($result);
							$cr_limit= $answer['credit_limit'];
							$c_d_amount= $answer['cur_due_amount'];
							$av_amount= $answer['avail_amount'];
						}
						// end of query

						// query 4 transaction info
						$query = "SELECT * FROM transaction WHERE tran_id=$chosen_trans";
						$result = mysqli_query($db, $query);
						if($result -> num_rows >0 ){
							$answer = mysqli_fetch_array($result);
							$merch= $answer['merch_name'];
							$trans_am= $answer['tran_amount'];
							$kind= $answer['kind'];
						}
						// end of query

						// query 4 merchant id
						$query = "SELECT ac_id FROM customer WHERE name='$merch'";
						$result = mysqli_query($db, $query);
						if($result -> num_rows >0 ){
							$answer = mysqli_fetch_array($result);
							$mid= $answer['ac_id'];
						}
						// end of query

						// query 4 merchant info
						$query = "SELECT * FROM merchant WHERE ac_id=$mid";
						$result = mysqli_query($db, $query);
						if($result -> num_rows >0){
							$answer = mysqli_fetch_array($result);
							$debt= $answer['debt'];
							$profit= $answer['profit'];
							$supply= $answer['supply'];
						}

						// remove money from merchant
						$profit= $profit - $trans_am + ($trans_am * $supply / 100);
						$debt= $debt - ($trans_am * $supply / 100);
						$query = "UPDATE merchant SET profit=$profit, debt=$debt WHERE ac_id=$mid";
						$result = mysqli_query($db, $query);

						// return money to customer
						if($kind=="charge"){
							$av_amount= $av_amount+$trans_am;
							$query = "UPDATE simple_cust SET avail_amount=$av_amount WHERE ac_id=$cid";
						}
						else{
							$c_d_amount= $c_d_amount-$trans_am;
							$query = "UPDATE simple_cust SET cur_due_amount=$c_d_amount WHERE ac_id=$cid";
						}

						$result = mysqli_query($db, $query);

						// manage return transaction here
						$query = "UPDATE transaction SET tran_amount=0 WHERE tran_id=$chosen_trans  ";
						$result = mysqli_query($db, $query);
						echo "<meta http-equiv='refresh' content='0'>";
					}
				//}
				mysqli_close($db);
				

  			?>

		</form>

	</body>
</html>