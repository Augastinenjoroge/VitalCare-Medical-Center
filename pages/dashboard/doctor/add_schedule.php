<?php
include('nav/header.php'); 

?>
<!-- end topbar -->
<!-- dashboard inner -->
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Add schedule</h2>
                </div>
            </div>
        </div>
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
                            <form method="POST" action="config/submit_schedule.php">
                                <fieldset>
                                    <div class="field">
                                        <label for="AvailableDate">Available Date:</label>
                                        <input type="date" id="AvailableDate" name="AvailableDate">
                                    </div>
                                    <div class="field">
                                        <label for="AvailableFrom">Available From:</label>
                                        <input type="time" id="AvailableFrom" name="AvailableFrom" value="08:00">
                                    </div>
                                    <div class="field">
                                        <label for="AvailableTo">Available To:</label>
                                        <input type="time" id="AvailableTo" name="AvailableTo" value="17:00">
                                    </div>
                                    <div class="field margin_0">
                                        <button type="button" onclick="addSchedule()" class="btn btn-primary">Add Schedule</button>
                                    </div>
                                </fieldset>
                                <div class="white_shd full margin_bottom_30">
                                    <div class="full graph_head">
                                        <div class="heading1 margin_0">
                                            <h2>schedule table</h2>
                                        </div>
                                    </div>
                                    <div class="table_section padding_infor_info">
                                        <div class="table-responsive-sm">
                                            <table class="table table-striped table-hover" id="scheduleTable">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>From</th>
                                                        <th>To</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <!-- Schedules will be added here dynamically -->
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="field margin_0">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <button type="button" onclick="clearForm()" class="btn btn-danger">Clear</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let scheduleCounter = 0;

    function addSchedule() {
        const date = document.getElementById('AvailableDate').value;
        const fromTime = document.getElementById('AvailableFrom').value;
        const toTime = document.getElementById('AvailableTo').value;

        if (!date || !fromTime || !toTime) {
            alert('Please fill out all fields.');
            return;
        }

        const table = document.getElementById('scheduleTable');
        const row = table.insertRow();
        row.id = 'scheduleRow_' + scheduleCounter;

        const dateCell = row.insertCell(0);
        const fromTimeCell = row.insertCell(1);
        const toTimeCell = row.insertCell(2);
        const actionCell = row.insertCell(3);

        dateCell.innerHTML = date + `<td><input type="hidden" name="schedules[${scheduleCounter}][date]" value="${date}"></td>`;
        fromTimeCell.innerHTML = fromTime + `<td><input type="hidden" name="schedules[${scheduleCounter}][from]" value="${fromTime}"></td>`;
        toTimeCell.innerHTML = toTime + `<td><input type="hidden" name="schedules[${scheduleCounter}][to]" value="${toTime}"></td>`;

        actionCell.innerHTML = `<button type="button" class="btn btn-success" onclick="editSchedule(${scheduleCounter})">Edit</button>
                                    <button type="button" class="btn btn-danger" onclick="deleteSchedule(${scheduleCounter})">Delete</button>`;

        scheduleCounter++;

        document.getElementById('AvailableDate').value = '';
        document.getElementById('AvailableFrom').value = '08:00';
        document.getElementById('AvailableTo').value = '17:00';

        sortTable();
    }

    function editSchedule(counter) {
        const row = document.getElementById('scheduleRow_' + counter);

        const fromTime = prompt("Edit Available From time:", row.cells[1].innerText);
        const toTime = prompt("Edit Available To time:", row.cells[2].innerText);

        if (fromTime && toTime) {
            row.cells[1].innerHTML = fromTime + `<input type="hidden" name="schedules[${counter}][from]" value="${fromTime}">`;
            row.cells[2].innerHTML = toTime + `<input type="hidden" name="schedules[${counter}][to]" value="${toTime}">`;
        }
    }

    function deleteSchedule(counter) {
        document.getElementById('scheduleRow_' + counter).remove();
    }

    function clearForm() {
        document.getElementById('AvailableDate').value = '';
        document.getElementById('AvailableFrom').value = '08:00';
        document.getElementById('AvailableTo').value = '17:00';
        document.getElementById('scheduleTable').getElementsByTagName('tbody')[0].innerHTML = '';
        scheduleCounter = 0;
    }

    function sortTable() {
        const table = document.getElementById('scheduleTable');
        const rows = Array.from(table.rows).slice(1);

        rows.sort((a, b) => {
            const dateA = new Date(a.cells[0].innerText);
            const dateB = new Date(b.cells[0].innerText);
            return dateA - dateB;
        });

        rows.forEach(row => table.appendChild(row));
    }
</script>
<?php
include('nav/footer.php'); // Include the auth.php file

?>