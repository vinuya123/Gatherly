<?php
session_start(); // Start the session to access user details

// Check if user details are set in the session; if not, you can redirect or show an error
if (!isset($_SESSION['name'], $_SESSION['email'], $_SESSION['bio'], $_SESSION['profile_pic'])) {
    // Redirect to edit profile page if not set
    header("Location: Edit Profile.php"); // Change this to your desired redirection
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Event Manager</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Profile section */
        .profile-section {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
            padding: 20px;
        }
        .profile-picture {
            width: 150px;
            height: 150px;
            background-color: lightgray;
            border-radius: 50%;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 50px;
            position: relative;
            cursor: pointer;
        }
        .profile-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }
        .profile-name {
            font-size: 24px;
            font-weight: bold;
            margin-top: 10px;
        }
        .profile-description {
            margin: 15px 0;
            font-size: 16px;
        }
        .edit-button {
            margin: 10px 0;
            padding: 8px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
        }
        .edit-button:hover {
            background-color: #0056b3;
        }
        .social-links a {
            margin: 0 10px;
            font-size: 24px;
            color: #333;
            text-decoration: none;
        }
        .social-links a:hover {
            color: #007BFF;
        }
        /* Dropdown menu styles */
        .dropdown-menu {
            display: none;
            position: absolute;
            top: 50px;
            right: 20px;
            background-color: white;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 5px;
            padding: 10px;
            width: 150px;
        }
        .dropdown-item {
            padding: 10px;
            display: block;
            color: #333;
            text-decoration: none;
        }
        .dropdown-item:hover {
            background-color: #f1f1f1;
        }
        /* Footer styles */
        .footer {
            text-align: left;
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: transparent;
            color: #000;
        }
        .footer p {
            margin: 0;
            padding: 10px 20px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-left">
            <a href="Home.html" class="nav-item home-link">
                <i class="fas fa-home"></i> Home
            </a>
        </div>
        <div class="nav-right">
            <a href="Events.html" class="nav-item">Events</a>
            <a href="About.html" class="nav-item">About</a>
            <a href="Profile.php" class="nav-item profile-icon">
                <i class="fas fa-user-circle"></i> 
            </a>
            <a href="#" class="nav-item menu-icon" onclick="toggleDropdown()">
                <i class="fas fa-bars"></i> <!-- Menu icon -->
            </a>
            <!-- Dropdown menu -->
            <div id="dropdown-menu" class="dropdown-menu">
                <a href="Login.html" class="dropdown-item">Login</a>
                <a href="Register.html" class="dropdown-item">Register</a>
            </div>
        </div>
    </nav>

    <!-- Profile Section -->
    <div class="profile-section">
    <div class="profile-picture">
        <img src="<?php echo htmlspecialchars($_SESSION['profile_pic']); ?>" alt="Profile Picture">
    </div>
    <div class="profile-name"><?php echo htmlspecialchars($_SESSION['name']); ?></div>
    
    <!-- Profile Bio -->
    <div class="profile-description">
        <?php echo htmlspecialchars($_SESSION['bio']); ?>
    </div>
    
    <!-- Email Display -->
    <div class="profile-email">
        <?php echo htmlspecialchars($_SESSION['email']); ?>
    </div>
    
    <!-- Edit Profile Button -->
    <a href="Edit Profile.php" class="edit-button">Edit Profile</a>

    <!-- Social Links -->
    <div class="social-links">
        <a href="https://linkedin.com" target="_blank"><i class="fab fa-linkedin"></i></a>
        <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
    </div>
</div>


    <!-- JavaScript for Dropdown -->
    <script>
        function toggleDropdown() {
            var dropdown = document.getElementById("dropdown-menu");
            dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
        }

        // Close dropdown when clicking outside
        window.onclick = function(event) {
            if (!event.target.matches('.menu-icon') && !event.target.matches('.fas')) {
                var dropdown = document.getElementById("dropdown-menu");
                if (dropdown.style.display === "block") {
                    dropdown.style.display = "none";
                }
            }
        }
    </script>
    
    <!-- Footer -->
    <footer class="footer">
        <p>© 2024 Event Management. All rights reserved.</p>
    </footer>
</body>
</html>
