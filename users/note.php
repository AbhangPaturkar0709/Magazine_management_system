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
            <?php include("message.php") ?>
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
                <h3 class="card-title">My Submitted Articles</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form action ="#" method ="post" enctype = "multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
              <label>Big Description</label>
                <textarea name="summernote" id="summernote" class="form-control" rows="4"></textarea>
              </div>
              <div class="form-group">
                <label for ="file">Upload File</label>
                <input name = "file" type="file" class="form-control" accept="image/png, image/git, image/jpeg">
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
  
          include("config/connection.php");
            

          $query = "select img from image where id = 1";
          $result = mysqli_query($connect, $query);
          $row = mysqli_fetch_assoc($result);
          
        
    ?>
          <div class="gallery">
                <img src="data:image/jpg;charset=utf;base64,<?php echo base64_encode($row['img']); ?>" alt="hi">
              </div>
        </div>
      </div>
    </div>
 
    <?php 
    if(isset($_POST['save_article']))
    {
        $sid = $_POST['summernote'];

        $doc = preg_replace("/\s+/","_", $_FILES['file']['name']);
        $doc_type = $_FILES['file']['type'];
        $doc_size = $_FILES['file']['size'];
        $doc_tem_loc = $_FILES['file']['tmp_name'];
        $doc_ext = pathinfo($doc, PATHINFO_EXTENSION);
        $doc_name = pathinfo($doc, PATHINFO_FILENAME);
        $doc_unique_name = $doc_name."_".date("mjYHis").".".$doc_ext;
        $imgContent = addslashes(file_get_contents($doc_tem_loc));


        
        if($sid == "")
        {
          $_SESSION['status'] = "Invalid Input...";
        }
        else
        {
          include("config/connection.php");
            

          $sql = "insert into magazines(`name`) values('$sid')";

          if(mysqli_query($connect, $sql))
          {
            $_SESSION['status'] = "Article uploaded successfully...";
          }
          mysqli_close($connect);
        }
    }
    ?>
<?php
include("includes/script.php");
?>
<script>
  
</script>
<?php
include("includes/footer.php");
?>

