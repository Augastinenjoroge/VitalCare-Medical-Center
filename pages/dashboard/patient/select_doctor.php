<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $department_id = $_POST['department'];
} else {
    die(header('Location:./select_department.php'). 'Invalid request.');
}

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
                            <h2>Select Doctor</h2>
                        </div>
                        <div class="logo_login">
                            <div class="center">
                                <img width="210" src="images/logo/vitalcare-medical-center-high-resolution-logo-transparent (1).png" alt="#" />
                            </div>
                        </div>
                        <div class="login_form">
                            <form action="select_date.php" method="POST">
                                <fieldset>
                                    <div class="field mb-3">
                                        <input type="hidden" name="department" value="<?php echo $department_id; ?>">
                                        <label for="doctor" class="label_field">Doctor:</label>
                                        <select name="doctor" id="doctor" class="form-select" required>
                                            <option value="">Select Doctor</option>
                                            <?php

                                            include 'db.php';

                                            $sql = "SELECT DoctorID, FirstName, LastName FROM Doctors WHERE DepartmentID = $department_id";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<option value='" . $row['DoctorID'] . "'>" . $row['FirstName'] . " " . $row['LastName'] . "</option>";
                                                }
                                            } else {
                                                echo "<option value=''>No doctors available</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="field margin_0">

                                        <input type="submit" value="Next" class="btn btn-success">

                                    </div>
                                </fieldset>
                            </form>

                            <form action="select_department.php" method="GET">
                                <div class="field margin_0" >
                                    <input type="submit" value="Back" class="btn btn-secondary">
                                </div>
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