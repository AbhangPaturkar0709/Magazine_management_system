<?php 
include("authentication.php");
include("includes/header.php");
include("includes/topbar.php");
include("includes/sidebar.php");
?>

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">

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
            Are your sure to Delete Student? 
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-danger" name="RemoveRole">YES</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
            </div>
            </form>
        </div>
      </div>
    </div>

    <?php
    if(isset($_POST['RemoveRole']))
    {
        $id = $_POST['id'];
        include("config/connection.php");
        $query = "delete from magazines where id = '$id'";
        mysqli_query($connect, $query);
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
              <li class="breadcrumb-item active">Magazine</li>
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
                <h3 class="card-title">Uploaded Magazines</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="text-center" width="10%">Sr. No.</th>
                      <th width="30%">Name</th>
                      <th class="text-center" width="15%">Upload Year</th>
                      <th class="text-center" width="15%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $i = 1;
                      include("config/connection.php");
                      $query = "Select *from magazines";
                      $result = mysqli_query($connect, $query);
                      if(mysqli_num_rows($result) > 0)
                      {
                        while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $i++; ?></td>
                      <td class="text"><?php echo ucwords($row['name']) ?></td>
                      <td class="text-center"><?php echo "".($row['uploadyear']-1)."-".substr($row['uploadyear'],2,2) ?></td>
                      <td align="center">
                        <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">Action
                          <span class="sr-only">Toggle Dropdown</span></button>
                            <div class="dropdown-menu" role="menu">
                              <a class="dropdown-item view_data" href="view_magazine.php?id=<?php echo $row['id']; ?>"><span class="fa fa-eye text-dark"></span> View</a>
                              <div class="dropdown-divider"></div>
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
                                <td style="background:white">No Magazine Found.</td>
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

