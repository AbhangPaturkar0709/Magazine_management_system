<?php 
include("includes/header.php");
?>
<style>
.carousel .item {
  height: 300px;
}

.item img {
    position: absolute;
    top: 0;
    left: 0;
    min-height: 300px;
}

</style>
<div class="sticky-top bg-secondary">
<nav class="navbar navbar-dark bg-primary">
      <h1 class="text-white">Government Polytechnic, Amravati</h1>
    </nav>
    <br>
    <nav class="nav nav-pills nav-fill bg-secondary">
  <a class="nav-item nav-link" href="#">Home</a>
  <a class="nav-item nav-link" href="#">About Us</a>
  <a class="nav-item nav-link" href="login.php"><i class="fas fa-sign-in-alt p-1 ps-2"></i>Login</a>
</nav>
</div>
<br>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card bg-info">
      <div class="text m-3">
        <h2>Welcome to Our Digital Magazine!!</h2>
        <p class="">"Digital Transformation is not about Technology at all,its about the people!" Yupp,Sure you'll get more featured and advanced enhancement in the Digital Magazine of ours containing technical as well as non-techical views of all time!!</p>
      </div>
    </div>
  </div>
</div>
<br>
<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="card">
        <div id="carouselExampleIndicators"  class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" style="height:500px;">
        <div class="carousel-item active">
        <img class="d-block w-100" src="../img/1.png" alt="First slide">
        </div>
        <div class="carousel-item">
        <img class="d-block w-100" src="../img/1.png" alt="Second slide">
        </div>
        <div class="carousel-item">
        <img class="d-block w-100" src="../img/1.png" alt="Third slide">
        </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
        </a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              
              <div class="card-body">
              <div data-draggable="true" class="" style="position: relative" draggable="false">
          <section draggable="false" class="container pt-1" data-v-271253ee="">
            <section class="mb-10">
            <h2 class="fw-bold  text-center color-primary">Latest Magazine</h2>
              <hr class="text-info" style="height:12px">
              <?php 
                include("config/connection.php");
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
              </div>
             </div>
            </div>
          </div>
        </div>
      </div>

<?php
include("includes/script.php");

?>