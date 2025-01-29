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

include('nav/header.php'); // Include the auth.php file
?>


<!-- end topbar -->
<!-- dashboard inner -->
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Doctor Calendar</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- invoice section -->
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <div class="heading1 margin_0">
                            <h2><i class="fa fa-calendar" aria-hidden="true"></i>Doctor Calendar</h2>
                        </div>
                    </div>
                    <div class="full padding_infor_info">
                        <div class="invoice_inner">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="white_shd full margin_bottom_30">
                                        <div class="full graph_head">
                                            <div class="heading1 margin_0">
                                                <h2>Calendar</h2>
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
                                                                    <th>Date</th>
                                                                    <th>From</th>
                                                                    <th>To</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php

                                                                $conn = new mysqli($servername, $username, $password, $dbname);
                                                                if ($conn->connect_error) {
                                                                    die("Connection failed: " . $conn->connect_error);
                                                                }


                                                                if (isset($_SESSION['user_id']) && isset($_SESSION['role_id']) && $_SESSION['role_id'] == 2) { // Assuming role_id 2 is for Doctor
                                                                    $userID = $_SESSION['user_id'];

                                                                    $sql = "SELECT DoctorID FROM Doctors WHERE UserID = '$userID'";
                                                                    $result = $conn->query($sql);

                                                                    if ($result->num_rows > 0) {
                                                                        $row = $result->fetch_assoc();
                                                                        $doctorID = $row['DoctorID'];

                                                                        $sql = "SELECT * FROM Doctor_Schedules WHERE DoctorID = '$doctorID' AND AvailableDate >= CURDATE() ORDER BY AvailableDate ASC";
                                                                        $result = $conn->query($sql);

                                                                        if ($result->num_rows > 0) {
                                                                            $count = 1;
                                                                            while ($schedule = $result->fetch_assoc()) {
                                                                                $availableDate = date("d F Y", strtotime($schedule['AvailableDate']));
                                                                                    $availableFrom = date("h:i A", strtotime($schedule['AvailableFrom']));
                                                                                    $availableTo = date("h:i A", strtotime($schedule['AvailableTo']));
                                                                                    echo "<tr>
                                                                                        <td>{$count}</td>
                                                                                        <td>{$availableDate}</td>
                                                                                        <td>{$availableFrom}</td>
                                                                                        <td>{$availableTo}</td>
                                    <td>
                                        <button type='button' class='btn btn-info' onclick=\"openEditPopup('{$schedule['ScheduleID']}', '{$schedule['AvailableDate']}', '{$schedule['AvailableFrom']}', '{$schedule['AvailableTo']}')\">Edit</button>
                                        <button type='button' class='btn btn-danger'onclick=\"deleteSchedule('{$schedule['ScheduleID']}')\">Delete</button>
                                    </td>
                                  </tr>";
                                                                                $count++;
                                                                            }
                                                                        } else {
                                                                            echo "<tr><td colspan='5'>No schedules found.</td></tr>";
                                                                        }
                                                                    } else {
                                                                        echo "<tr><td colspan='5'>Doctor not found.</td></tr>";
                                                                    }
                                                                } else {
                                                                    echo "<tr><td colspan='5'>Unauthorized access.</td></tr>";
                                                                }

                                                                $conn->close();
                                                                ?>
                                                            </tbody>
                                                        </table>

                                                        <div id="editPopup" class="popup-overlay">
                                                            <div class="full_container">
                                                                <div class="container">
                                                                    <div class="center">
                                                                        <div class="login_section">
                                                                            <div class="logo_login">
                                                                                <div class="center">
                                                                                    <img width="210" src="images/logo/vitalcare-medical-center-high-resolution-logo-transparent (1).png" alt="#" />
                                                                                </div>
                                                                            </div>
                                                                            <div class="login_form">
                                                                                <form method="POST" action="config/edit_schedule.php">
                                                                                    <fieldset>
                                                                                        <legend>Edit Date Time</legend>
                                                                                        <input type="hidden" id="editScheduleID" name="ScheduleID">
                                                                                        <div class="field">
                                                                                            <label for="editAvailableDate">Available Date:</label>
                                                                                            <input type="date" id="editAvailableDate" name="AvailableDate" readonly>
                                                                                        </div>
                                                                                        <div class="field">
                                                                                            <label for="editAvailableFrom">Available From:</label>
                                                                                            <input type="time" id="editAvailableFrom" name="AvailableFrom">
                                                                                        </div>
                                                                                        <div class="field">
                                                                                            <label for="editAvailableTo">Available To:</label>
                                                                                            <input type="time" id="editAvailableTo" name="AvailableTo">
                                                                                        </div>
                                                                                        <div class="field margin_0">
                                                                                            <button type="submit" class="btn btn-success">Update</button>
                                                                                            <button type="button" onclick="closeEditPopup()" class="btn btn-danger">Cancel</button>
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


<script>
    function openEditPopup(scheduleID, date, fromTime, toTime) {
        document.getElementById('editScheduleID').value = scheduleID;
        document.getElementById('editAvailableDate').value = date;
        document.getElementById('editAvailableFrom').value = fromTime;
        document.getElementById('editAvailableTo').value = toTime;
        document.getElementById('editPopup').style.display = 'block';
    }

    function closeEditPopup() {
        document.getElementById('editPopup').style.display = 'none';
    }

    function deleteSchedule(scheduleID) {
        if (confirm('Are you sure you want to delete this schedule?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = 'config/delete_schedule.php';
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'ScheduleID';
            input.value = scheduleID;
            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>
<style>
    #editPopup {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border: 1px solid #ccc;
        padding: 20px;
        background-color: white;
        z-index: 1000;
    }

    .popup-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }
</style>
<?php
include('nav/footer.php'); // Include the auth.php file

?>