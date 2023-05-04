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
          	<p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-3"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>About</span></p>
            <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">About</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-about d-md-flex">
    	<div class="one-half img" style="background-image: url(images/about.jpg);"></div>
    	<div class="one-half ftco-animate">
        <div class="heading-section ftco-animate ">
          <h2 class="mb-4"><span>About Magazine Management System</span></h2>
        </div>
        <div>
  				<p>The Magazine Management System is a web-based application designed to simplify the process of college magazine publication by providing a centralized platform for managing and publishing content. With its user-friendly interface and role-based access controls, the Magazine Management System offers a range of functionalities tailored to the needs of students, coordinators, staff, and admins. From uploading and reviewing content to managing departments and approving articles, the system provides a streamlined workflow for magazine publication. Developed using PHP and powered by a robust database, the system is designed for scalability and performance, making it an ideal solution for colleges of all sizes.</p>
  			</div>
    	</div>
    </section>
    <?php 
  include("includes/footer.php");
  include("includes/script.php");
?>