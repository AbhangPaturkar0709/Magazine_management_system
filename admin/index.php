<?php 
include("authentication.php");
include("includes/header.php");
include("includes/topbar.php");
include("includes/sidebar.php");
?>

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
<!-- Modal Change pass -->
<div class="modal fade" id="ChangePassModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="confirmationLabel">Change Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="" method= "POST">
          <div class="modal-body">
            <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for ="pass">New Password</label>
                    <input type="password" name="pass" class="form-control" id = "pass" value="" placeholder ="Enter Password" required>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for ="cpass">Confirm New Password</label>
                    <input type="password" name="cpass" class="form-control" id = "cpass" value="" placeholder ="Re-enter Password" required>
                  </div>
                </div>
              </div> 
              <div class="row">
                    <div class="col"><span class=
                      "text-danger"><small>* Password should be at least 8 character in length and should include <br>at least one uppercase/lowercase letter, one number, and one special character.</small></span>
                    </div>

                    <div class="col-md-2"><input type="checkbox" onclick="Toogle()"><span class=
                      "text"><small> Show Password</small></span>
                    </div>
                  </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success" name="ChangePass">Change</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
            </div>
            </form>
        </div>
      </div>
    </div>
    <script>
      function Toogle() {
        var temp = document.getElementById("pass");
        var ctemp = document.getElementById("cpass");
        if(temp.type === "password"){
          temp.type = "text";
          ctemp.type = "text";
        }
        else{
          temp.type = "password";
          ctemp.type = "password";
        }

      }
    </script>

<?php
    if(isset($_POST['ChangePass']))
    {
      $id = strtoupper($_SESSION['auth_admin']['admin_id']);
      $pass = $_POST['pass'];
      $cpass = $_POST['cpass'];

      if($pass !== $cpass)
      {
        $_SESSION['status'] = "Password and Confirm Password must be same...";
      }
      elseif($pass === $cpass)
      {
        $uppercase = preg_match('@[A-Z]@', $pass);
        $lowercase = preg_match('@[a-z]@', $pass);
        $number = preg_match('@[0-9]@', $pass);
        $specialchar = preg_match('@[^\w]@', $pass);

        if(!$uppercase || !$lowercase || !$number || !$specialchar || strlen($pass) < 8)
        {
          $_SESSION['status'] = "Password should be at least 8 character in length and should include at least one uppercase/lowercase letter, one number, and one special character. ";
        }
        else
        {
          include("config/connection.php");
          
          $query = "update users set password = '$pass' where id = '$id'";
          if(mysqli_query($connect, $query))
          {
              $_SESSION['status'] = "Password Changed successfully...";
          }
        }

      }
    }
    ?>

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <?php if($_SESSION['auth_admin']['admin_role'] == "ADMIN"){?>
        <div class="row">
          <div class="col-md-12">
            <?php
              include("message.php");
            ?>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <?php 
                include("config/connection.php");
                $query = "select count(id) from users where role in ('STUDENT','COORDINATOR')";
                $result = mysqli_query($connect, $query);
                $row = mysqli_fetch_assoc($result);
                echo "<h3>".$row['count(id)']."</h3>";
                mysqli_close($connect);
                ?>
                
                <p>Total Students</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="student.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <?php 
                include("config/connection.php");
                $query = "select count(id) from users where role ='STAFF'";
                $result = mysqli_query($connect, $query);
                $row = mysqli_fetch_assoc($result);
                echo "<h3>".$row['count(id)']."</h3>";
                mysqli_close($connect);
                ?>

                <p>Total Staff</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="staff.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              <?php 
                include("config/connection.php");
                $query = "select count(*) from articles INNER JOIN users ON articles.stud_id = users.id WHERE users.role IN ('STUDENT', 'COORDINATOR')";
                $result = mysqli_query($connect, $query);
                $row = mysqli_fetch_assoc($result);
                echo "<h3>".$row['count(*)']."</h3>";
                mysqli_close($connect);
                ?>

                <p>Total Students Article</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-copy"></i>
              </div>
              <a href="student_articles.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
              <?php 
                include("config/connection.php");
                $query = "select count(*) from department";
                $result = mysqli_query($connect, $query);
                $row = mysqli_fetch_assoc($result);
                echo "<h3>".$row['count(*)']."</h3>";
                mysqli_close($connect);
                ?>

                <p>Total Deparment</p>
              </div>
              <div class="icon">
                <i class="fa fa-building"></i>
              </div>
              <a href="department.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->   
        </div>
        <!-- /.row -->
        <?php }elseif($_SESSION['auth_admin']['admin_role'] == "STAFF"){?>
        <div class="row">
          <div class="col-md-12">
            <?php
              include("message.php");
            ?>
          </div>
          <div class="col-lg-4 col-6">
            <!-- PIE CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Total Students ( Year Wise )</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>

                </div>
              </div>
              <div class="card-body">
                <canvas id="pieChartStudYearWise" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- ./col -->  
          <div class="col-lg-4 col-6">
            <!-- PIE CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Students Contribution ( Year Wise )</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>

                </div>
              </div>
              <div class="card-body">
                <canvas id="pieChartYearWise" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- ./col -->

          <div class="col-lg-4 col-6">
            <!-- PIE CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Articles Status</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>

                </div>
              </div>
              <div class="card-body">
                <canvas id="pieChartStatusWise" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- ./col -->  
        </div>
        <!-- /.row -->
        </div>
        <?php }?>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?php
include("includes/script.php");
?>
<script>
  <?php
     include("config/connection.php");
     $dept = $_SESSION['auth_admin']['admin_dept'];

     $query = "select count(*) from users inner join department ON users.deptno = department.id WHERE users.year = '1st' AND department.d_name = '$dept'";
     $result = mysqli_query($connect, $query);
     $row = mysqli_fetch_assoc($result);
     $count_1st_stud = $row['count(*)'];

     $query = "select count(*) from users inner join department ON users.deptno = department.id WHERE users.year = '2nd' AND department.d_name = '$dept'";
     $result = mysqli_query($connect, $query);
     $row = mysqli_fetch_assoc($result);
     $count_2nd_stud = $row['count(*)'];

     $query = "select count(*) from users inner join department ON users.deptno = department.id WHERE users.year = '3rd' AND department.d_name = '$dept'";
     $result = mysqli_query($connect, $query);
     $row = mysqli_fetch_assoc($result);
     $count_3rd_stud = $row['count(*)'];

     $query = "select count(*) from articles INNER JOIN users ON articles.stud_id = users.id INNER JOIN department ON users.deptno = department.id WHERE users.YEAR = '1st' AND department.d_name = '$dept'";
     $result = mysqli_query($connect, $query);
     $row = mysqli_fetch_assoc($result);
     $count_1_year = $row['count(*)'];

     $query = "select count(*) from articles INNER JOIN users ON articles.stud_id = users.id INNER JOIN department ON users.deptno = department.id WHERE users.YEAR = '2nd' AND department.d_name = '$dept'";
     $result = mysqli_query($connect, $query);
     $row = mysqli_fetch_assoc($result);
     $count_2_year = $row['count(*)'];

     $query = "select count(*) from articles INNER JOIN users ON articles.stud_id = users.id INNER JOIN department ON users.deptno = department.id WHERE users.YEAR = '3rd' AND department.d_name = '$dept'";
     $result = mysqli_query($connect, $query);
     $row = mysqli_fetch_assoc($result);
     $count_3_year = $row['count(*)'];

     $query = "select count(*) from articles INNER JOIN users ON articles.stud_id = users.id INNER JOIN department ON users.deptno = department.id WHERE articles.status = 'pending' AND department.d_name = '$dept'";
     $result = mysqli_query($connect, $query);
     $row = mysqli_fetch_assoc($result);
     $count_pending = $row['count(*)'];

     $query = "select count(*) from articles INNER JOIN users ON articles.stud_id = users.id INNER JOIN department ON users.deptno = department.id WHERE articles.status = 'Approved' AND department.d_name = '$dept'";
     $result = mysqli_query($connect, $query);
     $row = mysqli_fetch_assoc($result);
     $count_approved = $row['count(*)'];

     $query = "select count(*) from articles INNER JOIN users ON articles.stud_id = users.id INNER JOIN department ON users.deptno = department.id WHERE articles.status = 'Modify' AND department.d_name = '$dept'";
     $result = mysqli_query($connect, $query);
     $row = mysqli_fetch_assoc($result);
     $count_modify = $row['count(*)'];

     $query = "select count(*) from articles INNER JOIN users ON articles.stud_id = users.id INNER JOIN department ON users.deptno = department.id WHERE articles.status = 'Rejected' AND department.d_name = '$dept'";
     $result = mysqli_query($connect, $query);
     $row = mysqli_fetch_assoc($result);
     $count_rejected = $row['count(*)'];
     mysqli_close($connect);
  ?>
  
  $(function () {
    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartStudYearWiseCanvas = $('#pieChartStudYearWise').get(0).getContext('2d')
    var pieChartYearWiseCanvas = $('#pieChartYearWise').get(0).getContext('2d')
    var pieChartStatusWiseCanvas = $('#pieChartStatusWise').get(0).getContext('2d')

    var pieDataStudYearWise        = {
      labels: [
          '1st Year',
          '2nd Year',
          '3rd Year',
      ],
      datasets: [
        {
          data: [<?php echo $count_1st_stud?>, <?php echo $count_2nd_stud?>, <?php echo $count_3rd_stud?>],
          backgroundColor : [ '#d2d6de', '#00c0ef', '#3c8dbc'],
        }
      ]
    }

    var pieDataYearWise        = {
      labels: [
          '1st Year',
          '2nd Year',
          '3rd Year',
      ],
      datasets: [
        {
          data: [<?php echo $count_1_year?>, <?php echo $count_2_year?>, <?php echo $count_3_year?>],
          backgroundColor : [ '#d2d6de', '#00c0ef', '#3c8dbc'],
        }
      ]
    }

    var pieDataStatusWise        = {
      labels: [
          'Pending',
          'Approved',
          'Under Modification',
          'Rejected',
      ],
      datasets: [
        {
          data: [<?php echo $count_pending?>, <?php echo $count_approved?>, <?php echo $count_modify?>, <?php echo $count_rejected?>],
          backgroundColor : ['#7c8184', '#5cb85c', '#f0ad4e', '#d9534f'],
        }
      ]
    }

    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(pieChartStudYearWiseCanvas, {
      type: 'pie',
      data: pieDataStudYearWise,
      options: pieOptions
    })

    new Chart(pieChartYearWiseCanvas, {
      type: 'pie',
      data: pieDataYearWise,
      options: pieOptions
    })

    new Chart(pieChartStatusWiseCanvas, {
      type: 'pie',
      data: pieDataStatusWise,
      options: pieOptions
    })

  })
  </script>
    
<?php
include("includes/footer.php");
?>