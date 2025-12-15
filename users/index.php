<?php
session_start();
error_reporting(0);
include("../config/config.php");
if (isset($_POST['submit'])) {
  $ret = mysqli_query($bd, "SELECT * FROM users WHERE userEmail='" . $_POST['username'] . "' and password='" . md5($_POST['password']) . "'");
  $num = mysqli_fetch_array($ret);
  if ($num > 0) {
    $extra = "dashboard.php";//
    $_SESSION['login'] = $_POST['username'];
    $_SESSION['id'] = $num['id'];
    // Simplified redirect to avoid URL construction issues
    header("location: dashboard.php");
    exit();
  } else {
    $_SESSION['login'] = $_POST['username'];
    $uip = $_SERVER['REMOTE_ADDR'];
    $status = 0;
    mysqli_query($bd, "insert into userlog(username,userip,status) values('" . $_SESSION['login'] . "','$uip','$status')");
    $errormsg = "Invalid username or password";
    // Simplified redirect for error case
    header("location: index.php");
    exit();
  }
}

if (isset($_POST['change'])) {
  $email = $_POST['email'];
  $contact = $_POST['contact'];
  $password = md5($_POST['password']);
  $query = mysqli_query($bd, "SELECT * FROM users WHERE userEmail='$email' and contactNo='$contact'");
  $num = mysqli_fetch_array($query);
  if ($num > 0) {
    mysqli_query($bd, "update users set password='$password' WHERE userEmail='$email' and contactNo='$contact' ");
    $msg = "Password Changed Successfully";
  } else {
    $errormsg = "Invalid email id or Contact no";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Complaint Management System - User Login">
  <meta name="author" content="ResolveX">
  <meta name="keyword" content="Complaint, Management, System, Login, ResolveX">

  <title>ResolveX | User Login</title>

  <!-- Bootstrap core CSS -->
  <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
  <link href="../assets/css/bootstrap.css" rel="stylesheet">
  <!--external css-->
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

    .form-control {
      border: 2px solid #e2e8f0;
      border-radius: 8px;
      padding: 14px 16px;
      font-size: 16px;
      transition: all 0.3s ease;
      margin-bottom: 25px;
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

    .forgot-password {
      text-align: right;
      margin-bottom: 25px;
    }

    .forgot-password a {
      color: var(--primary-color);
      font-weight: 600;
      text-decoration: none;
      font-size: 16px;
    }

    .forgot-password a:hover {
      text-decoration: underline;
    }

    .registration-link {
      text-align: center;
      margin-top: 25px;
      padding-top: 25px;
      border-top: 1px solid #e2e8f0;
      font-size: 16px;
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
      border-radius: 8px;
      margin-bottom: 25px;
      font-weight: 500;
      font-size: 16px;
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

    /* Modal Styles */
    .modal-header {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      color: white;
      border-radius: 8px 8px 0 0;
    }

    .modal-title {
      font-weight: 600;
      font-size: 20px;
    }

    .modal-body {
      padding: 25px;
    }

    .modal-footer {
      padding: 15px 25px;
      border-top: 1px solid #e2e8f0;
    }

    .btn-default {
      background-color: #f1f5f9;
      border: 1px solid #cbd5e1;
      color: #64748b;
      padding: 10px 20px;
      border-radius: 6px;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .btn-default:hover {
      background-color: #e2e8f0;
      border-color: #94a3b8;
    }

    .modal-content {
      border-radius: 8px;
      border: none;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .close {
      color: white;
      opacity: 0.8;
      text-shadow: none;
    }

    .close:hover {
      opacity: 1;
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

      body {
        padding: 0;
      }
    }
  </style>

  <script type="text/javascript">
    function valid() {
      if (document.forgot.password.value != document.forgot.confirmpassword.value) {
        alert("Password and Confirm Password Field do not match  !!");
        document.forgot.confirmpassword.focus();
        return false;
      }
      return true;
    }
  </script>
</head>

<body>
  <div class="login-container">
    <div class="login-header">
      <i class="fa fa-user"></i> User Login
    </div>

    <div class="login-body">
      <?php if ($errormsg): ?>
        <div class="alert alert-danger">
          <?php echo htmlentities($errormsg); ?>
        </div>
      <?php endif; ?>

      <?php if ($msg): ?>
        <div class="alert alert-success">
          <?php echo htmlentities($msg); ?>
        </div>
      <?php endif; ?>

      <form name="login" method="post">
        <div class="form-group">
          <input type="text" class="form-control" name="username" placeholder="Email Address" required autofocus>
        </div>

        <div class="form-group password-wrapper">
          <input type="password" class="form-control" name="password" id="loginPassword" required
            placeholder="Password">
          <span class="toggle-password" onclick="togglePassword('loginPassword', this)">
            <i class="fa fa-eye"></i>
          </span>
        </div>

        <div class="forgot-password">
          <a data-toggle="modal" href="#myModal">Forgot Password?</a>
        </div>

        <button class="btn-login" name="submit" type="submit">
          <i class="fa fa-lock"></i> Sign In
        </button>
      </form>

      <div class="registration-link">
        Don't have an account yet? <a href="registration.php">Create an account</a>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form name="forgot" method="post">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Forgot Password?</h4>
          </div>
          <div class="modal-body">
            <p>Enter your details below to reset your password.</p>

            <div class="form-group">
              <input type="email" name="email" placeholder="Email Address" autocomplete="off" class="form-control"
                required>
            </div>

            <div class="form-group">
              <input type="text" name="contact" placeholder="Contact Number" autocomplete="off" class="form-control"
                required>
            </div>

            <div class="form-group password-wrapper">
              <input type="password" class="form-control" placeholder="New Password" id="password" name="password"
                required>
              <span class="toggle-password" onclick="togglePassword('password', this)">
                <i class="fa fa-eye"></i>
              </span>
            </div>

            <div class="form-group password-wrapper">
              <input type="password" class="form-control" placeholder="Confirm Password" id="confirmpassword"
                name="confirmpassword" required>
              <span class="toggle-password" onclick="togglePassword('confirmpassword', this)">
                <i class="fa fa-eye"></i>
              </span>
            </div>
          </div>
          <div class="modal-footer">
            <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
            <button class="btn btn-login" type="submit" name="change" onclick="return valid();">Reset Password</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- modal -->

  <!-- js placed at the end of the document so the pages load faster -->
  <script src="../assets/js/jquery.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>

  <!-- Password Toggle Script -->
  <script>
    function togglePassword(fieldId, el) {
      const input = document.getElementById(fieldId);
      const icon = el.querySelector("i");

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

</body>

</html>