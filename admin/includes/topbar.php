<?php 
  if(session_status() === PHP_SESSION_NONE)
  {
    session_start();
  } 
  ?>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <?php 
        if($_SESSION['auth_admin']['admin_role'] == "ADMIN")
        {
        }
        elseif($_SESSION['auth_admin']['admin_role'] == "STAFF")
        {?>
          <li class="nav-item">
            <a class="nav-link"><span class = "ml-3"><b><?php echo ucwords($_SESSION['auth_admin']['admin_dept'])." DEPARTMENT</b> ( <i>STAFF</i> )" ?></span></a>
          </li>
        <?php
        }?>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    <li class="nav-item">
        <a href="#" class="nav-link"><span class = "ml-3">
          <?php  
            if(isset($_SESSION['admin_auth']))
            {
              if($_SESSION['auth_admin']['admin_role'] == "ADMIN")
              {
                echo $_SESSION['auth_admin']['admin_firstname'];
              }
              elseif($_SESSION['auth_admin']['admin_role'] == "STAFF")
              {
                $fn = substr(ucwords($_SESSION['auth_admin']['admin_firstname']), 0, 1);
                $mn = substr(ucwords($_SESSION['auth_admin']['admin_middlename']), 0, 1);
                $ln = ucwords($_SESSION['auth_admin']['admin_lastname']);
                echo "Prof. ".$fn.". ".$mn.". ".$ln;
              }
            }
            else
            {
              echo "Not Logged In";
            }
          ?></span></a>
      </li>
      <li class="nav-item">
        <form action="logoutcode.php" method="POST">
        <button type = "submit" class = "button-solid nav-link" name = "logout_btn" style="border:none; background:none;"><span class="fas fa-sign-out-alt"></span></button>
          </form>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->