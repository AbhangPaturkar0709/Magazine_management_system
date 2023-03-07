<?php
if(isset($_GET["id"])){
    $id = $_GET['id'];
    include("../inc/connection.php");
    $query = "select * from articles where id = $id";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_assoc($result);
    $pdf = $row['file'];
    $title = strtoupper($row['title']);
    $category = strtoupper($row['category']);
    $stud_id = $row['stud_id'];
    $uploaddate = $row['uploaddate'];
    $status = $row['status'];
    $comment = $row['comment'];
}
?>

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
              <li class="breadcrumb-item active">View</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
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
                            <form action = "code.php" method = "post">
                            <input type="text" name = "txt_comment" class="form-control" placeholder="Write Comments here ...">
                          </div>
                          <div class="col-auto">
                          <?php $status = strtoupper($row['status']);
                            if($status === "PENDING")
                            {?>
                                <button type="submit" value="<?php echo $_GET['id'] ?>" name = "art_approve" class="btn bg-gradient-success">Approve</button>
                                <button type="submit" value="<?php echo $_GET['id'] ?>" name = "art_modify" class="btn bg-gradient-warning">Modify</button>
                                <button type="submit" value="<?php echo $_GET['id'] ?>" name = "art_reject" class="btn bg-gradient-danger">Reject</button>
                            <?php
                            }
                            elseif($status === "APPORVED")
                            {?>
                                <button type="submit" value="<?php echo $_GET['id'] ?>" name = "art_modify" class="btn bg-gradient-warning">Modify</button>
                                <button type="submit" value="<?php echo $_GET['id'] ?>" name = "art_reject" class="btn bg-gradient-danger">Reject</button>
                            <?php
                            }
                            elseif($status === "REJECTED")
                            {?>     
                                <button type="submit" value="<?php echo $_GET['id'] ?>" name = "art_approve" class="btn bg-gradient-success">Approve</button>
                                <button type="submit" value="<?php echo $_GET['id'] ?>" name = "art_modify" class="btn bg-gradient-warning">Modify</button>
                            <?php
                            }
                            elseif($status === "MODIFY")
                            {?>
                                <button type="submit" value="<?php echo $_GET['id'] ?>" name = "art_approve" class="btn bg-gradient-success">Approve</button>
                                <button type="submit" value="<?php echo $_GET['id'] ?>" name = "art_reject" class="btn bg-gradient-danger">Reject</button>
                                <?php
                            }?>
                            </form>
                          </div>
                        </div>
                        <br>
                        <div class="col-auto">
                            <div class="d-flex align-items-center">
                              <a href="./magzine.php" class="btn btn-primary"><i class="fa fa-angle-left"></i> Back to List</a>
                             </div>
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