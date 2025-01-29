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
    $contactNumber = $conn->real_escape_string($_POST['ContactNumber']);
    $email = $conn->real_escape_string($_POST['Email']);
    $password = $conn->real_escape_string($_POST['Password']);
    $rePassword = $conn->real_escape_string($_POST['RePassword']);

    if ($password !== $rePassword) {
        echo "<script>
                alert('Passwords do not match.');
                window.location.href='../add_admin.php';
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
                window.location.href='../add_admin.php';
              </script>";
        exit;
    } else {
        // Insert new user with role 'Admin'
        $sql = "INSERT INTO Users (Email, PasswordHash, RoleID) VALUES ('$email', '$passwordHash', (SELECT RoleID FROM User_Roles WHERE RoleName = 'Admin'))";
        if ($conn->query($sql) === TRUE) {
            $userID = $conn->insert_id;

            // Insert new admin
            $sql = "INSERT INTO Admins (UserID, FirstName, LastName, ContactNumber, Email) VALUES ('$userID', '$firstName', '$lastName', '$contactNumber', '$email')";
            if ($conn->query($sql) === TRUE) {
                echo "<script>
                        alert('New admin added successfully.');
                        window.location.href='../add_admin.php';
                      </script>";
            } else {
                echo "<script>
                        alert('Error: " . $conn->error . "');
                        window.location.href='../add_admin.php';
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Error: " . $conn->error . "');
                    window.location.href='../add_admin.php';
                  </script>";
        }
    }
}

$conn->close();
?>
