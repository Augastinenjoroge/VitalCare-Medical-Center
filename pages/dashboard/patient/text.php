<!DOCTYPE html>
<html>
<head>
    <title>Book Appointment - Select Date</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <h2>Select Date</h2>
    <form action="select_time.php" method="POST">
        <input type="hidden" name="department" value="<?php echo $department_id; ?>">
        <input type="hidden" name="doctor" value="<?php echo $doctor_id; ?>">
        <input type="hidden" name="date" id="selectedDate" required>
        <div id="calendar"></div>
        <input type="submit" value="Next">
    </form>
    <form action="select_doctor.php" method="POST">
        <input type="hidden" name="department" value="<?php echo $department_id; ?>">
        <input type="submit" value="Back">
    </form>

    <script>
        $(document).ready(function() {
            var doctorId = <?php echo json_encode($doctor_id); ?>;

            $.ajax({
                url: 'get_doctor_schedule.php',
                type: 'POST',
                data: { doctor_id: doctorId },
                success: function(data) {
                    var events = JSON.parse(data);

                    var calendarEl = document.getElementById('calendar');
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        events: events,
                        dateClick: function(info) {
                            var selectedDate = info.dateStr;
                            $('#selectedDate').val(selectedDate);
                            calendarEl.querySelectorAll('.fc-day').forEach(function(dayEl) {
                                dayEl.style.backgroundColor = '';
                            });
                            info.dayEl.style.backgroundColor = '#00f'; // Highlight the selected date
                        }
                    });

                    calendar.render();
                }
            });
        });
    </script>
</body>
</html>
