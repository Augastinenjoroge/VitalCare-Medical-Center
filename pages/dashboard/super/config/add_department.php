<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medical"; // replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $departmentName = $conn->real_escape_string($_POST['DepartmentName']);
    $description = $conn->real_escape_string($_POST['Description']);

    // Check if department name already exists
    $sql = "SELECT * FROM Departments WHERE DepartmentName = '$departmentName'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<script>
                alert('Department name already exists.');
                window.location.href='../add_department.php';
              </script>";
    } else {
        // Insert the new department
        $sql = "INSERT INTO Departments (DepartmentName, Description) VALUES ('$departmentName', '$description')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    alert('New department added successfully.');
                    window.location.href='../add_department.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Error: " . $conn->error . "');
                    window.location.href='../add_department.php';
                  </script>";
        }
    }
}

$conn->close();
?>
