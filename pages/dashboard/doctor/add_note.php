<?php
session_start();
require 'db.php'; // Include your database connection file

// Check if the user is a doctor
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 2) {
    die("Access denied.");
}

$doctor_user_id = $_SESSION['user_id'];
$patient_id = isset($_POST['patient_id']) ? $_POST['patient_id'] : null;
$visit_date = isset($_POST['visit_date']) ? $_POST['visit_date'] : null;
$notes = isset($_POST['notes']) ? $_POST['notes'] : null;

if (!$patient_id || !$visit_date || !$notes) {
    die("All fields are required.");
}

// Fetch the doctor's ID
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

// Insert the new note
$sql = "INSERT INTO Patient_History (PatientID, DoctorID, VisitDate, Notes) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiss", $patient_id, $doctor_id, $visit_date, $notes);
$stmt->execute();
$stmt->close();

$conn->close();

header("Location: patient_details.php?patient_id=$patient_id");
exit;
?>
