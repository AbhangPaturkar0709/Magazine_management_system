<?php 
include("includes/header.php");
include("authentication.php");
include("includes/topbar.php");
include("includes/sidebar.php");
?>

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  <!-- Modal -->
  <div class="modal fade" id="confirmation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            Are your sure to change role as Coordinator ? 
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" name="change_role">YES</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
            </div>
            </form>
        </div>
      </div>
    </div>

    <?php
    if(isset($_POST['change_role']))
    {
        $idcode = $_POST['stud_id'];
        include("config/connection.php");
        $query = "update users set role = 'COORDINATOR' where id = '$idcode'";
        mysqli_query($connect, $query);
        unset($_POST['DEPT']); 
        unset($_POST['SEMESTER']);
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
                <h3 class="card-title">Registered Coordinator</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php if(isset($_POST['DEPT']) && isset($_POST['SEMESTER'])){ ?>
                  <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Sr. No.</th>
                      <th>ID Code</th>
                      <th>Full Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $i = 1;
                      include("../inc/connection.php");
                      $dept = $_POST['DEPT'];
                      $query = "select usr.id, usr.firstname, usr.middlename, usr.lastname FROM users AS usr JOIN department AS dpt ON usr.deptno = dpt.id WHERE usr.role = 'STUDENT' && dpt.id = '$dept'";
                      $result = mysqli_query($connect, $query);
                      if(mysqli_num_rows($result) > 0)
                      {
                      while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $i++; ?></td>
                      <td class="text"><?php echo $row['id'] ?></td>
                      <td class="text"><?php echo ucwords($row['firstname']." ".$row['middlename']." ".$row['lastname']) ?></td>
                      <td align="center">
                        <button type="button" value="<?php echo $row['id']; ?>" class="btn btn-primary btn-sm ChangeRole">Register as Coordinator</button>
                      </td>
						        </tr>
                    <?php 
                          }
                        }
                        else
                        {
                            ?>
                              <tr>
                                <td style="background:white">No Article Found.<?php echo $dept?></td>
                              </tr>
                            <?php
                        }
                    ?>
                  </tbody>
                </table>
                        <?php } else {?>

                          <form action="" method="POST">
                  <div class="row justify-content-between align-items-top">
                  <div class="row">
                    <div class="col">
                      <select name="DEPT" class="form-control">
                        <option value="-1">Select Department</option>
                            <?php 
                              include("config/connection.php");
                              $query = "select * from department";
                              $result = mysqli_query($connect, $query);
                              while($row = mysqli_fetch_assoc($result))
                              {
                                echo "<option value = '";
                                echo $row['id'];
                                echo "'>";
                                echo $row['d_name'];
                                echo "</option>";
                              }
                            ?>
                          </select>
                          </div>
                          <div class="col">
                          <select name="SEMESTER" class="form-control">
                            <option value="-1">Select Semester</option>
                            <?php 
                              include("config/connection.php");
                              $query = "select * from department";
                              $result = mysqli_query($connect, $query);
                              while($row = mysqli_fetch_assoc($result))
                              {
                                echo "<option value = '";
                                echo $row['id'];
                                echo "'>";
                                echo $row['d_name'];
                                echo "</option>";
                              }
                            ?>
                          </select>
                          </div>
                          <div class="col-auto">
                              <input type="submit" name="srch_stud" class="btn bg-gradient-success" value= "Search">
                          </div>
                        </div>
                            </div>
                            </form>
                            <!-- </div> -->
                            <hr>
                            <!-- <div class="card-body"> -->
                            <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Sr. No.</th>
                      <th>ID Code</th>
                      <th>Full Name</th>
                      <th>Department</th>
                      <th>Role</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $i = 1;
                      include("../inc/connection.php");
                      $query = "select usr.id, usr.firstname, usr.middlename, usr.lastname, usr.role, dpt.d_name FROM users AS usr JOIN department AS dpt ON usr.deptno = dpt.id WHERE usr.role = 'COORDINATOR'";
                      $result = mysqli_query($connect, $query);
                      if(mysqli_num_rows($result) > 0)
                      {
                      while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $i++; ?></td>
                      <td class="text"><?php echo $row['id'] ?></td>
                      <td class="text"><?php echo ucwords($row['firstname']." ".$row['middlename']." ".$row['lastname']) ?></td>
                      <td class="text"><?php echo ucwords($row['d_name'] ) ?></td>
                      <td align="center"><?php echo $row['role']; ?></td>
						        </tr>
                    <?php 
                          }
                        }
                        else
                        {
                            ?>
                              <tr>
                                <td style="background:white">No Article Found.<?php echo $dept?></td>
                              </tr>
                            <?php
                        }
                    ?>
                  </tbody>
                </table>

                <?php }   ?>
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
    $('.ChangeRole').click(function (e) {
      e.preventDefault();
      var usr_id = $(this).val();
      // console.log(usr_id);
      $('#user_id').val(usr_id);
      $('#confirmation').modal('show');
      
    });
  });
</script> 
<?php 
include("includes/footer.php");
?>

