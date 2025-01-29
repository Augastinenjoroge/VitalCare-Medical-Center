<?php
include('nav/header.php');
session_start();
require 'db.php'; // Include your database connection file

// Check if the user is a doctor
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 2) {
    die("Access denied.");
}

$doctor_user_id = $_SESSION['user_id'];

// Function to decrypt patient ID
function decryptPatientID($encrypted_id)
{
    $key = "VitalCare-Medical-Center"; // Change this key to match the one used in encrypt function
    $data = base64_decode(urldecode($encrypted_id));
    if ($data === false) {
        return false;
    }
    list($encrypted_data, $iv) = explode('::', $data, 2);
    if ($iv === false) {
        return false;
    }
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $key, 0, $iv);
}

$encrypted_patient_id = isset($_GET['patient_id']) ? $_GET['patient_id'] : null;

if (!$encrypted_patient_id) {
    die("Patient ID is required.");
}

$patient_id = decryptPatientID($encrypted_patient_id);

if (!$patient_id) {
    die("Invalid patient ID.");
}

// Fetch patient details
$sql = "SELECT * FROM Patients WHERE PatientID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$patient_result = $stmt->get_result();
$patient = $patient_result->fetch_assoc();
$stmt->close();

if (!$patient) {
    die("Patient not found.");
}

// Calculate age
$dob = new DateTime($patient['DateOfBirth']);
$now = new DateTime();
$age = $now->diff($dob)->y;

// Fetch patient history
$sql = "SELECT * FROM Patient_History WHERE PatientID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$history_result = $stmt->get_result();
$stmt->close();

// Fetch patient medications
$sql = "SELECT * FROM Medications WHERE HistoryID IN (SELECT HistoryID FROM Patient_History WHERE PatientID = ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$medication_result = $stmt->get_result();
$stmt->close();

// Fetch doctor 
$sql = "SELECT * FROM Doctors WHERE DoctorID IN (SELECT DoctorID FROM Patient_History WHERE PatientID = ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$doctor_result = $stmt->get_result();
$doctor = $doctor_result->fetch_assoc();
$stmt->close();

$conn->close();
?>





<!-- dashboard inner -->
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title center yellow_color">
                    <h1 class="blue2_color" style="font-size:50px;"> Patient Details</h1>
                </div>
            </div>
        </div>
        <div class="row column1">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <div class="heading1 margin_0">
                                <h2>Welcome</h2>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <a href="add_note_medication.php?patient_id=<?php echo urlencode($_GET['patient_id']); ?>" class="availability-container">
                                    <div class="user_profle_side">
                                        <div class="user_img">
                                            <div class="initials-avatar2"><i class="fa fa-wheelchair yellow_color"></i></div>
                                        </div>
                                        <div class="user_info">
                                            <p style="color: #36a9e2;">Add Note and Medication</p>
                                        </div>
                                    </div>

                                </a>
                            </div>

                        </div>

                    </div>
                    <div class="full price_table padding_infor_info">
                        <div class="row">
                            <!-- user profile section -->
                            <!-- profile image -->
                            <div class="col-lg-12">
                                <div class="full dis_flex center_text">
                                    <div class="profile_img">
                                        <div class="initials-avatar_index"><?php $patientfirstName = '';
                                                                            $patientlastName = '';
                                                                            $patientinitials = '';

                                                                            $patientfirstName = $patient['FirstName'];
                                                                            $patientlastName = $patient['LastName'];
                                                                            $patientinitials = strtoupper(substr($patientfirstName, 0, 1) . substr($patientlastName, 0, 1));
                                                                            echo $patientinitials; ?></div>
                                    </div>
                                    <div class="profile_contant">
                                        <div class="contact_inner">
                                            <h3><?php echo htmlspecialchars($patient['FirstName'] . ' ' . $patient['LastName']); ?></h3>
                                            <ul class="list-unstyled">
                                                <li>Age: <?php echo htmlspecialchars($age); ?></li>
                                                <li>Date Of Birth: <?php echo htmlspecialchars(date("jS F Y", strtotime($patient['DateOfBirth']))); ?></li>
                                                <li>Gender: <?php echo htmlspecialchars($patient['Gender']); ?></li>
                                                <li><i class="fa fa-envelope-o"></i> : <?php echo htmlspecialchars($patient['Email']); ?></li>
                                                <li><i class="fa fa-phone"></i> : <?php echo htmlspecialchars($patient['ContactNumber']); ?></li>
                                                <li>Address: <?php echo htmlspecialchars($patient['Address']); ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="white_shd full margin_bottom_30">
                                    <div class="full graph_head">
                                        <div class="heading1 margin_0">
                                            <h2>Patient History</h2>
                                        </div>
                                    </div>
                                    <div class="full progress_bar_inner">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="full">
                                                    <table class="table table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Visit Date</th>
                                                                <th>Notes</th>
                                                                <th>Diagnosed By</th>
                                                                <th>Diagnosed On</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php while ($history = $history_result->fetch_assoc()) {
                                                                // Fetch the doctor who diagnosed the patient for this history entry
                                                                require 'db.php'; // Reconnect to the database
                                                                $sql = "SELECT * FROM Doctors WHERE DoctorID = ?";
                                                                $stmt = $conn->prepare($sql);
                                                                $stmt->bind_param("i", $history['DoctorID']);
                                                                $stmt->execute();
                                                                $doctor_result = $stmt->get_result();
                                                                $doctor = $doctor_result->fetch_assoc();
                                                                $stmt->close();
                                                                $conn->close();
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo htmlspecialchars(date("jS F Y", strtotime($history['VisitDate']))); ?></td>
                                                                    <td><?php echo htmlspecialchars($history['Notes']); ?></td>
                                                                    <td><?php echo htmlspecialchars($doctor['FirstName'] . ' ' . $doctor['LastName']); ?></td>
                                                                    <td><?php echo htmlspecialchars(date("jS F Y \a\\t g:i a", strtotime($history['CreatedAt']))); ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="white_shd full margin_bottom_30">
                                    <div class="full graph_head">
                                        <div class="heading1 margin_0">
                                            <h2>Medications</h2>
                                        </div>
                                    </div>
                                    <div class="full progress_bar_inner">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="full">
                                                    <table class="table table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Medication Name</th>
                                                                <th>Dosage</th>
                                                                <th>Frequency</th>
                                                                <th>Start Date</th>
                                                                <th>End Date</th>
                                                                <th>Ensured</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php while ($medication = $medication_result->fetch_assoc()) { ?>
                                                                <tr>
                                                                    <td><?php echo htmlspecialchars($medication['MedicationName']); ?></td>
                                                                    <td><?php echo htmlspecialchars($medication['Dosage']); ?></td>
                                                                    <td><?php echo htmlspecialchars($medication['Frequency']); ?></td>
                                                                    <td><?php echo htmlspecialchars(date("jS F Y", strtotime($medication['StartDate']))); ?></td>
                                                                    <td>
                                                                        <?php
                                                                        // Check if EndDate is NULL or empty and display accordingly
                                                                        if (empty($medication['EndDate'])) {
                                                                            echo 'Ongoing Medication';
                                                                        } else {
                                                                            echo htmlspecialchars(date("jS F Y", strtotime($medication['EndDate'])));
                                                                        }
                                                                        ?>
                                                                    </td>

                                                                    <td><?php echo htmlspecialchars(date("jS F Y \a\\t g:i a", strtotime($medication['CreatedAt']))); ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
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

<?php
include('nav/footer.php'); // Include the auth.php file

?>