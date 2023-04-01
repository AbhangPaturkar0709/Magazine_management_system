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
          <form action ="#" method ="post" enctype = "multipart/form-data">
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

    <?php
        if(isset($_POST['save_article']))
        {
            $sid = $_POST['sid'];
            $article_title = trim($_POST['art_title']);
            $article_category = $_POST['category'];
            $doc = preg_replace("/\s+/","_", $_FILES['file']['name']);
            $doc_type = $_FILES['file']['type'];
            $doc_size = $_FILES['file']['size'];
            $doc_tem_loc = $_FILES['file']['tmp_name'];
            $doc_ext = pathinfo($doc, PATHINFO_EXTENSION);
            $doc_name = pathinfo($doc, PATHINFO_FILENAME);
            $doc_unique_name = $doc_name."_".date("mjYHis").".".$doc_ext;
            $doc_store = "../Documents/".$doc_unique_name;

            if($article_title == "" || $article_category == "-1" || $doc == "")
            {
              $_SESSION['status'] = "Invalid Input...";
            }
            else
            {
                include("config/connection.php");
                $query = "select *from users where id = '$sid'";
                $result = mysqli_query($connect, $query);
                if(mysqli_num_rows($result) == 0)
                {
                  $_SESSION['status'] = "No $sid student found...";
                }
                elseif(mysqli_num_rows($result) > 0)
                {
                  move_uploaded_file($doc_tem_loc, $doc_store);
                  
                  $sql = "insert into articles(`title`, `category`, `file`, `uploaddate`, `status`, `stud_id`) values('$article_title', '$article_category', '$doc_unique_name', now(), 'pending', '$sid')";
                  
                  if(mysqli_query($connect, $sql))
                  {
                    $_SESSION['status'] = "Article uploaded successfully...";
                  }
                }
                mysqli_close($connect);
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
              <li class="breadcrumb-item active">Articles</li>
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
                <h3 class="card-title">Submitted Articles</h3>
                <a href="#" data-toggle="modal" data-target="#AddArticleModal" class = "btn btn-primary float-right">Add Article</a>
              </div>

              <!-- /.card-header -->
            <div class="card-body">
                <?php if($_SESSION['auth_admin']['admin_role'] == "STAFF"){?>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Sr. No.</th>
                      <th>Title</th>
                      <th>Category</th>
                      <th>Upload Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $i = 1;
                        include("config/connection.php");
                        $staffid = $_SESSION['auth_admin']['admin_id'];
                        $query = "select id, title, category, file, uploaddate from articles where stud_id='$staffid'";
                      
                        $result = mysqli_query($connect, $query);
                        if(mysqli_num_rows($result) > 0)
                        {
                            while($row = mysqli_fetch_assoc($result)){
                        ?>
                    <tr>
                      <td class="text-center"><?php echo $i++; ?></td>
                      <td class="truncate-1"><?php echo ucwords($row['title']) ?></td>
                      <td><?php echo ucwords($row['category']) ?></td>
                      <td class="text-center"><?php echo date("M d, Y h:i A",strtotime($row['uploaddate'])) ?></td>
                      <td align="center">
                        <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">Action
                          <span class="sr-only">Toggle Dropdown</span></button>
                            <div class="dropdown-menu" role="menu">
                              <a class="dropdown-item view_data" href="view_article.php?id=<?php echo $row['id']; ?>"><span class="fa fa-eye text-dark"></span> View</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="#" data-id ="#"><span class="fa fa-edit text-primary"></span> Edit</a>
                              <div class="dropdown-divider"></div>
                                <a class="dropdown-item delete_data" href="#" data-id ="#"><span class="fa fa-trash text-danger"></span> Delete</a>
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
                <?php }elseif($_SESSION['auth_admin']['admin_role'] == "ADMIN"){?>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Sr. No.</th>
                      <th>STAFF-ID</th>
                      <th>Title</th>
                      <th>Category</th>
                      <th>Upload Date</th>
                      <th>Department</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $i = 1;
                        include("config/connection.php");
                        $user_role=$_SESSION['auth_admin']['admin_role'];
                        $query = "select art.id, art.title, art.category, art.file, art.uploaddate, art.stud_id, dpt.d_name from articles as art join users as usr on art.stud_id = usr.id join department as dpt on usr.deptno = dpt.id where usr.role='$user_role'";
                        
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
                       <td class="text-center"><?php $status = strtoupper($row['d_name']);?></td>
                      <td align="center">
                        <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">Action
                          <span class="sr-only">Toggle Dropdown</span></button>
                            <div class="dropdown-menu" role="menu">
                              <a class="dropdown-item view_data" href="view_article.php?id=<?php echo $row['id']; ?>&page=staffart"><span class="fa fa-eye text-dark"></span> View</a>
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
include("includes/footer.php");
?>

