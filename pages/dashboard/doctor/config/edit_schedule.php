<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medical"; // replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['user_id']) && isset($_SESSION['role_id']) && $_SESSION['role_id'] == 2) { // Assuming role_id 2 is for Doctor
        $scheduleID = $conn->real_escape_string($_POST['ScheduleID']);
        $from = $conn->real_escape_string($_POST['AvailableFrom']);
        $to = $conn->real_escape_string($_POST['AvailableTo']);

        $sql = "UPDATE Doctor_Schedules SET AvailableFrom = '$from', AvailableTo = '$to' WHERE ScheduleID = '$scheduleID'";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    alert('Schedule updated successfully.');
                    window.location.href='../doctor_schedule.php';
                  </script>";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "<script>
                alert('Unauthorized access.');
                window.location.href='../doctor_schedule.php';
              </script>";
    }
}

$conn->close();
?>
