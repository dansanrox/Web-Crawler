<?php
session_start();
	unset ($_SESSION['luser']);

	session_destroy();
	header('Location:../index.php');
	
?>