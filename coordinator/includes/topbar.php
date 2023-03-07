<?php 
  if(session_status() === PHP_SESSION_NONE)
  {
    session_start();
  } ?>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link"><span class = "ml-3"><b><?php echo ucwords($_SESSION['auth_user']['user_dept'])." DEPARTMENT</b> ( <i>STUDENT COORDINATOR</i> )" ?></span></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    <li class="nav-item">
        <a href="#" class="nav-link"><span class = "ml-3">
          <?php  
            if(isset($_SESSION['auth']))
            {
              $fn = ucwords($_SESSION['auth_user']['user_firstname']);
              $mn = ucwords($_SESSION['auth_user']['user_middlename']);
              $ln = ucwords($_SESSION['auth_user']['user_lastname']);
              echo $fn." ".$mn." ".$ln;
            }
            else
            {
              echo "Not Logged In";
            }
          ?></span></a>
      </li>
      <li class="nav-item">
        <form action="../student/logoutcode.php" method="POST">
        <button type = "submit" class = "button-solid nav-link" name = "logout_btn" style="border:none; background:none;"><span class="fas fa-sign-out-alt"></span></button>
          </form>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->