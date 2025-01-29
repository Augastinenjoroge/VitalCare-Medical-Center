<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medical";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Get POST data
$postData = json_decode(file_get_contents("php://input"), true);

// Check if ID parameter is provided
if (!isset($postData['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Doctor ID is required']);
    exit();
}

$doctorID = $postData['id'];

// Delete doctor from database
$sql = "DELETE FROM Doctors WHERE DoctorID = $doctorID";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['message' => 'Doctor deleted successfully']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Error deleting doctor: ' . $conn->error]);
}

$conn->close();
?>
