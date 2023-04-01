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
<div class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 my-5">
                <div class="card my-5">
                    <div class="card-header bg-light">
                        <h5>Users Login</h5>
                    </div>
                    <div class="card-body">
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
                        <form action="logincode.php" method="POST">
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
                                <a href="../index.html" >Back To Home Page</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include("includes/script.php");
include("includes/footer.php");
?>