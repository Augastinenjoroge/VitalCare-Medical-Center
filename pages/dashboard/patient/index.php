<?php
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) { // Assuming role_id 1 is for patient
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
$email = '';
$contactNumber = '';


// Fetch the doctor's details from the database
$userID = $_SESSION['user_id'];

// Check if the user is logged in and is a Admin
if (isset($_SESSION['user_id']) && isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) { // Assuming role_id 1 is for Admin
   $userID = $_SESSION['user_id'];

   $sql = "SELECT FirstName, LastName, Email, ContactNumber FROM Patients WHERE UserID = '$userID'";
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
                                    <p class="total_no">Not yet created</p>
                                    <p class="head_couter">Number Appointment</p>
                                 </div>
                              </div>
                           </div>
                           <!-- Availability Status Section -->
                           <div class="col-md-6 col-lg-3">
                              <a href="" class="availability-container">
                                 <div class="full socile_icons tw margin_bottom_30">
                                    <div class="social_icon">
                                       <i class="fa fa-user yellow_color"></i>
                                    </div>
                                    <div class="social_cont">
                                       
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