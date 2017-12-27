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
}else{
		function phpAlert($msg) {
					echo '<script type="text/javascript">
							window.alert("' . $msg . '")
							window.location.href="index.php";
							</script>';	
					}
					
		phpAlert("Please Login first...!");	
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

</div>			<div class="logo" style="width:600px;height:300px" >
						<img src="img/logo.png"  style="width:600px;height:300px"/>
						
					</div>

						<div class="searchBox">
						<h3 style="color:#009595">Ask Anything...!</h3>
							<form id="form1" name="form1" method="post" action="php/contactValid.php" >
								<input type="text" name="subject" id="subject" size="50" class="searchBar" style="width:400px;" placeholder="Enter Your Subject" />
								<br/><br/>
								<textarea name="message" id="message" style="width:400px;height:50px"  placeholder="Enter Your Message" class="searchBar" /></textarea>
								<br/><br/>
								<input type="hidden" value="<?php echo $user_name?>" name="user_name"/>
								<input type="hidden" value="<?php echo $$luser?>" name="email"/>
								<input type="submit" style="left:0px;" name="submit" id="button" class="searchBtn" value="Submit..!" />
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
