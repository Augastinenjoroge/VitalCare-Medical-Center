<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctor_id = $_POST['doctor'];
    $department_id = $_POST['department'];

    // Fetch the doctor's schedule from the database
    $stmt = $conn->prepare("SELECT AvailableDate FROM Doctor_Schedules WHERE DoctorID = ?");
    $stmt->bind_param("i", $doctor_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $available_dates = [];
    while ($row = $result->fetch_assoc()) {
        $available_dates[] = $row['AvailableDate'];
    }
    $stmt->close();
    $conn->close();
} else {
    die(header('Location:./select_doctor.php'). 'Invalid request.');
}
?>


<style>
    .calendar {
        display: table;
        width: 100%;
        border-collapse: collapse;
    }

    .calendar th,
    .calendar td {
        border: 1px solid #ccc;
        text-align: center;
        padding: 10px;
    }

    .calendar .available {
        background-color: #90EE90;
        /* Light green for available */
    }

    .calendar .not-available {
        background-color: #FFB6C1;
        /* Light pink for not available */
    }
</style>
<script>
    let currentMonth;
    let currentYear;

    function generateCalendar(availableDates) {
        const calendar = document.getElementById('calendar');
        calendar.innerHTML = ''; // Clear previous calendar

        const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        const monthAndYear = document.getElementById('monthAndYear');
        monthAndYear.textContent = monthNames[currentMonth] + ' ' + currentYear;

        const firstDay = new Date(currentYear, currentMonth, 1);
        const lastDay = new Date(currentYear, currentMonth + 1, 0);
        const daysInMonth = lastDay.getDate();

        // Create calendar header
        const headerRow = document.createElement('tr');
        const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        for (let day of daysOfWeek) {
            const th = document.createElement('th');
            th.textContent = day;
            headerRow.appendChild(th);
        }
        calendar.appendChild(headerRow);

        // Create blank cells for days before the first day of the month
        let row = document.createElement('tr');
        for (let i = 0; i < firstDay.getDay(); i++) {
            const cell = document.createElement('td');
            row.appendChild(cell);
        }

        // Add days to the calendar
        for (let day = 1; day <= daysInMonth; day++) {
            const date = new Date(currentYear, currentMonth, day);
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const dayString = String(date.getDate()).padStart(2, '0');
            const dateString = `${year}-${month}-${dayString}`;

            const cell = document.createElement('td');
            cell.textContent = day;

            if (availableDates.includes(dateString)) {
                cell.classList.add('available');
                cell.onclick = function() {
                    document.getElementById('date').value = dateString;
                    document.forms['dateForm'].submit();
                };
            } else {
                cell.classList.add('not-available');
            }

            row.appendChild(cell);

            if (date.getDay() === 6) {
                calendar.appendChild(row);
                row = document.createElement('tr');
            }
        }

        // Append the last row
        if (row.hasChildNodes()) {
            calendar.appendChild(row);
        }
    }

    function changeMonth(offset) {
        currentMonth += offset;
        if (currentMonth < new Date().getMonth() && currentYear === new Date().getFullYear()) {
            currentMonth = new Date().getMonth();
        } else if (currentMonth < 0) {
            currentMonth = 11;
            currentYear -= 1;
        } else if (currentMonth > 11) {
            currentMonth = 0;
            currentYear += 1;
        }
        fetchAvailableDates();
    }

    function fetchAvailableDates() {
        // Fetch available dates from the server based on the current month and year
        fetch('fetch_available_dates.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    doctor_id: <?php echo $doctor_id; ?>,
                    month: currentMonth + 1,
                    year: currentYear
                })
            })
            .then(response => response.json())
            .then(data => {
                generateCalendar(data.available_dates);
            })
            .catch(error => console.error('Error fetching available dates:', error));
    }

    document.addEventListener('DOMContentLoaded', function() {
        currentMonth = new Date().getMonth();
        currentYear = new Date().getFullYear();
        fetchAvailableDates();
    });
</script>

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
                            <h2>Select Date</h2>
                        </div>
                        <div class="logo_login">
                            <div class="center">
                                <img width="210" src="images/logo/vitalcare-medical-center-high-resolution-logo-transparent (1).png" alt="#" />
                            </div>
                        </div>
                        <div class="login_form">
                            <h2 class="mt-5">Select Date</h2>
                            <form id="dateForm" action="select_time.php" method="POST" class="mt-4">
                                <input type="hidden" name="department" value="<?php echo $department_id; ?>">
                                <input type="hidden" name="doctor" value="<?php echo $doctor_id; ?>">
                                <input type="hidden" name="date" id="date" required>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <button type="button" class="btn btn-primary" onclick="changeMonth(-1)"><i class="fa fa-arrow-circle-left"></i></button>
                                    <span id="monthAndYear"></span>
                                    <button type="button" class="btn btn-primary" onclick="changeMonth(1)"><i class="fa fa-arrow-circle-right"></i></button>
                                </div>
                                <table class="calendar table table-bordered" id="calendar"></table>
                                <div class="text-right">
                                    <input type="submit" class="btn btn-success" value="Next">
                                </div>
                            </form>
                            <form action="select_doctor.php" method="POST" class="mt-3">
                                <input type="hidden" name="department" value="<?php echo $department_id; ?>">
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