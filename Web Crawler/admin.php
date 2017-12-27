<?php 
session_start();
if(isset($_SESSION['luser'])){
	
	function phpAlert($msg) {
					echo '<script type="text/javascript">
							window.alert("' . $msg . '")
							window.location.href="index.php";
							</script>';	
					}
	phpAlert("Please Logout first to access admin page...!");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Web Crawler</title>
<link href="img/favicon.png" type="image/png" rel="icon">
<link href="style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="js/jquery.leanModal.min.js"></script>
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />
<link type="text/css" rel="stylesheet" href="css/style.css" />
</head>

<body>
<div id="grayLayer"></div>	
<div class="header">

</br></br>
<h5 style="padding-left:0px;">
| <a href="feedback.php">Feed Back </a>
</h5>
<h5 style="padding-right:0px;padding-left:0px;">
| <a href="contact.php">Contact Us</a>
</h5>
<h5 style="padding-right:0px;">
<a href="index.php">Home</a>
</h5>

</div>

<?php 

if (isset($_POST['submit'])) {
$user = $_POST['a_name'];	
$pass = $_POST['a_password'];	

include ('connection.php');

function phpAlert($msg) {
					echo '<script type="text/javascript">
					window.alert("' . $msg . '")
					window.location.href="admin.php";
					</script>';	
					}

$sql = mysql_query("SELECT admin_email FROM admin WHERE admin_email='$user' AND admin_password='$pass'") or die("Error : ".mysql_error());

if (mysql_num_rows($sql)>0) {
	
	//echo "true";
	mysql_close();
	$_SESSION['suser']=$user;
	header('location:adminMain.php');
	}

else {
		
		phpAlert( "Invalid Login! ");
	}
}
?>
				<div class="logo" style="width:300px;height:150px" >
						<img src="img/logo.png"  style="width:300px;height:150px"/>
					</div>

						<div class="searchBox">
						<h3 style="color:#009595;text-align:center;">Admin Login</h3>
							<form id="form1" name="form1" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
								
								<input type="email" name="a_name" id="s_url" size="30" class="searchBar" style="margin-left:150px;" placeholder="Enter Email" />
								<br/><br/>
								<input type="password" name="a_password" id="s_url" size="30" class="searchBar" style="margin-left:150px;" placeholder="Enter Password" />
								<br/><br/>
								<input type="submit" name="submit" id="button" class="searchBtn" style="right:210px;" value="Submit...!" />
							</form>
						</div>

 <!-- *** Dynamically-resized, slideshow-capable background image to any page or element *** -->
 	<script src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.backstretch.js"></script>
	 <script src="js/bootstrap.min.js"></script>
    <script>
    'use strict';

    /* ========================== */
    /* ::::::: Backstrech ::::::: */
    /* ========================== */
    // You may also attach Backstretch to a block-level element
    $.backstretch(
        [
            "img/bg/1.jpg",
            "img/bg/2.jpg",
            "img/bg/3.jpg"
        ],
    
        {
            duration    :   4500,
            fade        :   1500
        }
    );
    </script>
				
</body>
</html>
