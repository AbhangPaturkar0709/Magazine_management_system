
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Magzine Management System</a>
    	<div class="mr-auto"></div>
    	<div align="right"><ul class="navbar-nav" >
        <?php

          if(isset($_SESSION['student_email']))
          {
            $user = $_SESSION['student_email'];

              echo '
                <li class="nav-item"><a href="#" class="nav-item nav-link">'.$user.'</a></li>
                <li class="nav-item"><a href="inc/logout.php" class="nav-item nav-link">logout</a></li>
              ';
          }

          else
          {
            echo '
              <li class="nav-item"><a href="start.php" class="nav-item nav-link">Home</a></li>
              <li class="nav-item"><a href="users/login.php" class="nav-item nav-link">Login</a></li>
            ';
          }

        ?>
    	</ul>
        </div>
    	
    </nav>
</body>
</html>