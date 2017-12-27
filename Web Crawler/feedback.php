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
<style>
div#grayLayer{
	
     background:rgba(240,240,240 , 0.85);
   
}
div.logo{
	
	
	padding:10px;
	
}
div.searchBox{
	width:40%;
	position:relative;
	margin-left:5px;
}

div.header{
	width:50%;
	height:50px;
	margin-bottom:20px;
	float:right;

}
.searchBar{
	height:20px;
	padding:6px 12px;
	border-radius: 5px;
	outline: 0;
	background-color: #E6FFFF;
	border: 1px solid #01c0c0;		
}
</style>
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



					<div class="logo" style="height:150px;" >
						<img src="img/logo.png"  style="width:300px; height:150px;"/>
					</div>

						<div class="searchBox">
							<form id="form1" name="form1" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
								<textarea name="comment" id="message" style="width:500px;height:50px"  placeholder="Enter Your Message" class="searchBar" /></textarea></br></br>
								<input type="hidden" name="name" value="<?php echo $user_name; ?>" />
								<input type="submit" name="commentbtn" id="button" class="searchBtn" value="Go..!" />
							</form>
						</div>
		
<!--commenting--->		
<?php
// Create connection
include('connection.php');

$sql = "SELECT *  FROM comment Order By comment_id Desc";
$result = mysql_query($sql);
echo "<table>";

if (mysql_num_rows($result) > 0) {
    // output data of each row
    while($row = mysql_fetch_array($result)) {
        	
		echo '<tr >';
        echo  '<td style="padding:10px"><h3 style="margin-bottom:0px;">'. $row["name"]. ':</h3>'.$row["comment"].'</td>';
		echo "</tr>";
	}
echo "</table>";
}				
				
				
////click comment button				
if(isset($_POST["commentbtn"]))
{
if(isset($_SESSION['luser']) || isset($_SESSION['suser'])){
	$name = $_POST["name"];
	$comment = $_POST["comment"];

//////check for null values
if(!isset($comment) || trim($comment)===""){
	//////do nothing
}else{
// Create connection
include('connection.php');
 

$sql = "INSERT INTO comment (user_id,name, comment)
VALUES ('$luser','$name','$comment')";


mysql_query($sql);
header("Refresh:0");


/*if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
$conn->close();*/
}

}else{
/////////
	function phpAlert($msg) {
					echo '<script type="text/javascript">
					window.alert("' . $msg . '")
					window.location.href="feedback.php";
					</script>';	
					}	
	phpAlert("Please Login to Comment...!");
}
}
?>
<!-- end of commenting--->	




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


</body>
</html>
