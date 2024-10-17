<?php
session_start(); // Start the session

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize user inputs
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $bio = htmlspecialchars(trim($_POST['bio']));
    
    // Handle the file upload
    $profile_pic = ''; // Initialize profile picture variable

    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
        // Specify the directory where the file will be uploaded
        $upload_dir = 'uploads/'; // Make sure this directory exists and is writable
        $file_name = basename($_FILES['profile_pic']['name']);
        $target_file = $upload_dir . uniqid() . '-' . $file_name; // Create a unique file name

        // Check file type
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['profile_pic']['type'], $allowed_types)) {
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target_file)) {
                // Set the profile picture path in the session
                $profile_pic = $target_file;
            } else {
                // Handle error in file upload
                echo "Error uploading file.";
            }
        } else {
            echo "Unsupported file type.";
        }
    } else {
        // If no new file uploaded, keep the existing one
        $profile_pic = $_SESSION['profile_pic'] ?? '';
    }

    // Update the session variables with new data
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    $_SESSION['bio'] = $bio;
    $_SESSION['profile_pic'] = $profile_pic;

    // Redirect to the profile page
    header("Location: Profile.php");
    exit();
}

// Fetch the existing user details from the session for displaying in the form
$name = $_SESSION['name'] ?? '';
$email = $_SESSION['email'] ?? '';
$bio = $_SESSION['bio'] ?? '';
$profile_pic = $_SESSION['profile_pic'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Event Manager</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea {
            resize: vertical;
            height: 100px;
        }
        input[type="file"] {
            padding: 10px;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            width: 100%;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Profile</h1>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="form-group">
                <label for="bio">Bio:</label>
                <textarea name="bio" id="bio" required><?php echo htmlspecialchars($bio); ?></textarea>
            </div>
            <div class="form-group">
                <label for="profile_pic">Upload Profile Picture:</label>
                <input type="file" name="profile_pic" id="profile_pic" accept="image/*">
            </div>
            <button type="submit">Save Changes</button>
        </form>
    </div>
</body>
</html>
