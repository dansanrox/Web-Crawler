<?php 
session_start();
$url=$_GET['s_url'];

function phpAlert($msg) {
					echo '<script type="text/javascript">
					window.alert("' . $msg . '")
					window.location.href="../index.php";
					</script>';	
					}
					
	if(isset($_SESSION['luser']) || isset($_SESSION['suser']) )
		header('location:../searched.php?s_url='.$url.'');
	else
		phpAlert("Please Login first...!");
					
					

?>