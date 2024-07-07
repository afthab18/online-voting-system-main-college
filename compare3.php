<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user ID from the session
    if(isset($_POST['userid'])) {
        $userID = $_POST['userid'];

        // Check if the file is uploaded successfully
        if(isset($_FILES['image1']) && $_FILES['image1']['error'] === UPLOAD_ERR_OK) {
            // Path to the uploaded fingerprint image
            $uploaded_fingerprint_path = $_FILES['image1']['tmp_name'];

            // Sample array to store fingerprints (replace this with your actual data)
            $fingerprints = array(
                "20cs257" => "fingerprints/1.bmp",
                "20cs239" => "fingerprints/4.bmp"
                // Add more user IDs and corresponding fingerprint paths as needed
            );

            // Check if the user ID exists in the array
            if (array_key_exists($userID, $fingerprints)) {
                // Get the stored fingerprint path
                $stored_fingerprint_path = $fingerprints[$userID];

                // Call the script.py using Python with the paths of both fingerprints
                $command = "python script.py \"$uploaded_fingerprint_path\" \"$stored_fingerprint_path\"";
                
                // Execute the command and capture the output
                $output = shell_exec($command);

                // Check if the output indicates a successful fingerprint comparison
                if ($output == 1) {
                    // Fingerprint comparison successful, redirect to voting.php with userid
                    header("Location: capture.php?userid=" . urlencode($userID));
                    exit();
                } else {
                    // Fingerprint comparison failed, redirect to voter_login.php with error message
                    $_SESSION['error'] = "Fingerprints did not match.";
                    header("Location: voter_login.php");
                    exit();
                }
            } else {
                // User ID not found in the array, redirect to index.php with error message
                $_SESSION['error'] = "Invalid user ID.";
                header("Location: index.php");
                exit();
            }
        } else {
            // File upload failed, redirect to index.php with error message
            $_SESSION['error'] = "File upload failed.";
            header("Location: index.php");
            exit();
        }
    } else {
        // If userid is not set in session, redirect to login.php with error message
        $_SESSION['error'] = "User ID not found in session.";
        header("Location: voter_login.php");
        exit();
    }
} else {
    // If form is not submitted, redirect back to index.php
    header("Location: index.php");
    exit();
}
?>
