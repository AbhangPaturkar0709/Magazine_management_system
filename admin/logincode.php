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
                $admin_id = $row['id'];
                $admin_firstname = $row['firstname'];
                $admin_middlename = $row['middlename'];
                $admin_lastname = $row['lastname'];
                $admin_dept = $row['d_name'];
                $admin_role = $row['role'];
                $admin_email = $row['email'];
                $admin_mob = $row['mob'];
            }
            mysqli_close($connect);
            $_SESSION['admin_auth'] = true;
            $_SESSION['auth_admin'] = [
                'admin_id' => $admin_id,
                'admin_firstname' => $admin_firstname,
                'admin_middlename' => $admin_middlename,
                'admin_lastname' => $admin_lastname,
                'admin_dept' => $admin_dept,
                'admin_role' => $admin_role,
                'admin_email' => $admin_email,
                'admin_mob' => $admin_mob
            ];
            $_SESSION['status'] = "Logged In Successfully";
            
            header("Location: index.php");

        }
        else
        {
            $query = "select users.id, users.firstname, users.middlename, users.lastname, users.role, users.email, users.mob FROM users WHERE email = '$email' AND PASSWORD='$password'";
        
            $result = mysqli_query($connect, $query);

            if(mysqli_num_rows($result) > 0)
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    $admin_id = $row['id'];
                    $admin_firstname = $row['firstname'];
                    $admin_middlename = $row['middlename'];
                    $admin_lastname = $row['lastname'];
                    $admin_role = $row['role'];
                    $admin_email = $row['email'];
                    $admin_mob = $row['mob'];
                }
                mysqli_close($connect);
                $_SESSION['admin_auth'] = true;
                $_SESSION['auth_admin'] = [
                    'admin_id' => $admin_id,
                    'admin_firstname' => $admin_firstname,
                    'admin_middlename' => $admin_middlename,
                    'admin_lastname' => $admin_lastname,
                    'admin_role' => $admin_role,
                    'admin_email' => $admin_email,
                    'admin_mob' => $admin_mob
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
    }
    else
    {
        $_SESSION['status'] = "Access Denied";
        header("Location: login.php");
    }
?>