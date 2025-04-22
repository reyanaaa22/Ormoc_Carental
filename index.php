<?php  
session_start();  
$conn = new mysqli("localhost", "root", "", "ocrms");  

if ($conn->connect_error) {  
    die("Connection failed: " . $conn->connect_error);  
}  

// Handle login  
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {  
    $email = trim($_POST["email"]);  
    $password = $_POST["password"];  

    $stmt = $conn->prepare("SELECT id, first_name, password FROM users WHERE email = ?");  
    $stmt->bind_param("s", $email);  
    $stmt->execute();  
    $stmt->bind_result($user_id, $first_name, $hashed_password);  

    if ($stmt->fetch() && password_verify($password, $hashed_password)) {  
        $_SESSION['user_id'] = $user_id;  
        $_SESSION['first_name'] = $first_name;  
        $_SESSION['email'] = $email;  
        header("Location: dashboard.php");  
        exit();  
    } else {  
        $_SESSION['error'] = "Invalid email or password.";  
    }  

    $stmt->close();  
}  
?>  
<!DOCTYPE html>  
<html lang="en">  
<head>  
  <meta charset="UTF-8">  
  <title>Ormoc Car Rental</title>  
  <link rel="stylesheet" href="style.css">  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">    

  <script>  
    function toggleMenu() {  
      const menu = document.getElementById('mobileMenu');  
      menu.classList.toggle('show');  
    }  

    // Optional: close sidebar if user clicks outside of it  
    window.addEventListener('click', function(e) {  
      const sidebar = document.getElementById('mobileMenu');  
      const hamburger = document.querySelector('.hamburger-menu');  
      // Check if the sidebar is open AND the click is not inside the sidebar AND the click is not on the hamburger menu  
      if (sidebar.classList.contains('show') &&  
        !sidebar.contains(e.target) &&  
        !hamburger.contains(e.target)) {  
        sidebar.classList.remove('show');  
      }  
    });  


    function toggleLoginForm() {  
      const form = document.getElementById('loginForm');  
      form.style.display = form.style.display === 'block' ? 'none' : 'block';  
      // Close register form if it's open  
      document.getElementById('registerForm').style.display = 'none';  
    }  

    function toggleRegisterForm() {  
      const form = document.getElementById('registerForm');  
      form.style.display = form.style.display === 'block' ? 'none' : 'block';  
       // Close login form if it's open  
      document.getElementById('loginForm').style.display = 'none';  
    }  
  </script>  
</head>  
<body>  
<header class="top-header">  
  <div class="container">  
    Welcome to Ormoc Car Rental - Call us at (956) 783-3665
  </div>  
</header>  

<header class="main-header">  
  <div class="header-left">  
    <!-- Hamburger Menu -->  
    <div class="hamburger-menu" onclick="toggleMenu()">☰</div>  
    <!-- Logo -->  
    <img src="images/logo.png" alt="Logo" class="main-logo">  
  </div>  

  <!-- Top Navigation Bar -->  
  <nav class="top-nav">  
    <ul>  
      <li><a href="#"><i class="fas fa-car"></i> Manage bookings</a></li>  
      <li><a href="#">🌐 EN</a></li>  
      <li>  
        <a href="javascript:void(0);" onclick="toggleLoginForm()">  
          <i class="fas fa-user"></i> Log in | Register  
        </a>  
      </li>  
    </ul>  
  </nav>  
</header>  

<!-- Sidebar Hamburger Menu -->  
<div id="mobileMenu" class="sidebar">  
  <div class="sidebar-header">  
    <span class="close-btn" onclick="toggleMenu()">✕</span>  
    <img src="images/logo.png" alt="Logo" class="sidebar-logo">  
  </div>  
  <ul class="menu-items">  
    <li><a href="#home" onclick="toggleMenu()">Car Rental</a></li>  
    <li><a href="#explore" onclick="toggleMenu()">Explore Us</a></li>  
    <li><a href="#about" onclick="toggleMenu()">About</a></li>  
    <li><a href="contact.php">Contact Us</a></li>
    <li><a href="#rrj" onclick="toggleMenu()">RRJ<br><small>Car Subscription</small></a></li>  
    <li><a href="#business" onclick="toggleMenu()">Business</a></li>  
  </ul>  
</div>  

<div id="loginForm" class="form-container" style="display:none;">  
  <span class="close" onclick="toggleLoginForm()">&times;</span>  
  <h2>Sign In</h2>  
  <?php if (isset($_SESSION['error'])): ?>  
      <div class="error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>  
  <?php endif; ?>  
  <form method="POST" action="">  
      <input type="email" name="email" placeholder="Email" required>  
      <input type="password" name="password" placeholder="Password" required>  

      <div style="display: flex; justify-content: space-between; margin-top: 5px; margin-bottom: 10px; font-size: 14px;">  
          <a href="#" style="text-decoration: none; color: #7d2ae8;">Forgot password?</a>  
          <a href="#" onclick="toggleRegisterForm(); return false;" style="text-decoration: none; color: #7d2ae8;">Register</a>  
      </div>  

      <input type="submit" name="login" value="Login">  
  </form>  
  <div class="social-login">  
      <p>Or sign in with</p>  
      <div class="social-icons">  
          <a href="#"><img src="facebook-icon.png" alt="Facebook"></a>  
          <a href="#"><img src="google-icon.png" alt="Google"></a>  
          <a href="#"><img src="linkedin-icon.png" alt="LinkedIn"></a>  
      </div>  
  </div>  
</div>  

<!-- Register Form -->  
<div id="registerForm" class="form-container" style="display:none;">  
  <span class="close" onclick="toggleRegisterForm()">&times;</span>  
  <h2>Sign Up</h2>  
  <form method="POST" action="register.php">  
      <input type="text" name="full_name" placeholder="Full Name" required>  
      <input type="email" name="email" placeholder="Email" required>  
      <input type="text" name="contact_number" placeholder="Contact Number" required>  
      <input type="password" name="password" placeholder="Password" required>  
      <input type="password" name="confirm_password" placeholder="Confirm Password" required>  
      <input type="submit" value="Sign Up">  
  </form>  
</div>  

<section class="hero" id="home">  
  <div class="hero-text">  
    <h1>Ormoc Car Rental Service</h1>  
    <p class="tagline">Your journey starts here — fast, safe, and affordable car rentals in Ormoc.</p>  
    <div class="hero-buttons">  
      <button class="book" onclick="location.href='book.php'">Book Now</button>  
      <button class="explore" onclick="location.href='explore.php'">Explore Us</button>  
    </div>  
  </div>  
  <img src="images/blue.png" alt="Car">  
  <div class="wave">  
    <svg viewBox="0 0 1200 120" preserveAspectRatio="none">  
      <path d="M0,0 C300,100 900,0 1200,100 L1200,120 L0,120 Z"></path>  
    </svg>  
  </div>  
</section>  
<section class="best-car" id="best-car">  
  <div class="container">  
    <h2>Find the Best Car for You</h2>  
    <p>Select from our wide range of well-maintained vehicles perfect for every journey.</p>  

    <div class="car-list">  
      <div class="car-card">  
        <img src="images/toyota-vios.jpg" alt="Toyota Vios">  
        <h3>Toyota Vios</h3>  
        <p>₱1,500/day • Automatic • 5 Seats</p>  
        <button onclick="location.href='book.php'">Rent Now</button>  
      </div>  

      <div class="car-card">  
        <img src="images/mitsubishi-adventure.jpg" alt="Mitsubishi Adventure">  
        <h3>Mitsubishi Adventure</h3>  
        <p>₱1,800/day • Manual • 7 Seats</p>  
        <button onclick="location.href='book.php'">Rent Now</button>  
      </div>  

      <div class="car-card">  
        <img src="images/ford-ecosport.jpg" alt="Ford EcoSport">  
        <h3>Ford EcoSport</h3>  
        <p>₱2,000/day • Automatic • 5 Seats</p>  
        <button onclick="location.href='book.php'">Rent Now</button>  
      </div>  
    </div>  
  </div>  
</section>  

<section class="car-clips" id="car-clips">  
  <div class="car-clips-container">  
    <div class="car-text">  
      <h2>Experience Quality Car Rentals</h2>  
      <p>We offer reliable, clean, and affordable cars perfect for any trip around Ormoc City and beyond.  
         Watch some clips of our fleet in action and see why customers love our service!</p>  
      <ul>  
        <li>✅ Easy Booking Process</li>  
        <li>✅ Clean and Well-Maintained Cars</li>  
        <li>✅ Affordable Daily Rates</li>  
        <li>✅ Convenient Pickup Locations</li>  
      </ul>  
    </div>  

    <div class="car-videos">  
      <video src="videos/car1.mp4" controls></video>  
      <video src="videos/car2.mp4" controls></video>  
    </div>  
  </div>  
</section>  


<section class="about">  
  <div class="about-content">  
  <h2 style="text-align: center;">About Us</h2>  
  <p>Welcome to <strong>Ormoc Car Rental</strong> — your trusted partner for reliable and affordable vehicle rentals in Ormoc City.</p>  
    <ul>  

    </ul>  
  </div>  
  <div class="about-image">  
    <img src="images/blue.png" alt="Car Rental Service Image">  
  </div>  
</section>  

<section class="newsletter" id="newsletter">  
  <div class="newsletter-container">  
    <h2>Subscribe to Our Newsletter</h2>  
    <p>Get the latest updates, special promos, and exclusive car rental deals straight to your inbox.</p>  
    <form class="subscribe-form" action="#" method="post">  
      <input type="email" name="email" placeholder="Enter your email address" required>  
      <button type="submit">Subscribe</button>  
    </form>  
  </div>  
</section>  
<footer style="background: #222; color: #fff; padding: 30px 20px; text-align: center;">
  <div style="max-width: 1200px; margin: auto;">
    <h3>Ormoc Car Rental Service</h3>
    <p>&copy; 2025 Ormoc Car Rental. All rights reserved.</p>

    <div style="margin: 15px 0;">
      <p><strong>Phone:</strong> +63 912 345 6789</p>
      <p><strong>Email:</strong> contact@ormoccarrental.com</p>
      <p><strong>Location:</strong> Brgy. Cogon, Ormoc City, Leyte</p>
    </div>

    <div style="margin-top: 20px;">
      <a href="#"><img src="images/FB.jpg" alt="Facebook" style="height: 30px; margin: 0 10px;"></a>
      <a href="#"><img src="images/google.png" alt="Google" style="height: 30px; margin: 0 10px;"></a>
      <a href="#"><img src="images/linkedin-icon.png" alt="LinkedIn" style="height: 30px; margin: 0 10px;"></a>
    </div>
  </div>
</footer>

</body>  
</html>  