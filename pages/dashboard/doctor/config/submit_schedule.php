<?php
session_start();

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
    if (isset($_SESSION['user_id']) && isset($_SESSION['role_id']) && $_SESSION['role_id'] == 2) { // Assuming role_id 2 is for Doctor
        $userID = $_SESSION['user_id'];
        
        // Get the DoctorID from the Users table
        $sql = "SELECT DoctorID FROM Doctors WHERE UserID = '$userID'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $doctorID = $row['DoctorID'];
            
            $schedules = $_POST['schedules'];

            foreach ($schedules as $schedule) {
                $date = $conn->real_escape_string($schedule['date']);
                $from = $conn->real_escape_string($schedule['from']);
                $to = $conn->real_escape_string($schedule['to']);

                $sql = "INSERT INTO Doctor_Schedules (DoctorID, AvailableDate, AvailableFrom, AvailableTo) VALUES ('$doctorID', '$date', '$from', '$to')";
                if (!$conn->query($sql)) {
                    echo "Error: " . $conn->error;
                }
            }

            echo "<script>
                    alert('Schedules added successfully.');
                    window.location.href='../doctor_schedule.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Doctor not found.');
                    window.location.href='../../../auth/patient/';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Unauthorized access.');
                window.location.href='../../../auth/patient/';
              </script>";
    }
}

$conn->close();
?>
