<?php 
include("authentication.php");
include("includes/header.php");
?>

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
 <?php 
  
          include("config/connection.php");
            

          $query = "select name from magazines where id = 48";
          $result = mysqli_query($connect, $query);
          $row = mysqli_fetch_assoc($result);
          
        
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
                <h3 class="card-title">My Submitted Articles</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              
              <div class="gallery">
                <img src="data:image/jpg;charset=utf;base64,<?php echo base64_encode($row['name']); ?>" alt="hi">
              </div>
              
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

