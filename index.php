<?php
session_start();

// Check if userid is set in session
if (!isset($_SESSION['userid'])) {
    // If userid is not set, redirect to login page
    header("location:voter_login.php");
    exit(); // Make sure to exit after redirection
}

// Retrieve userid from session
$userid = $_SESSION['userid'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Fingerprint</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .card {
            width: 400px;
            margin: 150px auto;
            text-align: center;
            padding: 30px;
            border: 4px #a517ba solid;
            border-radius: 5px;
        }
        .slideUpBtn {
            padding: 12px 24px;
            background-color: transparent;
            border: 2px solid hsl(243, 80%, 62%);
            border-radius: 6px;
            position: relative;
            overflow: hidden;
            transition: all 0.5s cubic-bezier(1,.15,.34,.92);
            margin-top: 20px; /* Adjusted margin */
        }
        .form-group {
            margin-bottom: 20px; /* Adjusted margin */
        }
        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .file-upload-wrapper {
            position: relative;
            display: inline-block;
            text-align: center;
        }
        .file-upload-label {
            padding: 8px 20px; /* Adjusted padding */
            font-size: 14px; /* Adjusted font size */
            line-height: 1.5;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 10px; /* Moved down */
        }
        #image1 {
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            opacity: 0;
            z-index: 2;
        }
        #file-chosen {
            display: block;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <?php include("header.html"); ?>
    <section class="sec">
        <div class="card">
            <h3>Upload Fingerprint</h3>
            <form action="compare1.php" method="post" enctype="multipart/form-data">
                <!-- Hidden field to pass user ID from session -->
                <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                <div class="form-group">
                    <label for="image1" class="file-upload-wrapper">
                        <span class="file-upload-label">Choose file</span>
                        <input type="file" id="image1" name="image1" class="file-upload-input" accept=".jpg, .jpeg, .png, .bmp" required>
                    </label>
                </div>
                <div class="form-group">
                    <span id="file-chosen"></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="slideUpBtn" value="Submit">
                </div>
            </form>
        </div>
    </section>
    <?php include('footer.html'); ?>
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>    
    <script src="js/bootstrap.min.js"></script> 
    <script>
        // Display the selected file name
        document.getElementById("image1").addEventListener("change", function() {
            var fileName = this.files[0].name;
            document.getElementById("file-chosen").textContent = fileName;
        });
    </script>
</body>
</html>

