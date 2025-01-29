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
      href="../../images/vitalcare-medical-center-high-resolution-logo-transparent (1).png"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
      crossorigin="anonymous"
    />

    <!-- Animate.css -->
    <link rel="stylesheet" href="../css/animate.css" />
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="../css/icomoon.css" />
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="../css/bootstrap.css" />
    <!-- Flexslider  -->
    <link rel="stylesheet" href="../css/flexslider.css" />
    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="../css/owl.carousel.min.css" />
    <link rel="stylesheet" href="../css/owl.theme.default.min.css" />
    <!-- Colors CSS -->
    <link rel="stylesheet" href="../css/responsive.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/custom.css" />

    <script src="js/modernizr-2.6.2.min.js"></script>
    <script src="js/modernizer.js"></script>
    <link rel="stylesheet" href="../../styles/styles.css" />
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
            echo '<li><a href="../auth/router.php">Log in</a></li>';
        }
        ?>
            </ul>
          </div>
        </nav>
        <script src="../js/navbar.js"></script>
      </div>
    </header>