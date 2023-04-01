<?php 
include("includes/header.php");
include("authentication.php");
include("includes/topbar.php");
include("includes/sidebar.php");
?>

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  <!-- Modal -->
  <div class="modal fade" id="AddStaffModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Staff</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action ="#" method ="POST">
            <div class="modal-body">
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label for ="firstname">First Name</label>
                      <input type="text" name="firstname" class="form-control" value="" placeholder ="Enter First Name">
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for ="middlename">Middle Name</label>
                      <input type="text" name="middlename" class="form-control" value="" placeholder ="Enter Middle Name">
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for ="surname">Surname</label>
                      <input type="text" name="surname" class="form-control" value="" placeholder ="Enter Surname">
                    </div>
                  </div>
                </div>
                <div class="row">
                <div class="col">
                      <div class="form-group">
                        <label for ="email">E-mail</label>
                        <input type="email" name="email" class="form-control" value="" placeholder ="Enter E-mail">
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label for ="mob">Mobile</label>
                        <input type="tel" name="mob" class="form-control" value="" placeholder ="Enter Mobile Number">
                      </div>
                    </div>
                  </div>

                  <div class="row"> 
                    <div class="col">
                          <div class="form-group">
                            <label for ="id">STAFF-ID</label>
                            <input type="text" name="id" class="form-control" autocomplete="false" placeholder ="Enter ID Code E.g.(CM00X, ME0XX, etc.)">
                          </div>
                        </div>
                    <div class="col">
                      <div class="form-group">
                        <label for ="pass">Password</label>
                        <input type="password" name="pass" class="form-control" id="pass" value="" placeholder ="Enter Password">
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label for ="cpass">Confirm Password</label>
                        <input type="password" name="cpass" class="form-control" id="cpass" value="" placeholder ="Re-enter Password">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 ml-auto"><span class=
                      "text-danger"><small>* Password should be at least 8 character in length and should include <br>at least one uppercase/lowercase letter, one number, and one special character.</small></span>
                    </div>

                    <div class="col-md-2"><input type="checkbox" onclick="Toogle()"><span class=
                      "text"><small> Show Password</small></span>
                    </div>
                  </div>
              </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="save_staff">ADD</button>
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
    if(isset($_POST['save_staff']))
    {
      
        $staffid = strtoupper($_POST['id']);
        $firstname = strtoupper($_POST['firstname']);
        $middlename = strtoupper($_POST['middlename']);
        $lastname = strtoupper($_POST['surname']);
        $email = $_POST['email'];
        $mob = $_POST['mob'];

          if((!preg_match("/^[a-zA-z]*$/", $firstname)) || (!preg_match("/^[a-zA-z]*$/", $middlename))  || (!preg_match("/^[a-zA-z]*$/", $lastname)))
          {
            $_SESSION['status'] = "Invalid First Name or Middle Name or Last Name... ";
          }
          elseif(!preg_match("^[_a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9]+(\.[a-z0-9]+)*(\.[a-z]{2,3})$^", $email))
          {
            $_SESSION['status'] = "Invalid E-mail... ";
          }
          elseif(!preg_match("/^[0-9]{10}+$/", $mob))
          {
            $_SESSION['status'] = "Invalid Mobile Number... ";
          }
          elseif(strlen($staffid) !== 5)
          {
            $_SESSION['status'] = "Invalid STAFF-ID... "; 
          }
          elseif(strlen($staffid) == 5)
          {
            include("config/connection.php");
            
            $query = "select *from users where id = '$staffid'";
            $result = mysqli_query($connect, $query);
            if(mysqli_num_rows($result) > 0)
            {
                $_SESSION['status'] = "Already registered with STAFF-ID : $staffid";
            }
          }
          if($_POST['pass'] === $_POST['cpass'])
          {
            $uppercase = preg_match('@[A-Z]@', $_POST['pass']);
            $lowercase = preg_match('@[a-z]@', $_POST['pass']);
            $number = preg_match('@[0-9]@', $_POST['pass']);
            $specialchar = preg_match('@[^\w]@', $_POST['pass']);
            $pass = $_POST['pass'];

            if(!$uppercase || !$lowercase || !$number || !$specialchar || strlen($_POST['pass']) < 8)
            {
              $_SESSION['status'] = "Password should be at least 8 character in length and should include at least one uppercase/lowercase letter, one number, and one special character. ";
            }
            
            include("config/connection.php");
            $dept_code = substr($staffid, 0, 2);
            $query = "select id from department where code = '$dept_code'";
            $result = mysqli_query($connect, $query);
            if(mysqli_num_rows($result)>0)
            {
              $row = mysqli_fetch_assoc($result);
              $dept = $row['id'];

              $query = "insert into users(id, firstname, middlename, lastname, deptno, role, email, password, mob) values('$staffid', '$firstname', '$middlename', '$lastname', $dept, 'STAFF', '$email', '$pass', $mob)";
              if(mysqli_query($connect, $query))
              {
                  $_SESSION['status'] = "Staff Added successfully...";
              }
            }
            else
            {
              $_SESSION['status'] = "Invalid STAFF-ID...";
            }
          }
          else
          {
            $_SESSION['status'] = "Password and confirm password must be same...";
          }
    }
    ?>

    <!-- Modal delete date -->
  <div class="modal fade" id="DeleteDataConfirmation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <input type="hidden" name="id" id="stud_id">
            Are your sure to Delete Student? 
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
        $id = $_POST['id'];
        include("config/connection.php");
        $query = "delete from users where id = '$id'";
        mysqli_query($connect, $query);
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
              <li class="breadcrumb-item active">Staff</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
      </div><!-- /.content-header -->

      <div class="container">
        <div class="row">
          <div class="col-md-12">
          <?php include("message.php")?>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Registered Staff</h3>
                <a href="#" data-toggle="modal" data-target="#AddStaffModal" class = "btn btn-primary float-right">Add Staff</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Sr. No.</th>
                      <th>Staff-ID</th>
                      <th>Full Name</th>
                      <th>Department</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $i = 1;
                      include("config/connection.php");
                      $query = "Select u.id, u.firstname, u.middlename, u.lastname, d.d_name from users as u inner join department as d on u.deptno = d.id where u.role = 'STAFF'";
                      $result = mysqli_query($connect, $query);
                      if(mysqli_num_rows($result) > 0)
                      {
                      while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $i++; ?></td>
                      <td class="text"><?php echo $row['id']; ?></td>
                      <td class="text"><?php echo ucwords($row['firstname']." ".$row['middlename']." ".$row['lastname']) ?></td>
                      <td class="text"><?php echo ucwords($row['d_name']) ?></td>
                      <td align="center">
                        <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">Action
                          <span class="sr-only">Toggle Dropdown</span></button>
                            <div class="dropdown-menu" role="menu">
                              <a class="dropdown-item view_data" href="userprofile.php?id=<?php echo $row['id']; ?>&page=staffprof" data-id ="<?php echo $row['id'] ?>&page=staffprof"><span class="fa fa-eye text-dark"></span> View</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="#" data-id ="#"><span class="fa fa-edit text-primary"></span> Edit</a>
                              <div class="dropdown-divider"></div>
                              <button type="button" value="<?php echo $row['id'] ?>" class="dropdown-item delete_data"><span class="fa fa-trash text-danger"></span> Delete</button>
                            </div>
                      </td>
						        </tr>
                    <?php 
                          }
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
    $('.delete_data').click(function (e) {
      e.preventDefault();
      var usr_id = $(this).val();

      $('#stud_id').val(usr_id);
      $('#DeleteDataConfirmation').modal('show');
      
    });
  });
</script>
<?php
include("includes/footer.php");
?>

