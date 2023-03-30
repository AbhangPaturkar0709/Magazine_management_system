<?php
session_start();

if(!isset($_SESSION['users_auth']))
{
    $_SESSION['auth_status'] = "Login to Access System.";
    header("Location: login.php");
    exit();
}
?>

