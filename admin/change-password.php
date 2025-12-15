<?php
session_start();
include('../config/config.php');

if (strlen($_SESSION['alogin']) == 0) {
  header('location:index.php');
  exit;
}

date_default_timezone_set('Asia/Kolkata');
$currentTime = date('Y-m-d H:i:s');
$msg = "";

// Handle form submission
if (isset($_POST['submit'])) {
  $username = $_SESSION['alogin'];
  $currentPassword = $_POST['password'];
  $newPassword = $_POST['newpassword'];

  // Fetch stored password
  $stmt = $bd->prepare("SELECT password FROM admin WHERE username=?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $stmt->bind_result($hashedPassword);
  $stmt->fetch();
  $stmt->close();

  if (!$hashedPassword) {
    $msg = "❌ User not found!";
  } else {
    // Check if the current password matches (handle both MD5 and BCRYPT)
    $passwordMatch = false;

    // If it's an MD5 hash (32 characters long)
    if (strlen($hashedPassword) == 32 && ctype_xdigit($hashedPassword)) {
      // Verify using MD5
      if (md5($currentPassword) === $hashedPassword) {
        $passwordMatch = true;
      }
    }
    // If it's a BCRYPT hash (starts with $2y$)
    elseif (strpos($hashedPassword, '$2y$') === 0) {
      // Verify using password_verify
      if (password_verify($currentPassword, $hashedPassword)) {
        $passwordMatch = true;
      }
    }

    if ($passwordMatch) {
      // Hash the new password using BCRYPT
      $newHashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

      $update = $bd->prepare("UPDATE admin SET password=?, updationDate=? WHERE username=?");
      $update->bind_param("sss", $newHashedPassword, $currentTime, $username);
      $update->execute();
      $update->close();

      $msg = "✅ Password Changed Successfully!";
    } else {
      $msg = "❌ Old Password does not match!";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin | Change Password</title>
  <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
  <link rel="stylesheet" href="../assets/css/theme.css">
  <link rel="stylesheet" href="../assets/icons/css/font-awesome.css">
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
      --info-color: #3b82f6;
      --gray-100: #f1f5f9;
      --gray-200: #e2e8f0;
      --gray-300: #cbd5e1;
      --gray-400: #94a3b8;
      --gray-500: #64748b;
      --gray-600: #475569;
      --gray-700: #334155;
      --gray-800: #1e293b;
      --gray-900: #0f172a;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f1f5f9;
      color: var(--gray-700);
      line-height: 1.6;
      height: 100%;
      margin: 0;
      display: flex;
      flex-direction: column;
    }

    #container {
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    #main-content {
      flex: 1;
      margin-left: 260px;
      padding: 20px 15px;
      padding-top: 80px;
      transform: translateZ(0);
      -webkit-transform: translateZ(0);
    }

    .page-header {
      margin-bottom: 30px;
    }

    .page-header h1 {
      font-size: 28px;
      font-weight: 700;
      color: var(--gray-900);
      margin: 0;
      padding-bottom: 15px;
      border-bottom: 3px solid var(--primary-color);
      display: inline-block;
    }

    .card {
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
      padding: 25px;
      border: 1px solid var(--gray-200);
      margin-bottom: 30px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }

    .card-header {
      padding-bottom: 20px;
      margin-bottom: 25px;
      border-bottom: 2px solid var(--primary-color);
    }

    .card-header h3 {
      margin: 0;
      font-size: 22px;
      font-weight: 700;
      color: var(--gray-900);
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .form-group {
      margin-bottom: 25px;
    }

    .form-label {
      display: block;
      font-weight: 600;
      color: var(--gray-700);
      margin-bottom: 10px;
      font-size: 16px;
    }

    .input-group {
      position: relative;
      display: flex;
      align-items: stretch;
      width: 100%;
    }

    .form-control {
      width: 100%;
      padding: 14px 16px;
      border: 2px solid var(--gray-300);
      border-radius: 8px;
      font-size: 16px;
      transition: all 0.3s ease;
      background-color: white;
      color: var(--gray-700);
      padding-right: 50px;
    }

    .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.2);
      outline: none;
    }

    .input-group-text {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      background: transparent;
      border: none;
      cursor: pointer;
      color: var(--gray-500);
      font-size: 18px;
      z-index: 10;
      padding: 0;
      width: 24px;
      height: 24px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .input-group-text:hover {
      color: var(--primary-color);
    }

    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 14px 24px;
      font-size: 16px;
      font-weight: 600;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s ease;
      border: none;
      gap: 8px;
    }

    .btn-primary {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      color: white;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(37, 99, 235, 0.3);
    }

    .alert {
      padding: 16px 20px;
      border-radius: 8px;
      margin-bottom: 25px;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 12px;
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

    .close {
      float: right;
      font-size: 21px;
      font-weight: bold;
      line-height: 1;
      color: #000;
      text-shadow: 0 1px 0 #fff;
      opacity: 0.2;
      cursor: pointer;
      background: transparent;
      border: 0;
    }

    .password-strength {
      margin-top: 8px;
      font-size: 14px;
      font-weight: 500;
    }

    .password-match {
      margin-top: 8px;
      font-size: 14px;
      font-weight: 500;
    }

    .strength-weak {
      color: var(--danger-color);
    }

    .strength-medium {
      color: var(--warning-color);
    }

    .strength-strong {
      color: var(--success-color);
    }

    .match-valid {
      color: var(--success-color);
    }

    .match-invalid {
      color: var(--danger-color);
    }

    .breadcrumb {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 25px;
      padding: 12px 15px;
      background: var(--white);
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
      border: 1px solid var(--gray-200);
    }

    .breadcrumb a {
      color: var(--primary-color);
      text-decoration: none;
      font-weight: 500;
    }

    .breadcrumb a:hover {
      text-decoration: underline;
    }

    .breadcrumb .divider {
      color: var(--gray-400);
    }

    .breadcrumb .active {
      color: var(--gray-600);
      font-weight: 500;
    }

    @media (max-width: 768px) {
      #main-content {
        margin-left: 0;
        padding: 15px;
        padding-top: 80px;
      }

      .card {
        padding: 20px;
      }

      .page-header h1 {
        font-size: 24px;
      }

      .card-header h3 {
        font-size: 20px;
      }
    }
  </style>
  <script>
    function valid() {
      let pwd = document.chngpwd.password.value;
      let newpwd = document.chngpwd.newpassword.value;
      let confirmpwd = document.chngpwd.confirmpassword.value;

      if (pwd === "") { alert("Current Password is empty!"); return false; }
      if (newpwd === "") { alert("New Password is empty!"); return false; }
      if (confirmpwd === "") { alert("Confirm Password is empty!"); return false; }
      if (newpwd !== confirmpwd) { alert("New Password and Confirm Password do not match!"); return false; }
      if (newpwd.length < 8) { alert("Password must be at least 8 characters long!"); return false; }
      return true;
    }

    function checkStrength(password) {
      let strengthMsg = document.getElementById("strengthMsg");
      let strength = 0;

      if (password.length >= 8) strength++;
      if (/[A-Z]/.test(password)) strength++;
      if (/[a-z]/.test(password)) strength++;
      if (/[0-9]/.test(password)) strength++;
      if (/[^A-Za-z0-9]/.test(password)) strength++;

      if (password.length === 0) {
        strengthMsg.innerHTML = "";
        strengthMsg.className = "password-strength";
      } else if (strength <= 2) {
        strengthMsg.innerHTML = "Weak 🔴";
        strengthMsg.className = "password-strength strength-weak";
      } else if (strength === 3) {
        strengthMsg.innerHTML = "Medium 🟠";
        strengthMsg.className = "password-strength strength-medium";
      } else {
        strengthMsg.innerHTML = "Strong 🟢";
        strengthMsg.className = "password-strength strength-strong";
      }
    }

    function checkMatch() {
      let newpwd = document.getElementById("newpassword").value;
      let confirmpwd = document.getElementById("confirmpassword").value;
      let matchMsg = document.getElementById("matchMsg");

      if (confirmpwd.length === 0) {
        matchMsg.innerHTML = "";
        matchMsg.className = "password-match";
      } else if (newpwd === confirmpwd) {
        matchMsg.innerHTML = "Passwords Match ✅";
        matchMsg.className = "password-match match-valid";
      } else {
        matchMsg.innerHTML = "Passwords Do Not Match ❌";
        matchMsg.className = "password-match match-invalid";
      }
    }

    function togglePassword(id, iconId) {
      let field = document.getElementById(id);
      let icon = document.getElementById(iconId);
      if (field.type === "password") {
        field.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
      } else {
        field.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
      }
    }
  </script>
</head>

<body>
  <section id="container">
    <?php include('include/header.php'); ?>

    <?php include('include/sidebar.php'); ?>

    <section id="main-content">
      <div class="container-fluid">
        <div class="row">
          <div class="span12">
            <!-- Breadcrumb -->
            <div class="breadcrumb">
              <a href="dashboard.php"><i class="icon-dashboard"></i> Dashboard</a>
              <span class="divider">/</span>
              <span class="active">Change Password</span>
            </div>

            <!-- Page Header -->
            <div class="page-header">
              <h1><i class="icon-lock"></i> Change Password</h1>
            </div>

            <!-- Change Password Card -->
            <div class="card">
              <div class="card-header">
                <h3><i class="icon-key"></i> Update Your Password</h3>
              </div>
              <div class="card-body">
                <?php if ($msg) { ?>
                  <div class="alert <?php echo (strpos($msg, '✅') !== false) ? 'alert-success' : 'alert-danger'; ?>">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <?php
                    if (strpos($msg, '✅') !== false) {
                      echo '<i class="icon-ok"></i>';
                    } else {
                      echo '<i class="icon-remove"></i>';
                    }
                    echo htmlentities($msg);
                    ?>
                  </div>
                <?php } ?>

                <form class="form-horizontal" name="chngpwd" method="post" onSubmit="return valid();">
                  <!-- Current Password -->
                  <div class="form-group">
                    <label class="form-label" for="password">
                      <i class="icon-lock"></i> Current Password
                    </label>
                    <div class="input-group">
                      <input type="password" placeholder="Enter current password" name="password" id="password"
                        class="form-control" required>
                      <span class="input-group-text" onclick="togglePassword('password','icon1')">
                        <i id="icon1" class="fa fa-eye"></i>
                      </span>
                    </div>
                  </div>

                  <!-- New Password -->
                  <div class="form-group">
                    <label class="form-label" for="newpassword">
                      <i class="icon-key"></i> New Password
                    </label>
                    <div class="input-group">
                      <input type="password" placeholder="Enter new password" name="newpassword" id="newpassword"
                        class="form-control" required onkeyup="checkStrength(this.value); checkMatch();">
                      <span class="input-group-text" onclick="togglePassword('newpassword','icon2')">
                        <i id="icon2" class="fa fa-eye"></i>
                      </span>
                    </div>
                    <small id="strengthMsg" class="password-strength"></small>
                  </div>

                  <!-- Confirm Password -->
                  <div class="form-group">
                    <label class="form-label" for="confirmpassword">
                      <i class="icon-ok"></i> Confirm New Password
                    </label>
                    <div class="input-group">
                      <input type="password" placeholder="Re-enter new password" name="confirmpassword"
                        id="confirmpassword" class="form-control" required onkeyup="checkMatch();">
                      <span class="input-group-text" onclick="togglePassword('confirmpassword','icon3')">
                        <i id="icon3" class="fa fa-eye"></i>
                      </span>
                    </div>
                    <small id="matchMsg" class="password-match"></small>
                  </div>

                  <!-- Submit Button -->
                  <div class="form-group">
                    <div class="controls">
                      <button type="submit" name="submit" class="btn btn-primary">
                        <i class="icon-save"></i> Change Password
                      </button>
                      <button type="reset" class="btn"
                        style="background-color: var(--gray-200); color: var(--gray-700);">
                        <i class="icon-refresh"></i> Reset Form
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </section>

  <?php include('include/footer.php'); ?>

  <script src="../assets/scripts/jquery-1.9.1.min.js"></script>
  <script>
    // Close alert functionality
    document.addEventListener('DOMContentLoaded', function () {
      var closeButtons = document.querySelectorAll('.close');
      closeButtons.forEach(function (button) {
        button.addEventListener('click', function () {
          this.parentElement.style.display = 'none';
        });
      });
    });
  </script>
</body>

</html>