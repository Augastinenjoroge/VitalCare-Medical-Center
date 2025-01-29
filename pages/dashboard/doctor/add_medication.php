<?php
session_start();
require 'db.php'; // Include your database connection file

// Check if the user is a doctor
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 2) {
    die("Access denied.");
}

$doctor_user_id = $_SESSION['user_id'];
$patient_id = isset($_POST['patient_id']) ? $_POST['patient_id'] : null;
$medication_name = isset($_POST['medication_name']) ? $_POST['medication_name'] : null;
$dosage = isset($_POST['dosage']) ? $_POST['dosage'] : null;
$frequency = isset($_POST['frequency']) ? $_POST['frequency'] : null;
$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : null;
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : null;

if (!$patient_id || !$medication_name || !$dosage || !$frequency || !$start_date || !$end_date) {
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

// Fetch the latest history ID for the patient
$sql = "SELECT HistoryID FROM Patient_History WHERE PatientID = ? ORDER BY VisitDate DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$stmt->bind_result($history_id);
$stmt->fetch();
$stmt->close();

if (!$history_id) {
    die("Patient history not found.");
}

// Insert the new medication
$sql = "INSERT INTO Medications (HistoryID, MedicationName, Dosage, Frequency, StartDate, EndDate) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isssss", $history_id, $medication_name, $dosage, $frequency, $start_date, $end_date);
$stmt->execute();
$stmt->close();

$conn->close();

header("Location: patient_details.php?patient_id=$patient_id");
exit;
?>
