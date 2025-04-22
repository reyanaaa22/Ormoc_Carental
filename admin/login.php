<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $conn = new mysqli("localhost", "root", "", "ocrms");

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $admin = $result->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            // Store admin info in session
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['first_name'] . " " . $admin['last_name'];
            $_SESSION['admin_email'] = $admin['email'];
            $_SESSION['admin_pic'] = "admin-pic.jpg"; // optional: store profile image filename

            header("Location: dashboard.php"); // redirect to dashboard
            exit();
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "Admin not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <style>
    /* General Styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #004153;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    /* Container Styles */
    .container {
      background-color: #fff;
      width: 400px;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Title */
    .title {
      font-size: 24px;
      font-weight: bold;
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    /* Form Styles */
    .user-details {
      margin-bottom: 20px;
    }

    .input-box {
      margin-bottom: 15px;
    }

    .input-box span {
      font-size: 14px;
      color: #555;
      display: block;
      margin-bottom: 5px;
    }

    .input-box input {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 5px;
      outline: none;
    }

    .input-box input:focus {
      border-color: #0066cc;
    }

    /* Button Styles */
    .button {
      display: flex;
      justify-content: center;
    }

    .button input {
      width: 100%;
      padding: 12px;
      background-color: #0066cc;
      color: #fff;
      font-size: 16px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .button input:hover {
      background-color: #005bb5;
    }

    /* Error Message */
    p {
      text-align: center;
      font-size: 14px;
      color: red;
      margin-top: 10px;
    }

    /* Additional Links Styles */
    .links {
      text-align: center;
      margin-top: 15px;
    }

    .links a {
      color: #0066cc;
      text-decoration: none;
      font-size: 14px;
      margin: 0 10px;
    }

    .links a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="title">Login</div>
    <form method="POST" action="">
      <div class="user-details">
        <div class="input-box">
          <span class="details">Email</span>
          <input type="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="input-box">
          <span class="details">Password</span>
          <input type="password" name="password" placeholder="Enter your password" required>
        </div>
      </div>

      <div class="button">
        <input type="submit" value="Login">
      </div>

      <?php
      if (isset($error)) {
          echo "<p>$error</p>";
      }
      ?>

    </form>

    <!-- Forgot Password and Register Links -->
    <div class="links">
      <a href="forgot-password.php">Forgot Password?</a> | 
      <a href="register.php">Register</a>
    </div>
  </div>
</body>
</html>
