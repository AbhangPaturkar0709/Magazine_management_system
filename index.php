<?php
include("includes/header.php");
include("includes/topbar.php"); 
?>
        <div data-draggable="true" class="" style="position: relative" draggable="false">
          <section draggable="false" class="container pt-5" data-v-271253ee="">
            <section class="mb-10">
              <h2 class="fw-bold mb-5 text-center">Latest Magazine</h2>
              <hr class="text-info" style="height:12px">
              <?php 
                include("includes/connection.php");
                $query = "Select *from magazines order by uploadyear desc";
                $result = mysqli_query($connect, $query);
                if(mysqli_num_rows($result) > 0)
                {
                  while($row = mysqli_fetch_assoc($result))
                  {?>
                  <div class="row gx-lg-5 mb-2 justify-content-center">
                    <div class="col-md-3 text-center">
                      <img src="Documents/<?php echo $row['coverpage'] ?>" class="w-100 shadow-4-strong rounded-4 mb-4" alt="" aria-controls="#picker-editor" draggable="false"/>
                    </div>
                    <div class="col-md-6 mb-4 mb-md-0">
                      <h3 class="fw-bold"><?php echo $row['name'] ?></h3>
                      <div class="mb-2 text-primary small">
                        <i class="far fa-calendar-alt me-2" aria-controls="#picker-editor"></i><span><?php echo "".($row['uploadyear']-1)."-".substr($row['uploadyear'], 2, 2) ?></span>
                      </div>
                      <p class="text-muted"><?php echo $row['description']?></p>
                      <a class="btn btn-primary" href="view_magazine.php?id=<?php echo $row['id']; ?>" role="button" aria-controls="#picker-editor" draggable="false" style="min-width auto">VIEW<i class="fas fa-eye p-1"></i></a>
                    </div>
                  </div>
                  <hr style="height:2px">
                  <?php 
                  }
                  mysqli_close($connect);
                }
                else
                {
                  mysqli_close($connect);
                }?>
            </section>
          </section>
<?php 
include("includes/header.php");
?>