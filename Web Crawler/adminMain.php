<?php 
session_start();
if(isset($_SESSION['suser'])){
	$luser = $_SESSION['suser'];
	include ('php/connection.php');
	$sql = mysql_query("SELECT * FROM admin WHERE admin_email='$luser'") or die("User Error : ".mysql_error());
	while($get = mysql_fetch_array($sql)) {
	$admin_name = $get['admin_name'];
	}
}else{
	
	header('location:admin.php');
	
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
div.header{
	width:30%;
	height:50px;
	margin-bottom:20px;
	float:right;

}
div.logo{
	padding:10px;
}

div.userDetails{
	width:50%;
	float:left;
}
div.newadmin{
	width:50%;
	float:left;
}
</style>

</head>

<body>
<div id="grayLayer"></div>	
<div class="header">
 <h3 class="login"> 
<?php 
		if(isset($_SESSION['suser']))
			echo '<a id="modal_trigger" href="#">'.$admin_name.'(Admin)</a>|<a href="php/logout.php">Log out</a>';
			
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


				<div class="logo" style="width:300px;height:150px" >
						<img src="img/logo.png"  style="width:300px;height:150px"/>
						<h3 align="center">Admin Panel</h3>
					</div>
</br></br>
<div class="userDetails" >			
<h3 align="center" style="color:#009595;">User Details</h3>
<table border="1" align="center" width="80%">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<tr>
	<th >User ID</th>
	<th >Name</th>
	<th >Email</th>
	<th >Password</th>
	<th> <input  type="submit" value="Delete" name="delete"/></th>
</tr>
<?php
	include ('php/connection.php');
	$result = mysql_query("SELECT * FROM `user_details` ORDER BY `user_details`.`user_id` ASC");
	$count=mysql_num_rows($result);
	while($get = mysql_fetch_array($result)) {
		echo'<tr>';
		echo '<td>'.$get['user_id'].'</td>';
		echo '<td>'.$get['user_name'].'</td>';
		echo '<td>'.$get['user_email'].'</td>';
		echo '<td>'.$get['user_password'].'</td>';
		echo '<td align="center"><input type=checkbox name="userID[]" value="'.$get['user_id'].'"></td>';
		echo'</tr>';
	}
	
	echo '<tr><td align="right" colspan="4">Number of Users : </td><td align="right">'.$count.' </td></tr>';
?>
</table>
</form>
</div>
 
<div class="newadmin"> 
<h3 align="center" style="color:#009595;">Set New Admin</h3>
<table  align="center" width="80%">
<form method="post" action="php/adminValid.php">
<tr>
<td align="right">Admin Name :</td>
<td><input type="text" name="name" /></td>
</tr>
<tr>
<td align="right">Admin Email :</td>
<td><input type="email" name="email" /></td>
</tr>
<tr>
<td align="right">Admin password :</td>
<td><input type="password" name="password" /></td>
</tr>
<tr>
<td align="right">Re type password :</td>
<td><input type="password" name="repassword" /></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" name="submit" value="submit"/></td>
</tr>
</form>
</div>	
	
<?php 
if (isset($_POST['delete'])) {

	$user_id=$_POST['userID'];
	
	function phpAlert($msg) {
					echo '<script type="text/javascript">
					window.alert("' . $msg . '")
					window.location.href="adminMain.php";
					</script>';	
					}
	
	if($user_id==null){
		phpAlert("Select a User to Delete");
	}else{
		
		$N=count($user_id);
		include ('php/connection.php');
		
		for($i=0; $i<$N; $i++){
			
				$sql="DELETE from user_details where user_id='$user_id[$i]'";
				mysql_query($sql);
		}
		phpAlert("Successfully Deleted..!");
	}
}	

?>	
				
</body>
</html>
