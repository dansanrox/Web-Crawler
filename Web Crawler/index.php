<?php 
session_start();
if(isset($_SESSION['luser'])){
	$luser = $_SESSION['luser'];
	include ('php/connection.php');
	$sql = mysql_query("SELECT * FROM user_details WHERE user_email='$luser'") or die("User Error : ".mysql_error());
	while($get = mysql_fetch_array($sql)) {
	$user_name = $get['user_name'];
	}
}else if(isset($_SESSION['suser'])){
	$luser = $_SESSION['suser'];
	include ('php/connection.php');
	$sql = mysql_query("SELECT * FROM admin WHERE admin_email='$luser'") or die("User Error : ".mysql_error());
	while($get = mysql_fetch_array($sql)) {
	$user_name = $get['admin_name'];
}
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
 <h3 class="login"> 
<?php 
		if(isset($_SESSION['luser']))
			echo '<a id="modal_trigger" href="#">'.$user_name.'</a>|<a href="php/logout.php">Log out</a>';
			
		else if(isset($_SESSION['suser']))
			echo '<a id="modal_trigger" href="#">'.$user_name.'(Admin)</a>|<a href="php/logout.php">Log out</a>';
		else
			echo '<a id="modal_trigger" href="#modal">Login / Sign up</a>';
		?>
</h3>
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
					<div class="logo" style="width:600px;height:300px" >
						<img src="img/logo.png"  style="width:600px;height:300px"/>
					</div>

						<div class="searchBox">
							<form id="form1" name="form1" method="get" action="php/checkLogged.php" >
								
								<?php 
								if(isset($_GET['urlValid']))
									$placeHolder="Please Enter Valid URL...!";
								else
									$placeHolder="Enter Web URL to Crawl...!";
								?>
							
								<input type="text" name="s_url" id="s_url" size="50" class="searchBar" placeholder="<?php echo $placeHolder; ?>" />
								<input type="submit" name="button" id="button" class="searchBtn" value="Go..!" />
							</form>
						</div>
						
						
<!-- *** Pop up sign up/login Box *** -->		
<!--Form Validation-->
<?php 
$error="";
if (isset($_POST['submitLogin'])) {
$user = $_POST['u_email'];	
$pass = $_POST['u_passsword'];	

include ('connection.php');

function phpAlert($msg) {
					echo '<script type="text/javascript">
					window.alert("' . $msg . '")
					window.location.href="index.php";
					</script>';	
					}

$sql = mysql_query("SELECT user_email, user_password FROM user_details WHERE user_email='$user' AND user_password='$pass'") or die("Error : ".mysql_error());

if (mysql_num_rows($sql)>0) {
	
	//echo "true";
	mysql_close();
	$_SESSION['luser']=$user;
	$error="";
	header('Location:index.php');
	}

else {
		$error="Invalid Login...! Please Try again...!";
		phpAlert( "Invalid Login! ");
	}
}
?>

	<div id="modal" class="popupContainer" style="display:none;">
		<header class="popupHeader">
			<span class="header_title">Login</span>
			<span class="modal_close"><i class="fa fa-times"></i></span>
		</header>
		
		<section class="popupBody">
			<!-- Social Login -->
			<div class="social_login">
			
				<div class="centeredText">
					<span>Use your Email.... Its Free..!</span>
				</div>

				<div class="action_btns">
					<div class="one_half"><a href="#" id="login_form" class="btn">Login</a></div>
					<div class="one_half last"><a href="#" id="register_form" class="btn">Sign up</a></div>
				</div>
			</div>

			<!-- Username & Password Login form -->
			<div class="user_login">
			
				<form id="loginForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<label>Email </label>
					<input type="email" name="u_email" />
					<br />

					<label>Password</label>
					<input type="password" name="u_passsword" />
					<br />

					<div class="checkbox">
						<input id="remember" type="checkbox" name="remember" />
						<label for="remember">Remember me on this computer</label>
					</div>
						<p style="color:red"><?php echo $error; ?></P>
					<div class="action_btns">
						<div class="one_half"><a href="#" class="btn back_btn"><i class="fa fa-angle-double-left"></i> Back</a></div>
						<div class="one_half last"><input type="submit" name="submitLogin" id="submitLogin" value="Login"  /></div>
	
					</div>
				</form>

				
			</div>

			<!-- Register Form -->
			<div class="user_register">
				<form method="post" action="php/registerValid.php">
					<label>Full Name</label>
					<input type="text" name="userName"/>
					<br />

					<label>Email Address</label>
					<input type="email" name="email" />
					<br />

					<label>Password</label>
					<input type="password" name="password" />
					<br />
					
					<label>Re type Password</label>
					<input type="password" name="Repassword" />
					<br />

					<div class="action_btns">
						<div class="one_half"><a href="#" class="btn back_btn"><i class="fa fa-angle-double-left"></i> Back</a></div>
						<div class="one_half last"><input type="submit" id="submitLogin" name="signup" value="Sign Up"  /></div>
					</div>
				</form>
			</div>
		</section>
	</div>
<!--Pop up-->	
<script type="text/javascript">
	$("#modal_trigger").leanModal({top : 100, overlay : 0.6, closeButton: ".modal_close" });

	$(function(){
		// Calling Login Form
		$("#login_form").click(function(){
			$(".social_login").hide();
			$(".user_login").show();
			return false;
		});

		// Calling Register Form
		$("#register_form").click(function(){
			$(".social_login").hide();
			$(".user_register").show();
			$(".header_title").text('Register');
			return false;
		});

		// Going back to Social Forms
		$(".back_btn").click(function(){
			$(".user_login").hide();
			$(".user_register").hide();
			$(".social_login").show();
			$(".header_title").text('Login');
			return false;
		});

	})
</script>				
						
<!-- end of pop up sign up/ login box-->
				
				
				
				
				
				
				
				
				
				
				
				
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
