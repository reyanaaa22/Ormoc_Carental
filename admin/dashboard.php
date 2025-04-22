<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// You can now use these session variables:
$adminName = $_SESSION['admin_name'];
$adminPic = $_SESSION['admin_pic']; // optional
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      display: flex;
    }

    header {
      height: 60px;
      background-color: #004153;
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 10px;
      position: fixed;
      top: 0;
      left: 250px;
      right: 0;
      transition: left 0.3s;
      z-index: 1000;
    }

    .collapsed header {
      left: 70px;
    }

    .header-left .hamburger {
      font-size: 24px;
      cursor: pointer;
    }

    .header-right {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .notification-icon {
      font-size: 20px;
      cursor: pointer;
    }

    .profile-container {
      display: flex;
      align-items: center;
      cursor: pointer;
      position: relative;
    }

    .profile-container img {
      width: 35px;
      height: 35px;
      border-radius: 50%;
      margin-right: 10px;
    }

    .dropdown-menu {
      display: none;
      position: absolute;
      top: 50px;
      right: 0;
      background-color: white;
      color: black;
      border: 1px solid #ccc;
      border-radius: 5px;
      width: 180px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.15);
      z-index: 1001;
    }

    .dropdown-menu a {
      display: block;
      padding: 10px;
      text-decoration: none;
      color: #004153;
    }

    .dropdown-menu a:hover {
      background-color: #f0f0f0;
    }

    .sidebar {
      width: 250px;
      background-color: #004153;
      color: white;
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      overflow-y: auto;
      transition: width 0.3s;
      padding-top: 60px;
    }

    .collapsed .sidebar {
      width: 70px;
    }

    .sidebar .logo {
      display: flex;
      justify-content: center;
      margin-bottom: 20px;
    }

    .sidebar .logo img {
      width: 130px;
      height: 120px;
    }

    .sidebar ul {
      list-style: none;
      padding: 0;
    }

    .sidebar ul li {
      margin-bottom: 10px;
    }

    .sidebar ul li a {
      color: white;
      text-decoration: none;
      font-size: 16px;
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 20px;
      border-radius: 4px;
    }

    .sidebar ul li a:hover {
      background-color: #035c6e;
    }

    .collapsed .sidebar ul li a span {
      display: none;
    }

    .submenu {
      margin-left: 20px;
      display: none;
    }

    .collapsed .submenu {
      display: none !important;
    }

    .main-content {
      margin-left: 250px;
      padding: 80px 20px 20px;
      background-color: #f4f4f4;
      min-height: 100vh;
      transition: margin-left 0.3s;
      flex-grow: 1;
      width: 100%;
    }

    .collapsed .main-content {
      margin-left: 70px;
    }

    .toggle-arrow::after {
      content: "▼";
      float: right;
      transition: transform 0.3s;
    }

    .toggle-arrow.active::after {
      transform: rotate(-180deg);
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <div class="logo">
      <img src="images/logo.png" alt="Logo">
    </div>
    <ul>
      <li><a href="#" data-page="dashboard.php" id="dashboardLink">📊 <span>Dashboard</span></a></li>
      <li>
        <a class="toggle-arrow">🏷️ <span>Brands</span></a>
        <ul class="submenu">
          <li><a href="#" data-page="create_brand.php">➕ <span>Create Brand</span></a></li>
          <li><a href="#" data-page="manage_brand.php">🛠️ <span>Manage Brands</span></a></li>
        </ul>
      </li>
      <li>
        <a class="toggle-arrow">🚗 <span>Vehicles</span></a>
        <ul class="submenu">
          <li><a href="#" data-page="post_vehicles.php">➕ <span>Post Vehicles</span></a></li>
          <li><a href="#" data-page="manage_vehicles.php">🛠️ <span>Manage Vehicles</span></a></li>
        </ul>
      </li>
      <li><a href="#" data-page="manage_bookings.php">📅 <span>Manage Booking</span></a></li>
      <li><a href="#" data-page="contact.php">📨 <span>Contact Us</span></a></li>
      <li><a href="#" data-page="users.php">👥 <span>Registered Users</span></a></li>
      <li><a href="#" data-page="page.php">📄 <span>Manage Pages</span></a></li>
      <li><a href="#" data-page="update_contact.php">📞 <span>Update Contact Info</span></a></li>
      <li><a href="#" data-page="manageSub.php">📧 <span>Subscribers</span></a></li>
    </ul>
  </div>

  <header>
    <div class="header-left">
      <div class="hamburger" onclick="toggleSidebar()">☰</div>
    </div>
    <div class="header-right">
      <div class="notification-icon" title="Notifications">&#128276;</div>
      <div class="profile-container" onclick="toggleDropdown()">
        <img src="<?php echo $adminPic; ?>" alt="Admin Profile" />
        <span><?php echo $adminName; ?></span>
        <div class="dropdown-menu" id="profileDropdown">
          <a href="#">Change Profile Info</a>
          <a href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </header>

  <div class="main-content" id="mainContent">
    <h2>Welcome to the Admin Dashboard</h2>
    <p>Select a menu item from the sidebar to get started.</p>
  </div>

  <script>
    // Default content for the dashboard
    document.addEventListener("DOMContentLoaded", function () {
      const mainContent = document.querySelector('.main-content');
      mainContent.innerHTML = `
        <h2>Welcome to the Admin Dashboard</h2>
        <p>Select a menu item from the sidebar to get started.</p>
      `;

      // Load PHP content dynamically
      document.querySelectorAll('.sidebar a[data-page]').forEach(link => {
        link.addEventListener('click', function(e) {
          e.preventDefault();
          const page = this.getAttribute('data-page');

          // If the link clicked is for dashboard
          if (page === "dashboard.php") {
            mainContent.innerHTML = `
              <h2>Welcome to the Admin Dashboard</h2>
              <p>Select a menu item from the sidebar to get started.</p>
            `;
          } else {
            // Load other pages
            fetch(page)
              .then(response => {
                if (!response.ok) throw new Error("Failed to load content");
                return response.text();
              })
              .then(data => {
                mainContent.innerHTML = data;
              })
              .catch(error => {
                mainContent.innerHTML = `<p style="color:red;">Error: ${error.message}</p>`;
              });
          }
        });
      });
    });

    // Toggle submenu display
    document.querySelectorAll('.toggle-arrow').forEach(item => {
      item.addEventListener('click', () => {
        const submenu = item.nextElementSibling;
        if (!document.body.classList.contains("collapsed")) {
          submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
          item.classList.toggle('active');
        }
      });
    });

    // Toggle dropdown
    function toggleDropdown() {
      const dropdown = document.getElementById("profileDropdown");
      dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
    }

    window.addEventListener("click", function(e) {
      const profile = document.querySelector(".profile-container");
      const dropdown = document.getElementById("profileDropdown");
      if (!profile.contains(e.target)) {
        dropdown.style.display = "none";
      }
    });

    // Toggle sidebar collapse
    function toggleSidebar() {
      document.body.classList.toggle('collapsed');
    }
  </script>
</body>
</html>
