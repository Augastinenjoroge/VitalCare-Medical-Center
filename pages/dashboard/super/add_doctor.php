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
          <h2>Add Docter</h2>
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
              <form method="POST" action="config/add_doctor.php">
                <fieldset>
                  <div class="field">
                    <label class="label_field">First Name</label>
                    <input type="text" name="FirstName" placeholder="First Name" required />
                  </div>
                  <div class="field">
                    <label class="label_field">Last Name</label>
                    <input type="text" name="LastName" placeholder="Last Name" required />
                  </div>
                  <div class="field">
                    <label class="label_field">Department</label>
                    <select name="DepartmentID" id="DepartmentID" class="error-message" required>
                      <option value="">Select Department</option>
                      <?php
                      // Fetch departments from the database
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

                      $sql = "SELECT DepartmentID, DepartmentName FROM Departments";
                      $result = $conn->query($sql);

                      if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                          echo "<option value='" . $row["DepartmentID"] . "'>" . $row["DepartmentName"] . "</option>";
                        }
                      } else {
                        echo "<option value=''>No departments available</option>";
                      }
                      $conn->close();
                      ?>
                    </select>
                  </div>
                  <div class="field">
                    <label class="label_field">Contact_Number</label>
                    <input type="text" name="ContactNumber" placeholder="Contact Number" required />
                  </div>
                  <div class="field">
                    <label class="label_field">Email Address</label>
                    <input type="email" name="Email" placeholder="E-mail" required />
                  </div>
                  <div class="field">
                    <label class="label_field">Address</label>
                    <input type="text" name="Address" placeholder="Address" required />
                  </div>
                  <div class="field">
                    <label class="label_field">Password</label>
                    <input type="password" name="Password" placeholder="Password" required />
                  </div>
                  <div class="field">
                    <label class="label_field">Re-Password</label>
                    <input type="password" name="RePassword" placeholder="Re-Password" required />
                  </div>
                  <div class="field margin_0">
                    <label class="label_field hidden">hidden label</label>
                    <button type="submit" class="main_bt">Submit</button>
                  </div>
                </fieldset>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- footer -->

<?php
include('nav/footer.php');

?>