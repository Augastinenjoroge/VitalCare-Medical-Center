<?php
session_start();
require 'db.php'; // Include your database connection file

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

// Fetch appointments based on filters
$date_filter = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
$patient_name_filter = isset($_GET['patient_name']) ? $_GET['patient_name'] : null;

$where_clauses = ["DoctorID = ?"];
$params = [$doctor_id];
$param_types = "i";

if ($date_filter) {
    $where_clauses[] = "DATE(AppointmentDateTime) = ?";
    $params[] = $date_filter;
    $param_types .= "s";
}

if ($patient_name_filter) {
    $where_clauses[] = "(Patients.FirstName LIKE ? OR Patients.LastName LIKE ?)";
    $params[] = "%$patient_name_filter%";
    $params[] = "%$patient_name_filter%";
    $param_types .= "ss";
}

$where_sql = implode(" AND ", $where_clauses);

$sql = "SELECT Appointments.AppointmentID, Appointments.AppointmentDateTime, Patients.PatientID, Patients.FirstName, Patients.LastName 
        FROM Appointments 
        JOIN Patients ON Appointments.PatientID = Patients.PatientID 
        WHERE $where_sql 
        ORDER BY AppointmentDateTime ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param($param_types, ...$params);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Doctor Appointments</title>
    <script>
        function fetchAppointments() {
            const date = document.getElementById("date").value;
            const patientName = document.getElementById("patient_name").value;

            const xhr = new XMLHttpRequest();
            xhr.open("GET", `?date=${date}&patient_name=${patientName}`, true);
            xhr.onload = function () {
                if (this.status === 200) {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(this.responseText, "text/html");
                    const newTableBody = doc.querySelector("tbody").innerHTML;
                    document.querySelector("tbody").innerHTML = newTableBody;
                }
            };
            xhr.send();
        }

        function setupLiveSearch() {
            document.getElementById("date").addEventListener("change", fetchAppointments);
            document.getElementById("patient_name").addEventListener("keyup", function() {
                clearTimeout(this.delay);
                this.delay = setTimeout(fetchAppointments, 300);
            });
        }

        window.onload = setupLiveSearch;
    </script>
</head>

<body>
    <h1>Doctor's Appointments</h1>
    <form id="filterForm" onsubmit="return false;">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($date_filter); ?>">
        <label for="patient_name">Patient Name:</label>
        <input type="text" id="patient_name" name="patient_name" value="<?php echo htmlspecialchars($patient_name_filter); ?>">
    </form>
    <table border="1">
        <thead>
            <tr>
                <th>Appointment ID</th>
                <th>Appointment Date & Time</th>
                <th>Patient Name</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>" . htmlspecialchars($row['AppointmentID']) . "</td>
                    <td>" . htmlspecialchars($row['AppointmentDateTime']) . "</td>
                    <td><a href='patient_details.php?patient_id=" . htmlspecialchars($row['PatientID']) . "'>" . htmlspecialchars($row['FirstName'] . ' ' . $row['LastName']) . "</a></td>
                  </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No appointments found for this filter.</td></tr>";
            }

            $stmt->close();
            $conn->close();
            ?>
        </tbody>
    </table>
</body>

</html>
