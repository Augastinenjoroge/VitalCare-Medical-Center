<!DOCTYPE html>
<h1tml lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VitalCare Medical Center</title>
    <link
      rel="icon"
      type="image/png"
      href="../images/vitalcare-medical-center-high-resolution-logo-transparent (1).png"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
      crossorigin="anonymous"
    />

   
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="css/bootstrap.css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Colors CSS -->
    <link rel="stylesheet" href="css/colors.css" />
    <!-- ALL VERSION CSS -->
    <link rel="stylesheet" href="css/versions.css" />
    <!-- Colors CSS -->
    <link rel="stylesheet" href="css/responsive.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css" />

    <script src="js/modernizr-2.6.2.min.js"></script>

    <link rel="stylesheet" href="../styles/styles.css" />
  </head>
  <body>
    <header>
      <div class="navwelcome">
        <nav>
          <div class="nav-main">
            <div class="nav-header">
              <a href="index.php">
                <img
                  class="logo"
                  src="../images/vitalcare-medical-center-high-resolution-logo-transparent.png"
                  alt="logo"
              /></a>
              <i class="fa fa-bars" aria-hidden="true"></i>
            </div>
            <ul class="menu">
            <li>
                <a href="index.php">Home</a>
              </li>
              <li>
                <a href="aboutus.php">About us</a>
              </li>
              <li>
                <a href="Appointments.php">Appointments</a>
              </li>
              <li>
                <a href="Contact.php">Contact Us</a>
              </li>
              <?php
        // Output the appropriate link based on the login status
        if (isset($_SESSION['user_logged_in'])) {
			echo '<li><a href="../auth/router.php?action=logout">Logout</a></li>';
        } else {
            echo '<li><a href="auth/patient">Log in</a></li>';
        }
        ?>  
            </ul>
          </div>
        </nav>
        <script src="../js/navbar.js"></script>
      </div>
    </header>

    <div
      id="about"
      class="section wow fadeIn"
      style="margin-top: 200px; margin-bottom: 50px"
    >
      <div class="container">
        <div class="heading">
          <span class="icon-logo"
            ><img src="../images/icon-logo.png" alt="#"
          /></span>
          <h2>The Specialist Clinic</h2>
        </div>
        <!-- end title -->
        <div class="row">
          <div class="col-md-6">
            <div class="message-box">
              <h4>What We Do</h4>
              <h2>Clinic Service</h2>
              <p class="lead">
                Patients rave about clinics that deliver a winning combination:
              </p>
              <p>
                friendly and efficient staff who get you in and out quickly,
                knowledgeable providers who explain things clearly, sparkling
                clean facilities that put you at ease, and a wide range of
                affordable healthcare options so you can get the care you need
                without breaking the bank.
              </p>
              <a
                href="Services.php"
                data-scroll
                class="btn btn-light btn-radius btn-brd grd1 effect-1"
                >Learn More</a
              >
            </div>
            <!-- end messagebox -->
          </div>
          <!-- end col -->
          <div class="col-md-6">
            <div class="post-media wow fadeIn">
              <img src="../images/about_03.jpg" alt="" class="img-responsive" />
              <a
                href="http://www.youtube.com/watch?v=nrJtHemSPW4"
                data-rel="prettyPhoto[gal]"
                class="playbutton"
                ><i class="flaticon-play-button"></i
              ></a>
            </div>
            <!-- end media -->
          </div>
          <!-- end col -->
        </div>
        <!-- end row -->
        <hr class="hr1" />
        <div class="row">
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="service-widget">
              <div class="post-media wow fadeIn">
                <a
                  href="../images/clinic_01.jpg"
                  data-rel="prettyPhoto[gal]"
                  class="hoverbutton global-radius"
                  ><i class="flaticon-unlink"></i
                ></a>
                <img
                  src="../images/clinic_01.jpg"
                  alt=""
                  class="img-responsive"
                />
              </div>
              <h3>Digital Control Center</h3>
            </div>
            <!-- end service -->
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="service-widget">
              <div class="post-media wow fadeIn">
                <a
                  href="../images/clinic_02.jpg"
                  data-rel="prettyPhoto[gal]"
                  class="hoverbutton global-radius"
                  ><i class="flaticon-unlink"></i
                ></a>
                <img
                  src="../images/clinic_02.jpg"
                  alt=""
                  class="img-responsive"
                />
              </div>
              <h3>Hygienic Operating Room</h3>
            </div>
            <!-- end service -->
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="service-widget">
              <div class="post-media wow fadeIn">
                <a
                  href="../images/clinic_03.jpg"
                  data-rel="prettyPhoto[gal]"
                  class="hoverbutton global-radius"
                  ><i class="flaticon-unlink"></i
                ></a>
                <img
                  src="../images/clinic_03.jpg"
                  alt=""
                  class="img-responsive"
                />
              </div>
              <h3>Specialist Physicians</h3>
            </div>
            <!-- end service -->
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="service-widget">
              <div class="post-media wow fadeIn">
                <a
                  href="../images/clinic_01.jpg"
                  data-rel="prettyPhoto[gal]"
                  class="hoverbutton global-radius"
                  ><i class="flaticon-unlink"></i
                ></a>
                <img
                  src="../images/clinic_01.jpg"
                  alt=""
                  class="img-responsive"
                />
              </div>
              <h3>Digital Control Center</h3>
            </div>
            <!-- end service -->
          </div>
        </div>
        <!-- end row -->
      </div>
      <!-- end container -->
    </div>

    <div id="testimonials" class="section wb wow fadeIn">
      <div class="container">
        <div class="heading">
          <span class="icon-logo"
            ><img src="../images/icon-logo.png" alt="#"
          /></span>
          <h2>Testimonials</h2>
        </div>
        <!-- end title -->
        <div class="row">
          <div
            class="col-md-6 col-sm-12 wow fadeIn"
            data-wow-duration="1s"
            data-wow-delay="0.2s"
          >
            <div class="testimonial clearfix">
              <div class="desc">
                <h3>
                  <i class="fa fa-quote-left"></i> The amazing clinic! Wonderful
                  Support!
                </h3>
                <p class="lead">
                  VitalCare Medical Center is an amazing clinic with wonderful
                  staff who are always there to help!
                </p>
              </div>
              <div class="testi-meta">
                <img
                  src="../images/testi_01.png"
                  alt=""
                  class="img-responsive alignleft"
                />
                <h4>James Fernando <small>- Manager of Racer</small></h4>
              </div>
              <!-- end testi-meta -->
            </div>
            <!-- end testimonial -->
          </div>
          <!-- end col -->
          <div
            class="col-md-6 col-sm-12 wow fadeIn"
            data-wow-duration="1s"
            data-wow-delay="0.4s"
          >
            <div class="testimonial clearfix">
              <div class="desc">
                <h3><i class="fa fa-quote-left"></i> Thanks for Help us!</h3>
                <p class="lead">
                  So grateful to the VitalCare team for their expertise and for
                  helping me get back on my feet!
                </p>
              </div>
              <div class="testi-meta">
                <img
                  src="../images/testi_02.png"
                  alt=""
                  class="img-responsive alignleft"
                />
                <h4>Andrew Atkinson <small>- Life Manager</small></h4>
              </div>
              <!-- end testi-meta -->
            </div>
            <!-- end testimonial -->
          </div>
          <!-- end col -->
        </div>
        <!-- end row -->
        <hr class="invis" />
        <div class="row">
          <div
            class="col-md-6 col-sm-12 wow fadeIn"
            data-wow-duration="1s"
            data-wow-delay="0.6s"
          >
            <div class="testimonial clearfix">
              <div class="desc">
                <h3>
                  <i class="fa fa-quote-left"></i> The amazing facilities!
                </h3>
                <p class="lead">
                  Thanks to VitalCare Medical Center, I received the care I
                  needed in a top-notch facility.
                </p>
              </div>
              <div class="testi-meta">
                <img
                  src="../images/testi_03.png"
                  alt=""
                  class="img-responsive alignleft"
                />
                <h4>Amanda DOE <small>- Manager of Racer</small></h4>
              </div>
              <!-- end testi-meta -->
            </div>
            <!-- end testimonial -->
          </div>
          <!-- end col -->
          <div
            class="col-md-6 col-sm-12 wow fadeIn"
            data-wow-duration="1s"
            data-wow-delay="0.8s"
          >
            <div class="testimonial clearfix">
              <div class="desc">
                <h3>
                  <i class="fa fa-quote-left"></i> The doctor was very
                  knowledgeable
                </h3>
                <p class="lead">
                  Highly recommend VitalCare - the doctors are incredibly
                  knowledgeable and the facilities are top-notch!
                </p>
              </div>
              <div class="testi-meta">
                <img
                  src="../images/testi_01.png"
                  alt=""
                  class="img-responsive alignleft"
                />
                <h4>Martin Johnson <small>- Founder of Goosilo</small></h4>
              </div>
              <!-- end testi-meta -->
            </div>
            <!-- end testimonial -->
          </div>
          <!-- end col -->
        </div>
        <!-- end row -->
      </div>
      <!-- end container -->
    </div>

    <div id="fh5co-page">
      <footer id="fh5co-footer" role="contentinfo">
        <div class="container">
          <div class="col-md-3 col-sm-12 col-sm-push-0 col-xs-12 col-xs-push-0">
            <h3>About Us</h3>
            <p>
              At VitalCare Medical Center, we're dedicated to providing
              exceptional healthcare for you and your loved ones. We offer a
              welcoming environment with cutting-edge technology and a team of
              dedicated professionals.
            </p>
          </div>
          <div
            class="col-md-6 col-md-push-1 col-sm-12 col-sm-push-0 col-xs-12 col-xs-push-0"
          >
            <h3>Our Services</h3>
            <ul class="float">
              <li><a href="#">Home</a></li>
              <li><a href="#">About us</a></li>
              <li><a href="#">service</a></li>
              <li><a href="#">Doctors</a></li>
            </ul>
            <ul class="float">
              <li><a href="#">Patient Resources</a></li>
              <li><a href="#">Appointments</a></li>
              <li><a href="#">Contact Us</a></li>
            </ul>
          </div>

          <div
            class="col-md-2 col-md-push-1 col-sm-12 col-sm-push-0 col-xs-12 col-xs-push-0"
          >
            <h3>Follow Us</h3>
            <ul class="fh5co-social">
              <li>
                <a href="#"><i class="icon-twitter"></i></a>
              </li>
              <li>
                <a href="#"><i class="icon-facebook"></i></a>
              </li>
              <li>
                <a href="#"><i class="icon-google-plus"></i></a>
              </li>
              <li>
                <a href="#"><i class="icon-instagram"></i></a>
              </li>
            </ul>
          </div>
        </div>
      </footer>
    </div>

    <!-- jQuery -->
    <script src="../js/jquery.min.js"></script>
    <!-- jQuery Easing -->
    <script src="../js/jquery.easing.1.3.js"></script>
    <!-- Bootstrap -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- Waypoints -->
    <script src="../js/jquery.waypoints.min.js"></script>
    <!-- Owl Carousel -->
    <script src="../js/owl.carousel.min.js"></script>
    <!-- Flexslider -->
    <script src="../js/jquery.flexslider-min.js"></script>

    <!-- MAIN JS -->
    <script src="../js/main.js"></script>
    <!-- all js files -->
    <script src="../js/all.js"></script>
    <!-- all plugins -->
    <script src="../js/custom.js"></script>
  </body>
</h1tml>
