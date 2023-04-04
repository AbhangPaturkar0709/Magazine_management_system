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
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
        <?php if($_SESSION['auth_user']['user_role'] == "STUDENT"){?>
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-md-12">
            <?php
              include("message.php");
            ?>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <?php 
                include("config/connection.php");
                $id = $_SESSION['auth_user']['user_id'];
                $query = "select count(*) from articles WHERE stud_id = '$id'";
                $result = mysqli_query($connect, $query);
                $row = mysqli_fetch_assoc($result);
                echo "<h3>".$row['count(*)']."</h3>";
                mysqli_close($connect);
                ?>
                
                <p>Total Uploaded Articles</p>
              </div>
              <div class="icon">
              <i class="nav-icon fas fa-copy"></i>
              </div>
              <a href="myarticles.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
              <?php 
                include("config/connection.php");
                $id = $_SESSION['auth_user']['user_id'];
                $query = "select count(*) from articles where stud_id = '$id' and status = 'pending'";
                $result = mysqli_query($connect, $query);
                $row = mysqli_fetch_assoc($result);
                echo "<h3>".$row['count(*)']."</h3>";
                mysqli_close($connect);
                ?>

                <p>Total Pending Article</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-copy"></i>
              </div>
              <a href="myarticles.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              <?php 
                include("config/connection.php");
                $id = $_SESSION['auth_user']['user_id'];
                $query = "select count(*) from articles where stud_id = '$id' and status = 'Modify'";
                $result = mysqli_query($connect, $query);
                $row = mysqli_fetch_assoc($result);
                echo "<h3>".$row['count(*)']."</h3>";
                mysqli_close($connect);
                ?>

                <p>Under Modification Article</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-copy"></i>
              </div>
              <a href="myarticles.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <?php 
                include("config/connection.php");
                $id = $_SESSION['auth_user']['user_id'];
                $query = "select count(*) from articles where stud_id = '$id' and status = 'Approved'";
                $result = mysqli_query($connect, $query);
                $row = mysqli_fetch_assoc($result);
                echo "<h3>".$row['count(*)']."</h3>";
                mysqli_close($connect);
                ?>

                <p>Total Approved Article</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-copy"></i>
              </div>
              <a href="myarticles.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->  
        </div>
        <!-- /.row -->
          <?php }elseif($_SESSION['auth_user']['user_role'] == "COORDINATOR"){ ?>
            <h3 class="card-title">My Uploaded Articles</h3><br><br>
            <div class="row">
          <div class="col-md-12">
            <?php
              include("message.php");
            ?>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <?php 
                include("config/connection.php");
                $id = $_SESSION['auth_user']['user_id'];
                $query = "select count(*) from articles where stud_id = '$id'";
                $result = mysqli_query($connect, $query);
                $row = mysqli_fetch_assoc($result);
                echo "<h3>".$row['count(*)']."</h3>";
                mysqli_close($connect);
                ?>
                
                <p>Total Uploaded Articles</p>
              </div>
              <div class="icon">
              <i class="nav-icon fas fa-copy"></i>
              </div>
              <a href="myarticles.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
              <?php 
                include("config/connection.php");
                $id = $_SESSION['auth_user']['user_id'];
                $query = "select count(*) from articles where stud_id = '$id' and status = 'pending'";
                $result = mysqli_query($connect, $query);
                $row = mysqli_fetch_assoc($result);
                echo "<h3>".$row['count(*)']."</h3>";
                mysqli_close($connect);
                ?>

                <p>Total Pending Article</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-copy"></i>
              </div>
              <a href="myarticles.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              <?php 
                include("config/connection.php");
                $id = $_SESSION['auth_user']['user_id'];
                $query = "select count(*) from articles where stud_id = '$id' and status = 'Modify'";
                $result = mysqli_query($connect, $query);
                $row = mysqli_fetch_assoc($result);
                echo "<h3>".$row['count(*)']."</h3>";
                mysqli_close($connect);
                ?>

                <p>Under Modification Article</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-copy"></i>
              </div>
              <a href="myarticles.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <?php 
                include("config/connection.php");
                $id = $_SESSION['auth_user']['user_id'];
                $query = "select count(*) from articles where stud_id = '$id' and status = 'Approved'";
                $result = mysqli_query($connect, $query);
                $row = mysqli_fetch_assoc($result);
                echo "<h3>".$row['count(*)']."</h3>";
                mysqli_close($connect);
                ?>
                
                <p>Total Approved Articles</p>
              </div>
              <div class="icon">
              <i class="nav-icon fas fa-copy"></i>
              </div>
              <a href="myarticles.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /.row -->
        <hr>
        <h3 class="card-title">Students Articles</h3><br><br>
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <?php 
                include("config/connection.php");
                $dept = $_SESSION['auth_user']['user_dept'];
                $query = "select count(*) from articles INNER JOIN users ON articles.stud_id = users.id INNER JOIN department ON users.deptno = department.id WHERE users.role  IN ('STUDENT', 'COORDINATOR') and department.d_name = '$dept'";
                $result = mysqli_query($connect, $query);
                $row = mysqli_fetch_assoc($result);
                echo "<h3>".$row['count(*)']."</h3>";
                mysqli_close($connect);
                ?>
                
                <p>Students Total Articles</p>
              </div>
              <div class="icon">
              <i class="nav-icon fas fa-copy"></i>
              </div>
              <a href="articles.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
              <?php 
                include("config/connection.php");
                $dept = $_SESSION['auth_user']['user_dept'];
                $query = "select count(*) from articles INNER JOIN users ON articles.stud_id = users.id INNER JOIN department ON users.deptno = department.id WHERE users.role  IN ('STUDENT', 'COORDINATOR') and department.d_name = '$dept' and articles.status = 'pending'";
                $result = mysqli_query($connect, $query);
                $row = mysqli_fetch_assoc($result);
                echo "<h3>".$row['count(*)']."</h3>";
                mysqli_close($connect);
                ?>

                <p>Students Pending Article</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-copy"></i>
              </div>
              <a href="articles.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              <?php 
                include("config/connection.php");
                $dept = $_SESSION['auth_user']['user_dept'];
                $query = "select count(*) from articles INNER JOIN users ON articles.stud_id = users.id INNER JOIN department ON users.deptno = department.id WHERE users.role  IN ('STUDENT', 'COORDINATOR') and department.d_name = '$dept' and articles.status = 'Modify'";
                $result = mysqli_query($connect, $query);
                $row = mysqli_fetch_assoc($result);
                echo "<h3>".$row['count(*)']."</h3>";
                mysqli_close($connect);
                ?>

                <p>Students Under Modification Article</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-copy"></i>
              </div>
              <a href="articles.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <?php 
                include("config/connection.php");
                $dept = $_SESSION['auth_user']['user_dept'];
                $query = "select count(*) from articles INNER JOIN users ON articles.stud_id = users.id INNER JOIN department ON users.deptno = department.id WHERE users.role  IN ('STUDENT', 'COORDINATOR') and department.d_name = '$dept' and articles.status = 'Approved'";
                $result = mysqli_query($connect, $query);
                $row = mysqli_fetch_assoc($result);
                echo "<h3>".$row['count(*)']."</h3>";
                mysqli_close($connect);
                ?>
                
                <p>Students Approved Articles</p>
              </div>
              <div class="icon">
              <i class="nav-icon fas fa-copy"></i>
              </div>
              <a href="articles.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /.row -->
        <?php }?>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?php
include("includes/script.php");
include("includes/footer.php");
?>