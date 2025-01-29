<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php';

/* if (session_status() == PHP_SESSION_NONE) {
    session_start();
} */

if (!isset($_SESSION['user_id'])) {
    die(header('Location:../../auth/'). "User not logged in.");
}

// Retrieve the PatientID based on the logged-in user's UserID
$user_id = $_SESSION['user_id'];
$patient_id = null;

// Query to get the PatientID from the Patients table
$sql = "SELECT PatientID FROM Patients WHERE UserID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($patient_id);
$stmt->fetch();
$stmt->close();

if (!$patient_id) {
    die("Patient record not found.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctor_id = $_POST['doctor'];
    $department_id = $_POST['department'];
    $selected_date = $_POST['date'];
    $selected_time = $_POST['time'];

    // Fetch the doctor's name
    $sql = "SELECT FirstName, LastName FROM Doctors WHERE DoctorID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $doctor_id);
    $stmt->execute();
    $stmt->bind_result($doctor_first_name, $doctor_last_name);
    $stmt->fetch();
    $stmt->close();

    if (!$doctor_first_name || !$doctor_last_name) {
        die(header('Location:./select_doctor.php'). "Doctor record not found.");
    }

    // Fetch the department name
    $sql = "SELECT DepartmentName FROM Departments WHERE DepartmentID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $department_id);
    $stmt->execute();
    $stmt->bind_result($department_name);
    $stmt->fetch();
    $stmt->close();

    if (!$department_name) {
        die(header('Location:./select_department.php'). "Department record not found.");
    }

    $appointment_datetime = $selected_date . " " . $selected_time . ":00";

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO Appointments (PatientID, DoctorID, AppointmentDateTime, Status) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $status = 'Booked';
    $stmt->bind_param("iiss", $patient_id, $doctor_id, $appointment_datetime, $status);

    if ($stmt->execute()) {
        echo "Appointment booked successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    die(header('Location:./select_department.php'). 'Invalid request.');
}
?>

<?php
include('nav/header.php'); // Include the auth.php file
?>
<div class="container mt-5">
    <h2 class="mb-4">Appointment Confirmation</h2>
    <div class="card">
        <div class="card-body">
            <p class="card-text"><strong>Doctor:</strong> <?php echo htmlspecialchars($doctor_first_name . ' ' . $doctor_last_name); ?></p>
            <p class="card-text"><strong>Department:</strong> <?php echo htmlspecialchars($department_name); ?></p>
            <p class="card-text"><strong>Date:</strong> <?php echo htmlspecialchars($selected_date); ?></p>
            <p class="card-text"><strong>Time:</strong> <?php echo htmlspecialchars($selected_time); ?></p>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="select_department.php" class="btn btn-primary mt-3">Book another appointment</a>
                <a href="select_department.php" class="btn btn-secondary mt-3">View appointment</a>
            </div>
        </div>
    </div>
</div>


<script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
        window.onpopstate = function(event) {
            if (event) {
                window.location.href = "select_department.php";
            }
        };
    </script>

<?php
include('nav/footer.php'); // Include the auth.php file

?>
<?php
// Unset session variables used for confirmation
unset($_SESSION['appointment_confirmed']);
unset($_SESSION['doctor_first_name']);
unset($_SESSION['doctor_last_name']);
unset($_SESSION['department_name']);
unset($_SESSION['selected_date']);
unset($_SESSION['selected_time']);
?>