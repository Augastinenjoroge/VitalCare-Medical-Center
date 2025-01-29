<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medical"; // replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
};

include('nav/header.php'); 

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
                                <input type="text" class="sr-input" id="search" placeholder="Search Patient">
                                <button class="btn sr-btn" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="inbox-body">
                        <div class="mail-option">
                            <div class="btn-group hidden-phone">
                                <select id="genderFilter" class="form-control">
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
                            <div class="btn-group hidden-phone">
                                <select id="addressFilter" class="form-control">
                                    <option value="">Filter by Address</option>
                                    <?php
                                    $conn = new mysqli($servername, $username, $password, $dbname);
                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    };

                                    $addressResult = $conn->query("SELECT DISTINCT Address FROM Patients");
                                    while ($addressRow = $addressResult->fetch_assoc()) {
                                        echo "<option value='{$addressRow['Address']}'>{$addressRow['Address']}</option>";
                                    }
                                    ?>
                                </select>
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
                                                        <table class="table table-striped table-hover">

                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>First Name</th>
                                                                    <th>Last Name</th>
                                                                    <th>Date of Birth</th>
                                                                    <th>Gender</th>
                                                                    <th>Contact Number</th>
                                                                    <th>Email</th>
                                                                    <th>Address</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="patientsTable">
                                                                <?php
                                                                $conn = new mysqli($servername, $username, $password, $dbname);
                                                                if ($conn->connect_error) {
                                                                    die("Connection failed: " . $conn->connect_error);
                                                                };

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
                                                                        echo "<td>{$row['DateOfBirth']}</td>";
                                                                        echo "<td>{$row['Gender']}</td>";
                                                                        echo "<td>{$row['ContactNumber']}</td>";
                                                                        echo "<td>{$row['Email']}</td>";
                                                                        echo "<td>{$row['Address']}</td>";
                                                                        echo "<td>";
                                                                        echo "<button class='btn btn-info edit-btn' data-toggle='modal' data-target='#editModal' data-id='{$row['PatientID']}'><i class='fa fa-edit'></i> Edit</button>";
                                                                        echo "&nbsp&nbsp&nbsp";
                                                                        echo "<button class='btn btn-danger delete-btn' data-id='{$row['PatientID']}'><i class='fa fa-trash'></i> Delete</button>";
                                                                        echo "</td>";
                                                                        echo "</tr>";

                                                                        $count ++;
                                                                    }
                                                                } else {
                                                                    echo "<tr><td colspan='8'>No patients found</td></tr>";
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


<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog full_container container center" role="document">
        <div class="modal-content login_section">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Patient</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="logo_login">
                <div class="center">
                    <img width="210" src="images/logo/vitalcare-medical-center-high-resolution-logo-transparent (1).png" alt="#" />
                </div>
            </div>
            <div class="login_form">
                <form id="editForm">
                    <input type="hidden" id="editPatientID">
                    <div class="field">
                        <label for="editFirstName">First Name</label>
                        <input type="text" class="form-control" id="editFirstName">
                    </div>
                    <div class="field">
                        <label for="editLastName">Last Name</label>
                        <input type="text" class="form-control" id="editLastName">
                    </div>
                    <div class="field">
                        <label for="editDateOfBirth">Date of Birth</label>
                        <input type="date" class="form-control" id="editDateOfBirth">
                    </div>
                    <div class="field">
                        <label for="editGender">Gender</label>
                        <input type="text" class="form-control" id="editGender">
                    </div>
                    <div class="field">
                        <label for="editContactNumber">Contact Number</label>
                        <input type="text" class="form-control" id="editContactNumber">
                    </div>
                    <div class="field">
                        <label for="editEmail">Email</label>
                        <input type="email" class="form-control" id="editEmail">
                    </div>
                    <div class="field">
                        <label for="editAddress">Address</label>
                        <input type="text" class="form-control" id="editAddress">
                    </div>
                    <div class="field margin_0">
                        <button type="button" class="btn btn-info" id="saveEdit">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    function showAlert(message, type) {
        const alertHTML = `
                <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                    ${message}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            `;
        $('#alert-container').html(alertHTML);
    }

    $(document).ready(function() {
        // Real-time search
        $('#search').on('keyup', function() {
            var searchText = $(this).val().toLowerCase();
            $('#patientsTable tr').each(function() {
                var currentRow = $(this);
                var firstName = currentRow.find('td:eq(1)').text().toLowerCase();
                var lastName = currentRow.find('td:eq(2)').text().toLowerCase();
                if (firstName.indexOf(searchText) !== -1 || lastName.indexOf(searchText) !== -1) {
                    currentRow.show();
                } else {
                    currentRow.hide();
                }
            });
        });

        // Filter by gender
        $('#genderFilter').on('change', function() {
            var gender = $(this).val();
            $('#patientsTable tr').each(function() {
                var currentRow = $(this);
                var rowGender = currentRow.find('td:eq(4)').text();
                if (gender === "" || rowGender === gender) {
                    currentRow.show();
                } else {
                    currentRow.hide();
                }
            });
        });

        // Filter by address
        $('#addressFilter').on('change', function() {
            var address = $(this).val();
            $('#patientsTable tr').each(function() {
                var currentRow = $(this);
                var rowAddress = currentRow.find('td:eq(6)').text();
                if (address === "" || rowAddress === address) {
                    currentRow.show();
                } else {
                    currentRow.hide();
                }
            });
        });

        // Handle edit button click
        $(document).on('click', '.edit-btn', function() {
            var patientID = $(this).data('id');
            axios.get('config/get_patient.php', {
                params: {
                    id: patientID
                }
            }).then(function(response) {
                var patient = response.data;
                $('#editPatientID').val(patient.PatientID);
                $('#editFirstName').val(patient.FirstName);
                $('#editLastName').val(patient.LastName);
                $('#editDateOfBirth').val(patient.DateOfBirth);
                $('#editGender').val(patient.Gender);
                $('#editContactNumber').val(patient.ContactNumber);
                $('#editEmail').val(patient.Email);
                $('#editAddress').val(patient.Address);
            });
        });

        // Handle save edit button click
        $('#saveEdit').on('click', function() {
            var patientID = $('#editPatientID').val();
            var data = {
                FirstName: $('#editFirstName').val(),
                LastName: $('#editLastName').val(),
                DateOfBirth: $('#editDateOfBirth').val(),
                Gender: $('#editGender').val(),
                ContactNumber: $('#editContactNumber').val(),
                Email: $('#editEmail').val(),
                Address: $('#editAddress').val()
            };
            axios.post('config/update_patient.php?id=' + patientID, data)
                .then(function(response) {
                    alert('Patient updated successfully');
                    window.location.href = 'list_patients.php';
                })
                .catch(function(error) {
                    showAlert('Error updating patient: ' + error.message, 'danger');
                });
        });

        // Handle delete button click
        $(document).on('click', '.delete-btn', function() {
            var patientID = $(this).data('id');
            if (confirm('Are you sure you want to delete this patient?')) {
                axios.post('config/delete_patient.php', {
                        id: patientID
                    })
                    .then(function(response) {
                        showAlert('Patient deleted successfully', 'success');
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    })
                    .catch(function(error) {
                        showAlert('Error deleting patient: ' + error.message, 'danger');
                    });
            }
        });
    });
</script>

<?php
include('nav/footer.php'); // Include the auth.php file

?>