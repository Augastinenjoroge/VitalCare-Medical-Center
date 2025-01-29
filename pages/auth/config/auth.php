<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medical";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

function redirectWithMessage($message, $url) {
    $_SESSION['message'] = $message;
    header("Location: $url");
    exit();
}

// Auto-login if session variables are set
if (isset($_SESSION['user_id']) && isset($_SESSION['role_id'])) {
    switch ($_SESSION['role_id']) {
        case 1:
            header("Location: ../dashboard/patient/");
            break;
        case 2:
            header("Location: ../dashboard/doctor/");
            break;
        case 3:
            header("Location: ../dashboard/super/");
            break;
        default:
            redirectWithMessage('Invalid role.', '../index.php');
    }
    exit();
}

// Handle sign-up
$firstname = $lastname = $dob = $gender = $contact = $email = $address = $password = $re_password = '';
$firstname_err = $lastname_err = $dob_err = $gender_err = $contact_err = $email_err = $address_err = $password_err = $re_password_err = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    if (empty(trim($_POST["firstname"]))) {
        $firstname_err = "Please enter your first name.";
    } else {
        $firstname = trim($_POST["firstname"]);
    }
    
    if (empty(trim($_POST["lastname"]))) {
        $lastname_err = "Please enter your last name.";
    } else {
        $lastname = trim($_POST["lastname"]);
    }

    if (empty(trim($_POST["dob"]))) {
        $dob_err = "Please enter your date of birth.";
    } else {
        $dob = trim($_POST["dob"]);
        $dob_date = DateTime::createFromFormat('Y-m-d', $dob);
        $today = new DateTime();
        $age = $today->diff($dob_date)->y;
        if (!$dob_date || $dob_date > $today) {
            $dob_err = "Please enter a valid date of birth.";
        } elseif ($age < 18) {
            $dob_err = "You must be at least 18 years old.";
        }
    }

    if (empty(trim($_POST["gender"]))) {
        $gender_err = "Please select your gender.";
    } else {
        $gender = trim($_POST["gender"]);
    }

    if (empty(trim($_POST["contact"]))) {
        $contact_err = "Please enter your contact number.";
    } else {
        $contact = trim($_POST["contact"]);
        if (!preg_match('/^\d{10}$/', $contact)) {
            $contact_err = "Please enter a valid 10-digit contact number.";
        }
    }

    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } else {
        $sql = "SELECT PatientID FROM Patients WHERE Email = :email";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $param_email = trim($_POST["email"]);
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $email_err = "This email is already registered.";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            unset($stmt);
        }
    }

    if (empty(trim($_POST["address"]))) {
        $address_err = "Please enter your address.";
    } else {
        $address = trim($_POST["address"]);
        if (strlen($address) < 5) {
            $address_err = "Address is too short.";
        }
    }
    
    if (empty(trim($_POST["pass"]))) {
        $password_err = "Please enter a password.";     
    } elseif (strlen(trim($_POST["pass"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["pass"]);
    }
    
    if (empty(trim($_POST["re_pass"]))) {
        $re_password_err = "Please confirm password.";     
    } else {
        $re_password = trim($_POST["re_pass"]);
        if (empty($password_err) && ($password != $re_password)) {
            $re_password_err = "Passwords did not match.";
        }
    }

    if (empty($firstname_err) && empty($lastname_err) && empty($dob_err) && empty($gender_err) && empty($contact_err) && empty($email_err) && empty($address_err) && empty($password_err) && empty($re_password_err)) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $role_id = 1;
        $sql = "INSERT INTO Users (Email, PasswordHash, RoleID) VALUES (:email, :password, :role_id)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":role_id", $role_id, PDO::PARAM_INT);
            $param_email = $email;
            $param_password = $password_hash;
            if ($stmt->execute()) {
                $user_id = $conn->lastInsertId();
                $sql = "INSERT INTO Patients (UserID, FirstName, LastName, DateOfBirth, Gender, ContactNumber, Email, Address) VALUES (:user_id, :firstname, :lastname, :dob, :gender, :contact, :email, :address)";
                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
                    $stmt->bindParam(":firstname", $firstname, PDO::PARAM_STR);
                    $stmt->bindParam(":lastname", $lastname, PDO::PARAM_STR);
                    $stmt->bindParam(":dob", $dob, PDO::PARAM_STR);
                    $stmt->bindParam(":gender", $gender, PDO::PARAM_STR);
                    $stmt->bindParam(":contact", $contact, PDO::PARAM_STR);
                    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
                    $stmt->bindParam(":address", $address, PDO::PARAM_STR);
                    if ($stmt->execute()) {
                        redirectWithMessage('Registration successful. You can now log in.', '../index.php');
                    } else {
                        redirectWithMessage('Oops! Something went wrong. Please try again later.', '../index.php');
                    }
                }
                unset($stmt);
            } else {
                redirectWithMessage('Oops! Something went wrong. Please try again later.', '../index.php');
            }
        }
        unset($stmt);
    } else {
        $error_message = implode("\\n", array_filter([$firstname_err, $lastname_err, $dob_err, $gender_err, $contact_err, $email_err, $address_err, $password_err, $re_password_err]));
        redirectWithMessage($error_message, '../index.php');
    }
}




// Handle SIGN IN 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signin'])) {
    $email = trim($_POST['email']);
    $password = $_POST['your_pass'];
    
    if (empty($email) || empty($password)) {
        redirectWithMessage('Please fill in all fields.', '../index.php');
    }
    
    try {
        $stmt = $conn->prepare("SELECT * FROM Users WHERE Email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['PasswordHash'])) {
            $_SESSION['user_id'] = $user['UserID'];
            $_SESSION['role_id'] = $user['RoleID'];

            // Redirect based on role
            switch ($user['RoleID']) {
                case 1:
                    header("Location: ../../dashboard/patient/");
                    break;
                case 2:
                    header("Location: ../../dashboard/doctor/");
                    break;
                case 3:
                    header("Location: ../../dashboard/super/");
                    break;
                default:
                    redirectWithMessage('Invalid role.', '../index.php');
            }
            exit();
        } else {
            redirectWithMessage('Invalid credentials.', '../index.php');
        }
    } catch (PDOException $e) {
        redirectWithMessage('Login failed: ' . $e->getMessage(), '../index.php');
    }
}
?>
