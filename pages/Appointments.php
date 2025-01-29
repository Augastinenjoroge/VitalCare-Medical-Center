<!DOCTYPE html>
<h1tml lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="viewport" content="initial-scale=1, maximum-scale=1" />
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
      id="home"
      class="parallax first-section wow fadeIn"
      data-stellar-background-ratio="0.4"
      style="background-image: url('../images/slider-bg.png')"
    >
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12">
            <div class="text-contant">
              <h2>
                <span class="center"
                  ><span class="icon"
                    ><img src="../images/icon-logo.png" alt="#" /></span
                ></span>
                <a
                  href=""
                  class="typewrite"
                  data-period="2000"
                  data-type='[ "Welcome to Life Care", "We Care Your Health", "We are Expert!" ]'
                >
                  <span class="wrap"></span>
                </a>
              </h2>
            </div>
          </div>
        </div>
        <!-- end row -->
      </div>
      <!-- end container -->
    </div>
    <!-- end section -->
    <div id="time-table" class="time-table-section">
      <div class="container">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
          <div class="row">
            <div class="service-time one" style="background: #2895f1">
              <span class="info-icon"
                ><i class="fa fa-ambulance" aria-hidden="true"></i
              ></span>
              <h3>Emergency Case</h3>
              <p>
              Rapid Response, Compassionate Care
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
          <div class="row">
            <div class="service-time middle" style="background: #0071d1">
              <span class="info-icon"
                ><i class="fa fa-clock-o" aria-hidden="true"></i
              ></span>
              <h3>Working Hours</h3>
              <div class="time-table-section">
                <ul>
                  <li>
                    <span class="left">Monday - Friday</span
                    ><span class="right">8.00 – 18.00</span>
                  </li>
                  <li>
                    <span class="left">Saturday</span
                    ><span class="right">8.00 – 16.00</span>
                  </li>
                  <li>
                    <span class="left">Sunday</span
                    ><span class="right">8.00 – 13.00</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
          <div class="row">
            <div class="service-time three" style="background: #0060b1">
              <span class="info-icon"
                ><i class="fa fa-hospital-o" aria-hidden="true"></i
              ></span>
              <h3>Clinic Timetable</h3>
              <p>
              Committed to Your Well-being with the best time for your care
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="service" class="services wow fadeIn">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
            <div class="inner-services">
              <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="serv">
                  <span class="icon-service"
                    ><img src="../images/service-icon1.png" alt="#"
                  /></span>
                  <h4>PREMIUM FACILITIES</h4>
                  <p>Relax in comfort with advanced technology at VitalCare.</p>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="serv">
                  <span class="icon-service"
                    ><img src="../images/service-icon2.png" alt="#"
                  /></span>
                  <h4>LARGE LABORATORY</h4>
                  <p>Get fast, accurate results in our on-site lab.</p>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="serv">
                  <span class="icon-service"
                    ><img src="../images/service-icon3.png" alt="#"
                  /></span>
                  <h4>DETAILED SPECIALIST</h4>
                  <p>
                    Our specialists provide personalized care for all your
                    needs.
                  </p>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="serv">
                  <span class="icon-service"
                    ><img src="../images/service-icon4.png" alt="#"
                  /></span>
                  <h4>CHILDREN CARE CENTER</h4>
                  <p>Keep kids entertained during your visit.</p>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="serv">
                  <span class="icon-service"
                    ><img src="../images/service-icon5.png" alt="#"
                  /></span>
                  <h4>FINE INFRASTRUCTURE</h4>
                  <p>Experience our modern, well-maintained facilities.</p>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="serv">
                  <span class="icon-service"
                    ><img src="../images/service-icon6.png" alt="#"
                  /></span>
                  <h4>ANYTIME BLOOD BANK</h4>
                  <p>Receive 24/7 access to blood for critical care.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="appointment-form">
              <h3><span>+</span> Book Appointment</h3>
              <div class="form">
                <form action="index.php">
                  <fieldset>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="row">
                        <div class="form-group">
                          <input
                            type="text"
                            id="name"
                            placeholder="Your Name"
                          />
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="row">
                        <div class="form-group">
                          <input
                            type="email"
                            placeholder="Email Address"
                            id="email"
                          />
                        </div>
                      </div>
                    </div>
                    <div
                      class="col-lg-12 col-md-12 col-sm-12 col-xs-12 select-section"
                    >
                      <div class="row">
                        <div class="form-group">
                          <select class="form-control">
                            <option>Day</option>
                            <option>Sunday</option>
                            <option>Monday</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <select class="form-control">
                            <option>Time</option>
                            <option>AM</option>
                            <option>PM</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="row">
                        <div class="form-group">
                          <select class="form-control">
                            <option>Doctor Name</option>
                            <option>Mr.Peter</option>
                            <option>Mr.Thuo</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="row">
                        <div class="form-group">
                          <textarea
                            rows="4"
                            id="textarea_message"
                            class="form-control"
                            placeholder="Your Message..."
                          ></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="row">
                        <div class="form-group">
                          <div class="center">
                            <button type="submit">Submit</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end section -->

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

    <!-- MAIN JS -->
    <script src="../js/main.js"></script>
    <!-- all js files -->
    <script src="../js/all.js"></script>
    <!-- all plugins -->
    <script src="../js/custom.js"></script>
  </body>
</h1tml>
