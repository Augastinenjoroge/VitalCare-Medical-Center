<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medical"; // replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $conn->real_escape_string($_POST['FirstName']);
    $lastName = $conn->real_escape_string($_POST['LastName']);
    $departmentID = $conn->real_escape_string($_POST['DepartmentID']);
    $contactNumber = $conn->real_escape_string($_POST['ContactNumber']);
    $email = $conn->real_escape_string($_POST['Email']);
    $address = $conn->real_escape_string($_POST['Address']);
    $password = $conn->real_escape_string($_POST['Password']);
    $rePassword = $conn->real_escape_string($_POST['RePassword']);

    if ($password !== $rePassword) {
        echo "<script>
                alert('Passwords do not match.');
                window.location.href='../add_doctor.php';
              </script>";
        exit;
    }

    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    // Check if email already exists in Users
    $sql = "SELECT * FROM Users WHERE Email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<script>
                alert('Email already exists.');
                window.location.href='../add_doctor.php';
              </script>";
        exit;
    } else {
        // Insert new user with role 'Doctor'
        $sql = "INSERT INTO Users (Email, PasswordHash, RoleID) VALUES ('$email', '$passwordHash', (SELECT RoleID FROM User_Roles WHERE RoleName = 'Doctor'))";
        if ($conn->query($sql) === TRUE) {
            $userID = $conn->insert_id;

            // Insert new doctor
            $sql = "INSERT INTO Doctors (UserID, FirstName, LastName, DepartmentID, ContactNumber, Email, Address) VALUES ('$userID', '$firstName', '$lastName', '$departmentID', '$contactNumber', '$email', '$address')";
            if ($conn->query($sql) === TRUE) {
                echo "<script>
                        alert('New doctor added successfully.');
                        window.location.href='../add_doctor.php';
                      </script>";
            } else {
                echo "<script>
                        alert('Error: " . $conn->error . "');
                        window.location.href='../add_doctor.php';
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Error: " . $conn->error . "');
                    window.location.href='../add_doctor.php';
                  </script>";
        }
    }
}

$conn->close();
?>
