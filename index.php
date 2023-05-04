<?php 
  include("includes/header.php");
  include("includes/topbar.php");
?>
<div
      class="hero-wrap js-fullheight"
      style="background-image: url('images/bg_2.jpg')"
      data-stellar-background-ratio="0.5"
    >
      <div class="overlay"></div>
      <div class="container">
        <div
          class="row no-gutters slider-text js-fullheight align-items-center justify-content-start"
          data-scrollax-parent="true"
        >
          <div
            class="col-xl-10 ftco-animate mb-5 pb-5"
            data-scrollax=" properties: { translateY: '70%' }"
          >
            <h1
              class="mb-5"
              data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"
            >
              Digital Magazine <br /><span
                >Government Polytechnic, Amravati</span
              >
            </h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section ftco-counter">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <span class="subheading"
              >Explore college life with our new magazine release.</span
            >
            <h2 class="mb-4"><span>Latest</span> Magazine</h2>
          </div>
        </div>
        <div
          data-draggable="true"
          class=""
          style="position: relative"
          draggable="false"
        >
          <section draggable="false" class="container pt-5" data-v-271253ee="">
            <?php 
                include("includes/connection.php");
                $query = "Select *from magazines order by uploadyear desc";
                $result = mysqli_query($connect, $query);
                if(mysqli_num_rows($result) >
            0) { while($row = mysqli_fetch_assoc($result)) {?>
            <div class="row gx-lg-5 mb-2 justify-content-center">
              <div class="col-md-3 text-center">
                <img
                  src="Documents/<?php echo $row['coverpage'] ?>"
                  class="w-100 shadow-4-strong rounded-4 mb-4"
                  alt=""
                  aria-controls="#picker-editor"
                  draggable="false"
                />
              </div>
              <div class="col-md-6 mb-4 mb-md-0">
                <h3 class="fw-bold"><?php echo $row['name'] ?></h3>
                <div class="mb-2 text-primary small">
                  <i
                    class="far fa-calendar-alt me-2"
                    aria-controls="#picker-editor"
                  ></i
                  ><span
                    ><?php echo "".($row['uploadyear']-1)."-".substr($row['uploadyear'], 2, 2) ?></span
                  >
                </div>
                <p class="text-muted"><?php echo $row['description']?></p>
                <a
                  class="btn btn-primary"
                  href="view_magazine.php?id=<?php echo $row['id']; ?>"
                  role="button"
                  aria-controls="#picker-editor"
                  draggable="false"
                  style="min-width auto"
                  >VIEW<i class="fas fa-eye p-1"></i
                ></a>
              </div>
            </div>
            <hr style="height: 2px" />
            <?php 
                  }
                  mysqli_close($connect);
                }
                else
                {
                  mysqli_close($connect);
                }?>
          </section>
        </div>
      </div>
    </section>

    <section class="ftco-section services-section bg-light">
      <div class="container">
        <div class="row d-flex">
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block">
              <div class="icon"><span class="flaticon-resume"></span></div>
              <div class="media-body">
                <h3 class="heading mb-3">Interactive Content</h3>
                <p>
                  A digital magazine website for a college should have
                  interactive content that engages students and provides them
                  with a unique reading experience.
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block">
              <div class="icon">
                <span class="flaticon-collaboration"></span>
              </div>
              <div class="media-body">
                <h3 class="heading mb-3">User-friendly navigation</h3>
                <p>
                  The website should have a simple and intuitive navigation
                  system.
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block">
              <div class="icon"><span class="flaticon-promotions"></span></div>
              <div class="media-body">
                <h3 class="heading mb-3">Mobile-responsive design</h3>
                <p>
                  With more and more people accessing websites on their mobile
                  devices, it's important for a digital magazine website to have
                  a responsive design.
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block">
              <div class="icon"><span class="flaticon-employee"></span></div>
              <div class="media-body">
                <h3 class="heading mb-3">Informative Exploration</h3>
                <p>Relevant and informative content for college students.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section
      class="ftco-section ftco-counter img"
      id="section-counter"
      style="background-image: url(images/bg_1.jpg)"
      data-stellar-background-ratio="0.5"
    >
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-10">
            <div class="row">
              <div
                class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate"
              >
                <div class="block-18 text-center">
                  <div class="text">
                  <?php 
                    include("includes/connection.php");
                    $query = "Select count(*) from users where role in ('STUDENT', 'COORDINATOR')";
                    $result = mysqli_query($connect, $query);
                    if(mysqli_num_rows($result) >0) 
                    $row = mysqli_fetch_assoc($result) 
                    ?>
                    <strong class="number" data-number="<?php echo $row['count(*)']?>">0</strong>
                    <span>Students</span>
                  </div>
                </div>
              </div>
              <div
                class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate"
              >
                <div class="block-18 text-center">
                  <div class="text">
                  <?php 
                    include("includes/connection.php");
                    $query = "Select count(*) from articles";
                    $result = mysqli_query($connect, $query);
                    if(mysqli_num_rows($result) >0) 
                    $row = mysqli_fetch_assoc($result) 
                    ?>
                    <strong class="number" data-number="<?php echo $row['count(*)']?>">0</strong>
                    <span>Articles</span>
                  </div>
                </div>
              </div>
              <div
                class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate"
              >
                <div class="block-18 text-center">
                  <div class="text">
                  <?php 
                    include("includes/connection.php");
                    $query = "Select count(*) from articles where category = 'Technical'";
                    $result = mysqli_query($connect, $query);
                    if(mysqli_num_rows($result) >0) 
                    $row = mysqli_fetch_assoc($result) 
                    ?>
                    <strong class="number" data-number="<?php echo $row['count(*)']?>">0</strong>
                    <span>Technical Articles</span>
                  </div>
                </div>
              </div>
              <div
                class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate"
              >
                <div class="block-18 text-center">
                  <div class="text">
                  <?php 
                    include("includes/connection.php");
                    $query = "Select count(*) from articles where category = 'Non-Technical'";
                    $result = mysqli_query($connect, $query);
                    if(mysqli_num_rows($result) >0) 
                    $row = mysqli_fetch_assoc($result) 
                    ?>
                    <strong class="number" data-number="<?php echo $row['count(*)']?>">0</strong>
                    <span>Non-Technical Articles</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

<?php 
  include("includes/footer.php");
  include("includes/script.php");
?>