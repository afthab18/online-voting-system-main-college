<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Capture</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .card {
            width: 400px;
            margin: 20px auto; /* Adjusted margin-top */
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
            margin-top: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .file-upload-wrapper {
            position: relative;
            display: inline-block;
            text-align: center;
        }
        .file-upload-label {
            padding: 8px 20px;
            font-size: 14px;
            line-height: 1.5;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 10px;
        }
        #video {
            width: 100%;
            height: 240px; /* Reduced height */
            margin-bottom: 20px;
        }
        #canvas {
            display: none;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include("header.html"); ?>

    <!-- Main Section -->
    <section class="sec">
        <div class="card">
            <h1 style="margin-top: 10px;">Image Capture</h1> <!-- Adjusted margin-top -->
            <video id="video" width="640" height="240" autoplay></video>
            <div class="form-group">
                <label for="imageCapture" class="file-upload-wrapper">
                    <span class="file-upload-label">Capture</span>
                    <input type="button" id="imageCapture" onclick="capturePhoto()" class="file-upload-input" accept=".jpg, .jpeg, .png" required>
                </label>
            </div>
            <canvas id="canvas"></canvas>
            <form id="captureForm" action="compare2.php" method="post" style="display: none;">
                <!-- Hidden input field to store the captured photo data -->
                <input type="hidden" id="photoInput" name="photo">
            </form>
        </div>
    </section>

    <!-- Footer -->
    <?php include('footer.html'); ?>

    <!-- Scripts -->
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>    
    <script src="js/bootstrap.min.js"></script> 
    <script>
        // Function to initialize video feed from webcam
        async function initCamera() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ video: true });
                const videoElement = document.getElementById('video');
                videoElement.srcObject = stream;
            } catch (error) {
                console.error('Error accessing webcam:', error);
            }
        }

        // Call the function to initialize the camera when the page loads
        window.onload = function() {
            initCamera();
        };

        // Function to capture photo from webcam and submit the form
        function capturePhoto() {
            var canvas = document.getElementById('canvas');
            var context = canvas.getContext('2d');
            var video = document.getElementById('video');

            // Set canvas dimensions to match video feed
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;

            // Draw the current frame from the video onto the canvas
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Convert canvas content to data URL
            var dataURL = canvas.toDataURL('image/jpeg');

            // Set the photo data to a hidden input field
            document.getElementById('photoInput').value = dataURL;

            // Submit the form
            document.getElementById('captureForm').submit();
        }
    </script>
</body>
</html>
