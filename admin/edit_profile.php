<?php
session_start();
include 'includes/db.php';

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

if (!empty($password)) {
  $password = password_hash($password, PASSWORD_DEFAULT);
  $sql = "UPDATE admins SET name='$name', email='$email', password='$password' WHERE id=$id";
} else {
  $sql = "UPDATE admins SET name='$name', email='$email' WHERE id=$id";
}

if ($conn->query($sql) === TRUE) {
  $_SESSION['admin_name'] = $name;
  echo "<script>alert('Profile updated successfully');window.location='index.php';</script>";
} else {
  echo "Error updating record: " . $conn->error;
}
