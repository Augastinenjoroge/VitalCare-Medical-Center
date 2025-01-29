<?php
session_start();

// Redirect to login page if the user is not logged in or not an Admin
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role_id']) || $_SESSION['role_id'] != 3) { // role_id 3 is for Administrator
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
$email = '';
$contactNumber = '';
$initials = '';

// Check if the user is logged in and is a Admin
if (isset($_SESSION['user_id']) && isset($_SESSION['role_id']) && $_SESSION['role_id'] == 3) { // Assuming role_id 2 is for Admin
   $userID = $_SESSION['user_id'];

   $sql = "SELECT FirstName, LastName, Email, ContactNumber FROM Admins WHERE UserID = '$userID'";
   $result = $conn->query($sql);

   if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $firstName = $row['FirstName'];
      $lastName = $row['LastName'];
      $email = $row['Email'];
      $contactNumber = $row['ContactNumber'];
      $initials = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));
   }
}

// Initialize variables to store counts
$patientCount = 0;
$doctorCount = 0;
$userCount = 0;

// Count the number of patients
$sql = "SELECT COUNT(*) AS patientCount FROM Patients";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
   $row = $result->fetch_assoc();
   $patientCount = $row['patientCount'];
}

// Count the number of doctors
$sql = "SELECT COUNT(*) AS doctorCount FROM Doctors";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
   $row = $result->fetch_assoc();
   $doctorCount = $row['doctorCount'];
}

// Count the number of users
$sql = "SELECT COUNT(*) AS userCount FROM Users";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
   $row = $result->fetch_assoc();
   $userCount = $row['userCount'];
}

$conn->close();
?>


<?php
include('nav/header.php'); // Include the auth.php file
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
                                 <h3><?php echo htmlspecialchars($firstName . ' ' . $lastName); ?></h3>
                                 <p><strong>Administrator </strong></p>
                                 <ul class="list-unstyled">
                                    <li><i class="fa fa-envelope-o"></i> : <?php echo htmlspecialchars($email); ?></li>
                                    <li><i class="fa fa-phone"></i> : <?php echo htmlspecialchars($contactNumber); ?></li>
                                 </ul>
                              </div>
                           </div>
                        </div>

                        <!-- end user profile section -->

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
<div class="row column1 center">
   <div class="col-md-6 col-lg-3">
      <a href="./list_patients.php">
         <div class="full counter_section margin_bottom_30">
            <div class="couter_icon">
               <div>
                  <i class="fa fa-user yellow_color"></i>
               </div>
            </div>
            <div class="counter_no">
               <div>
                  <p class="total_no"><?php echo $patientCount; ?></p>
                  <p class="head_couter">Patients</p>
               </div>
            </div>
         </div>
      </a>
   </div>
   <div class="col-md-6 col-lg-3">
      <a href="./list_doctors.php">
         <div class="full counter_section margin_bottom_30">
            <div class="couter_icon">
               <div>
                  <i class="fa fa-user blue1_color"></i>
               </div>
            </div>
            <div class="counter_no">
               <div>
                  <p class="total_no"><?php echo $doctorCount; ?></p>
                  <p class="head_couter">Doctors</p>
               </div>
            </div>
         </div>
      </a>
   </div>
   <div class="col-md-6 col-lg-3">
      <a href="./list_users.php">
         <div class="full counter_section margin_bottom_30">
            <div class="couter_icon">
               <div>
                  <i class="fa fa-users red_color"></i>
               </div>
            </div>
            <div class="counter_no">
               <div>
                  <p class="total_no"><?php echo $userCount; ?></p>
                  <p class="head_couter">Users</p>
               </div>
            </div>
         </div>
      </a>
   </div>

</div>



<style>
   .initials-avatar_index {
      display: inline-block;
      width: 160px;
      /* Adjust size as needed */
      height: 160px;
      /* Adjust size as needed */
      background-color: #007bff;
      color: #fff;
      font-size: 100px;
      /* Adjust size as needed */
      text-align: center;
      line-height: 160px;
      /* Should match height */
      border-radius: 50%;
   }
</style>
<!-- footer -->
<?php
include('nav/footer.php');

?>