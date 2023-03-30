<?php
    session_start();

    if(isset($_POST['logout_btn']))
    {
        session_destroy();
        unset($_SESSION['auth']);
        unset($_SESSION['auth_admin']);

        $_SESSION['status'] = "Logged out successfully.";
        header("Location: login.php");
        exit(0);
    }
?>