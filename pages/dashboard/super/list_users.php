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
                    <h2>List of Users</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- invoice section -->
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">

                    <div class="inbox-head">
                        <h3><i class="fa fa-file-text-o" aria-hidden="true"></i> List of Users</h3>
                        <form action="#" class="pull-right position search_inbox">
                            <div class="input-append">
                                <input type="text" class="sr-input" id="emailSearch" placeholder="Search Email">
                                <button class="btn sr-btn" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="inbox-body">
                        <div class="mail-option">
                            <div class="btn-group hidden-phone">
                                <select id="roleFilter" class="form-control">
                                    <option value="all">All Roles</option>
                                    <option value="Patient">Patient</option>
                                    <option value="Doctor">Doctor</option>
                                    <option value="Admin">Admin</option>
                                </select>
                            </div>

                            <div class="btn-group">
                                <a href="list_users.php" class="btn mini tooltips">
                                    <i class=" fa fa-refresh"></i>
                                </a>
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
                                                <h2>Users</h2>
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
                                                                    <th>Email</th>
                                                                    <th>Role</th>
                                                                    <th>Created At</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="usersTable">
                                                                <?php
                                                                $conn = new mysqli($servername, $username, $password, $dbname);
                                                                if ($conn->connect_error) {
                                                                    die("Connection failed: " . $conn->connect_error);
                                                                };

                                                                // Fetch users
                                                                $sql = "SELECT Users.UserID, Users.Email, Users.RoleID, User_Roles.RoleName, Users.CreatedAt
                        FROM Users
                        INNER JOIN User_Roles ON Users.RoleID = User_Roles.RoleID
                        ORDER BY Users.RoleID";

                                                                $result = $conn->query($sql);
                                                                $count = 1;
                                                                if ($result->num_rows > 0) {
                                                                    while ($row = $result->fetch_assoc()) {
                                                                        echo "<tr data-id='{$row['UserID']}'>";
                                                                        echo "<td>{$count}</td>";
                                                                        echo "<td>{$row['Email']}</td>";
                                                                        echo "<td>{$row['RoleName']}</td>";
                                                                        echo "<td>{$row['CreatedAt']}</td>";

                                                                        $count++;
                                                                    }
                                                                } else {
                                                                    echo "<tr><td colspan='5'>No users found</td></tr>";
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

<script>
    // JavaScript for filtering
    document.getElementById('roleFilter').addEventListener('change', function() {
        filterUsers();
    });

    document.getElementById('emailSearch').addEventListener('input', function() {
        filterUsers();
    });

    function filterUsers() {
        var selectedRole = document.getElementById('roleFilter').value.toLowerCase();
        var searchValue = document.getElementById('emailSearch').value.trim().toLowerCase();
        var tableRows = document.getElementById('usersTable').getElementsByTagName('tr');

        for (var i = 0; i < tableRows.length; i++) {
            var row = tableRows[i];
            var role = row.getElementsByTagName('td')[2]; // Role column is the third column (index 2)
            var email = row.getElementsByTagName('td')[1]; // Email column is the second column (index 1)

            var roleMatch = selectedRole === 'all' || role.innerHTML.trim().toLowerCase() === selectedRole;
            var emailMatch = email.innerHTML.trim().toLowerCase().includes(searchValue);

            if (roleMatch && emailMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    }
</script>

<?php
include('nav/footer.php'); // Include the auth.php file

?>