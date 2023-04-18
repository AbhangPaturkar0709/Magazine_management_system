<?php
    session_start();

    if(isset($_POST['login_btn']))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        include("config/connection.php");
        $query = "select users.id, users.firstname, users.middlename, users.lastname, department.d_name, users.role, users.email, users.mob FROM users INNER JOIN department ON users.deptno=department.id WHERE email = '$email' AND PASSWORD='$password'";
        
        $result = mysqli_query($connect, $query);

        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                $user_id = $row['id'];
                $user_firstname = $row['firstname'];
                $user_middlename = $row['middlename'];
                $user_lastname = $row['lastname'];
                $user_dept = $row['d_name'];
                $user_role = $row['role'];
                $user_email = $row['email'];
                $user_mob = $row['mob'];
            }
            mysqli_close($connect);
            if($user_role == 'STUDENT' || $user_role == 'COORDINATOR')
            {
                $_SESSION['users_auth'] = true;
                $_SESSION['auth_user'] = [
                    'user_id' => $user_id,
                    'user_firstname' => $user_firstname,
                    'user_middlename' => $user_middlename,
                    'user_lastname' => $user_lastname,
                    'user_dept' => $user_dept,
                    'user_role' => $user_role,
                    'user_email' => $user_email,
                    'user_mob' => $user_mob
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