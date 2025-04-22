<?php
session_start();
$conn = new mysqli("localhost", "root", "", "ocrms");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $first_name = trim($_POST["first_name"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Check if the email already exists
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $_SESSION['error'] = "Email is already registered.";
        header("Location: index.php");
        exit();
    }

    $check->close();

    // Insert new user
    $stmt = $conn->prepare("INSERT INTO users (first_name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $first_name, $email, $password);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Registration successful. Please log in.";
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['error'] = "Registration failed. Please try again.";
        header("Location: index.php");
        exit();
    }

    $stmt->close();
}
?>
