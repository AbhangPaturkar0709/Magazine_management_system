<?php 
include("authentication.php");
include("includes/header.php");
include("includes/topbar.php");
include("includes/sidebar.php");
?>

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  <!-- Modal -->
    <div class="modal fade" id="AddArticleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Article</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action ="code.php" method ="post" enctype = "multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <label for ="sid">ID Code</label>
                <input name = "sid" type="text" class="form-control" placeholder ="ID Code" required>
              </div>
              <div class="form-group">
                <label for ="art_title">Title</label>
                <input name = "art_title" type="text" class="form-control" placeholder ="Article Title" required>
              </div>
              <div class="form-group">
                <label for ="ddl_category">Select Category</label>
                <select name="category" class="form-control">
                  <option value="-1">Select Category</option>
                  <option>Technical</option>
                  <option>Non-Technical</option>
                  </select>
                </div>
              <div class="form-group">
                <label for ="file">Upload File</label>
                <input name = "file" type="file" class="form-control" accept=".pdf">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="save_article">ADD</button>
            </div>
            </form>
        </div>
      </div>
    </div>

   
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
              <li class="breadcrumb-item active">Articles</li>
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
                <h3 class="card-title">Students Submitted Articles</h3>
                <a href="#" data-toggle="modal" data-target="#AddArticleModal" class = "btn btn-primary float-right">Add Article</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Sr. No.</th>
                      <th>ID Code</th>
                      <th>Title</th>
                      <th>Category</th>
                      <th>Upload Date</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $i = 1;
                      include("config/connection.php");
                      $query="";
                      if($_SESSION['auth_admin']['admin_role'] == "ADMIN")
                      {
                        $user_role=$_SESSION['auth_admin']['admin_role'];
                        $query = "select art.id, art.title, art.category, art.file, art.uploaddate, art.status, art.stud_id from articles as art join users as usr on art.stud_id = usr.id where usr.role in ('STUDENT', 'COORDINATOR')";
                      }
                      elseif($_SESSION['auth_admin']['admin_role'] == "STAFF")
                      {
                        $dept = $_SESSION['auth_admin']['admin_dept'];
                        $query = "select art.id, art.title, art.category, art.file, art.uploaddate, art.status, art.comment, art.stud_id from articles as art join users as usr on art.stud_id = usr.id join department as dpt on usr.deptno = dpt.id where dpt.d_name = '$dept' and usr.role in ('STUDENT', 'COORDINATOR')";
                      }
                      
                      $result = mysqli_query($connect, $query);
                      if(mysqli_num_rows($result) > 0)
                      {
                      while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $i++; ?></td>
                      <td class=""><?php echo $row['stud_id'] ?></td>
                      <td class="truncate-1"><?php echo ucwords($row['title']) ?></td>
                      <td><?php echo ucwords($row['category']) ?></td>
                      <td class="text-center"><?php echo date("M d, Y h:i A",strtotime($row['uploaddate'])) ?></td>
                       <td class="text-center">
                        <?php $status = strtoupper($row['status']);
                       if($status === "PENDING")
                       {
                        echo "<i class='text-secondary'>".ucwords($status)."</i>";
                       } 
                       elseif($status === "APPROVED")
                       {
                        echo "<b class='text-success'>".ucwords($status)."</b>";
                       } 
                       elseif($status === "REJECTED")
                       {
                        echo "<b class='text-danger'>".ucwords($status)."</b>";
                       } 
                       elseif($status === "MODIFY")
                       {
                        echo "<b class='text-warning'>".ucwords($status)."</b>";
                       } 
                       ?>
                       </td>
                      <td align="center">
                        <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">Action
                          <span class="sr-only">Toggle Dropdown</span></button>
                            <div class="dropdown-menu" role="menu">
                              <a class="dropdown-item view_data" href="view_article.php?id=<?php echo $row['id']; ?>&page=studart"><span class="fa fa-eye text-dark"></span> View</a>
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

