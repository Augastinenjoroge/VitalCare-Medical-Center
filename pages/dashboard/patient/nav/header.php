<?php
include 'db.php';

$firstName = '';
$lastName = '';
$initials = '';

// Check if the user is logged in and is a doctor
if (isset($_SESSION['user_id']) && isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) { // Assuming role_id 1 is for Patient
    $userID = $_SESSION['user_id'];

    $sql = "SELECT FirstName, LastName FROM Patients WHERE UserID = '$userID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $firstName = $row['FirstName'];
        $lastName = $row['LastName'];
        $initials = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));
    }
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="viewport" content="initial-scale=1, maximum-scale=1" />
    <!-- site metas -->
    <title>VitalCare Medical Center</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!-- site icon -->
    <link rel="icon" href="images/logo/vitalcare-medical-center-high-resolution-logo-transparent (1).png" type="image/png" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- site css -->
    <link rel="stylesheet" href="style.css" />
    <!-- responsive css -->
    <link rel="stylesheet" href="css/responsive.css" />
    <!-- color css -->
    <link rel="stylesheet" href="css/colors.css" />
    <!-- select bootstrap -->
    <link rel="stylesheet" href="css/bootstrap-select.css" />
    <!-- scrollbar css -->
    <link rel="stylesheet" href="css/perfect-scrollbar.css" />
    <!-- custom css -->
    <link rel="stylesheet" href="css/custom.css" />
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        .initials-avatar {
            display: inline-block;
            width: 40px;
            height: 40px;
            background-color: #007bff;
            color: #fff;
            font-size: 20px;
            text-align: center;
            line-height: 40px;
            border-radius: 50%;
        }
        .initials-avatar2 {
            display: inline-block;
            width: 70px;
            height: 70px;
            background-color: #007bff;
            color: #fff;
            font-size: 40px;
            text-align: center;
            line-height: 70px;
            border-radius: 50%;
        }
    </style>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


</head>

<body class="dashboard dashboard_1">
    <div class="full_container">
        <div class="inner_container">
            <!-- Sidebar  -->
            <nav id="sidebar">
                <div class="sidebar_blog_1">
                    <div class="sidebar-header">
                        <div class="logo_section">
                            <a href="index.php"><img class="logo_icon img-responsive" src="images/logo/logo_icon.png" alt="#" /></a>
                        </div>
                    </div>
                    <div class="sidebar_user_info">
                        <div class="icon_setting"></div>
                        <div class="user_profle_side">
                            <div class="user_img">
                                <div class="initials-avatar2"><?php echo $initials; ?></div>
                            </div>
                            <div class="user_info">
                                <h6><?php echo htmlspecialchars($firstName); ?></h6>
                                <p><span class="online_animation"></span> Online</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sidebar_blog_2">
                    <h4>Patient Dashboard</h4>
                    <ul class="list-unstyled components">
                        
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard yellow_color"></i>
                                <span>Dashboard</span></a>
                        </li>
                        <li>
                            <a href="appointments.php"><i class="fa fa-briefcase blue1_color"></i>
                                <span>Appointment</span></a>
                        </li>
                        <li>
                            <a href="select_department.php"><i class="fa fa-calendar orange_color"></i>
                                <span>Add Appointment</span></a>
                        </li>
                        <!-- <li>
                            <a href="add_schedule.php"><i class="fa fa-clock-o purple_color"></i>
                                <span>Add Schedule</span></a>
                        </li> -->
                        
                        <li>
                            <a href="#"><i class="fa fa-rss-square red_color"></i>
                                <span>Help Desk</span></a>
                        </li>

                        <!-- <li>
                            <a href="#element" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-diamond purple_color"></i>
                                <span>Elements</span></a>
                            <ul class="collapse list-unstyled" id="element">
                                <li>
                                    <a href="general_elements.php">> <span>General Elements</span></a>
                                </li>
                                <li>
                                    <a href="media_gallery.php">> <span>Media Gallery</span></a>
                                </li>
                                <li>
                                    <a href="icons.php">> <span>Icons</span></a>
                                </li>
                                <li>
                                    <a href="invoice.php">> <span>Invoice</span></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="tables.php"><i class="fa fa-table purple_color2"></i>
                                <span>Tables</span></a>
                        </li>
                        <li>
                            <a href="#apps" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-object-group blue2_color"></i>
                                <span>Apps</span></a>
                            <ul class="collapse list-unstyled" id="apps">
                                <li>
                                    <a href="email.php">> <span>Email</span></a>
                                </li>
                                <li>
                                    <a href="calendar.php">> <span>Calendar</span></a>
                                </li>
                                <li>
                                    <a href="media_gallery.php">> <span>Media Gallery</span></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="price.php"><i class="fa fa-briefcase blue1_color"></i>
                                <span>Pricing Tables</span></a>
                        </li>
                        <li>
                            <a href="contact.php">
                                <i class="fa fa-paper-plane red_color"></i>
                                <span>Contact</span></a>
                        </li>
                        <li class="active">
                            <a href="#additional_page" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-clone yellow_color"></i>
                                <span>Additional Pages</span></a>
                            <ul class="collapse list-unstyled" id="additional_page">
                                <li>
                                    <a href="profile.php">> <span>Profile</span></a>
                                </li>
                                <li>
                                    <a href="project.php">> <span>Projects</span></a>
                                </li>
                                <li>
                                    <a href="login.php">> <span>Login</span></a>
                                </li>
                                <li>
                                    <a href="404_error.php">> <span>404 Error</span></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="map.php"><i class="fa fa-map purple_color2"></i> <span>Map</span></a>
                        </li>
                        <li>
                            <a href="charts.php"><i class="fa fa-bar-chart-o green_color"></i>
                                <span>Charts</span></a>
                        </li>
                        <li>
                            <a href="settings.php"><i class="fa fa-cog yellow_color"></i>
                                <span>Settings</span></a>
                        </li> -->
                    </ul>
                </div>
            </nav>
            <!-- end sidebar -->
            <!-- right content -->
            <div id="content">
                <!-- topbar -->
                <div class="topbar">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="full">
                            <button type="button" id="sidebarCollapse" class="sidebar_toggle">
                                <i class="fa fa-bars"></i>
                            </button>
                            <div class="logo_section">
                                <a href="index.php"><img class="img-responsive" src="images/logo/vitalcare-medical-center-high-resolution-logo-transparent (1).png" alt="#" /><span class="name_user">VitalCare Medical Center</span></a>
                            </div>
                            <div class="right_topbar">
                                <div class="icon_info">
                                    <ul>
                                        <li>
                                            <a href="#"><i class="fa fa-bell-o"></i><span class="badge">2</span></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-question-circle"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-envelope-o"></i><span class="badge">3</span></a>
                                        </li>
                                    </ul>
                                    <ul class="user_profile_dd">
                                        <li>
                                            <a class="dropdown-toggle" data-toggle="dropdown">
                                                <div class="initials-avatar"><?php echo $initials; ?></div>
                                                <span class="name_user"><?php echo htmlspecialchars($firstName . ' ' . $lastName); ?></span>
                                            </a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">My Profile</a>
                                                <a class="dropdown-item" href="#">Settings</a>
                                                <a class="dropdown-item" href="#">Help</a>
                                                <a class="dropdown-item" href="config/logout.php"><span>Log Out</span> <i class="fa fa-sign-out"></i></a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
                