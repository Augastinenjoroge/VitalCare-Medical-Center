<?php
include 'db.php';

$data = json_decode(file_get_contents('php://input'), true);

$doctor_id = $data['doctor_id'];
$month = $data['month'];
$year = $data['year'];

// Fetch the doctor's schedule from the database for the specified month and year
$stmt = $conn->prepare("SELECT AvailableDate FROM Doctor_Schedules WHERE DoctorID = ? AND MONTH(AvailableDate) = ? AND YEAR(AvailableDate) = ?");
$stmt->bind_param("iii", $doctor_id, $month, $year);
$stmt->execute();
$result = $stmt->get_result();

$available_dates = [];
while ($row = $result->fetch_assoc()) {
    $available_dates[] = $row['AvailableDate'];
}
$stmt->close();
$conn->close();

echo json_encode(['available_dates' => $available_dates]);
?>
