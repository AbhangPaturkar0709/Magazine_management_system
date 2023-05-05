<?php 
session_start();
include("includes/header.php");
if(isset($_SESSION['users_auth']))
{
    $_SESSION['status'] = "You are already logged In.";
    header("Location: index.php");
    exit(0);
}
?>
<style>
    .divider:after,
.divider:before {
content: "";
flex: 1;
height: 1px;
background: #eee;
}
.h-custom {
height: calc(100% - 73px);
}
@media (max-width: 450px) {
.h-custom {
height: 100%;
}
}
</style>
<section class="vh-100 bg-info">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="../images/1.png"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
      
        <form action="logincode.php" method="POST">
          <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
            <p class="lead fw-normal mb-0 me-3"><b>Magazine Management System</b></p>
          </div>

          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0">Sign In</p>
          </div>
          <?php
            if(isset($_SESSION['auth_status']))
            {
                ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Hey! </strong><?php echo $_SESSION['auth_status']; ?>
                    <button type="button" class ="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
                unset($_SESSION['auth_status']);
            }

            ?>
            <?php 
                include("message.php");
            ?>
            <div class="form-group">
                <label for="">Email ID</label>
                <input type="text" name="email" class = "form-control" placeholder="Enter Email Id">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="password" class = "form-control" placeholder="Enter Password">
            </div>
            <hr>
            <div class="form-group">
                <input type="submit" name="login_btn" class = "btn btn-primary btn-block" value="Login">
            </div>
            <hr>
            <div class="form-group">
                <a href="../index.php" class="text-white" >Go To Website</a>
            </div>
        </form>
      </div>
    </div>
  </div>
  <div
    class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-secondary">
    <strong>Copyright &copy; 2022-2023 <a href="http://localhost/magazine_management_system/index.php" class="text-info" >Magazine Management System</a></strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </div>
</section>

<?php
include("includes/script.php");
?>