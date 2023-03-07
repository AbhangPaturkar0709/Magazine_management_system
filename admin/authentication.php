<?php
session_start();

if(!isset($_SESSION['auth']))
{
    $_SESSION['auth_status'] = "Login to Access Admin Dashboard.";
    header("Location: login.php");
    exit();
}
?>

