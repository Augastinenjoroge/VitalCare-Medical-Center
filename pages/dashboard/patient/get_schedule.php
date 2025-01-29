<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctor_id = $_POST['doctor'];

    $sql = "SELECT AvailableDate FROM Doctor_Schedules WHERE DoctorID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $doctor_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $available_dates = [];
    while ($row = $result->fetch_assoc()) {
        $available_dates[] = $row['AvailableDate'];
    }
    
    $stmt->close();
    $conn->close();

    echo json_encode($available_dates);
} else {
    echo json_encode([]);
}
?>
