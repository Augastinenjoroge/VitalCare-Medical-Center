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

// Fetch department details from database
$sql = "SELECT * FROM Departments WHERE DepartmentID = $departmentID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $department = $result->fetch_assoc();
    echo json_encode($department);
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Department not found']);
}

$conn->close();
?>
