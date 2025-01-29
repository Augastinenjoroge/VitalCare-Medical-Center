<?php

include('nav/header.php');

?>
<!-- end topbar -->
<!-- dashboard inner -->
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title center">
                    <h2>Book Appointment</h2>
                </div>
            </div>
        </div>
        <div class="full_container">
            <div class="container">
                <div class="center">
                    <div class="login_section">
                        <div class="page_title center">
                            <h2>Select Department</h2>
                        </div>
                        <div class="logo_login">
                            <div class="center">
                                <img width="210" src="images/logo/vitalcare-medical-center-high-resolution-logo-transparent (1).png" alt="#" />
                            </div>
                        </div>
                        <div class="login_form">

                            <form action="select_doctor.php" method="POST">
                                <fieldset>
                                    <div class="field">
                                        <label for="department" class="label_field">Department:</label>
                                        <select name="department" id="department" required>
                                            <option value="">Select Department</option>
                                            <?php

                                            include 'db.php';

                                            $sql = "SELECT DepartmentID, DepartmentName FROM Departments";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<option value='" . $row['DepartmentID'] . "'>" . $row['DepartmentName'] . "</option>";
                                                }
                                            } else {
                                                echo "<option value=''>No departments available</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="field margin_0">
                                        <input type="submit" value="Next" class="main_bt">
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('nav/footer.php'); // Include the auth.php file

?>