<?php
session_start();

if(!isset($_SESSION['auth']))
{
    $_SESSION['auth_status'] = "Login to Access Dashboard.";
    header("Location: ../student/login.php");
    exit();
}
elseif(isset($_SESSION['auth']))
{
    if($_SESSION['auth_user']['user_role'] == "ADMIN")
    {
        $_SESSION['auth_status'] = "You are already login...";
        header("Location: ../admin/login.php");
        exit();
    }
    if($_SESSION['auth_user']['user_role'] == "STUDENT")
    {
        $_SESSION['auth_status'] = "You are already login...";
        header("Location: ../student/login.php");
        exit();
    }
}

?>

