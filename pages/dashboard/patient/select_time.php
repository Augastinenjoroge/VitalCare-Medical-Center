<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctor_id = $_POST['doctor'];
    $department_id = $_POST['department'];
    $selected_date = $_POST['date'];
} else {
    die(header('Location:./select_time.php'). 'Invalid request.');
}

function getAvailableTimes($doctor_id, $selected_date, $conn)
{
    $available_times = [];
    $sql = "SELECT AvailableFrom, AvailableTo FROM Doctor_Schedules WHERE DoctorID = $doctor_id AND AvailableDate = '$selected_date'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $from_time = new DateTime($row['AvailableFrom']);
        $to_time = new DateTime($row['AvailableTo']);

        while ($from_time < $to_time) {
            $next_time = clone $from_time;
            $next_time->add(new DateInterval('PT30M'));
            if ($next_time > $to_time) break;

            $time_slot = $from_time->format('H:i');
            $sql_check = "SELECT * FROM Appointments WHERE DoctorID = $doctor_id AND AppointmentDateTime = '$selected_date $time_slot:00'";
            $result_check = $conn->query($sql_check);

            if ($result_check->num_rows == 0) {
                $available_times[] = $time_slot;
            }
            $from_time = $next_time;
        }
    }
    return $available_times;
}

$available_times = getAvailableTimes($doctor_id, $selected_date, $conn);
?>

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
                            <h2>Select Time</h2>
                        </div>
                        <div class="logo_login">
                            <div class="center">
                                <img width="210" src="images/logo/vitalcare-medical-center-high-resolution-logo-transparent (1).png" alt="#" />
                            </div>
                        </div>
                        <div class="login_form">
                            <form action="confirm_appointment.php" method="POST" class="mt-4">
                                <input type="hidden" name="department" value="<?php echo $department_id; ?>">
                                <input type="hidden" name="doctor" value="<?php echo $doctor_id; ?>">
                                <input type="hidden" name="date" value="<?php echo $selected_date; ?>">
                                <div class="field">
                                    <label for="time" class="label_field">Time:</label>
                                    <select name="time" id="time" required>
                                        <option value="">Select Time</option>
                                        <?php
                                        include 'db.php';
                                        if (count($available_times) > 0) {
                                            foreach ($available_times as $time) {
                                                echo "<option value='" . $time . "'>" . $time . "</option>";
                                            }
                                        } else {
                                            echo "<option value=''>No available times</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="text-right">
                                    <input type="submit" class="btn btn-success" value="Next">
                                </div>
                            </form>
                            <form action="select_date.php" method="POST" class="mt-3">
                                <input type="hidden" name="department" value="<?php echo $department_id; ?>">
                                <input type="hidden" name="doctor" value="<?php echo $doctor_id; ?>">
                                <input type="submit" class="btn btn-secondary" value="Back">
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