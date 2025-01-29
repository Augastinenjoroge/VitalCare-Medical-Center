<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medical";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$patientID = $_GET['id'];
$data = json_decode(file_get_contents('php://input'), true);

$sql = "UPDATE Patients SET 
    FirstName = '{$data['FirstName']}', 
    LastName = '{$data['LastName']}', 
    DateOfBirth = '{$data['DateOfBirth']}', 
    Gender = '{$data['Gender']}', 
    ContactNumber = '{$data['ContactNumber']}', 
    Email = '{$data['Email']}', 
    Address = '{$data['Address']}'
    WHERE PatientID = $patientID";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => $conn->error]);
}

$conn->close();
?>
