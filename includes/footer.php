<footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">About</h2>
              <p>
              Stay up-to-date with the latest happenings on campus with our online college magazine.
              </p>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Departments</h2>
              <ul class="list-unstyled">
              <?php 
                include("includes/connection.php");
                $query = "Select d_name from department";
                $result = mysqli_query($connect, $query);
                if(mysqli_num_rows($result) >
            0) { while($row = mysqli_fetch_assoc($result)) {?>
                <li class="py-2 d-block"><?php echo $row['d_name'] ?></li>
                <?php }}else{?>
                  <li class="py-2 d-block">No Department Found.</li>
                  <?php } ?>
              </ul>
            </div>
          </div>

          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">College</h2>
              <div class="block-23 mb-3">
                <ul>
                  <li>
                    <span class="text"
                      >Government Polytechnic, Amravati is an Autonomous Institute of Government of Maharashtra which is one of the oldest institutes established in 1955.</span
                    >
                  </li>
                  <li>
                    <a href="#"
                      ><span class="text">gpamravati@gmail.com</span></a
                    >
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">
            <p>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              <strong>Copyright &copy; 2022-2023 <a href="http://localhost/magazine_management_system/index.php">Magazine Management System</a>.</strong>
    All rights reserved.
    <div class="float-center d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
            </p>
          </div>
        </div>
      </div>
    </footer>

    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen">
      <svg class="circular" width="48px" height="48px">
        <circle
          class="path-bg"
          cx="24"
          cy="24"
          r="22"
          fill="none"
          stroke-width="4"
          stroke="#eeeeee"
        />
        <circle
          class="path"
          cx="24"
          cy="24"
          r="22"
          fill="none"
          stroke-width="4"
          stroke-miterlimit="10"
          stroke="#F96D00"
        />
      </svg>
    </div>

