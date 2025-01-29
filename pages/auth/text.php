<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="POST" class="register-form" id="register-form" action="config/auth.php">

<div class="form-group">
  <label for="firstname"><i class="zmdi zmdi-account material-icons-name"></i></label>
  <input type="text" name="firstname" id="firstname" placeholder="First Name" />
</div>
<div class="form-group">
  <label for="lastname"><i class="zmdi zmdi-account material-icons-name"></i></label>
  <input type="text" name="lastname" id="lastname" placeholder="Last Name" />
</div>
<div class="form-group">
  <label for="dob"><i class="zmdi zmdi-calendar-alt"></i></label>
  <input type="date" name="dob" id="dob" placeholder="Date of Birth" />
</div>
<div class="form-group">
  <label for="gender"><i class="zmdi zmdi-male-female"></i></label>

  <select name="gender" id="gender">
    <option value="">Select Gender</option>
    <option value="Male">Male</option>
    <option value="Female">Female</option>
  </select>
</div>
<div class="form-group">
  <label for="contact"><i class="zmdi zmdi-phone"></i></label>
  <input type="tel" name="contact" id="contact" placeholder="Contact Number"/>
</div>
<div class="form-group">
  <label for="email"><i class="zmdi zmdi-email"></i></label>
  <input type="email" name="email" id="email" placeholder="Your Email"/>
</div>
<div class="form-group">
  <label for="address"><i class="zmdi zmdi-pin"></i></label>
  <input type="text" name="address" id="address" placeholder="Address"/>
</div>
<div class="form-group">
  <label for="pass"><i class="zmdi zmdi-lock"></i></label>
  <input type="password" name="pass" id="pass" placeholder="Password"/>
</div>
<div class="form-group">
  <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
  <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password"/>
</div>
<div class="form-group">
  <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
  <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in <a href="#" class="term-service">Terms of service</a></label>
</div>
<div class="form-group form-button">
  <input type="submit" name="signup" id="signup" class="form-submit" value="Register" />
</div>
</form>
</body>
</html>