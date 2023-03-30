<?php
session_start();

if(!isset($_SESSION['admin_auth']))
{
    $_SESSION['auth_status'] = "Login to Access Admin Dashboard.";
    header("Location: login.php");
    exit();
}
?>

