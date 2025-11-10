<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Academic Management System - UPSA</title>
  <?php include "dbConfig.php"; ?>
  
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
    }

    header {
      background: linear-gradient(135deg, #ff6b35 0%, #ff8c42 100%);
      text-align: center;
      padding: 25px;
      color: white;
      font-size: 28px;
      font-weight: bold;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .nav {
      background: linear-gradient(135deg, #d946a6 0%, #e879b9 100%);
      text-align: center;
      padding: 12px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .nav a {
      display: inline-block;
      border: 2px solid white;
      padding: 10px 25px;
      margin: 5px;
      text-decoration: none;
      background: white;
      color: #333;
      font-weight: bold;
      border-radius: 25px;
      transition: all 0.3s ease;
      cursor: pointer;
    }

    .nav a:hover,
    .nav a.active {
      background: linear-gradient(135deg, #ff6b35 0%, #ff8c42 100%);
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .tab-content {
      display: none;
      animation: fadeIn 0.5s;
    }

    .tab-content.active {
      display: block;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    .container {
      max-width: 1400px;
      margin: 20px auto;
      padding: 20px;
    }

    .section {
      background: white;
      border-radius: 15px;
      padding: 30px;
      margin-bottom: 30px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    h2 {
      color: #667eea;
      margin-bottom: 25px;
      font-size: 2rem;
      border-bottom: 4px solid #667eea;
      padding-bottom: 12px;
      text-align: center;
    }

    .form {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
      margin-bottom: 20px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
    }

    label {
      font-weight: 600;
      margin-bottom: 8px;
      color: #555;
      font-size: 1rem;
    }

    input, select, textarea {
      padding: 12px;
      border: 2px solid #ddd;
      border-radius: 8px;
      font-size: 1rem;
      transition: all 0.3s ease;
      font-family: inherit;
    }

    input:focus, select:focus, textarea:focus {
      outline: none;
      border-color: #667eea;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    input::placeholder {
      color: #999;
      font-style: italic;
    }

    textarea {
      resize: vertical;
      min-height: 100px;
    }

    input[type="radio"],
    input[type="checkbox"] {
      width: auto;
      margin-right: 8px;
    }

    .radio-group,
    .checkbox-group {
      border: 2px dashed #667eea;
      padding: 15px;
      border-radius: 8px;
      background: #f8f9ff;
    }

    .radio-group label,
    .checkbox-group label {
      display: flex;
      align-items: center;
      margin-bottom: 8px;
      font-weight: normal;
    }

    input[type="color"] {
      width: 80px;
      height: 45px;
      padding: 2px;
      cursor: pointer;
    }

    .button-group {
      grid-column: 1 / -1;
      display: flex;
      gap: 15px;
      justify-content: center;
      margin-top: 20px;
      flex-wrap: wrap;
    }

    .btn {
      padding: 14px 35px;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .btn-primary {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-secondary {
      background: #6c757d;
      color: white;
    }

    .btn-secondary:hover {
      background: #5a6268;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(108, 117, 125, 0.4);
    }

    .table-container {
      overflow-x: auto;
      margin-top: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    thead {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
    }

    th {
      padding: 16px;
      text-align: left;
      font-weight: 600;
      text-transform: uppercase;
      font-size: 0.9rem;
      letter-spacing: 0.5px;
    }

    td {
      padding: 14px 16px;
      border-bottom: 1px solid #eee;
    }

    tbody tr:hover {
      background: #f8f9fa;
    }

    .notification {
      position: fixed;
      top: 20px;
      right: 20px;
      padding: 15px 25px;
      border-radius: 8px;
      color: white;
      font-weight: 600;
      opacity: 0;
      transition: opacity 0.3s ease;
      z-index: 1000;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
      max-width: 300px;
    }

    .notification.show {
      opacity: 1;
    }

    .notification.success {
      background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    }

    .notification.error {
      background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
    }

    .footer {
      background: linear-gradient(135deg, #ff4500 0%, #ff6347 100%);
      text-align: center;
      padding: 20px;
      color: white;
      font-weight: bold;
      box-shadow: 0 -4px 15px rgba(0, 0, 0, 0.2);
    }

    #showDate {
      display: block;
      margin-top: 8px;
      font-size: 0.95em;
    }

    @media (max-width: 768px) {
      header {
        font-size: 20px;
        padding: 20px;
      }
      
      h2 {
        font-size: 1.5rem;
      }
      
      .form {
        grid-template-columns: 1fr;
      }
      
      .container {
        padding: 10px;
      }

      .nav a {
        padding: 8px 15px;
        margin: 3px;
        font-size: 0.9rem;
      }

      .section {
        padding: 20px;
      }
    }
  </style>
</head>
<body>
  <?php
    if(isset($_POST['cmdEnter'])){
      $fname = mysqli_real_escape_string($dbCon, $_POST['fname']);
      $sname = mysqli_real_escape_string($dbCon, $_POST['sname']);
      $gender = mysqli_real_escape_string($dbCon, $_POST['gender']);
      $langSpoken = isset($_POST['lang']) ? implode(', ', $_POST['lang']) : '';
      $dob = mysqli_real_escape_string($dbCon, $_POST['dob']);
      $level = mysqli_real_escape_string($dbCon, $_POST['lvl']);
      $email = mysqli_real_escape_string($dbCon, $_POST['emAdd']);
      $wgt = mysqli_real_escape_string($dbCon, $_POST['wgt']);
      $hgt = mysqli_real_escape_string($dbCon, $_POST['hgt']);
      $pword = mysqli_real_escape_string($dbCon, $_POST['pword']);
      
      $partOfFname = substr($fname, 0, 3);
      $uname = strtolower($partOfFname . "." . $sname);
      
      $sqlSt = "INSERT INTO registratIon (sName, fName, gender, langSpoken, dateOfBirth, sLevel, email, wgt, hgt, userName, pword) 
                VALUES('$sname','$fname','$gender','$langSpoken','$dob','$level','$email','$wgt','$hgt','$uname','$pword')";
      
      if(mysqli_query($dbCon, $sqlSt)){
        echo "<script>
          window.onload = function() {
            showNotification('Student registered successfully!', 'success');
          };
        </script>";
      } else {
        echo "<script>
          window.onload = function() {
            showNotification('Error: " . mysqli_error($dbCon) . "', 'error');
          };
        </script>";
      }
    }
  ?>

  <header id="greeting">Academic Management System</header>

  <div class="nav">
    <a class="active" onclick="showTab(event, 'student')">Student Info</a>
    <a onclick="showTab(event, 'courses')">Courses</a>
    <a onclick="showTab(event, 'exams')">Exam Results</a>
    <a onclick="showTab(event, 'records')">View Records</a>
  </div>

  <!-- Student Info Tab -->
  <div id="student" class="tab-content active">
    <div class="container">
      <div class="section">
        <h2>Student Registration Form</h2>
        <form method="POST" class="form">
          <div class="form-group">
            <label for="fname">First Name:</label>
            <input type="text" id="fname" name="fname" placeholder="Enter your first name" required>
          </div>

          <div class="form-group">
            <label for="sname">Surname:</label>
            <input type="text" id="sname" name="sname" placeholder="Enter your surname" required>
          </div>

          <div class="form-group" style="grid-column: 1 / -1;">
            <label>Select Your Gender:</label>
            <div class="radio-group">
              <label><input type="radio" name="gender" value="MALE" required> Male</label>
              <label><input type="radio" name="gender" value="FEMALE"> Female</label>
            </div>
          </div>

          <div class="form-group" style="grid-column: 1 / -1;">
            <label>Select all Languages Spoken:</label>
            <div class="checkbox-group">
              <label><input type="checkbox" name="lang[]" value="English" checked> English</label>
              <label><input type="checkbox" name="lang[]" value="French"> French</label>
              <label><input type="checkbox" name="lang[]" value="Twi"> Twi</label>
              <label><input type="checkbox" name="lang[]" value="Ga"> Ga</label>
              <label><input type="checkbox" name="lang[]" value="Ewe"> Ewe</label>
              <label><input type="checkbox" name="lang[]" value="Others"> Others</label>
            </div>
          </div>

          <div class="form-group">
            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required>
          </div>

          <div class="form-group">
            <label for="level">Level:</label>
            <select id="level" name="lvl" required>
              <option value="100">100</option>
              <option value="200">200</option>
              <option value="300">300</option>
              <option value="400">400</option>
            </select>
          </div>

          <div class="form-group">
            <label for="email">E-Mail Address:</label>
            <input type="email" id="email" name="emAdd" placeholder="student@upsa.edu.gh" required>
          </div>

          <div class="form-group">
            <label for="wgt">Weight (kg):</label>
            <input type="number" id="wgt" name="wgt" step="0.1" min="1" placeholder="e.g., 65.5">
          </div>

          <div class="form-group">
            <label for="hgt">Height (m):</label>
            <input type="number" id="hgt" name="hgt" step="0.01" min="0.1" placeholder="e.g., 1.75">
          </div>

          <div class="form-group">
            <label for="scode">Password:</label>
            <input type="password" id="scode" name="pword" placeholder="Enter password" required>
          </div>

          <div class="form-group">
            <label for="favcolor">Favourite Color:</label>
            <input type="color" id="favcolor" name="favcolor" value="#667eea">
          </div>

          <div class="button-group">
            <button type="submit" name="cmdEnter" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-secondary">Clear Form</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Courses Tab -->
  <div id="courses" class="tab-content">
    <div class="container">
      <div class="section">
        <h2>Course Information</h2>
        <div style="padding: 20px; text-align: center;">
          <h3 style="color: #667eea; margin-bottom: 20px;">Available Courses</h3>
          <ul style="list-style: none; padding: 0;">
            <li style="margin: 15px 0; padding: 15px; background: #f8f9ff; border-radius: 8px; border-left: 4px solid #667eea;">
              <strong>IT101</strong> - Introduction to Web Development (3 Credits)
            </li>
            <li style="margin: 15px 0; padding: 15px; background: #f8f9ff; border-radius: 8px; border-left: 4px solid #764ba2;">
              <strong>IT201</strong> - Database Management Systems (3 Credits)
            </li>
            <li style="margin: 15px 0; padding: 15px; background: #f8f9ff; border-radius: 8px; border-left: 4px solid #d946a6;">
              <strong>IT301</strong> - Software Engineering (4 Credits)
            </li>
            <li style="margin: 15px 0; padding: 15px; background: #f8f9ff; border-radius: 8px; border-left: 4px solid #ff6b35;">
              <strong>IT401</strong> - Advanced Programming (4 Credits)
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- Exams Tab -->
  <div id="exams" class="tab-content">
    <div class="container">
      <div class="section">
        <h2>Exam Results</h2>
        <div style="padding: 20px; text-align: center;">
          <p style="font-size: 1.2rem; color: #667eea;">Sample exam results will be displayed here</p>
          <div style="margin-top: 30px; padding: 20px; background: #f8f9ff; border-radius: 8px;">
            <h4 style="color: #764ba2;">PHP Programming Test Results</h4>
            <p style="margin-top: 10px;">15 students passed with marks above 50</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Records Tab -->
  <div id="records" class="tab-content">
    <div class="container">
      <div class="section">
        <h2>Student Registration Records</h2>
        <div class="table-container">
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Surname</th>
                <th>Gender</th>
                <th>Languages</th>
                <th>DOB</th>
                <th>Level</th>
                <th>Email</th>
                <th>Username</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $query = "SELECT * FROM registratIon ORDER BY ID DESC";
                $result = mysqli_query($dbCon, $query);
                
                if($result && mysqli_num_rows($result) > 0) {
                  while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['ID']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['fName']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['sName']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['langSpoken']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['dateOfBirth']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['sLevel']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['userName']) . "</td>";
                    echo "</tr>";
                  }
                } else {
                  echo '<tr><td colspan="9" style="text-align: center; color: #999;">No registration records found</td></tr>';
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="footer">
    Developed by UPSA Level 300 IT Students ®️
    <span id="showDate"></span>
  </div>

  <div id="notification" class="notification"></div>

  <script>
    function showNotification(message, type = 'success') {
      const notification = document.getElementById('notification');
      notification.textContent = message;
      notification.className = `notification ${type} show`;
      setTimeout(() => notification.classList.remove('show'), 3000);
    }

    function showTab(event, tabName) {
      event.preventDefault();
      document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
      document.querySelectorAll('.nav a').forEach(link => link.classList.remove('active'));
      document.getElementById(tabName).classList.add('active');
      event.currentTarget.classList.add('active');
    }

    function updateGreeting() {
      const now = new Date();
      const hours = now.getHours();
      const name = document.getElementById("fname").value.trim();
      let greeting = hours >= 6 && hours < 12 ? "Good Morning" : 
                     hours >= 12 && hours < 17 ? "Good Afternoon" : 
                     hours >= 17 && hours < 21 ? "Good Evening" : 
                     hours >= 21 && hours <= 23 ? "Good Night" : "Blessed Dawn";
      document.getElementById("greeting").textContent = name ? `${greeting}, ${name}! - Academic Management System` : "Academic Management System";
    }

    window.onload = function() {
      const date = new Date();
      const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
      const dd = String(date.getDate()).padStart(2, '0');
      const mm = String(date.getMonth() + 1).padStart(2, '0');
      document.getElementById("showDate").textContent = `Today is: ${days[date.getDay()]}, ${dd}/${mm}/${date.getFullYear()}`;
      updateGreeting();
      document.getElementById("fname").addEventListener("input", updateGreeting);
      
      const dobInput = document.getElementById('dob');
      const currentDate = new Date();
      const yy = currentDate.getFullYear() - 18;
      const m = String(currentDate.getMonth() + 1).padStart(2, '0');
      const d = String(currentDate.getDate()).padStart(2, '0');
      dobInput.max = `${yy}-${m}-${d}`;
    };
  </script>
</body>
</html>
