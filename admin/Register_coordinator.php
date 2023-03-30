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
              <li class="breadcrumb-item active">Register Co-ordinator</li>
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
                <h3 class="card-title">Registered Student</h3><br>
                <hr>
                <form action="" method="POST">
                  <div class="row justify-content-center">
                      <div class="row">
                      <?php if($_SESSION['auth_admin']['admin_role'] == "ADMIN"){?>
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
                              <?php }?>
                          <div class="col">
                              <select name="year" class="form-control">
                                  <option value="-1">Select Year</option>
                                  <option value="1st">1st Year</option>
                                  <option value="2nd">2nd Year</option>
                                  <option value="3rd">3rd Year</option>
                              </select>
                              </div>
                            <div class="col-auto">
                              <input type="submit" name="search_stud" class="btn btn-outline-light" value= "Search">
                              </div>
                        </div>
                      </div>
                    </form>
                </div>
                
              <!-- /.card-header -->
              <div class="card-body">

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
                    <!-- <tr> -->
              <?php
              if(isset($_POST['DEPT']) && isset($_POST['year']))
              {
                if($_POST['DEPT'] == "-1" && $_POST['year'] == "-1")
                {
                  echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                          <strong>Hey..!</strong> No Data Found...
                              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                              <span aria-hidden='true'>&times;</span>
                              </button>
                          </div>";
                }
                else
                {
                  include("config/connection.php");
                  $i = 1;
                  $dept = $_POST['DEPT'];
                  $year = $_POST['year']; 
                  $query = "select usr.id, usr.firstname, usr.middlename, usr.lastname, dpt.d_name FROM users AS usr JOIN department AS dpt ON usr.deptno = dpt.id WHERE usr.role = 'COORDINATOR' && dpt.id = '$dept' && usr.year = '$year'";
                  $result = mysqli_query($connect, $query);
                  if(mysqli_num_rows($result) > 0)
                  {
                    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            <strong>Hey..!</strong> Only 1 student can be a co-ordinator of each branch per year...
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>";
                  }
                  else
                  {
                    $query = "select usr.id, usr.firstname, usr.middlename, usr.lastname, dpt.d_name FROM users AS usr JOIN department AS dpt ON usr.deptno = dpt.id WHERE usr.role = 'STUDENT' && dpt.id = '$dept' && usr.year = '$year'";
                    $result = mysqli_query($connect, $query);
                    if(mysqli_num_rows($result) > 0)
                    {
                      while($row = mysqli_fetch_assoc($result))
                      { 
                        echo "<tr><td class='text-center'>". $i++ ."</td>
                        <td class='text'>". $row['id'] ."</td>
                        <td class='text'>". ucwords($row['firstname']." ".$row['middlename']." ".$row['lastname']) ."</td>
                        <td class='text'>". ucwords($row['d_name']) ."</td>
                        <td align='center'><button type='button' value='". $row['id']." ' class='btn btn-info btn-sm ChangeRole'>Register</button></td></tr>";
                      }
                    }
                    else
                    {
                      echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            <strong>Hey..!</strong> No Data Found...
                              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                              <span aria-hidden='true'>&times;</span>
                              </button>
                          </div>";
                    }
                  }
                }
              }
              elseif(isset($_POST['year']))
              {
                  include("config/connection.php");
                  $i = 1;
                  $dept = $_SESSION['auth_admin']['admin_dept'];
                  $year = $_POST['year']; 
                  
                  $query = "select usr.id, usr.firstname, usr.middlename, usr.lastname, usr.year FROM users AS usr JOIN department AS dpt ON usr.deptno = dpt.id WHERE usr.role = 'COORDINATOR' && dpt.d_name = '$dept' && usr.year = '$year'";
                  $result = mysqli_query($connect, $query);
                  if(mysqli_num_rows($result) > 0)
                  {
                    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            <strong>Hey..!</strong> Only 1 student can be a co-ordinator of each branch per year...
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>";
                  }
                  else
                  {
                    $_SESSION['status'] = $year."".$dept;
                    $query = "select usr.id, usr.firstname, usr.middlename, usr.lastname, usr.year FROM users AS usr JOIN department AS dpt ON usr.deptno = dpt.id WHERE usr.role = 'STUDENT' && dpt.d_name = '$dept' && usr.year = '$year'";
                    $result = mysqli_query($connect, $query);
                    if(mysqli_num_rows($result) > 0)
                    {
                      while($row = mysqli_fetch_assoc($result))
                      { 
                        echo "<tr><td class='text-center'>". $i++ ."</td>
                        <td class='text'>". $row['id'] ."</td>
                        <td class='text'>". ucwords($row['firstname']." ".$row['middlename']." ".$row['lastname']) ."</td>
                        <td align='center'><button type='button' value='". $row['id']." ' class='btn btn-info btn-sm ChangeRole'>Register</button></td></tr>";
                      }
                    }
                    else
                    {
                      echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            <strong>Hey..!</strong> No Data Found...
                              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                              <span aria-hidden='true'>&times;</span>
                              </button>
                          </div>";
                    }
                  }
              }
              ?>
                      <!-- </tr> -->
                    </tbody>
                </table>
                
                <br>
                <div class="col-auto">
                  <div class="d-flex align-items-center">
                    <a href="./coordinator.php" class="btn btn-primary"><i class="fa fa-angle-left"></i> Back to List</a>
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
?>
<script>
  $(document).ready(function (){
    $('.ChangeRole').click(function (e) {
      e.preventDefault();
      var usr_id = $(this).val();

      $('#user_id').val(usr_id);
      $('#confirmation').modal('show');
      
    });
  });
</script>
<?php
include("includes/footer.php");
?>