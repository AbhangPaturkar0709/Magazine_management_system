<body>
    <nav
      class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light"
      id="ftco-navbar"
    >
      <div class="container">
        <a class="navbar-brand" href="index.php">Magazine Management System</a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#ftco-nav"
          aria-controls="ftco-nav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a href="index.php" class="nav-link">Home</a>
            </li>
            
            <li class="nav-item dropdown">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Academic Years</a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <?php 
                  include("includes/connection.php");
                  $query = "select distinct uploadyear from magazines where uploadyear NOT IN (select MAX(uploadyear) from magazines)";
                  $result = mysqli_query($connect, $query);
                  if(mysqli_num_rows($result) >0) 
                  { 
                    while($row = mysqli_fetch_assoc($result))
                    {?>
                      <li><a href="index.php?academic_year=<?php echo $row['uploadyear'] ?>" class="dropdown-item"><?php echo "".($row['uploadyear']-1)." - ".substr($row['uploadyear'], 2, 2) ?></a></li>
                    <?php }
                  }
                  else
                  {
                    echo "<li class='dropdown-item'>No Previous Academics Found</li>";
                  }
                ?>
                
                
              </ul>
            </li>
            <li class="nav-item">
              <a href="about.php" class="nav-link">About</a>
            </li>
            <li class="nav-item cta cta-colored">
              <a href="users/login.php" class="nav-link">Login</a>
            </li>
            
          </ul>
        </div>
      </div>
    </nav>
    <!-- END nav -->

