<?php
session_start();

// Check if userid is set in session
if (!isset($_SESSION['userid'])) {
    // If userid is not set, redirect to login page with error message
    $_SESSION['error'] = "Session expired. Please log in again.";
    header("location:voter_login.php");
    exit();
}

// Retrieve userid from session
$userid = $_SESSION['userid'];

// Check if photo is received
if (isset($_POST['photo'])) {
    // Store the received photo data
    $photoData = $_POST['photo'];

    // Store the received photo data as an image file
    $photoPath = "uploads/$userid.jpg";
    file_put_contents($photoPath, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $photoData)));

    // Load the image from the array of the corresponding userid
    $arrayImagePath = "images/$userid.jpg"; // Assuming images are stored in a directory named 'images'
    
    // Call face.py using exec with the image paths as arguments
    exec("python f.py $arrayImagePath $photoPath", $output);

    // Check the output of face.py
    if (isset($output[0]) && strtolower(trim($output[0])) === "true") {
        // If face.py returns true, redirect to voting.php
        header("location:voting.php");
        exit();
    } else {
        // If face.py returns false or there's an error, redirect to voter_login.php with error message
        $_SESSION['error'] = "Face did not match.";
        header("location:voter_login.php");
        exit();
    }
} else {
    // If photo is not received, redirect to voter_login.php with error message
    $_SESSION['error'] = "No photo received. Please try again.";
    header("location:voter_login.php");
    exit();
}
?>
