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
            <a href="index.php" class="nav-link" <?= $page == 'index.php' ? 'active':'' ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="myarticles.php" class="nav-link <?= $page == 'myarticles.php' || $page == 'articles.php' || $page == 'view_article.php'? 'active':'' ?>">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Articles
              </p>
            </a>
            <?php if($_SESSION['auth_user']['user_role'] == "COORDINATOR"){?>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="myarticles.php" class="nav-link <?= $page == 'myarticles.php' ? 'active':'' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>My Articles</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="articles.php" class="nav-link <?= $page == 'articles.php' ? 'active':'' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Articles</p>
                </a>
              </li>
            </ul>
           <?php } ?>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>