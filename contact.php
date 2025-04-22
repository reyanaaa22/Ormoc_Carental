<?php
$name = $email = $message = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = htmlspecialchars($_POST["name"]);
  $email = htmlspecialchars($_POST["email"]);
  $message = htmlspecialchars($_POST["message"]);

  // You can also save to database or send email here
  $success = "Thank you, $name! We have received your message.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Us</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f5f5;
      padding: 20px;
    }
    .contact-form {
      background: #fff;
      padding: 30px;
      max-width: 500px;
      margin: auto;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .contact-form h2 {
      margin-bottom: 20px;
    }
    .contact-form input, .contact-form textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
    }
    .contact-form button {
      background: #007bff;
      color: white;
      padding: 10px 20px;
      border: none;
      cursor: pointer;
    }
    .success-message {
      background-color: #d4edda;
      color: #155724;
      padding: 10px;
      border: 1px solid #c3e6cb;
      margin-bottom: 15px;
    }
  </style>
</head>
<body>

<div class="contact-form">
  <h2>Contact Us</h2>

  <?php if (!empty($success)): ?>
    <div class="success-message"><?php echo $success; ?></div>
  <?php endif; ?>

  <form method="POST" action="contact.php">
    <input type="text" name="name" placeholder="Your Name" required value="<?php echo htmlspecialchars($name); ?>">
    <input type="email" name="email" placeholder="Your Email" required value="<?php echo htmlspecialchars($email); ?>">
    <textarea name="message" placeholder="Your Message" rows="6" required><?php echo htmlspecialchars($message); ?></textarea>
    <button type="submit">Send Message</button>
  </form>
</div>

</body>
</html>
