<?php
session_start();
include 'includes/db.php';

$admin_id = $_SESSION['admin_id'];

$sql = "SELECT * FROM admins WHERE id = $admin_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Change Profile Info</title>
</head>
<body>
  <h2>Update Profile Info</h2>
  <form action="update_profile.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $admin_id; ?>">
    <label>Name:</label><br>
    <input type="text" name="name" value="<?php echo $row['name']; ?>"><br><br>
    <label>Email:</label><br>
    <input type="email" name="email" value="<?php echo $row['email']; ?>"><br><br>
    <label>Change Password (optional):</label><br>
    <input type="password" name="password"><br><br>
    <button type="submit">Update</button>
  </form>
</body>
</html>
