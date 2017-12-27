<?php
session_start();
	if(isset($_POST['signup'])){
		include_once("connection.php");
		
		$name = mysql_real_escape_string($_POST['userName']);
		$email = mysql_real_escape_string($_POST['email']);
	    $pass1 = mysql_real_escape_string($_POST['password']);
		$pass2 = mysql_real_escape_string($_POST['Repassword']);
		
		//php function that showing messages
		function phpAlert($msg) {
					echo '<script type="text/javascript">
							window.alert("' . $msg . '")
							window.location.href="../index.php";
							</script>';	
					}
		
		
		if( $name!="" && $email!="" && $pass1!="" && $pass2!=""){
			
			$check_email = "SELECT * FROM user_details WHERE user_email='$email'";
			
			$check=mysql_query($check_email);
				
				if(mysql_num_rows($check)>0) {
					phpAlert("Sorry this email has been already registered");
				
				}else{
					
					if($pass1==$pass2)
					{
						// connection open
						#establishing the connection
						include_once("connection.php");
						
						
						#inserting the values
						$stmt = "INSERT INTO `user_details` (`user_name`,`user_email`,`user_password`) 
								VALUES('$name','$email','$pass1')";
						
						mysql_query($stmt)or die("Query error..".mysql_error());
						if(mysql_affected_rows())
						{
							$_SESSION['luser'] = $email;
							header ('Location:../index.php');
						}
						else {
							phpAlert("Registration Error..!");
							}
					}
					else {
						phpAlert("Password does not match");
						}
						
			
			
			}
		}
		else {
			phpAlert("Please fill all data fields");
			}
			
	}


?>