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

        $sql = "DELETE FROM Doctor_Schedules WHERE ScheduleID = '$scheduleID'";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    alert('Schedule deleted successfully.');
                    window.location.href='../doctor_schedule.php';
                  </script>";
        } else {
            echo "Error deleting record: " . $conn->error;
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
