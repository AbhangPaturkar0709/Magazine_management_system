<?php 
include("includes/header.php");
include("authentication.php");
include("includes/topbar.php");
include("includes/sidebar.php");
?>

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  <!-- Modal -->
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
                        <label for ="idcode">ID Code</label>
                        <input type="text" name="idcode" class="form-control" value="" placeholder ="Enter ID Code">
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label for ="department">Department</label>
                        <select name="department" class="form-control">
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
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label for ="mob">Mobile</label>
                        <input type="text" name="mob" class="form-control" value="" placeholder ="Enter Mobile Number">
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
                        <label for ="pass">Password</label>
                        <input type="password" name="pass" class="form-control" id = "pass" value="" placeholder ="Enter Password" >
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label for ="cpass">Confirm Password</label>
                        <input type="password" name="cpass" class="form-control" id = "cpass" value="" placeholder ="Re-enter Password">
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
              <button type="submit" class="btn btn-primary" name="save_student">ADD</button>
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
        $dept = $_POST['department'];
        $mob = $_POST['mob'];
        $pass = $_POST['pass'];
        $cpass = $_POST['cpass'];

          if((!preg_match("/^[a-zA-z]*$/", $firstname)) || (!preg_match("/^[a-zA-z]*$/", $middlename))  || (!preg_match("/^[a-zA-z]*$/", $lastname)))
          {
            $_SESSION['status'] = "Invalid First Name or Middle Name or Last Name... ";
          }
          elseif(strlen($idcode) !== 7)
          {
            $_SESSION['status'] = "Invalid ID-CODE... "; 
          }
          elseif(strlen($idcode) !== 7)
          {
            include("config/connection.php");
            
            $query = "select *from users where id = '$idcode'";
            $result = mysqli_query($connect, $query);
            if(mysqli_num_rows($result) > 0)
            {
                $_SESSION['status'] = "Already registered with same ID-CODE...";
            }
          }
          elseif ($dept == "-1") 
          {
            $_SESSION['status'] = "Invalid Department...";
          }
          elseif((!preg_match("/^[0-9]{10}+$/", $mob)))
          {
            $_SESSION['status'] = "Invalid Mobile Number... ";
          }
          elseif((!preg_match("^[_a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9]+(\.[a-z0-9]+)*(\.[a-z]{2,3})$^", $email)))
          {
            $_SESSION['status'] = "Invalid E-mail... ";
          }
          elseif($pass !== $cpass)
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

            include("config/connection.php");
            
            $query = "insert into users values('$idcode', '$firstname', '$middlename', '$lastname', $dept , 'STUDENT', '$email', '$pass', $mob)";
            if(mysqli_query($connect, $query))
            {
                $_SESSION['status'] = "Student Added successfully...";
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
                <a href="#" data-toggle="modal" data-target="#AddStudentModal" class = "btn btn-primary float-right">Add Student</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Sr. No.</th>
                      <th>ID Code</th>
                      <th>Full Name</th>
                      <th>Department</th>
                      <th>E-mail</th>
                      <th>Contact No.</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $i = 1;
                      include("config/connection.php");
                      $query = "Select u.id, u.firstname, u.middlename, u.lastname, d.d_name, u.email, u.mob from users as u inner join department as d on u.deptno = d.id where u.role = 'STUDENT'";
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
                      <td class="text"><?php echo $row['email'] ?></td>
                      <td class="text"><?php echo "+91 ".$row['mob'] ?></td>
                      <td align="center">
                        <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">Action
                          <span class="sr-only">Toggle Dropdown</span></button>
                            <div class="dropdown-menu" role="menu">
                              <a class="dropdown-item view_data" href="#" data-id ="#"><span class="fa fa-eye text-dark"></span> View</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="#" data-id ="#"><span class="fa fa-edit text-primary"></span> Edit</a>
                              <div class="dropdown-divider"></div>
                                <a class="dropdown-item delete_data" href="#" data-id ="#"><span class="fa fa-trash text-danger"></span> Delete</a>
                            </div>
                      </td>
						        </tr>
                    <?php 
                          }
                        }
                        else
                        {
                            ?>
                              <tr>
                                <td style="background:white">No Article Found.</td>
                              </tr>
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
include("includes/footer.php");
?>

