<?php
session_start();
error_reporting(0);
include("../config/config.php");
if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$ret = mysqli_query($bd, "SELECT * FROM admin WHERE username='$username'");
	$num = mysqli_fetch_array($ret);
	if ($num > 0) {
		// Check password (handle both MD5 and BCRYPT)
		$storedPassword = $num['password'];
		$passwordMatch = false;

		// If it's an MD5 hash (32 characters long)
		if (strlen($storedPassword) == 32 && ctype_xdigit($storedPassword)) {
			// Verify using MD5
			if (md5($password) === $storedPassword) {
				$passwordMatch = true;
				// Upgrade to BCRYPT for future logins
				$newHashedPassword = password_hash($password, PASSWORD_BCRYPT);
				mysqli_query($bd, "UPDATE admin SET password='$newHashedPassword' WHERE username='$username'");
			}
		}
		// If it's a BCRYPT hash (starts with $2y$)
		elseif (strpos($storedPassword, '$2y$') === 0) {
			// Verify using password_verify
			if (password_verify($password, $storedPassword)) {
				$passwordMatch = true;
			}
		}

		if ($passwordMatch) {
			$extra = "dashboard.php";//
			$_SESSION['alogin'] = $_POST['username'];
			$_SESSION['adminid'] = $num['id'];  // Changed from 'id' to 'adminid'
			// Simplified redirect to avoid URL construction issues
			header("location: dashboard.php");
			exit();
		} else {
			$_SESSION['errmsg'] = "Invalid username or password";
			// Simplified redirect for error case
			header("location: index.php");
			exit();
		}
	} else {
		$_SESSION['errmsg'] = "Invalid username or password";
		// Simplified redirect for error case
		header("location: index.php");
		exit();
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ResolveX | Admin Login</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="../assets/css/theme.css" rel="stylesheet">
	<link type="text/css" href="../assets/icons/css/font-awesome.css" rel="stylesheet">
	<link rel="icon" type="image/x-icon" href="../img/favicon.ico">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
		rel='stylesheet'>

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

		html,
		body {
			height: 100%;
			margin: 0;
			padding: 0;
		}

		body {
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			background: linear-gradient(135deg, #f0f4f8, #e2e8f0);
			color: #334155;
			line-height: 1.6;
			font-size: 16px;
			min-height: 100vh;
			display: flex;
			align-items: center;
			justify-content: center;
			margin: 0;
			padding: 0;
		}

		.login-container {
			max-width: 550px;
			width: 100%;
			background: white;
			border-radius: 12px;
			box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
			overflow: hidden;
			margin: 20px;
		}

		.login-header {
			background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
			color: white;
			padding: 30px;
			text-align: center;
			font-size: 28px;
			font-weight: 700;
		}

		.login-body {
			padding: 35px;
		}

		/* Increase specificity to override Bootstrap styles */
		.login-body .form-control {
			border: 2px solid #e2e8f0 !important;
			border-radius: 8px !important;
			padding: 14px 16px !important;
			font-size: 16px !important;
			transition: all 0.3s ease !important;
			margin-bottom: 25px !important;
			height: auto !important;
			width: 100% !important;
			box-sizing: border-box !important;
			background-color: white !important;
			color: #334155 !important;
		}

		.login-body .form-control:focus {
			border-color: var(--primary-color) !important;
			box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2) !important;
			outline: none !important;
		}

		.password-wrapper {
			position: relative;
			margin-bottom: 25px;
		}

		.password-wrapper input {
			padding-right: 50px !important;
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
			display: flex;
			align-items: center;
			justify-content: center;
			height: 100%;
			z-index: 10;
		}

		.password-wrapper .toggle-password:hover {
			color: var(--primary-color);
		}

		.btn-login {
			background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
			border: none;
			color: white;
			padding: 16px;
			font-size: 18px;
			font-weight: 600;
			border-radius: 8px;
			width: 100%;
			transition: all 0.3s ease;
			margin: 10px 0 25px 0;
			cursor: pointer;
		}

		.btn-login:hover {
			transform: translateY(-2px);
			box-shadow: 0 5px 15px rgba(37, 99, 235, 0.3);
		}

		.btn-login:focus {
			outline: none;
			box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.3);
		}

		.back-to-portal {
			text-align: center;
			margin-top: 25px;
			padding-top: 25px;
			border-top: 1px solid #e2e8f0;
			font-size: 16px;
		}

		.back-to-portal a {
			color: var(--primary-color);
			font-weight: 600;
			text-decoration: none;
			font-size: 16px;
		}

		.back-to-portal a:hover {
			text-decoration: underline;
		}

		.alert {
			padding: 15px 20px;
			border-radius: 8px;
			margin-bottom: 25px;
			font-weight: 500;
			font-size: 16px;
		}

		.alert-danger {
			background-color: rgba(239, 68, 68, 0.15);
			border: 1px solid var(--danger-color);
			color: #b91c1c;
		}

		.navbar {
			display: none;
		}

		.footer {
			color: #999;
			padding: 20px 0;
			text-align: center;
			font-size: 14px;
			width: 100%;
		}

		/* Override Bootstrap container styles */
		.container {
			width: 100%;
			max-width: 100%;
			padding: 0;
			margin: 0;
		}

		/* Ensure proper centering */
		.login-wrapper {
			width: 100%;
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
		}

		@media (max-width: 576px) {
			.login-container {
				margin: 15px;
				border-radius: 10px;
			}

			.login-header {
				padding: 25px 20px;
				font-size: 24px;
			}

			.login-body {
				padding: 25px;
			}

			/* Mobile styles for form controls */
			.login-body .form-control {
				border: 2px solid #e2e8f0 !important;
				border-radius: 8px !important;
				padding: 14px 16px !important;
				font-size: 16px !important;
				transition: all 0.3s ease !important;
				margin-bottom: 25px !important;
				height: auto !important;
				width: 100% !important;
				box-sizing: border-box !important;
			}

			.password-wrapper input {
				padding-right: 50px !important;
			}

			body {
				padding: 0;
			}
		}
	</style>
</head>

<body>
	<div class="login-wrapper">
		<div class="login-container">
			<div class="login-header">
				<i class="icon-lock"></i> Admin Login
			</div>

			<div class="login-body">
				<?php if ($_SESSION['errmsg']): ?>
					<div class="alert alert-danger">
						<?php echo htmlentities($_SESSION['errmsg']); ?>
						<?php echo htmlentities($_SESSION['errmsg'] = ""); ?>
					</div>
				<?php endif; ?>

				<form class="form-vertical" method="post">
					<div class="form-group">
						<input class="form-control" type="text" id="inputEmail" name="username" placeholder="Username"
							required autofocus>
					</div>

					<div class="form-group">
						<div class="password-wrapper">
							<input class="form-control" type="password" id="inputPassword" name="password"
								placeholder="Password" required>
							<span class="toggle-password" onclick="togglePassword('inputPassword', this)">
								<i class="icon-eye-open" style="margin-top: -20px; font-size: 18px;"></i>
							</span>
						</div>
					</div>

					<button type="submit" class="btn-login" name="submit">Sign In</button>
				</form>

				<div class="back-to-portal">
					<a href="../index.php">
						<i class="icon-arrow-left"></i> Back to Portal
					</a>
				</div>
			</div>
		</div><!--/.login-container-->

		<div class="footer">
			<div class="container">
				<b class="copyright">&copy; 2025 ResolveX </b> All rights reserved.
			</div>
		</div>
	</div>

	<script src="../assets/scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="../assets/scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

	<script>
		function togglePassword(fieldId, el) {
			const input = document.getElementById(fieldId);
			const icon = el.querySelector("i");

			if (input.type === "password") {
				input.type = "text";
				icon.classList.remove("icon-eye-open");
				icon.classList.add("icon-eye-close");
			} else {
				input.type = "password";
				icon.classList.remove("icon-eye-close");
				icon.classList.add("icon-eye-open");
			}
		}
	</script>
</body>

</html>