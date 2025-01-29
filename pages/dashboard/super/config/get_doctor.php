<?php
header('Content-Type: application/json');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medical";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check if ID parameter is provided
if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Doctor ID is required']);
    exit();
}

$doctorID = $_GET['id'];

// Fetch doctor details from database
$sql = "SELECT Doctors.DoctorID, Doctors.FirstName, Doctors.LastName, Doctors.DepartmentID, Departments.DepartmentName, Doctors.ContactNumber, Doctors.Email, Doctors.Address
        FROM Doctors
        INNER JOIN Departments ON Doctors.DepartmentID = Departments.DepartmentID
        WHERE Doctors.DoctorID = $doctorID";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $doctor = $result->fetch_assoc();
    echo json_encode($doctor);
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Doctor not found']);
}


?>

