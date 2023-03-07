<?php
    session_start();

    if(isset($_POST['login_btn']))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        include("config/connection.php");
        $query = "select *from users where email='$email' and password='$password'";
        
        $result = mysqli_query($connect, $query);

        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                $user_role = $row['role'];
                $user_email = $row['email'];
            }
            
            if($user_role === "ADMIN")
            {
                $_SESSION['auth'] = true;
                $_SESSION['auth_user'] = [
                    'user_email' => $user_email,
                    'user_role' => $user_role
                ];
                $_SESSION['status'] = "Logged In Successfully";
                header("Location: index.php");
            }
            else
            {
                $_SESSION['status'] = "Invalid Email or Password.";
                header("Location: login.php");
            }
        }
        else
        {
            $_SESSION['status'] = "Invalid Email or Password.";
            header("Location: login.php");
        }
    }
    else
    {
        $_SESSION['status'] = "Access Denied";
        header("Location: login.php");
    }
?>