<?php 
include("includes/header.php");
include("authentication.php");
include("includes/topbar.php");
include("includes/sidebar.php");
?>

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  <!-- Modal -->
  <div class="modal fade" id="RemoveConfirmation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="confirmationLabel">confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="" method= "POST">
          <div class="modal-body">
            <input type="hidden" name="stud_id" id="user_id">
            Are your sure to Remove from Coordinator ? 
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-danger" name="RemoveRole">YES</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
            </div>
            </form>
        </div>
      </div>
    </div>

    <?php
    if(isset($_POST['RemoveRole']))
    {
        $idcode = $_POST['stud_id'];
        include("config/connection.php");
        $query = "update users set role = 'STUDENT' where id = '$idcode'";
        mysqli_query($connect, $query);
        mysqli_close($connect);
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
              <li class="breadcrumb-item active">Users</li>
              <li class="breadcrumb-item active">Co-ordinator</li>
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
                <h3 class="card-title">Registered Co-ordinator</h3>
                <a href="Register_coordinator.php" class = "btn btn-primary float-right">Enroll Co-ordinator</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <?php if($_SESSION['auth_admin']['admin_role'] == "ADMIN"){?>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Sr. No.</th>
                      <th>ID Code</th>
                      <th>Full Name</th>
                      <th>Department</th>
                      <th>Year</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $i = 1;
                      include("config/connection.php");
                      $query = "Select u.id, u.firstname, u.middlename, u.lastname, d.d_name, u.year from users as u inner join department as d on u.deptno = d.id where u.role = 'COORDINATOR'";
                      $result = mysqli_query($connect, $query);
                      if(mysqli_num_rows($result) > 0)
                      {
                      while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $i++; ?></td>
                      <td class="text"><?php echo $row['id'] ?></td>
                      <td class="text"><?php echo ucwords($row['firstname']." ".$row['middlename']." ".$row['lastname']) ?></td>
                      <td class="text"><?php echo ucwords($row['d_name']) ?></td>
                      <td class="text"><?php echo $row['year']." Year" ?></td>
                      <td align="center"><button type="button" value="<?php echo $row['id'] ?>" class="btn btn-danger btn-sm RemoveRole">Remove</button></td>
						        </tr>
                    <?php 
                          }
                          mysqli_close($connect);  
                        }
                        else
                        {
                            ?>
                              <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                <strong>Hey..!</strong> No Data Found...
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>
                            <?php
                        }
                    ?>
                  </tbody>
                </table>
                <?php }elseif($_SESSION['auth_admin']['admin_role'] == "STAFF"){?>
                  <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Sr. No.</th>
                      <th>ID Code</th>
                      <th>Full Name</th>
                      <th>Year</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $i = 1;
                      include("config/connection.php");
                      $dept = $_SESSION['auth_admin']['admin_dept'];
                      $query = "Select u.id, u.firstname, u.middlename, u.lastname, u.year from users as u inner join department as d on u.deptno = d.id where u.role = 'COORDINATOR' && d.d_name='$dept'";
                      $result = mysqli_query($connect, $query);
                      if(mysqli_num_rows($result) > 0)
                      {
                      while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $i++; ?></td>
                      <td class="text"><?php echo $row['id'] ?></td>
                      <td class="text"><?php echo ucwords($row['firstname']." ".$row['middlename']." ".$row['lastname']) ?></td>
                      <td class="text"><?php echo $row['year']." Year" ?></td>
                      <td align="center"><button type="button" value="<?php echo $row['id'] ?>" class="btn btn-danger btn-sm RemoveRole">Remove</button></td>
						        </tr>
                    <?php 
                          }
                          mysqli_close($connect);
                        }
                        else
                        {
                            ?>
                              <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                <strong>Hey..!</strong> No Data Found...
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>
                            <?php
                        }
                    ?>
                  </tbody>
                </table>
                <?php } ?>
             </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
<?php
include("includes/script.php");
?>
<script>
  $(document).ready(function (){
    $('.RemoveRole').click(function (e) {
      e.preventDefault();
      var usr_id = $(this).val();

      $('#user_id').val(usr_id);
      $('#RemoveConfirmation').modal('show');
      
    });
  });
</script>
<?php
include("includes/footer.php");
?>

