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

    <!-- Animate.css -->
    <link rel="stylesheet" href="css/animate.css" />
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="css/icomoon.css" />
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="css/bootstrap.css" />
    <!-- Flexslider  -->
    <link rel="stylesheet" href="css/flexslider.css" />
    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="css/owl.carousel.min.css" />
    <link rel="stylesheet" href="css/owl.theme.default.min.css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Site CSS -->
    <link rel="stylesheet" href="style.css" />
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

    <!-- Start contact  -->
    <section id="mu-contact" style="margin-top: 100px">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="mu-contact-area">
              <!-- start title -->
              <div class="mu-title">
                <h2>Get in Touch</h2>
                <p>
                  Warm and inviting: Ready to experience VitalCare? Get in touch
                  to schedule your visit.
                </p>
              </div>
              <!-- end title -->
              <!-- start contact content -->
              <div class="mu-contact-content">
                <div class="row">
                  <div class="col-md-6">
                    <div class="mu-contact-left">
                      <form class="contactform">
                        <p class="comment-form-author">
                          <label for="author"
                            >Name <span class="required">*</span></label
                          >
                          <input
                            type="text"
                            required="required"
                            size="30"
                            value=""
                            name="author"
                          />
                        </p>
                        <p class="comment-form-email">
                          <label for="email"
                            >Email <span class="required">*</span></label
                          >
                          <input
                            type="email"
                            required="required"
                            aria-required="true"
                            value=""
                            name="email"
                          />
                        </p>
                        <p class="comment-form-url">
                          <label for="subject">Subject</label>
                          <input type="text" name="subject" />
                        </p>
                        <p class="comment-form-comment">
                          <label for="comment">Message</label>
                          <textarea
                            required="required"
                            aria-required="true"
                            rows="8"
                            cols="45"
                            name="comment"
                          ></textarea>
                        </p>
                        <p class="form-submit">
                          <input
                            type="submit"
                            value="Send Message"
                            class="mu-post-btn"
                            name="submit"
                          />
                        </p>
                      </form>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mu-contact-right">
                      <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15956.07976251628!2d36.6653724!3d-1.1462334!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2ske!4v1709586420701!5m2!1sen!2ske"
                        width="600"
                        height="450"
                        style="border: 0"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                      ></iframe>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end contact content -->
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End contact  -->

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
