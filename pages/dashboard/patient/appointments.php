<?php


include('nav/header.php'); // Include the auth.php file
?>

<?php if ($message) : ?>
    <script>
        alert('<?php echo $message; ?>');
    </script>
<?php endif; ?>

<!-- end topbar -->
<!-- dashboard inner -->
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Appointments</h2>
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
                                                <h2>Your Appointments</h2>
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
                                                                    <th>Doctor</th>
                                                                    <th>Date</th>
                                                                    <th>Time</th>
                                                                    <th>Status</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                session_start();
                                                                include 'db.php'; // Include your database connection file

                                                                // Establish database connection
                                                                $conn = new mysqli($servername, $username, $password, $dbname);
                                                                if ($conn->connect_error) {
                                                                    die("Connection failed: " . $conn->connect_error);
                                                                }

                                                                // Check if the user is logged in and has a role of 'Patient'
                                                                if (isset($_SESSION['user_id']) && isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {
                                                                    $userID = $_SESSION['user_id'];

                                                                    // Function to get patient ID from user ID
                                                                    function getPatientID($conn, $userID)
                                                                    {
                                                                        $stmt = $conn->prepare("SELECT PatientID FROM Patients WHERE UserID = ?");
                                                                        $stmt->bind_param("i", $userID);
                                                                        $stmt->execute();
                                                                        $result = $stmt->get_result();
                                                                        $row = $result->fetch_assoc();
                                                                        return $row['PatientID'];
                                                                    }

                                                                    // Get the patient ID
                                                                    $patientID = getPatientID($conn, $userID);

                                                                    // Cancel an appointment
                                                                    $message = '';
                                                                    if (isset($_POST['cancel'])) {
                                                                        $appointmentID = $_POST['appointment_id'];
                                                                        $stmt = $conn->prepare("UPDATE Appointments SET Status = 'Cancelled' WHERE AppointmentID =? AND PatientID =?");
                                                                        $stmt->bind_param("ii", $appointmentID, $patientID);
                                                                        if ($stmt->execute()) {
                                                                            $message =  "Appointment successfully cancelled.";
                                                                            echo "<script>
                        if (confirm('$message')) {
                            window.location.href='appointments.php';
                        }
                    </script>";
                                                                        } else {
                                                                            $message = "Error cancelling appointment. Please try again.";
                                                                            echo "<script>alert('$message');</script>";
                                                                        }
                                                                    }

                                                                    // Get the patient's appointments from the current date onward
                                                                    $currentDate = date('Y-m-d');
                                                                    $stmt = $conn->prepare("SELECT a.AppointmentID, a.AppointmentDateTime, a.Status, d.FirstName AS DoctorFirstName, d.LastName AS DoctorLastName
                                FROM Appointments a
                                JOIN Doctors d ON a.DoctorID = d.DoctorID
                                WHERE a.PatientID = ? AND a.Status <> 'Cancelled' AND a.AppointmentDateTime >= ?
                                ORDER BY a.AppointmentDateTime ASC");
                                                                    $stmt->bind_param("is", $patientID, $currentDate);
                                                                    $stmt->execute();
                                                                    $result = $stmt->get_result();

                                                                    $num = 1;
                                                                    if ($result->num_rows > 0) {
                                                                        while ($row = $result->fetch_assoc()) {
                                                                            $date = date('F j, Y', strtotime($row['AppointmentDateTime']));
                                                                            $time = date('h:i A', strtotime($row['AppointmentDateTime']));
                                                                            echo "<tr>
                        <td>{$num}</td>
                        <td>{$row['DoctorFirstName']} {$row['DoctorLastName']}</td>
                        <td>{$date}</td>
                        <td>{$time}</td>
                        <td>{$row['Status']}</td>
                        <td>";
                                                                            if ($row['Status'] != 'Cancelled') {
                                                                                echo "<form method='post'>
                            <input type='hidden' name='appointment_id' value='{$row['AppointmentID']}'>
                            <button type='submit' class='btn btn-danger' name='cancel'>Cancel</button>
                          </form>";
                                                                            }
                                                                            echo "</td>
                      </tr>";
                                                                            $num++;
                                                                        }
                                                                    } else {
                                                                        echo "<tr><td colspan='6'>No appointments found.</td></tr>";
                                                                    }
                                                                } else {
                                                                    echo "<tr><td colspan='6'>Unauthorized access.</td></tr>";
                                                                }

                                                                $conn->close();
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

<?php
include('nav/footer.php'); // Include the auth.php file

?>
<?php
$conn->close();
?>