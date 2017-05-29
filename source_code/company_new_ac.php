<!DOCTYPE html>
<html lang="en">
	
	<head>
		<title>create account</title>
		<meta charset="UTF-8">
		<meta name="description" content="fill in form for new account">
		<meta name="keywords" content="homepage, ccc, hy360">
		<link rel="stylesheet" type="text/css" href="side.css">	
		<link rel="stylesheet" type="text/css" href="home.css">
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
			<a href="http://localhost/loged_ccc.php "><img style="width: 10%;" id=logo_image src="3.png" alt="No Image">
			</a>
			<h1 style="position: absolute; left: 40%; top:5%; color:black; font-family: sans-serif; text-align: center">New Company Account</h1>	
		</header>


		<form method="post"  style="margin-right:30%" >
  			Company's Acount Id:*<input id="fill_in" type="number" name="account_id"  placeholder="12345"  ><br><br>
  			Company's Name:*<input id="fill_in" type="text" name="name" placeholder="Giannis" value=""><br><br>
  			Company's Credit Limit:*<input id="fill_in" type="number" step=0.000001 name="limit"  placeholder="400" value=""><br><br>
  			Company's Availiable amount:*<input id="fill_in" type="number" step=0.000001 name="amount" placeholder="5.000" value=""><br><br>
  			Company's Expiration Date:*<input id="fill_in" type="Date" name="exp" value=""><br><br>
  			
  			<input style="background-color: #d1d6a8;" type="submit" value="Submit" name="Submit">

		</form>

		<?php
			
    		if(isset($_POST["Submit"])){

				require_once('connection.php');

				$query = "INSERT INTO customer (ac_id, name, active) VALUES (?,?,'true')";
				$query2 = "INSERT INTO simple_cust (ac_id, credit_limit, cur_due_amount, avail_amount,exp_date) VALUES (?,?,0,?,?)";
				
				$stmt= mysqli_prepare($db, $query);
				$stmt2= mysqli_prepare($db, $query2);

				$ac_id = trim( $_POST['account_id']);
				$name = trim($_POST['name']);

				$cr_lm = trim( $_POST['limit']);
				$av_am = trim ( $_POST['amount']);
				$date = trim( $_POST['exp']);

				

				mysqli_stmt_bind_param($stmt, "is", $ac_id, $name  );
				mysqli_stmt_bind_param($stmt2, "idds",$ac_id, $cr_lm,  $av_am , $date );

				mysqli_stmt_execute($stmt);
				mysqli_stmt_execute($stmt2);

				$rows= mysqli_stmt_affected_rows($stmt);
				$rows2= mysqli_stmt_affected_rows($stmt2);

				if($rows > 0 && $rows2 > 0){	
					echo 'New Person Entered <br/>'; 
				}
				else{
					echo 'Account already exists <br/>';
				}

				$tempId=$ac_id;
 				$var_str = var_export($tempId, true);
				$var = "<?php\n\n\$tempId = $var_str;\n\n?>";
 				file_put_contents('tempId.php', $var);
				
				mysqli_stmt_close($stmt);
				mysqli_stmt_close($stmt2);		
				mysqli_close($db);

			}
		?>

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