<?php
// Include the database connection file
include('db.php');

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $gender = isset($_POST['gender']) ? implode(", ", $_POST['gender']) : "";

    // Handle image upload
    $targetDir = "uploads/";
    $imageName = basename($_FILES["profile_image"]["name"]);
    $targetFile = $targetDir . $imageName;

    if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $targetFile)) {
        // Insert into database
        $sql = "INSERT INTO admin (first_name, last_name, email, phone_number, password, gender, profile_image) 
                VALUES ('$first_name', '$last_name', '$email', '$phone_number', '$password', '$gender', '$imageName')";

        if ($conn->query($sql) === TRUE) {
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Failed to upload image.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registration Form</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: Arial, sans-serif;
      background-color: #004153;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .container {
      background-color: #fff;
      width: 800px;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
      text-align: center;
    }
    .title {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
      color: #333;
    }
    .user-details {
      margin-bottom: 20px;
    }
    .name-row {
      display: flex;
      gap: 20px;
      justify-content: space-between;
      margin-bottom: 15px;
    }
    .name-row .input-box {
      flex: 1;
    }
    .input-box {
      margin-bottom: 15px;
    }
    .input-box span {
      font-size: 14px;
      color: #555;
      display: block;
      margin-bottom: 5px;
      text-align: left;
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
    .gender-details {
      margin-bottom: 20px;
      text-align: left;
    }
    .gender-title {
      font-size: 14px;
      color: #555;
      margin-bottom: 10px;
    }
    .checkbox-group {
      display: flex;
      gap: 20px;
    }
    .checkbox-group label {
      display: flex;
      align-items: center;
      gap: 5px;
      font-size: 14px;
      color: #555;
    }
    .button {
      margin-top: 20px;
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
    p {
      text-align: center;
      font-size: 14px;
      color: red;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="title">Registration</div>
    <form method="POST" action="" enctype="multipart/form-data">
      <div class="user-details">
        <div class="name-row">
          <div class="input-box">
            <span class="details">First Name</span>
            <input type="text" name="first_name" placeholder="Enter your First Name" required>
          </div>
          <div class="input-box">
            <span class="details">Last Name</span>
            <input type="text" name="last_name" placeholder="Enter your Last Name" required>
          </div>
        </div>
        <div class="input-box">
          <span class="details">Email</span>
          <input type="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="input-box">
          <span class="details">Phone Number</span>
          <input type="text" name="phone_number" placeholder="Enter your phone number" required>
        </div>
        <div class="input-box">
          <span class="details">Password</span>
          <input type="password" name="password" placeholder="Enter your password" required>
        </div>
        <div class="input-box">
          <span class="details">Confirm Password</span>
          <input type="password" name="confirm_password" placeholder="Confirm your password" required>
        </div>

        <div class="input-box">
          <span class="details">Profile Picture</span>
          <input type="file" name="profile_image" accept="image/*" required>
        </div>
      </div>

      <div class="gender-details">
        <span class="gender-title">Gender</span>
        <div class="checkbox-group">
          <label><input type="checkbox" name="gender[]" value="Male"> Male</label>
          <label><input type="checkbox" name="gender[]" value="Female"> Female</label>
        </div>
      </div>

      <div class="button">
        <input type="submit" value="Register">
      </div>
    </form>
  </div>
</body>
</html>
