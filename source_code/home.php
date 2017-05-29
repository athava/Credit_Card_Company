<!DOCTYPE html>
<html lang="en">


	<head>
		<title>CCC</title>
		<meta charset="UTF-8">
		<meta name="description" content="credit card comany">
		<meta name="keywords" content="homepage, ccc, hy360">	  
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="home.css">

		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,700">
	  
	</head>
	
	<body style="background-color: white;">
		
		<header1>
			<div >
				<img src="3.png" alt="No Image">
				<h1 class=header_adj>Welcome to Credit Card Company!</h1>
			</div>	
		</header1>
	
		<div id="login">
		
		<form name='form-login'  method="post"  >
		   
			<span class="fontawesome-user"></span>
				<input type="text" id="pass" placeholder="Account ID" name="acc_id" value=''>
			
			<h1 class=header_adj>Sign In as:</h1>
			
			<input type="submit" value="Customer" name="cust_but">
			<br><br>

			<input type="submit" value="Administrator (ccc)" name="admin_but">

		</form>
		
		<?php
		require_once('connection.php');
		
    		if (isset($_POST['cust_but'])) {

    			error_reporting(E_ERROR | E_PARSE);
				
				$tmp=trim( $_POST['acc_id']);

				$tempId=$tmp;
 				$var_str = var_export($tempId, true);
				$var = "<?php\n\n\$tempId = $var_str;\n\n?>";
 				file_put_contents('tempId.php', $var);

    			$sql = "SELECT active FROM customer WHERE ac_id = $tmp";
				$result = mysqli_query($db, $sql);
				if( $result -> num_rows >0) {
					while ($row = mysqli_fetch_array($result)){
						if ($row['active']=='false'){
							echo "INACTIVE ACCOUNT";
						}
						else if($row['active']=='true'){ 
							

							$sql = "SELECT ac_id FROM simple_cust WHERE ac_id =$tmp";
							$result = mysqli_query($db, $sql);
							if( $result -> num_rows >0) {
								while ($row = mysqli_fetch_array($result)){
									header("Location: http://localhost/loged_customer.php"); 
								}
							}

							$sql = "SELECT ac_id FROM company_cust WHERE ac_id =$tmp";
							$result = mysqli_query($db, $sql);
							if( $result -> num_rows >0) {
								while ($row = mysqli_fetch_array($result)){
									header("Location: http://localhost/loged_company.php"); 
								}
							}				
							$sql = "SELECT ac_id FROM merchant WHERE ac_id =$tmp";
							$result = mysqli_query($db, $sql);
							if( $result -> num_rows >0) {
								while ($row = mysqli_fetch_array($result)){
									header("Location: http://localhost/loged_merch.php"); 
								}
							} 
							
						}
					}
				}else {
					$sql = "SELECT employee_id, ac_id FROM company_cust WHERE employee_id = '$tmp'";
					$result = mysqli_query($db, $sql);
					if( $result -> num_rows >0) {
						while ($row = mysqli_fetch_array($result)){
							$a=$row['ac_id'];
							$sql="SELECT active From customer WHERE ac_id= $a";
							$result = mysqli_query($db, $sql);
							if( $result -> num_rows >0) {
								$row = mysqli_fetch_array($result);
								if($row['active']=='true') {
									header("Location: http://localhost/loged_employee.php");
								}else{
									echo "INACTIVE ACCOUNT";
								}
							}
							 
						}
					}
					else {echo "ACCOUNT ID NOT FOUND TRY AGAIN";}
				}
			}
   		 	else if (isset($_POST['admin_but'])) {
        		header("Location: http://localhost/loged_ccc.php");

    		}

    		mysqli_close($db);

		?>
	  
  
	</body>
</html>
