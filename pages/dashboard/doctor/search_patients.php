<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php';

function encryptPatientID($patient_id)
{
    $key = "VitalCare-Medical-Center"; // Change this key to something more secure
    $iv_length = openssl_cipher_iv_length('aes-256-cbc');
    $iv = openssl_random_pseudo_bytes($iv_length);
    $encrypted = openssl_encrypt($patient_id, 'aes-256-cbc', $key, 0, $iv);
    return urlencode(base64_encode($encrypted . '::' . $iv));
}

$nameQuery = isset($_GET['name']) ? $_GET['name'] : '';
$genderQuery = isset($_GET['gender']) ? $_GET['gender'] : '';

$sql = "SELECT * FROM Patients WHERE (FirstName LIKE ? OR LastName LIKE ?)";
if (!empty($genderQuery)) {
    $sql .= " AND Gender = ?";
}
$sql .= " ORDER BY FirstName";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('Prepare failed: ' . $conn->error);
}

$search = "%" . $nameQuery . "%";
if (!empty($genderQuery)) {
    $stmt->bind_param('sss', $search, $search, $genderQuery);
} else {
    $stmt->bind_param('ss', $search, $search);
}

if (!$stmt->execute()) {
    die('Execute failed: ' . $stmt->error);
}

$result = $stmt->get_result();

$output = '';
$count = 1;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $encrypted_id = encryptPatientID($row['PatientID']);
        $output .= "<tr data-id='{$row['PatientID']}'>";
        $output .= "<td>{$count}</td>";
        $output .= "<td><a href='patient_details.php?patient_id=" . htmlspecialchars($encrypted_id) . "'>" . htmlspecialchars($row['FirstName']) . "</a></td>";
        $output .= "<td><a href='patient_details.php?patient_id=" . htmlspecialchars($encrypted_id) . "'>" . htmlspecialchars($row['LastName']) . "</a></td>";
        $output .= "<td><a href='patient_details.php?patient_id=" . htmlspecialchars($encrypted_id) . "'>" . htmlspecialchars($row['Gender']) . "</a></td>";
        $output .= "</tr>";
        $count++;
    }
} else {
    $output .= "<tr><td colspan='4'>No patients found</td></tr>";
}

echo $output;
?>
