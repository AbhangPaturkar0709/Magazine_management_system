  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <span class="brand-text font-weight-light">Magazine Management</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    <?php $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'],"/")+1); ?>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="index.php" class="nav-link <?= $page == 'index.php' ? 'active':'' ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          
          <li class="nav-item">
            <a href="#" class="nav-link <?= $page == 'student_articles.php' || $page == 'staff_articles.php' || $page == 'view_article.php'? 'active':'' ?>">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Articles
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <?php if($_SESSION['auth_admin']['admin_role'] == "ADMIN"){ ?>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="student_articles.php" class="nav-link <?= $page == 'student_articles.php' ? 'active':'' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Articles</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="staff_articles.php" class="nav-link <?= $page == 'staff_articles.php' ? 'active':'' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Staff Articles</p>
                </a>
              </li>
            </ul>
            
            <?php }elseif($_SESSION['auth_admin']['admin_role'] == "STAFF"){?>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="staff_articles.php" class="nav-link <?= $page == 'staff_articles.php' ? 'active':'' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>My Articles</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="student_articles.php" class="nav-link <?= $page == 'student_articles.php' ? 'active':'' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Articles</p>
                </a>
              </li>
            </ul>
          </li>
            <?php }?>

          <li class="nav-item">
            <a href="#" class="nav-link <?= $page == 'student.php' || $page == 'staff.php' || $page == 'coordinator.php' || $page == 'Register_coordinator.php' || $page == 'userprofile.php' ? 'active':'' ?>">
            <i class="fas fa-circle nav-icon"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="student.php" class="nav-link <?= $page == 'student.php' ? 'active':'' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student</p>
                </a>
              </li>
              <?php if($_SESSION['auth_admin']['admin_role'] == "ADMIN"){ ?>
              <li class="nav-item">
                <a href="staff.php" class="nav-link <?= $page == 'staff.php' ? 'active':'' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Staff</p>
                </a>
              </li>
              <?php }?>
              <li class="nav-item">
                <a href="coordinator.php" class="nav-link <?= $page == 'coordinator.php' ? 'active':'' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Co-ordinator</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="magazine.php" class="nav-link <?= $page == 'magazine.php' || $page == 'view_magazine.php' ? 'active':'' ?>">
            <i class="nav-icon fas fa-book"></i>
              <p>
                Magazine
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>