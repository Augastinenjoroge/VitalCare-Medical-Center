<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medical";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Check if ID parameter is provided
if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Doctor ID is required']);
    exit();
}

$doctorID = $_GET['id'];

// Get POST data
$postData = json_decode(file_get_contents("php://input"), true);

$firstName = $postData['FirstName'];
$lastName = $postData['LastName'];
$departmentID = $postData['DepartmentID'];
$contactNumber = $postData['ContactNumber'];
$email = $postData['Email'];
$address = $postData['Address'];

// Update doctor in database
$sql = "UPDATE Doctors
        SET FirstName = '$firstName',
            LastName = '$lastName',
            DepartmentID = $departmentID,
            ContactNumber = '$contactNumber',
            Email = '$email',
            Address = '$address'
        WHERE DoctorID = $doctorID";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['message' => 'Doctor updated successfully']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Error updating doctor: ' . $conn->error]);
}


// Close connection
$conn->close();
?>
