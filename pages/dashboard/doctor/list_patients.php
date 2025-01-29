<?php
include('nav/header.php');
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




<!-- end topbar -->
<!-- dashboard inner -->
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>List of Patient</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- invoice section -->
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">

                    <div class="inbox-head">
                        <h3><i class="fa fa-file-text-o" aria-hidden="true"></i> List of Patient</h3>
                        <form action="#" class="pull-right position search_inbox">
                            <div class="input-append">
                                <input type="text" class="sr-input" id="nameSearchInput"  placeholder="Search Patient">
                                <button class="btn sr-btn" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="inbox-body">
                        <div class="mail-option">
                            <div class="btn-group hidden-phone">
                                <select  id="genderFilterInput" class="form-control">
                                    <option value="">Filter by Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>

                            <div class="btn-group">
                                <a href="list_patients.php" class="btn mini tooltips">
                                    <i class=" fa fa-refresh"></i>
                                </a>
                            </div>
                            
                        </div>
                    </div>
                    <!-- Alert container -->
                    <div id="alert-container"></div>
                    <div class="full padding_infor_info">
                        <div class="invoice_inner">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="white_shd full margin_bottom_30">
                                        <div class="full graph_head">
                                            <div class="heading1 margin_0">
                                                <h2>Patient</h2>
                                            </div>
                                        </div>
                                        <div class="full progress_bar_inner">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="full">
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        function fetchPatients() {
            var nameQuery = $('#nameSearchInput').val();
            var genderQuery = $('#genderFilterInput').val();

            $.ajax({
                url: 'search_patients.php',
                type: 'GET',
                data: { name: nameQuery, gender: genderQuery },
                success: function(data) {
                    $('#patientsTable').html(data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('AJAX error: ' + textStatus + ' : ' + errorThrown);
                }
            });
        }

        $('#nameSearchInput').on('keyup', fetchPatients);
        $('#genderFilterInput').on('change', fetchPatients);
    });
</script>


<?php
include('nav/footer.php'); // Include the auth.php file

?>