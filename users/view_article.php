<?php
$id ="";
if(isset($_GET["id"])){
    $id = $_GET['id'];
    include("config/connection.php");
    $query = "select * from articles where id = $id";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_assoc($result);
    $pdf = $row['file'];
    $title = strtoupper($row['title']);
    $category = strtoupper($row['category']);
    $stud_id = $row['stud_id'];
    $uploaddate = $row['uploaddate'];
    $status = strtoupper($row['status']);
    $comment = $row['comment'];
}

include("includes/header.php");
include("includes/topbar.php");
include("includes/sidebar.php");
?>
<style>
    #magazine-cover-view{
        object-fit:scale-down;
        object-position:center center;
        height:30vh;
        width:20vw;
    }
    #author-avatar{
        height:35px;
        width:35px;
        object-fit: cover;
        object-position:center center;
        border-radius:50% 50%
    }
    #PDF-holder{
        height:80vh;
    }
</style>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
 <?php 
		$user_email = $_SESSION['auth_user']['user_email'];
		include("config/connection.php");
		$query = "select *from users where email = '$user_email'";
		$result = mysqli_query($connect, $query);
    $row = mysqli_fetch_assoc($result);
		?>
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
          <form action ="code.php?id=<?php echo $id?>" method ="post" enctype = "multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <label for ="sid">ID Code</label>
                <input type="text" name="sid" class="form-control" value="<?php echo $row['id'] ?>" readonly>
              </div>
              <div class="form-group">
                <label for ="semail">E-mail</label>
                <input type="text" name="semail" class="form-control" value="<?php echo $row['email'] ?>" readonly>
              </div>
              <div class="form-group">
                <label for ="art_title">Title</label>
                <input name = "art_title" type="text" class="form-control" value="<?php echo $title ?>" placeholder ="Article Title" required>
              </div>
              <div class="form-group">
                <label for ="ddl_category" value = "Technical">Select Category</label>
                <select name="category" class="form-control">
                  <?php 
                  if($category === "TECHNICAL")
                  {?>
                    <option selected>Technical</option>
                    <option>Non-Technical</option>

                  <?php }
                  if($category === "NON-TECHNICAL")
                  {?>
                    <option>Technical</option>
                    <option selected>Non-Technical</option>
                  <?php
                  }
                  ?>
                  </select>
                </div>
              <div class="form-group">
                <label for ="file">Upload File</label>
                <input name = "file" type="file" value="111" class="form-control" accept=".pdf">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="update_article">UPDATE</button>
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
              <li class="breadcrumb-item active">View</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
        <?php
            include("message.php");
          ?>
          <div class="card">
              <div class="card-header">
                <h5 class="card-title">Article Details</h5>
              </div>
              <div class="card-body">
                <div class="container-fluid">
                <div class="row justify-content-center align-items-end">
                        <div class="col-md-8">
                            <div class="row justify-content-between align-items-top">
                                <div class="col">
                                  <h2 class='text-purple'><b><?php echo $title ?></b></h2>
                                  <span class="text-muted"><?php echo $category ?></span>
                                </div>
                                <div class="col-auto">
                                <div class="d-flex align-items-center">
                                          <span>ID Code : </span>
                                          <span class="mx-2 text-muted"><?php echo $stud_id ?></span>
                                      </div>
                                      <span class="text-muted">
                                          <i class="fa fa-calendar-day"></i> <?php echo date("M d, Y h:i A",strtotime($uploaddate)) ?>
                                      </span>
                                </div>
                              </div>
                              <hr>
                              <div class="row justify-content-between align-items-top">
                                <div class="col-lg-9">
                                <span class="text-muted"><?php echo $comment ?></span>
                                  </div>
                                  <div class="col-auto">
                                  <?php
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
                                  </div>
                                </div>
                              </div>
                          </div>
                      </div>
                    <hr>
                    <div class="row">
                          <h4 class="text-purple"><b>PDF File</b></h4>
                          <hr>
                          <div class="w-100" id="PDF-holder">
                          <iframe src="../Documents/<?php echo $pdf; ?>" frameborder="1" class="w-100 h-100 bg-dark"></iframe>
                          </div>
                      </div>
                        <br>
                        <div class="row justify-content-between align-items-top">
                          <div class="col">
                            <?php if($_GET['page'] == "myart"){ ?>
                            <a href="./myarticles.php" class="btn btn-primary"><i class="fa fa-angle-left"></i> Back to List</a>
                            <?php }elseif($_GET['page'] == "studart") {?>
                            <a href="./articles.php" class="btn btn-primary"><i class="fa fa-angle-left"></i> Back to List</a>\
                            <?php }?>
                          </div>
                          <?php 
                          if ($status === "MODIFY" && $_GET['page'] == "myart")
                          {?>
                          <div class="col-auto">
                            <a href="" data-toggle="modal" data-target="#AddArticleModal" class = "btn btn-warning float-right">UPDATE</a>  
                          </div>
                          <?php }?>
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
include("includes/footer.php");
?>