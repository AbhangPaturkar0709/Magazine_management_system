<!DOCTYPE html>
<html lang="en">
  <head>
  <link rel="icon" href="LOGO.png"/>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />

    <title>Magazine Management System</title>
  </head>
  <body>
    <?php
      session_start();
      include("inc/top_navbar.php");
      if(isset($_SESSION['auth']))
      {
        $_SESSION['role_as'] = "";
          
        if($_SESSION['role_as'] == "STUDENT")
        {
            $_SESSION['status'] = "Please Logout to access Home page.";
            header("Location: student/index.php");
           exit(0);
        }
          
        elseif($_SESSION['role_as'] == "COORDINATOR")
        {
            $_SESSION['status'] = "Please Logout to access Home page.";
            header("Location: coordinator/index.php");
            exit(0);
        }
      }
  ?>
  </body>
</html>
