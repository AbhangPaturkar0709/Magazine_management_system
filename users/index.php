<?php 
include("includes/header.php");
include("authentication.php");
include("includes/topbar.php");
include("includes/sidebar.php");
?>

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">

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
      $id = strtoupper($_SESSION['auth_user']['user_id']);
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
        <?php if($_SESSION['auth_user']['user_role'] == "STUDENT"){?>
        <!-- Small boxes (Stat box) -->
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
                <h3 class="card-title">Articles Status</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>

                </div>
              </div>
              <div class="card-body">
                <canvas id="pieChartMyArtStatusWise" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- ./col -->
          </section>
      <!-- /.content -->
    </div>
<?php
include("includes/script.php");
?>
<script>
<?php
     include("config/connection.php");
     $id = $_SESSION['auth_user']['user_id'];

     $query = "select count(*) from articles WHERE status = 'pending' AND stud_id = '$id'";
     $result = mysqli_query($connect, $query);
     $row = mysqli_fetch_assoc($result);
     $count_myart_pending = $row['count(*)'];

     $query = "select count(*) from articles WHERE status = 'Approved' AND stud_id = '$id'";
     $result = mysqli_query($connect, $query);
     $row = mysqli_fetch_assoc($result);
     $count_myart_approved = $row['count(*)'];

     $query = "select count(*) from articles WHERE status = 'Modify' AND stud_id = '$id'";
     $result = mysqli_query($connect, $query);
     $row = mysqli_fetch_assoc($result);
     $count_myart_modify = $row['count(*)'];

     $query = "select count(*) from articles WHERE status = 'Rejected' AND stud_id = '$id'";
     $result = mysqli_query($connect, $query);
     $row = mysqli_fetch_assoc($result);
     $count_myart_rejected = $row['count(*)'];

     mysqli_close($connect);
  ?>
  
  $(function () {
    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartMyArtStatusWiseCanvas = $('#pieChartMyArtStatusWise').get(0).getContext('2d')

    var pieDataMyArtStatusWise        = {
      labels: [
          'Pending',
          'Approved',
          'Under Modification',
          'Rejected',
      ],
      datasets: [
        {
          data: [<?php echo $count_myart_pending?>, <?php echo $count_myart_approved?>, <?php echo $count_myart_modify?>, <?php echo $count_myart_rejected?>],
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
    new Chart(pieChartMyArtStatusWiseCanvas, {
      type: 'pie',
      data: pieDataMyArtStatusWise ,
      options: pieOptions
    })

  })
</script>
<?php 
include("includes/footer.php");
}elseif($_SESSION['auth_user']['user_role'] == "COORDINATOR"){ ?>

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
                <h3 class="card-title">Articles Status</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>

                </div>
              </div>
              <div class="card-body">
                <canvas id="pieChartMyArtStatusWise" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
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
                <h3 class="card-title">Students Articles Status</h3>

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
     $dept = $_SESSION['auth_user']['user_dept'];
     $id = $_SESSION['auth_user']['user_id'];

     $query = "select count(*) from articles WHERE status = 'pending' AND stud_id = '$id'";
     $result = mysqli_query($connect, $query);
     $row = mysqli_fetch_assoc($result);
     $count_myart_pending = $row['count(*)'];

     $query = "select count(*) from articles WHERE status = 'Approved' AND stud_id = '$id'";
     $result = mysqli_query($connect, $query);
     $row = mysqli_fetch_assoc($result);
     $count_myart_approved = $row['count(*)'];

     $query = "select count(*) from articles WHERE status = 'Modify' AND stud_id = '$id'";
     $result = mysqli_query($connect, $query);
     $row = mysqli_fetch_assoc($result);
     $count_myart_modify = $row['count(*)'];

     $query = "select count(*) from articles WHERE status = 'Rejected' AND stud_id = '$id'";
     $result = mysqli_query($connect, $query);
     $row = mysqli_fetch_assoc($result);
     $count_myart_rejected = $row['count(*)'];

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
    var pieChartMyArtStatusWiseCanvas = $('#pieChartMyArtStatusWise').get(0).getContext('2d')
    var pieChartStatusWiseCanvas = $('#pieChartStatusWise').get(0).getContext('2d')

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

    var pieDataMyArtStatusWise        = {
      labels: [
          'Pending',
          'Approved',
          'Under Modification',
          'Rejected',
      ],
      datasets: [
        {
          data: [<?php echo $count_myart_pending?>, <?php echo $count_myart_approved?>, <?php echo $count_myart_modify?>, <?php echo $count_myart_rejected?>],
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
    new Chart(pieChartMyArtStatusWiseCanvas, {
      type: 'pie',
      data: pieDataMyArtStatusWise ,
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
}
?>