<?php
session_start();
error_reporting(E_ERROR);
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

//////chaeck for URL validation

if(!isset($_GET['s_url']) || trim($_GET['s_url'])===""){
	header('location:index.php');
}else if(filter_var($_GET['s_url'], FILTER_VALIDATE_URL)===false){
	header('location:index.php?urlValid="false"');
}else{
		$url=$_GET['s_url'];
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

						<div class="searchBox" style="width:60%">
							<form id="form1" name="form1" method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
								<input type="text" name="s_url" id="s_url" size="50" class="searchBar" value="<?php echo $url; ?>" />
								<input type="submit" name="image" id="button" class="searchBtn" style="right:300px;" value="Images" />
								<input type="submit" name="links" id="button" class="searchBtn" style="right:170px;" value="Other Links" />
							</form>
						</div>

						

<?php

//images showing
if(!isset($_GET['links'])){
include("Crawler.php");
$mycrawler=new Crawler();
$image=$mycrawler->crawlImage($url);

//print the result

/////////////////////////if image not found
if(sizeof($image['link'])>0){
for($i=0;$i<sizeof($image['link']);$i++)
{
//list($width, $height, $type, $attr) = getimagesize($image['src'][$i]);//not working data-tooltip part
//echo '<div id="img_'.$i.'" style="position:absolute;display:none; background:#ccc;border: 1px solid;z-index: 1;" >'.$attr.'</div>';//not working	
echo '<div class="imgHolder" ><a href="'.$image['link'][$i].'" target="_blank" ><img src="'.$image['src'][$i].'" /></a></div>';
}  
}else{
	
	echo '<p style="color:red;margin:15px;">No Images Found... Sorry..! :(</p>';
}
} else if(isset($_GET['links'])){
include("Crawler.php");
$mycrawler=new Crawler();

if(isset($_GET['s_url'])){
$url=$_GET['s_url'];
}
$link=$mycrawler->crawlLinks($url);

//print the result
echo '</br></br>';
if(sizeof($link['link'])>0){
echo "<table width=\"100%\" border=\"1\">
  <tr>
    <td width=\"30%\"><div align=\"center\"><b>Link Text </b></div></td>
    <td width=\"30%\"><div align=\"center\"><b>Link</b></div></td>
    <td width=\"40%\"><div align=\"center\"><b>Text with Link</b> </div></td>
  </tr>";
for($i=0;$i<sizeof($link['link']);$i++)
{
echo "<tr>
    <td><div align=\"center\">".$link['text'][$i]."</div></td>
    <td><div align=\"center\">".$link['link'][$i]."</div></td>
    <td><div align=\"center\"><a href=\"".$link['link'][$i]."\">".$link['text'][$i]."</a></div></td>
  </tr>";		
		
}
}else{
	
	echo '<p style="color:red;margin:15px;">No Links Found... Sorry..! :(</p>';
}  
echo "</table>";
}
?>

<!-----Not Working--
<script>
$("a").hover(function(e) {
    $($(this).data("tooltip")).css({
        left: e.pageX + 1,
        top: e.pageY + 1
    }).stop().show(100);
}, function() {
    $($(this).data("tooltip")).hide();
});
</script>	
<--->
</body>
</html>
