<?php
include('nav/header.php');

include('db.php');

// Start output buffering
ob_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role_id']) || $_SESSION['role_id'] != 2) { // Assuming role_id 2 is for Doctor
   header("Location: ../../auth/");
   exit();
}

$firstName = '';
$lastName = '';
$initials = '';
$email = '';
$contactNumber = '';
$departmentName = '';
$status = 'Off';
$availableFrom = '';
$availableTo = '';

// Fetch the doctor's details from the database
$userID = $_SESSION['user_id'];

$sql = "SELECT d.FirstName, d.LastName, d.Email, d.ContactNumber, dept.DepartmentName 
        FROM Doctors d
        JOIN Departments dept ON d.DepartmentID = dept.DepartmentID
        WHERE d.UserID = '$userID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   $row = $result->fetch_assoc();
   $firstName = $row['FirstName'];
   $lastName = $row['LastName'];
   $email = $row['Email'];
   $contactNumber = $row['ContactNumber'];
   $departmentName = $row['DepartmentName'];
   $initials = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));
}

// Fetch the doctor's schedule for today
$today = date('Y-m-d');
$sql = "SELECT AvailableFrom, AvailableTo FROM Doctor_Schedules WHERE DoctorID = (SELECT DoctorID FROM Doctors WHERE UserID = '$userID') AND AvailableDate = '$today'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   $schedule = $result->fetch_assoc();
   $status = 'Available';
   $availableFrom = date("h:i A", strtotime($schedule['AvailableFrom']));
   $availableTo = date("h:i A", strtotime($schedule['AvailableTo']));
}

// Fetch the number of appointments for today
$sql = "SELECT COUNT(*) as appointment_count FROM Appointments WHERE DoctorID = '$doctorID' AND DATE(AppointmentDateTime) = '$today' AND Status = 'Booked'";
$result = $conn->query($sql);
$appointmentCount = 0;

if ($result->num_rows > 0) {
   $row = $result->fetch_assoc();
   $appointmentCount = $row['appointment_count'];
}

// Determine the availability status and link destination
$appointmentLink = '';
if ($appointmentCount > 0) {
   $appointmentLink = 'appointment.php';
   $appointmentText = 'View Appointment';
} else {
   $appointmentText = 'No Appointments Today';
}

$conn->close();
?>


<!-- dashboard inner -->
<div class="midde_cont">
   <div class="container-fluid">
      <div class="row column_title">
         <div class="col-md-12">
            <div class="page_title center yellow_color">
               <h1 class="blue2_color" style="font-size:70px;"> welcome to Viral Medical Care</h1>
            </div>
         </div>
      </div>
      <div class="row column1">
         <div class="col-md-2"></div>
         <div class="col-md-8">
            <div class="white_shd full margin_bottom_30">
               <div class="full graph_head">
                  <div class="heading1 margin_0">
                     <h2>Welcome</h2>
                  </div>
               </div>
               <div class="full price_table padding_infor_info">
                  <div class="row">
                     <!-- user profile section -->
                     <!-- profile image -->
                     <div class="col-lg-12">
                        <div class="full dis_flex center_text">
                           <div class="profile_img">
                              <div class="initials-avatar_index"><?php echo $initials; ?></div>
                           </div>
                           <div class="profile_contant">
                              <div class="contact_inner">
                                 <h3>Dr. <?php echo htmlspecialchars($firstName . ' ' . $lastName); ?></h3>
                                 <p><strong>Department: </strong><?php echo htmlspecialchars($departmentName); ?></p>
                                 <ul class="list-unstyled">
                                    <li><i class="fa fa-envelope-o"></i> : <?php echo htmlspecialchars($email); ?></li>
                                    <li><i class="fa fa-phone"></i> : <?php echo htmlspecialchars($contactNumber); ?></li>
                                 </ul>
                              </div>
                           </div>
                        </div>

                        <!-- end user profile section -->
                        <div class="row column1 social_media_section full dis_flex margin_top_30 center">
                           <div class="col-md-6 col-lg-3">
                              <div class="full socile_icons google_p margin_bottom_30">
                                 <div class="social_icon">
                                    <i class="fa fa-child yellow_color"></i>
                                 </div>
                                 <div class="social_cont">
                                       <a href="<?php echo htmlspecialchars($appointmentLink); ?>">
                                          <p class="total_no"><?php echo htmlspecialchars($appointmentCount); ?></p>
                                          <p class="head_couter">Number of Appointments</p>
                                       </a>
                                 </div>
                              </div>
                           </div>
                           <!-- Availability Status Section -->
                           <div class="col-md-6 col-lg-3">
                              <a href="<?php echo $status == 'Available' ? 'doctor_schedule.php' : 'add_schedule.php'; ?>" class="availability-container">
                                 <div class="full socile_icons tw margin_bottom_30">
                                    <div class="social_icon">
                                       <i class="fa fa-user yellow_color"></i>
                                    </div>
                                    <div class="social_cont">
                                       <p class="total_no">Status: <span><?php echo htmlspecialchars($status); ?></span></p>
                                       <?php if ($status == 'Available') : ?>
                                          <p class="head_couter">from <span><?php echo htmlspecialchars($availableFrom); ?></span> to <span><?php echo htmlspecialchars($availableTo); ?></span></p>
                                       <?php else : ?>
                                          <p class="head_couter">Set Schedule</p>
                                       <?php endif; ?>
                                    </div>
                                 </div>
                              </a>
                           </div>

                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-2"></div>
            </div>
            <!-- end row -->
         </div>
      </div>
   </div>
</div>


<style>
   .availability-container {
      cursor: pointer;
      text-decoration: none;
      color: inherit;
   }
</style>

<?php
include('nav/footer.php'); // Include the auth.php file

?>