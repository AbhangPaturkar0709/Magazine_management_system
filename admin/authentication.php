<?php
session_start();

if(!isset($_SESSION['auth']))
{
    $_SESSION['auth_status'] = "Login to Access Admin Dashboard.";
    header("Location: login.php");
    exit();
}
elseif(isset($_SESSION['auth']))
{
    if($_SESSION['auth_user']['user_role'] == "STUDENT")
    {
        $_SESSION['auth_status'] = "Login with admin email id & password to access Admin Dashboard.";
        header("Location: login.php");
        exit();
    }
    if($_SESSION['auth_user']['user_role'] == "COORDINATOR")
    {
        $_SESSION['auth_status'] = "Login with admin email id & password to access Admin Dashboard.";
        header("Location: login.php");
        exit();
    }
}
?>

