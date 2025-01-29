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
?>

<div class="container">
    <input type="text" id="searchInput" class="form-control" placeholder="Search by First or Last Name or Gender...">
    <table class="table table-striped table-hover mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
            </tr>
        </thead>
        <tbody id="patientsTable">
            <?php
            // Fetch patients
            $sql = "SELECT * FROM Patients ORDER BY FirstName";
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
            ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#searchInput').on('keyup', function() {
            var query = $(this).val();
            $.ajax({
                url: 'search_patients.php',
                type: 'GET',
                data: { query: query },
                success: function(data) {
                    $('#patientsTable').html(data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('AJAX error: ' + textStatus + ' : ' + errorThrown);
                }
            });
        });
    });
</script>



