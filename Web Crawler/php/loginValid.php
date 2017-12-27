<?php 
session_start();
$user = $_POST['u_email'];	
$pass = $_POST['u_passsword'];	

function phpAlert($msg) {
					echo '<script type="text/javascript">
					window.alert("' . $msg . '")
					window.location.href="../login.php";
					</script>';	
					}

include ('connection.php');

$sql = mysql_query("SELECT user_email, user_password FROM user_details WHERE user_email='$user' AND user_password='$pass'") or die("Error : ".mysql_error());

if (mysql_num_rows($sql)>0) {
	
	//echo "true";
	mysql_close();
	$_SESSION['luser']=$user;
	header('Location:../index.php');
	}

else {
	phpAlert( "Invalid Login! ");
	
	}




?>