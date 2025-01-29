<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medical";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}
// Check if ID parameter is provided
if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Department ID is required']);
    exit();
}

$departmentID = $_GET['id'];

// Get POST data
$postData = json_decode(file_get_contents("php://input"), true);

$departmentName = $postData['DepartmentName'];
$description = $postData['Description'];

// Update department in database
$sql = "UPDATE Departments
        SET DepartmentName = '$departmentName',
            Description = '$description'
        WHERE DepartmentID = $departmentID";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['message' => 'Department updated successfully']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Error updating department: ' . $conn->error]);
}

$conn->close();
?>
