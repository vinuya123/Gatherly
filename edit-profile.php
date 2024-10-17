<?php
session_start();

// Assuming you have already connected to your database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $bio = $_POST['bio'];

    // Handle the file upload for the profile picture
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
        $upload_dir = 'uploads/';
        $file_name = basename($_FILES['profile_pic']['name']);
        $target_file = $upload_dir . $file_name;

        // Attempt to move the uploaded file
        if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target_file)) {
            // File upload successful, save the new image path
            // You can also save this to your database if needed
            $_SESSION['profile_pic'] = $target_file; // Store path in session
        } else {
            echo "Error uploading the profile picture.";
        }
    }

    // Save other profile details to session or database
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    $_SESSION['bio'] = $bio;

    // Redirect to the profile page to refresh it with updated details
    header("Location: Profile.php"); // Change this to your actual profile page
    exit(); // Important to call exit after a redirect
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Your form goes here -->
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Name" value="<?php echo $_SESSION['name']; ?>" required>
        <input type="email" name="email" placeholder="Email" value="<?php echo $_SESSION['email']; ?>" required>
        <textarea name="bio" placeholder="Bio" required><?php echo $_SESSION['bio']; ?></textarea>
        <input type="file" name="profile_pic" accept="image/*">
        <button type="submit">Update Profile</button>
    </form>
</body>
</html>
