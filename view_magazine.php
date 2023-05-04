<?php
$id ="";
if(isset($_GET['id']))
{
  $id = $_GET['id'];
  include("includes/connection.php");
  $query = "select * from magazines where id = $id";
  $result = mysqli_query($connect, $query);
  $row = mysqli_fetch_assoc($result);
  $pdf = $row['filename'];
  $coverpage = $row['coverpage'];
  $name = strtoupper($row['name']);
  $desp = strtoupper($row['description']);
  $uploadyear = $row['uploadyear'];
  mysqli_close($connect);

}
include("includes/header.php");
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

    <div class="container mt-5 pt-5">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
              <div class="card-header">
                <h5 class="card-title">Magazine Details</h5>
              </div>
              <div class="card-body">
                <div class="container-fluid">
                  <div class="row justify-content-center align-items-end">
                      <div class="col-md-4 text-center">
                          <img src="Documents/<?php echo $coverpage ?>" alt="" id="magazine-cover-view" class="img-thumbnail bg-dark">
                      </div>
                      <div class="col-md-8">
                          <h2 class='text-purple'><b><?php echo $row['name'] ?></b></h2>
                          <hr>
                          <div class="row justify-content-between align-items-top">
                              <div class="col-auto">
                                  <span class="text-muted">
                                      <i class="fa fa-calendar-day"></i> <?php echo "".($uploadyear-1)."-".substr($uploadyear, 2, 2) ?>
                                  </span>
                              </div>
                          </div>
                      </div>
                  </div>
                  <br>
                  <div class="row py-3">
                    <div class="col-md-12">
                        <div class="text-muted">Description</div>
                        <div><?php echo $desp ?></div>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <h4 class="text-purple"><b>PDF File</b></h4>
                      <hr>
                    <div class="w-100" id="PDF-holder">
                      <iframe src="Documents/<?php echo $pdf; ?>" frameborder="1" class="w-100 h-100 bg-dark"></iframe>
                    </div>
                  </div>
                  <br>
                  <div class="col">
                    <a href="./index.php" class="btn btn-primary"><i class="fa fa-angle-left"></i> Back to List</a>
                  </div>
                </div>
            </div>
        </div>
      </div>
</div>
</div>
</div>

<?php 
  include("includes/footer.php");
  include("includes/script.php");
?>