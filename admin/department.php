<?php 
include("authentication.php");
include("includes/header.php");
include("includes/topbar.php");
include("includes/sidebar.php");
?>

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
      <!-- Modal add student -->
  <div class="modal fade" id="AddDeptModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Deparment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action ="#" method ="POST">
            <div class="modal-body">
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label for ="deptname">Department Name</label>
                      <input type="text" name="deptname" class="form-control" value="" placeholder ="Enter Department Name">
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for ="deptcode">Department Code</label>
                      <input type="text" name="deptcode" class="form-control" value="" placeholder ="Enter Department Code E.g.(CM, CE, IF, etc.)">
                    </div>
                  </div>
                </div>
              </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="save_dept">ADD</button>
            </div>
          </form>
        </div>
      </div>
    </div>

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
            <input type="hidden" name="id" id="id">
            Are your sure to Delete Department? 
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-danger" name="RemoveDept">YES</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
            </div>
            </form>
        </div>
      </div>
    </div>

    <?php
    if(isset($_POST['save_dept']))
    {
        $d_name = strtoupper($_POST['deptname']);
        $d_code = strtoupper($_POST['deptcode']);
        include("config/connection.php");
        $query = "select max(id) from department";
        $result = mysqli_query($connect, $query);
        $row = mysqli_fetch_assoc($result);
        $row = $row['max(id)'] + 1;
        $query = "insert into department VALUES ($row, '$d_name', '$d_code')";
        mysqli_query($connect, $query);
        $_SESSION['status'] = "Department Added Successfully...";
        mysqli_close($connect);
    }

    if(isset($_POST['RemoveDept']))
    {
        $id = $_POST['id'];
        include("config/connection.php");
        $query = "delete from department where id = '$id'";
        mysqli_query($connect, $query);
        $_SESSION['status'] = "Department Deleted Successfully...";
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
              <li class="breadcrumb-item active">Department</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
      </div><!-- /.content-header -->

      <div class="container">
        <div class="row">
          <div class="col-md-12">
          <?php
            include("message.php");
          ?>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Departments</h3>
                <a href="#" data-toggle="modal" data-target="#AddDeptModal" class = "btn btn-primary float-right">Add Department</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Sr. No.</th>
                      <th>Deparment Name</th>
                      <th>Deparment Code</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $i = 1;
                      include("config/connection.php");
                      $query = "Select *from department";
                      $result = mysqli_query($connect, $query);
                      if(mysqli_num_rows($result) > 0)
                      {
                        while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $i++; ?></td>
                      <td class="text"><?php echo ucwords($row['d_name']) ?></td>
                      <td class="text-center"><?php echo $row['code']?></td>
                      <td align="center">
                        <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">Action
                          <span class="sr-only">Toggle Dropdown</span></button>
                            <div class="dropdown-menu" role="menu">
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
                              <tr>
                                <td style="background:white">No Department Found.</td>
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
?>
<script>
  $(document).ready(function (){
    $('.delete_data').click(function (e) {
      e.preventDefault();
      var id = $(this).val();

      $('#id').val(id);
      $('#DeleteDataConfirmation').modal('show');
      
    });
  });
</script>
<?php
include("includes/footer.php");
?>

