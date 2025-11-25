<?php
include('../config/config.php');
error_reporting(0);

if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $contactno = $_POST['contactno'];
    $status = 1;

    // Simple check for confirm password
    if ($password != $cpassword) {
        $msg = "Passwords do not match!";
    } else {
        // Use MD5 as in your original code (for now, can switch to password_hash for security)
        $hashedPassword = md5($password);

        $query = mysqli_query($bd, "INSERT INTO users(fullName,userEmail,password,contactNo,status) 
                  VALUES('$fullname','$email','$hashedPassword','$contactno','$status')");
        if ($query) {
            // Redirect to the login/sign-in page after successful registration
            header("Location: index.php");
            exit();
        } else {
            $msg = "Something went wrong. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Complaint Management System - User Registration">
    <meta name="author" content="ResolveX">
    <title>ResolveX | User Registration</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --accent-color: #3b82f6;
            --light-color: #f8fafc;
            --dark-color: #0f172a;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --navbar-bg: #2c3e50;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f0f4f8, #e2e8f0);
            color: #334155;
            line-height: 1.6;
            padding: 0;
            font-size: 16px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .container {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .registration-container {
            max-width: 550px;
            width: 100%;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 20px;
        }

        .registration-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 30px;
            text-align: center;
            font-size: 28px;
            font-weight: 700;
        }

        .registration-body {
            padding: 35px;
            padding-bottom: 20px;
        }

        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 14px 16px;
            /* Increased padding for better touch targets */
            font-size: 16px;
            /* Standard font size */
            transition: all 0.3s ease;
            /* More spacing between fields */
            height: auto;
            width: 100%;
            box-sizing: border-box;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
            outline: none;
        }

        .password-wrapper {
            position: relative;
            margin-bottom: 25px;
        }

        .password-wrapper input {
            padding-right: 50px;
            /* More space for eye icon */
            width: 100%;
            box-sizing: border-box;
        }

        .password-wrapper .toggle-password {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #888;
            font-size: 18px;
            /* Larger icon size */
        }

        .password-wrapper .toggle-password:hover {
            color: var(--primary-color);
        }

        .btn-register {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            color: white;
            padding: 16px;
            /* Larger button */
            font-size: 18px;
            /* Readable button text */
            font-weight: 600;
            border-radius: 8px;
            width: 100%;
            transition: all 0.3s ease;
            margin-top: 15px;
            cursor: pointer;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(37, 99, 235, 0.3);
        }

        .btn-register:disabled,
        .btn-register[disabled] {
            background: #9ca3af;
            /* muted grey */
            border-color: #9ca3af;
            box-shadow: none;
            cursor: not-allowed;
            opacity: 0.9;
            transform: none;
        }

        .btn-register:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.3);
        }

        .registration-link {
            text-align: center;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #e2e8f0;
            font-size: 16px;
            /* Standard text size */
        }

        .registration-link a {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
            font-size: 16px;
        }

        .registration-link a:hover {
            text-decoration: underline;
        }

        .alert {
            padding: 15px 20px;
            /* Larger padding */
            border-radius: 8px;
            margin-bottom: 25px;
            font-weight: 500;
            font-size: 16px;
            /* Standard message size */
        }

        .alert-success {
            background-color: rgba(16, 185, 129, 0.15);
            border: 1px solid var(--success-color);
            color: #047857;
        }

        .alert-danger {
            background-color: rgba(239, 68, 68, 0.15);
            border: 1px solid var(--danger-color);
            color: #b91c1c;
        }

        .availability-status {
            font-size: 15px;
            /* Slightly smaller than main text */
            margin-top: 5px;
            display: block;
        }

        .availability-status.success {
            color: var(--success-color);
        }

        .availability-status.error {
            color: var(--danger-color);
        }

        @media (max-width: 576px) {
            .registration-container {
                margin: 25px;
                border-radius: 10px;
            }

            .registration-header {
                padding: 25px 20px;
                font-size: 24px;
            }

            .registration-body {
                padding: 25px;
            }

            body {
                padding: 15px 0;
            }
        }
    </style>

    <script src="assets/js/jquery.js"></script>
    <script>
        function userAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_availability.php",
                data: 'email=' + $("#email").val(),
                type: "POST",
                success: function (data) {
                    $("#user-availability-status1").html(data);
                    $("#loaderIcon").hide();
                },
                error: function () { }
            });
        }

        function togglePassword(fieldId, element) {
            const input = document.getElementById(fieldId);
            const icon = element.querySelector("i");
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <div class="registration-container">
            <div class="registration-header">
                <i class="fa fa-user-plus"></i> Create Account
            </div>

            <div class="registration-body">
                <?php if ($msg): ?>
                    <div
                        class="alert <?php echo (strpos($msg, 'successful') !== false) ? 'alert-success' : 'alert-danger'; ?>">
                        <?php echo htmlentities($msg); ?>
                    </div>
                <?php endif; ?>

                <form method="post">
                    <div class="form-group" style="margin-bottom: 5px;">
                        <input type="text" class="form-control" placeholder="Full Name" name="fullname" required
                            autofocus>
                    </div>

                    <div class="form-group" style="margin-bottom: 5px;">
                        <input type="email" class="form-control" placeholder="Email Address" id="email"
                            onBlur="userAvailability()" name="email" required>
                        <span id="user-availability-status1" class="availability-status"></span>
                    </div>

                    <div class="form-group password-wrapper" style="margin-bottom: 5px;">
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password"
                            required>
                        <span class="toggle-password" onclick="togglePassword('password', this)">
                            <i class="fa fa-eye"></i>
                        </span>
                    </div>

                    <div class="form-group password-wrapper" style="margin-bottom: 5px;">
                        <input type="password" class="form-control" placeholder="Confirm Password" name="cpassword"
                            id="cpassword" required>
                        <span class="toggle-password" onclick="togglePassword('cpassword', this)">
                            <i class="fa fa-eye"></i>
                        </span>
                    </div>

                    <div class="form-group" style="margin-bottom: 5px;">
                        <input type="text" class="form-control" maxlength="10" name="contactno"
                            placeholder="Contact Number" required>
                    </div>

                    <button id="submit" class="btn-register" type="submit" name="submit">
                        <i class="fa fa-user"></i> Register Now
                    </button>
                </form>

                <div class="registration-link">
                    Already have an account? <a href="index.php">Sign In</a>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>