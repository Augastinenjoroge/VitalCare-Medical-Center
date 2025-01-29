<?php
session_start();
include('config/auth.php'); // Include the auth.php file

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="main">

        <!-- Modal Popup for Messages -->
        <div id="messageModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <p id="modalMessage"></p>
            </div>
        </div>

        <!-- Display error messages -->
        <div class="error-messages">
            <?php if (isset($_SESSION['message'])): ?>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        showMessage('<?php echo $_SESSION['message']; ?>');
                    });
                </script>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>
        </div>
        
        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Create an account</h2>
                        <form method="POST" class="register-form" id="register-form" action="config/auth.php">
                        
                        <div class="form-group">
                        <label for="firstname"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="firstname" id="firstname" placeholder="First Name" class="error-message"/>
                    </div>
                    <div class="form-group">
                        <label for="lastname"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="lastname" id="lastname" placeholder="Last Name" class="error-message"/>
                    </div>
                    <div class="form-group">
                        <label for="dob"><i class="zmdi zmdi-calendar-alt"></i></label>
                        <input type="date" name="dob" id="dob" placeholder="Date of Birth" class="error-message"/>
                    </div>
                    <div class="form-group">
                        <label for="gender"><i class="zmdi zmdi-male-female"></i></label>
                       
                        <select name="gender" id="gender" class="error-message">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="contact"><i class="zmdi zmdi-phone"></i></label>
                        <input type="tel" name="contact" id="contact" placeholder="Contact Number" class="error-message"/>
                    </div>
                    <div class="form-group">
                        <label for="email"><i class="zmdi zmdi-email"></i></label>
                        <input type="email" name="email" id="email" placeholder="Your Email" class="error-message"/>
                    </div>
                    <div class="form-group">
                        <label for="address"><i class="zmdi zmdi-pin"></i></label>
                        <input type="text" name="address" id="address" placeholder="Address" class="error-message"/>
                    </div>
                    <div class="form-group">
                        <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="pass" id="pass" placeholder="Password" class="error-message"/>
                    </div>
                    <div class="form-group">
                        <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                        <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password" class="error-message"/>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                        <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                    </div>
                    <div class="form-group form-button">
                        <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                    </div>
                </form>
            </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="#" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sign in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
                    </div>
                    <div class="signin-form">
                        <h2 class="form-title">Sign In</h2>
                        <form method="POST" class="register-form" id="login-form" action="config/auth.php">

                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="your_pass" id="your_pass" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                                <a href="#" class="signup-image-link">Create an account</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        function showMessage(message) {
            var modal = document.getElementById("messageModal");
            var span = document.getElementsByClassName("close")[0];
            document.getElementById("modalMessage").innerText = message;
            modal.style.display = "block";
            span.onclick = function() {
                modal.style.display = "none";
            }
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        }
    </script>

<!-- <script>
// Get form elements
const registerForm = document.getElementById('register-form');
const inputs = registerForm.getElementsByTagName('input');
const errors = {};

// Validate form inputs
function validateForm() {
  for (let i = 0; i < inputs.length; i++) {
    const input = inputs[i];
    const inputId = input.id;

    // Clear previous error messages
    if (errors[inputId]) {
      removeError(inputId);
      delete errors[inputId];
    }

    // Validate each input field
    switch (inputId) {
      case 'firstname':
        if (input.value.trim() === '') {
          errors[inputId] = 'Please enter your first name.';
        }
        break;
      case 'lastname':
        if (input.value.trim() === '') {
          errors[inputId] = 'Please enter your last name.';
        }
        break;
      case 'dob':
        if (input.value.trim() === '') {
          errors[inputId] = 'Please enter your date of birth.';
        }
        break;
      case 'gender':
        if (input.value === '') {
          errors[inputId] = 'Please select your gender.';
        }
        break;
      case 'contact':
        if (input.value.trim() === '') {
          errors[inputId] = 'Please enter your contact number.';
        } else if (!/^\d{10}$/.test(input.value.trim())) {
          errors[inputId] = 'Please enter a valid 10-digit contact number.';
        }
        break;
      case 'email':
        if (input.value.trim() === '') {
          errors[inputId] = 'Please enter your email.';
        }
        break;
      case 'address':
        if (input.value.trim() === '') {
          errors[inputId] = 'Please enter your address.';
        }
        break;
      case 'pass':
        if (input.value.trim() === '') {
          errors[inputId] = 'Please enter a password.';
        } else if (input.value.trim().length < 6) {
          errors[inputId] = 'Password must have at least 6 characters.';
        }
        break;
      case 're_pass':
        if (input.value.trim() === '') {
          errors[inputId] = 'Please confirm your password.';
        } else if (input.value.trim() !== inputs['pass'].value.trim()) {
          errors[inputId] = 'Passwords did not match.';
        }
        break;
    }
  }

  // Display error messages
  for (const errorId in errors) {
    displayError(errorId, errors[errorId]);
  }

  // Prevent form submission if there are errors
  if (Object.keys(errors).length > 0) {
    return false;
  }
}

// Display error message
function displayError(inputId, message) {
  const errorElement = document.createElement('div');
  errorElement.className = 'error-message';
  errorElement.style.color = 'red';
  errorElement.style.marginTop = '5px';
  errorElement.innerHTML = `<i class="material-icons">error</i> ${message}`;

  const formGroup = input.parentElement.querySelector('.form-group');
  formGroup.appendChild(errorElement);
}

// Remove error message
function removeError(inputId) {
  const errorElement = document.querySelector(`#${inputId} + .error-message`);
  if (errorElement) {
    errorElement.remove();
  }
}

// Add event listener to form
registerForm.addEventListener('submit', function(event) {
  event.preventDefault();
  if (validateForm()) {
    registerForm.submit();
  }
});
</script> -->

    <!-- CSS for Modal -->
    <style>
        .error-message {
  display: flex;
  align-items: center;
  font-size: 14px;
  margin-top: 5px;
}

.error-message i {
  font-size: 18px;
  margin-right: 5px;
}
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</body>
</html>
