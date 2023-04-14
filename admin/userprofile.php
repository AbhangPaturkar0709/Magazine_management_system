<?php 
include("authentication.php");
include("includes/header.php");
include("includes/topbar.php");
include("includes/sidebar.php");

include("config/connection.php");
$idcode = $_GET['id'];
$query = "select u.id, u.firstname, u.middlename, u.lastname, u.email, u.mob, u.year, d.d_name FROM users AS u INNER JOIN department AS d ON u.deptno = d.id WHERE u.id = '$idcode'";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);
mysqli_close($connect);

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">User Profile</h3>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-md-auto text-center">
                                    <div class="row align-items-start">
                                        <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius" alt="User-Profile-Image">
                                    </div>
                                    <div class="row align-item-end">
                                        <p class="text-center"><b> -: <?php echo $row['id'] ?> :- </b></p>
                                    </div>
                                    <div class="row align-item-end">
                                    <?php if($_GET['page'] == "staffprof"){?>
                                        <p class="text-muted"><?php echo "Prof. ".ucwords($row['firstname']." ".ucwords($row['lastname']))?></p>
                                            <?php }elseif($_GET['page'] == "studprof"){?>
                                            <p class="text-muted"><?php echo ucwords($row['firstname']." ".ucwords($row['lastname']))?></p>   
                                            <?php }?>
                                        
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-auto">
                                <h6 class="text-bold">-- Details --</h6>
                                    <div class="row">
                                        <div class="col">
                                            <p class="m-b-10 f-w-600">Full Name : </p>
                                            <?php if($_GET['page'] == "staffprof"){?>
                                            <h6 class="text-muted f-w-400"><i><?php echo "Prof. ".ucwords($row['firstname']." ". ucwords($row['middlename'])." ".ucwords($row['lastname']))?></i></h6>
                                            <?php }elseif($_GET['page'] == "studprof"){?>
                                            <h6 class="text-muted f-w-400"><i><?php echo ucwords($row['firstname']." ". ucwords($row['middlename'])." ".ucwords($row['lastname']))?></i></h6>   
                                            <?php }?>
                                        </div>
                                        <div class="col">
                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <p class="m-b-10 f-w-600">Department :</p>
                                            <h6 class="text-muted f-w-400"><i><?php echo ucwords($row['d_name'])?></i></h6>
                                        </div>
                                        <?php if($_GET['page'] == "studprof"){?>
                                        <div class="col">
                                            <p class="m-b-10 f-w-600">Year : </p>
                                            <h6 class="text-muted f-w-400"><i><?php echo $row['year']." Year"; ?></i></h6>
                                        </div>
                                        <?php }?>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <p class="m-b-10 f-w-600">Email : </p>
                                            <h6 class="text-muted f-w-400"><i><?php echo $row['email']?></i></h6>
                                        </div>
                                        <div class="col">
                                            <p class="m-b-10 f-w-600">Phone :</p>
                                            <h6 class="text-muted f-w-400"><i><?php echo "+91-".$row['mob']?></i></h6>
                                        </div>
                                    </div>
                                    <ul class="social-link list-unstyled m-t-40 m-b-10">
                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="facebook" data-abc="true"><i class="mdi mdi-facebook feather icon-facebook facebook" aria-hidden="true"></i></a></li>
                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="twitter" data-abc="true"><i class="mdi mdi-twitter feather icon-twitter twitter" aria-hidden="true"></i></a></li>
                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="instagram" data-abc="true"><i class="mdi mdi-instagram feather icon-instagram instagram" aria-hidden="true"></i></a></li>
                                    </ul>
                            </div>
                            <hr>
                            <div class="col-auto">
                            <div class="d-flex align-items-center">
                            <?php if($_GET['page'] == "staffprof"){?>
                                <a href="./staff.php" class="btn btn-primary"><i class="fa fa-angle-left"></i> Back to List</a>
                                            <?php }elseif($_GET['page'] == "studprof"){?>
                                                <a href="./student.php" class="btn btn-primary"><i class="fa fa-angle-left"></i> Back to List</a>
                                            <?php }elseif($_GET['page'] == "staffprof1"){?>
                                            <a href="./index.php" class="btn btn-primary"><i class="fa fa-angle-left"></i> Back to List</a>
                                            <?php }?>
                             </div>
                          </div>
                        </div>
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