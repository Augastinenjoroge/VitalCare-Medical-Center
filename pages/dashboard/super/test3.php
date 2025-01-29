<?php
session_start();
$servername = "localhost"; // Replace with your server name
$username = "root"; // Replace with your username
$password = ""; // Replace with your password
$database = "medical"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$firstName = '';
$lastName = '';
$email = '';
$contactNumber = '';
$initials = '';

// Check if the user is logged in and is a Admin
if (isset($_SESSION['user_id']) && isset($_SESSION['role_id']) && $_SESSION['role_id'] == 3) { // Assuming role_id 2 is for Admin
   $userID = $_SESSION['user_id'];

   echo $userID;

   $sql = "SELECT FirstName, LastName, Email, ContactNumber FROM Admins WHERE UserID = '$userID'";
   $result = $conn->query($sql);

   if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $firstName = $row['FirstName'];
      $lastName = $row['LastName'];
      $email = $row['Email'];
      $contactNumber = $row['ContactNumber'];
      $initials = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));
   }
   
   echo $userID;
}


?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Department</th>
            <th>Gender</th>
            <th>Contact Number</th>
            <th>Email</th>
            <th>Address</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="doctorsTable">
        <?php
        session_start();
        $servername = "localhost"; // Replace with your server name
        $username = "root"; // Replace with your username
        $password = ""; // Replace with your password
        $database = "medical"; // Replace with your database name

        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // Fetch doctors with department names
        $sql = "SELECT d.DoctorID, d.FirstName, d.LastName, d.Gender, d.ContactNumber, d.Email, d.Address, dept.DepartmentName
                        FROM Doctors d
                        LEFT JOIN Departments dept ON d.DepartmentID = dept.DepartmentID
                        ORDER BY d.FirstName";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $count = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr data-id='{$row['DoctorID']}'>";
                echo "<td>{$count}</td>";
                echo "<td>{$row['FirstName']}</td>";
                echo "<td>{$row['LastName']}</td>";
                echo "<td>{$row['DepartmentName']}</td>";
                echo "<td>{$row['Gender']}</td>";
                echo "<td>{$row['ContactNumber']}</td>";
                echo "<td>{$row['Email']}</td>";
                echo "<td>{$row['Address']}</td>";
                echo "<td>";
                echo "<button class='btn btn-warning edit-btn' data-toggle='modal' data-target='#editModal' data-id='{$row['DoctorID']}'>Edit</button>";
                echo "<button class='btn btn-danger delete-btn' data-id='{$row['DoctorID']}'>Delete</button>";
                echo "</td>";
                echo "</tr>";
                $count++;
            }
        } else {
            echo "<tr><td colspan='9'>No doctors found</td></tr>";
        }

        $conn->close();
        ?>
    </tbody>
</table>