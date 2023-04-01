<?php 
include("authentication.php");
include("includes/header.php");
include("includes/topbar.php");
include("includes/sidebar.php");
?>

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
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
          <?php
            include("message.php");
          ?>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Submitted Articles</h3>
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
                      <th>Comments</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $i = 1;
                      include("config/connection.php");
                      $stud_dept = $_SESSION['auth_user']['user_dept'];
                      $query = "select art.id, art.title, art.category, art.file, art.uploaddate, art.status, art.comment, art.stud_id from articles as art join users as usr on art.stud_id = usr.id join department as dpt on usr.deptno = dpt.id where dpt.d_name = '$stud_dept'";
                      // $query = "Select *from articles where stud_ = '$stud_dept'";
                      $result = mysqli_query($connect, $query);
                      if(mysqli_num_rows($result) > 0)
                      {
                        while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $i++; ?></td>
                      <td class="text"><?php echo $row['stud_id'] ?></td>
                      <td class="text"><?php echo ucwords($row['title']) ?></td>
                      <td class="text"><?php echo ucwords($row['category']) ?></td>
                      <td class="text"><?php echo date("M d, Y h:i A",strtotime($row['uploaddate'])) ?></td>
                      <td class="text-center">
                        <?php $status = strtoupper($row['status']);
                              if($status === "PENDING")
                              {
                                echo "<i class='text-secondary'>".ucwords($status)."</i>";
                              } 
                              elseif($status === "APPORVED")
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
                      <td class="text"><?php echo ucwords($row['comment']) ?></td>
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

