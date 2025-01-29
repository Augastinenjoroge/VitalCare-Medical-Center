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

?>




<!-- end topbar -->
<!-- dashboard inner -->
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>List of Doctor</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- invoice section -->
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">

                    <div class="inbox-head">
                        <h3><i class="fa fa-file-text-o" aria-hidden="true"></i> List of Doctor</h3>
                        <form action="#" class="pull-right position search_inbox">
                            <div class="input-append">
                                <input type="text" class="sr-input" id="search" placeholder="Search Name">
                                <button class="btn sr-btn" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="inbox-body">
                        <div class="mail-option">
                            <div class="btn-group hidden-phone">
                                <select id="departmentFilter" class="form-control">
                                    <option value="">Filter by Department</option>
                                    <?php
                                    $conn = new mysqli($servername, $username, $password, $dbname);
                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    };

                                    $departmentResult = $conn->query("SELECT * FROM Departments");
                                    while ($departmentRow = $departmentResult->fetch_assoc()) {
                                        echo "<option value='{$departmentRow['DepartmentName']}'>{$departmentRow['DepartmentName']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="btn-group">
                                <a href="list_doctors.php" class="btn mini tooltips">
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

                                    $addressResult = $conn->query("SELECT DISTINCT Address FROM Doctors");
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
                                                <h2>Doctor</h2>
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
                                                                    <th>Department</th>
                                                                    <th>Contact Number</th>
                                                                    <th>Email</th>
                                                                    <th>Address</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="doctorsTable">
                                                                <?php

                                                                $conn = new mysqli($servername, $username, $password, $dbname);
                                                                if ($conn->connect_error) {
                                                                    die("Connection failed: " . $conn->connect_error);
                                                                };

                                                                $sql = "SELECT Doctors.DoctorID, Doctors.FirstName, Doctors.LastName, Departments.DepartmentName, Doctors.ContactNumber, Doctors.Email, Doctors.Address
                        FROM Doctors
                        INNER JOIN Departments ON Doctors.DepartmentID = Departments.DepartmentID
                        ORDER BY Doctors.FirstName";
                                                                $result = $conn->query($sql);
                                                                $count = 1;
                                                                if ($result->num_rows > 0) {
                                                                    while ($row = $result->fetch_assoc()) {
                                                                        echo "<tr data-id='{$row['DoctorID']}'>";
                                                                        echo "<td>{$count}</td>";
                                                                        echo "<td>{$row['FirstName']}</td>";
                                                                        echo "<td>{$row['LastName']}</td>";
                                                                        echo "<td>{$row['DepartmentName']}</td>";
                                                                        echo "<td>{$row['ContactNumber']}</td>";
                                                                        echo "<td>{$row['Email']}</td>";
                                                                        echo "<td>{$row['Address']}</td>";
                                                                        echo "<td>";
                                                                        echo "<button class='btn btn-info edit-btn' data-toggle='modal' data-target='#editModal' data-id='{$row['DoctorID']}'><i class='fa fa-edit'></i> Edit</button>";
                                                                        echo "&nbsp&nbsp&nbsp";
                                                                        echo "<button class='btn btn-danger delete-btn' data-id='{$row['DoctorID']}'><i class='fa fa-trash'></i> Delete</button>";
                                                                        echo "</td>";
                                                                        echo "</tr>";
                                                                        $count++;
                                                                    }
                                                                } else {
                                                                    echo "<tr><td colspan='8'>No doctors found</td></tr>";
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

        <div class="modal-content  login_section">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Doctor</h5>
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
                    <input type="hidden" id="editDoctorID">
                    <div class="field">
                        <label for="editFirstName">First Name</label>
                        <input type="text" class="form-control" id="editFirstName">
                    </div>
                    <div class="field">
                        <label for="editLastName">Last Name</label>
                        <input type="text" class="form-control" id="editLastName">
                    </div>
                    <div class="form-group">
                        <label for="editDepartment">Department</label>
                        <select class="form-control" id="editDepartment">
                            <?php
                            $departmentResult = $conn->query("SELECT * FROM Departments");
                            while ($departmentRow = $departmentResult->fetch_assoc()) {
                                echo "<option value='{$departmentRow['DepartmentID']}'>{$departmentRow['DepartmentName']}</option>";
                            }
                            ?>
                        </select>
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
                    </div>
                </form>
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
            $('#doctorsTable tr').each(function() {
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

        // Filter by department
        $('#departmentFilter').on('change', function() {
            var departmentID = $(this).val();
            $('#doctorsTable tr').each(function() {
                var currentRow = $(this);
                var rowDepartmentID = currentRow.find('td:eq(3)').text();
                if (departmentID === "" || rowDepartmentID == departmentID) {
                    currentRow.show();
                } else {
                    currentRow.hide();
                }
            });
        });

        // Filter by address
        $('#addressFilter').on('change', function() {
            var address = $(this).val();
            $('#doctorsTable tr').each(function() {
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
            var doctorID = $(this).data('id');
            axios.get('config/get_doctor.php', {
                params: {
                    id: doctorID
                }
            }).then(function(response) {
                var doctor = response.data;
                $('#editDoctorID').val(doctor.DoctorID);
                $('#editFirstName').val(doctor.FirstName);
                $('#editLastName').val(doctor.LastName);
                $('#editDepartment').val(doctor.DepartmentID);
                $('#editContactNumber').val(doctor.ContactNumber);
                $('#editEmail').val(doctor.Email);
                $('#editAddress').val(doctor.Address);
            });
        });

        // Handle save edit button click
        $('#saveEdit').on('click', function() {
            var doctorID = $('#editDoctorID').val();
            var data = {
                FirstName: $('#editFirstName').val(),
                LastName: $('#editLastName').val(),
                DepartmentID: $('#editDepartment').val(),
                ContactNumber: $('#editContactNumber').val(),
                Email: $('#editEmail').val(),
                Address: $('#editAddress').val()
            };
            axios.post('config/update_doctor.php?id=' + doctorID, data)
                .then(function(response) {
                    alert('Doctor updated successfully');
                    window.location.href = 'list_doctors.php';
                })
                .catch(function(error) {
                    showAlert('Error updating doctor: ' + error.message, 'danger');
                });
        });

        // Handle delete button click
        $(document).on('click', '.delete-btn', function() {
            var doctorID = $(this).data('id');
            if (confirm('Are you sure you want to delete this doctor?')) {
                axios.post('delete_doctor.php', {
                        id: doctorID
                    })
                    .then(function(response) {
                        showAlert('Doctor deleted successfully', 'success');
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    })
                    .catch(function(error) {
                        showAlert('Error deleting doctor: ' + error.message, 'danger');
                    });
            }
        });
    });
</script>


<?php
include('nav/footer.php'); // Include the auth.php file

?>