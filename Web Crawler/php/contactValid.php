
<?php

$contact_name = $_POST['user_name'];
$contact_email = $_POST['email'];
$contact_subject = $_POST['subject'];
$contact_message = $_POST['message'];


function phpAlert($msg) {
    echo '<script type="text/javascript">
			window.alert("' . $msg . '")
			window.location.href="../contact.php";
			</script>';	
}

if ($_POST['submit']){

	if( $contact_subject != '' && $contact_message != '' )
	{
		$sender = $contact_email;
		$receiver = "dansanrox@gmail.com";
		$client_ip = $_SERVER['REMOTE_ADDR'];
		$email_body = "Name: $contact_name \nEmail: $sender \n\nSubject: $contact_subject \n\nMessage: \n\n$contact_message \n\nIP: $client_ip ";		
		$extra = "From:{$contact_email}";

		if( mail($receiver,"Contact-Dhanuka Online",$email_body,$extra )) {
			
			
			
			
			phpAlert(   "Your message is successfully sent"   ); 
			
			}else{
			phpAlert(   "Your message is NOT sent"   ); 
			}

	}else {
	phpAlert(   "Please fill the Subject & Message"   ); 

	}
}

?>
</head>

<body>

</body>
</html>