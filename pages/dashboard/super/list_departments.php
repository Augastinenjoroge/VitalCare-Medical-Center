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
                    <h2>List of Departments</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- invoice section -->
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">

                    <div class="inbox-head">
                        <h3><i class="fa fa-file-text-o" aria-hidden="true"></i> List of Departments</h3>
                        <form action="#" class="pull-right position search_inbox">
                            <div class="input-append">
                                <input type="text" class="sr-input" id="search" placeholder="Search department">
                                <button class="btn sr-btn" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
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
                                                <h2>Departments</h2>
                                            </div>
                                        </div>
                                        <div class="full progress_bar_inner">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="full">
                                                        <?php
                                                        // list_departments.php

                                                        $conn = new mysqli($servername, $username, $password, $dbname);
                                                        if ($conn->connect_error) {
                                                            die("Connection failed: " . $conn->connect_error);
                                                        };

                                                        // Fetch departments
                                                        $sql = "SELECT * FROM Departments ORDER BY DepartmentName";
                                                        $result = $conn->query($sql);

                                                        $count = 1;

                                                        if ($result->num_rows > 0) {
                                                            echo '<table class="table table-striped table-hover">';
                                                            echo '<thead>';
                                                            echo '<tr>';
                                                            echo '<th>#</th>';
                                                            echo '<th>Department Name</th>';
                                                            echo '<th>Description</th>';
                                                            echo '<th>Actions</th>';
                                                            echo '</tr>';
                                                            echo '</thead>';
                                                            echo '<tbody id="departmentsTable">';

                                                            while ($row = $result->fetch_assoc()) {
                                                                echo "<tr data-id='{$row['DepartmentID']}'>";
                                                                echo "<td>{$count}</td>";
                                                                echo "<td>{$row['DepartmentName']}</td>";
                                                                echo "<td>{$row['Description']}</td>";
                                                                echo "<td>";
                                                                echo "<button class='btn btn-info edit-btn' data-toggle='modal' data-target='#editModal' data-id='{$row['DepartmentID']}'><i class='fa fa-edit'></i> Edit</button>";
                                                                echo "&nbsp;&nbsp;&nbsp;";
                                                                echo "<button class='btn btn-danger delete-btn' data-id='{$row['DepartmentID']}'><i class='fa fa-trash'></i> Delete</button>";
                                                                echo "</td>";
                                                                echo "</tr>";
                                                                $count++;
                                                            }

                                                            echo '</tbody>';
                                                            echo '</table>';
                                                        } else {
                                                            echo "<p>No departments found</p>";
                                                        }

                                                        $conn->close();
                                                        ?>



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
                <h5 class="modal-title" id="editModalLabel">Edit department</h5>
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
                    <input type="hidden" id="editDepartmentID">
                    <div class="field">
                        <label for="editDepartmentName">Department Name</label>
                        <input type="text" class="form-control" id="editDepartmentName">
                    </div>
                    <div class="field">
                        <label for="editDescription">Description</label>
                        <input type="text" class="form-control" id="editDescription">
                    </div>
                    <div class="field margin_0">
                        <button type="button" class="btn btn-info" id="saveEdit">Save Changes</button>
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
            $('#departmentsTable tr').each(function() {
                var currentRow = $(this);
                var departmentName = currentRow.find('td:eq(1)').text().toLowerCase();
                if (departmentName.indexOf(searchText) !== -1) {
                    currentRow.show();
                } else {
                    currentRow.hide();
                }
            });
        });

        // Handle edit button click
        $(document).on('click', '.edit-btn', function() {
            var departmentID = $(this).data('id');
            axios.get('config/get_department.php', {
                params: {
                    id: departmentID
                }
            }).then(function(response) {
                var department = response.data;
                $('#editDepartmentID').val(department.DepartmentID);
                $('#editDepartmentName').val(department.DepartmentName);
                $('#editDescription').val(department.Description);
            });
        });

        // Handle save edit button click
        $('#saveEdit').on('click', function() {
            var departmentID = $('#editDepartmentID').val();
            var data = {
                DepartmentName: $('#editDepartmentName').val(),
                Description: $('#editDescription').val()
            };
            axios.post('config/update_department.php?id=' + departmentID, data)
                .then(function(response) {
                    alert('Department updated successfully');
                    window.location.href = 'list_departments.php';
                })
                .catch(function(error) {
                    showAlert('Error updating department: ' + error.message, 'danger');
                });
        });

        // Handle delete button click
        $(document).on('click', '.delete-btn', function() {
            var departmentID = $(this).data('id');
            if (confirm('Are you sure you want to delete this department?')) {
                axios.post('config/delete_department.php', {
                        id: departmentID
                    })
                    .then(function(response) {
                        showAlert('Department deleted successfully', 'success');
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    })
                    .catch(function(error) {
                        showAlert('Error deleting department: ' + error.message, 'danger');
                    });
            }
        });
    });
</script>

<?php
include('nav/footer.php'); // Include the auth.php file

?>