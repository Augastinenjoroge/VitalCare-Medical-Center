<?php
include 'db.php';

// Function to encrypt patient ID
function encryptPatientID($patient_id)
{
    $key = "VitalCare-Medical-Center"; // Change this key to something more secure
    $iv_length = openssl_cipher_iv_length('aes-256-cbc');
    $iv = openssl_random_pseudo_bytes($iv_length);
    $encrypted = openssl_encrypt($patient_id, 'aes-256-cbc', $key, 0, $iv);
    return urlencode(base64_encode($encrypted . '::' . $iv));
}

if (isset($_GET['search']) || isset($_GET['gender'])) {
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $gender = isset($_GET['gender']) ? $_GET['gender'] : '';

    $sql = "SELECT * FROM Patients WHERE (FirstName LIKE '%$search%' OR LastName LIKE '%$search%')";

    if (!empty($gender)) {
        $sql .= " AND Gender = '$gender'";
    }

    $sql .= " ORDER BY FirstName";
    $result = $conn->query($sql);
    $count = 1;

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $encrypted_id = encryptPatientID($row['PatientID']);
            echo "<tr data-id='{$row['PatientID']}'>";
            echo "<td>{$count}</td>";
            echo "<td><a href='patient_details.php?patient_id=" . htmlspecialchars($encrypted_id) . "'>" . htmlspecialchars($row['FirstName']) . "</a></td>";
            echo "<td><a href='patient_details.php?patient_id=" . htmlspecialchars($encrypted_id) . "'>" . htmlspecialchars($row['LastName']) . "</a></td>";
            echo "<td><a href='patient_details.php?patient_id=" . htmlspecialchars($encrypted_id) . "'>" . htmlspecialchars($row['Gender']) . "</a></td>";
            echo "</tr>";
            $count++;
        }
    } else {
        echo "<tr><td colspan='4'>No patients found</td></tr>";
    }
    exit();
}
?>
