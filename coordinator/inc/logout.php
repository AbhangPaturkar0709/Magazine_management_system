<?php
session_start();

if(isset($_SESSION['student_email']))
{

	unset($_SESSION['student_email']);
	header("Location:../../start.php");
	
}

?>