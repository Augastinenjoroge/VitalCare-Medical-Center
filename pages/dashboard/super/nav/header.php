<?php
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role_id']) || $_SESSION['role_id'] != 3) { // Assuming role_id 2 is for Doctor
    header("Location: ../../auth/patient/");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medical"; // replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$firstName = '';
$lastName = '';
$initials = '';

// Check if the user is logged in and is a Admin
if (isset($_SESSION['user_id']) && isset($_SESSION['role_id']) && $_SESSION['role_id'] == 3) { // Assuming role_id 2 is for Admin
    $userID = $_SESSION['user_id'];

    $sql = "SELECT FirstName, LastName FROM Admins WHERE UserID = '$userID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $firstName = $row['FirstName'];
        $lastName = $row['LastName'];
        $initials = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));
    }
}

$conn->close();
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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

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
                                <h6>Administrator <?php echo htmlspecialchars($firstName); ?></h6>
                                <p><span class="online_animation"></span> Online</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sidebar_blog_2">
                    <h4>Doctor Dashboard</h4>
                    <ul class="list-unstyled components">

                        <li>
                            <a href="index.php"><i class="fa fa-dashboard yellow_color"></i>
                                <span>Dashboard</span></a>
                        </li>
                        <li>
                            <a href="doctor_schedule.php"><i class="fa fa-calendar orange_color"></i>
                                <span>Schedule</span></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-briefcase blue1_color"></i>
                                <span>Appointment</span></a>
                        </li>

                        <li>
                            <a href="#element" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-file-text-o purple_color"></i>
                                <span>List of users</span></a>
                            <ul class="collapse list-unstyled" id="element">
                                <li>
                                    <a href="list_users.php">> <span>Users List</span></a>
                                </li>
                                <li>
                                    <a href="list_patients.php">> <span>Patients List</span></a>
                                </li>
                                <li>
                                    <a href="list_doctors.php">> <span>Doctors LIst</span></a>
                                </li>
                                <li>
                                    <a href="list_departments.php">> <span>Departments List</span></a>
                                </li>

                            </ul>
                        </li>
                        <li class="active">
                            <a href="#additional_page" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-clone yellow_color"></i>
                                <span>Additional Pages</span></a>
                            <ul class="collapse list-unstyled" id="additional_page">
                                <li>
                                    <a href="add_admin.php">> <span>Add Admin</span></a>
                                </li>
                                <li>
                                    <a href="add_doctor.php">> <span>Add Doctors</span></a>
                                </li>
                                <li>
                                    <a href="add_department.php">> <span>Add Departments</span></a>
                                </li>
                                
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-rss-square red_color"></i>
                                <span>Help Desk</span></a>
                        </li>
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
                                                <span class="name_user">Administrator <?php echo htmlspecialchars($firstName . ' ' . $lastName); ?></span>
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