<?php 
include("includes/header.php");
include("authentication.php");
include("includes/topbar.php");
include("includes/sidebar.php");
?>

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  <!-- Modal add student -->
  <div class="modal fade" id="AddStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
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
                      <input type="text" name="firstname" class="form-control" value="" placeholder ="Enter First Name" required>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for ="middlename">Middle Name</label>
                      <input type="text" name="middlename" class="form-control" value="" placeholder ="Enter Middle Name" required>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for ="surname">Surname</label>
                      <input type="text" name="surname" class="form-control" value="" placeholder ="Enter Surname" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                <div class="col">
                      <div class="form-group">
                        <label for ="email">E-mail</label>
                        <input type="email" name="email" class="form-control" value="" placeholder ="Enter E-mail" required>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label for ="mob">Mobile</label>
                        <input type="text" name="mob" class="form-control" value="" placeholder ="Enter Mobile Number" required>
                      </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                          <label for ="idcode">ID Code</label>
                          <input type="text" name="idcode" class="form-control" value="" placeholder ="Enter ID Code E.g.(20CM00X, 19ME0XX, etc.)" required>
                        </div>
                      </div>
                  </div>

              </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="save_student">ADD</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal Import Excel -->
  <div class="modal fade" id="AddStudentsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Import Excel-sheet</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action ="code.php" method ="POST" enctype = "multipart/form-data">
            <div class="modal-body">
            <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label for ="firstname">Excel-Sheet Format</label><br>
                      <a class="btn" href="../Documents/EXCELSHEETFORMAT.xlsx"  download="StudentExcelSheetFormat"><span class="fa fa-download text-dark"></span> DOWNLOAD FORMAT</a>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for ="middlename">Upload Excel-Sheet</label>
                      <input type="file" name="importfile" class="form-control" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                    </div>
                  </div>

                </div>
              </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="import_students">IMPORT</button>
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
    if(isset($_POST['save_student']))
    {
      $idcode = strtoupper(trim($_POST['idcode']));
      $firstname = strtoupper(trim($_POST['firstname']));
      $middlename = strtoupper(trim($_POST['middlename']));
      $lastname = strtoupper(trim($_POST['surname']));
      $email = strtolower(trim($_POST['email']));
      $mob = $_POST['mob'];
        
      include("config/connection.php");
      $query = "select *from users where email = '$email'";
      $result = mysqli_query($connect, $query);
      if(mysqli_num_rows($result) > 0)
      {
        $_SESSION['status'] = "Email Already Exists...";
      }
      else
      {
        if((!preg_match("/^[a-zA-z]*$/", $firstname)) || (!preg_match("/^[a-zA-z]*$/", $middlename))  || (!preg_match("/^[a-zA-z]*$/", $lastname)))
        {
          $_SESSION['status'] = "Invalid First Name or Middle Name or Last Name... ";
        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
          $_SESSION['status'] = "Invalid E-mail... ";
        }
        elseif(!preg_match('/^[0-9]{10}+$/', $mob))
        {
          $_SESSION['status'] = "Invalid Mobile Number... ";
        }
        elseif(strlen($idcode) !== 7)
        {
          $_SESSION['status'] = "Invalid ID-CODE... "; 
        }
        elseif(strlen($idcode) == 7)
        {
          include("config/connection.php");
          
          $query = "select *from users where id = '$idcode'";
          $result = mysqli_query($connect, $query);
          if(mysqli_num_rows($result) > 0)
          {
              $_SESSION['status'] = "Already registered with ID-CODE : $idcode";
          }
          mysqli_close($connect);
        }
        
        include("config/connection.php");
        $dept_code = substr($idcode, 2, 2);
        $YearFromId = substr($idcode, 0, 2);
        $CurrentYear = date("y");
        $query = "select id from department where code = '$dept_code'";
        $result = mysqli_query($connect, $query);
        if((mysqli_num_rows($result)>0) && (($YearFromId <= $CurrentYear) && ($YearFromId >= $CurrentYear-3)))
        {
          $row = mysqli_fetch_assoc($result);
          $dept = $row['id'];
          $x = $CurrentYear - $YearFromId;
          $year = "";
          if($x == 0 || $x == 1)
          {
            $year = '1st';
          }
          elseif($x == 2)
          {
            $year = '2nd';
          }
          elseif($x == 3)
          {
            $year = '3rd';
          }

          if($_SESSION['auth_admin']['admin_role'] == "ADMIN")
          {
            $query = "insert into users values('$idcode', '$firstname', '$middlename', '$lastname', $dept, '$year', 'STUDENT', '$email', '$idcode', $mob)";
            if(mysqli_query($connect, $query))
            {
                $_SESSION['status'] = "Student Added successfully...";
            }
          }
          elseif($_SESSION['auth_admin']['admin_role'] == "STAFF")
          {
            $dept_name = $_SESSION['auth_admin']['admin_dept'];
            $query="select id, code from department where d_name = '$dept_name'";
            $row = mysqli_fetch_assoc($result = mysqli_query($connect, $query));
            $dpt_code = $row['code'];
            $d_id = $row['id'];
            if($dept_code !== $dpt_code)
            {
              $_SESSION['status'] = "Invalid ID-CODE...";
            }
            else
            {
              $query = "insert into users values('$idcode', '$firstname', '$middlename', '$lastname', $dept, '$year', 'STUDENT', '$email', '$idcode', $mob)";
              if(mysqli_query($connect, $query))
              {
                  $_SESSION['status'] = "Student Added successfully...";
              }
            }
          }
          mysqli_close($connect);
        }
        else
        {
          $_SESSION['status'] = "Invalid ID-CODE...";
        }
        
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

    <!-- Modal delete date -->
  <div class="modal fade" id="DeleteStudentsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            Are your sure to Remove All Student? 
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-danger" name="RemoveStudents">YES</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
            </div>
            </form>
        </div>
      </div>
    </div>

    <?php
    if(isset($_POST['RemoveStudents']))
    {
        include("config/connection.php");
        $query = "delete from users where role in ('STUDENT', 'COORDINATOR')";
        mysqli_query($connect, $query);
        mysqli_close($connect);
    }
    if(isset($_POST['RemoveRole']))
    {
        $id = $_POST['id'];
        include("config/connection.php");
        $query = "delete from users where id = '$id'";
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
              <li class="breadcrumb-item active">Student</li>
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
                <h3 class="card-title">Registered Student</h3>
                <button type="button" class="btn btn-primary float-right btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown"><span class="fa fa-user"></span>&nbsp
                  <span class="sr-only">Toggle Dropdown</span></button>
                    <div class="dropdown-menu" role="menu">
                      <a href="#" data-toggle="modal" data-target="#AddStudentModal" class="dropdown-item"><span class="fa fa-user-plus"></span> Add Student</a>
                      <div class="dropdown-divider"></div>
                      <a href="#" data-toggle="modal" data-target="#AddStudentsModal" class="dropdown-item"><span class="fa fa-upload"></span> Import Excel</a>
                      <div class="dropdown-divider"></div>
                      <a href="#" data-toggle="modal" data-target="#DeleteStudentsModal" class="dropdown-item"><span class="fa fa-trash text-danger"></span> Clear Data</a>
                      </div>
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
                      $query = "Select u.id, u.firstname, u.middlename, u.lastname, d.d_name, u.year from users as u inner join department as d on u.deptno = d.id where u.role in ('STUDENT', 'COORDINATOR')";
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
                      <td align="center">
                        <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">Action
                          <span class="sr-only">Toggle Dropdown</span></button>
                            <div class="dropdown-menu" role="menu">
                              <a class="dropdown-item view_data" href="userprofile.php?id=<?php echo $row['id'] ?>&page=studprof" data-id ="<?php echo $row['id'] ?>&page=studprof"><span class="fa fa-eye text-dark"></span> View</a>
                              <div class="dropdown-divider"></div>
                              <button type="button" value="<?php echo $row['id'] ?>" class="dropdown-item delete_data"><span class="fa fa-trash text-danger"></span> Delete</button>
                            </div>
                      </td>
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
                      $query = "Select u.id, u.firstname, u.middlename, u.lastname, u.year from users as u inner join department as d on u.deptno = d.id where u.role in ('STUDENT', 'COORDINATOR') && d.d_name='$dept'";
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
                      <td align="center">
                        <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">Action
                          <span class="sr-only">Toggle Dropdown</span></button>
                            <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item view_data" href="userprofile.php?id=<?php echo $row['id'] ?>&page=studprof" data-id ="<?php echo $row['id'] ?>&page=studprof"><span class="fa fa-eye text-dark"></span> View</a>
                              <div class="dropdown-divider"></div>
                              <button type="button" value="<?php echo $row['id'] ?>" class="dropdown-item delete_data"><span class="fa fa-trash text-danger"></span> Delete</button>
                            </div>
                      </td>
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

