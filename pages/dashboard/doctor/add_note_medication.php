<?php
include('nav/header.php');

session_start();
require 'db.php'; // Include your database connection file

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the user is a doctor
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 2) {
    die("Access denied.");
}

$doctor_user_id = $_SESSION['user_id'];

// Fetch the doctor's ID from the Users table
$sql = "SELECT DoctorID FROM Doctors WHERE UserID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $doctor_user_id);
$stmt->execute();
$stmt->bind_result($doctor_id);
$stmt->fetch();
$stmt->close();

if (!$doctor_id) {
    die("Doctor not found.");
}

// Function to decrypt patient ID
function decryptPatientID($encrypted_id)
{
    $key = "VitalCare-Medical-Center"; // Change this key to match the one used in encrypt function
    list($encrypted_data, $iv) = explode('::', base64_decode(urldecode($encrypted_id)), 2);
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $notes = $_POST['notes'];
    $add_medication = isset($_POST['add_medication']) ? true : false;
    $medication_name = $add_medication ? $_POST['medication_name'] : null;
    $dosage = $add_medication ? $_POST['dosage'] : null;
    $frequency = $add_medication ? $_POST['frequency'] : null;
    $start_date = $add_medication ? $_POST['start_date'] : null;
    $end_date = $add_medication ? ($_POST['end_date'] ?: null) : null; // Set to NULL if empty
    $visit_date = date('Y-m-d');

    // Validate required fields if medication is being added
    if ($add_medication) {
        if (empty($dosage) || empty($frequency) || empty($start_date)) {
            die('Dosage, Frequency, and Start Date are required.');
        }
    }

    // Insert note into Patient_History
    $sql = "INSERT INTO Patient_History (PatientID, DoctorID, VisitDate, Notes, CreatedAt) VALUES (?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("iiss", $patient_id, $doctor_id, $visit_date, $notes);
    if (!$stmt->execute()) {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    }
    $history_id = $stmt->insert_id;
    $stmt->close();

    if ($add_medication) {
        // Insert medication into Medications
        $sql = "INSERT INTO Medications (HistoryID, MedicationName, Dosage, Frequency, StartDate, EndDate, CreatedAt) VALUES (?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        // Use NULL for empty dates
        $stmt->bind_param("isssss", $history_id, $medication_name, $dosage, $frequency, $start_date, $end_date);
        if (!$stmt->execute()) {
            die('Execute failed: ' . htmlspecialchars($stmt->error));
        }
        $stmt->close();
    }

    // Redirect to patient details page
    header("Location: patient_details.php?patient_id=" . urlencode($encrypted_patient_id));
    exit;
}
?>




<style>
    .editor-container {
        margin: 20px 0;
    }

    .editor-label {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 5px;
        display: block;
    }

    .editor-textarea {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
    }
</style>

<script>
    function toggleMedicationFields() {
        var medicationFields = document.getElementById("medication_fields");
        var addMedicationCheckbox = document.getElementById("add_medication");
        medicationFields.style.display = addMedicationCheckbox.checked ? "block" : "none";

        // Set required attributes based on checkbox state
        document.getElementById("dosage").required = addMedicationCheckbox.checked;
        document.getElementById("frequency").required = addMedicationCheckbox.checked;
        document.getElementById("start_date").required = addMedicationCheckbox.checked;
    }
</script>

<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Add Note and Medication</h2>
                </div>
            </div>
        </div>
        <div class="full_container">
            <div class="container">
                <div class="center">
                    <div class="login_section">
                        <div class="logo_login">
                            <div class="center">
                                <img width="210" src="images/logo/vitalcare-medical-center-high-resolution-logo-transparent (1).png" alt="#" />
                            </div>
                        </div>
                        <div class="full graph_head">
                            <div class="heading1 margin_0">
                                <h2>Add Note and Medication for Patient</h2>
                            </div>
                        </div>
                        <div class="login_form">
                            <form action="add_note_medication.php?patient_id=<?php echo htmlspecialchars($encrypted_patient_id); ?>" method="POST">
                                <fieldset>
                                    <input type="hidden" name="patient_id" value="<?php echo htmlspecialchars($encrypted_patient_id); ?>">

                                    <div class="field editor-container">
                                        <label for="notes" class="editor-label">Notes:</label>
                                        <textarea id="notes" name="notes" class="editor-textarea" required></textarea><br>
                                    </div>

                                    <div class="field">
                                        <input type="checkbox" id="add_medication" name="add_medication" onclick="toggleMedicationFields()">
                                        <label for="add_medication">Add Medication</label>
                                    </div>

                                    <div id="medication_fields" style="display: none;">
                                        <div class="field">
                                            <label for="medication_name">Medication Name:</label>
                                            <input type="text" id="medication_name" name="medication_name"><br>
                                        </div>
                                        <div class="field">
                                            <label for="dosage">Dosage:</label>
                                            <input type="text" id="dosage" name="dosage"><br>
                                        </div>
                                        <div class="field">
                                            <label for="frequency">Frequency:</label>
                                            <input type="text" id="frequency" name="frequency"><br>
                                        </div>
                                        <div class="field">
                                            <label for="start_date">Start Date:</label>
                                            <input type="date" id="start_date" name="start_date"><br>
                                        </div>
                                        <div class="field">
                                            <label for="end_date">End Date:</label>
                                            <input type="date" id="end_date" name="end_date"><br>
                                        </div>
                                    </div>

                                    <div class="field margin_0">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    tinymce.init({
        selector: '#notes',
        height: 300,
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount',
            'autoresize' // Add the autoresize plugin
        ],
        toolbar: 'undo redo | formatselect | bold italic backcolor | \
                  alignleft aligncenter alignright alignjustify | \
                  bullist numlist outdent indent | removeformat | help',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
        autoresize_bottom_margin: 20, // Additional margin for autoresize
        autoresize_min_height: 300,
        autoresize_max_height: 800 // Set a maximum height if needed
    });
</script>

<?php
include('nav/footer.php'); // Include the auth.php file

?>