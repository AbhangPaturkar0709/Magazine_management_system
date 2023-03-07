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
                        <label for ="id">ID</label>
                        <input type="text" name="id" class="form-control" autocomplete="false" placeholder ="Enter ID Code">
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
                        <input type="tel" name="mob" class="form-control" value="" placeholder ="Enter Mobile Number">
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
                        <input type="password" name="pass" class="form-control" value="" placeholder ="Enter Password">
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label for ="cpass">Confirm Password</label>
                        <input type="password" name="cpass" class="form-control" value="" placeholder ="Re-enter Password">
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

    <?php
    if(isset($_POST['save_student']))
    {
        $id = strtoupper($_POST['id']);
        $firstname = strtoupper($_POST['firstname']);
        $middlename = strtoupper($_POST['middlename']);
        $lastname = strtoupper($_POST['surname']);
        $email = $_POST['email'];
        $dept = $_POST['department'];
        $mob = $_POST['mob'];
        $pass = $_POST['pass'];
        $cpass = $_POST['cpass'];

        if(($id == "" || $firstname == "" || $middlename == "" || $lastname == "" || $email == "" || $dept == "-1" || $mob == "" || $pass == "" || $cpass == "") && ($pass !== $cpass)) 
        {
            $_SESSION['status'] = "Invalid Input...";
        }
        else
        {
            include("config/connection.php");
            
            $query = "insert into users values('$id', '$firstname', '$middlename', '$lastname', $dept , 'STAFF', '$email', '$pass', $mob)
            ";

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
                <h3 class="card-title">Registered Staff</h3>
                <a href="#" data-toggle="modal" data-target="#AddStaffModal" class = "btn btn-primary float-right">Add Staff</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Sr. No.</th>
                      <!-- <th>ID Code</th> -->
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
                      $query = "Select u.id, u.firstname, u.middlename, u.lastname, d.d_name, u.email, u.mob from users as u inner join department as d on u.deptno = d.id where u.role = 'STAFF'";
                      $result = mysqli_query($connect, $query);
                      if(mysqli_num_rows($result) > 0)
                      {
                      while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $i++; ?></td>
                      <!-- <td class="text"></td> -->
                      <td class="text"><?php echo ucwords($row['firstname']." ".$row['middlename']." ".$row['lastname']) ?></td>
                      <td class="text"><?php echo ucwords($row['d_name']) ?></td>
                      <td class="text"><?php echo $row['email'] ?></td>
                      <td class="text"><?php echo "+91 ".$row['mob'] ?></td>
                      <td align="center">
                        <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">Action
                          <span class="sr-only">Toggle Dropdown</span></button>
                            <div class="dropdown-menu" role="menu">
                              <a class="dropdown-item view_data" href="view_magzine.php?id=<?php echo $row['id']; ?>" data-id ="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
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

