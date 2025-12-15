<?php
session_start();
error_reporting(0);
include('../config/config.php');
if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
} else {
  date_default_timezone_set('Asia/Kolkata');
  $currentTime = date('d-m-Y h:i:s A', time());


  if (isset($_POST['submit'])) {
    $sql = mysqli_query($bd, "SELECT password FROM  users where password='" . md5($_POST['password']) . "' && userEmail='" . $_SESSION['login'] . "'");
    $num = mysqli_fetch_array($sql);
    if ($num > 0) {
      $con = mysqli_query($bd, "update users set password='" . md5($_POST['newpassword']) . "', updationDate='$currentTime' where userEmail='" . $_SESSION['login'] . "'");
      $successmsg = "Password Changed Successfully !!";
    } else {
      $errormsg = "Old Password not match !!";
    }
  }
  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Complaint Management System - Change Password">
    <meta name="author" content="ResolveX">
    <meta name="keyword" content="Complaint, Management, System, Password, ResolveX">

    <title>ResolveX | Change Password</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
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
        /* Add padding to prevent content from being hidden under header */
        /* Added for better scrolling performance */
        transform: translateZ(0);
        -webkit-transform: translateZ(0);
      }

      .header-title {
        color: var(--gray-900);
        font-weight: 700;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--primary-color);
      }

      .header-title i {
        color: var(--primary-color);
        margin-right: 10px;
      }

      .form-panel {
        background: white;
        border-radius: 12px;
        /* Optimized box-shadow for better performance */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        padding: 30px;
        border: 1px solid var(--gray-200);
        margin-bottom: 30px;
      }

      .form-header {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid var(--gray-200);
      }

      .form-header h4 {
        font-size: 22px;
        font-weight: 700;
        color: var(--gray-900);
        margin: 0;
      }

      .form-group {
        margin-bottom: 25px;
      }

      .control-label {
        font-weight: 600;
        color: var(--gray-700);
        font-size: 16px;
        margin-bottom: 8px;
        display: block;
        text-align: left !important;
      }

      .password-wrapper {
        position: relative;
      }

      .password-wrapper input {
        border: 2px solid var(--gray-200);
        border-radius: 8px;
        padding: 12px 15px;
        font-size: 16px;
        /* Reduced transition for better performance */
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
        height: auto;
        width: 100%;
        box-sizing: border-box;
      }

      .password-wrapper input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
        outline: none;
      }

      .password-wrapper .toggle-password {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: var(--gray-400);
        font-size: 18px;
      }

      .password-wrapper .toggle-password:hover {
        color: var(--primary-color);
      }

      .btn-primary {
        /* Replaced gradient with solid color for better performance */
        background: #2563eb;
        border: none;
        color: white;
        padding: 14px 25px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 8px;
        /* Reduced transition for better performance */
        transition: box-shadow 0.2s ease;
        cursor: pointer;
        display: inline-block;
      }

      .btn-primary:hover {
        /* Removed transform for better performance */
        box-shadow: 0 5px 15px rgba(37, 99, 235, 0.3);
      }

      .btn-primary:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.3);
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

      .close {
        color: inherit;
        opacity: 0.7;
        text-shadow: none;
      }

      .close:hover {
        opacity: 1;
      }

      @media (max-width: 768px) {
        #main-content {
          margin-left: 0;
          padding: 15px;
          padding-top: 80px;
        }

        .form-panel {
          padding: 20px;
        }
      }
    </style>

    <script type="text/javascript">
      function valid() {
        if (document.chngpwd.password.value == "") {
          alert("Current Password Field is Empty !!");
          document.chngpwd.password.focus();
          return false;
        }
        else if (document.chngpwd.newpassword.value == "") {
          alert("New Password Field is Empty !!");
          document.chngpwd.newpassword.focus();
          return false;
        }
        else if (document.chngpwd.confirmpassword.value == "") {
          alert("Confirm Password Field is Empty !!");
          document.chngpwd.confirmpassword.focus();
          return false;
        }
        else if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
          alert("Password and Confirm Password Field do not match  !!");
          document.chngpwd.confirmpassword.focus();
          return false;
        }
        return true;
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
    <section id="container">
      <?php include("includes/header.php"); ?>
      <?php include("includes/sidebar.php"); ?>

      <section id="main-content">
        <section class="wrapper">
          <h3 class="header-title"><i class="fa fa-lock"></i> Change Password</h3>

          <div class="row mt">
            <div class="col-lg-12">
              <div class="form-panel">
                <div class="form-header">
                  <h4><i class="fa fa-lock"></i> Update Your Password</h4>
                </div>

                <?php if ($successmsg) { ?>
                  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Success!</b> <?php echo htmlentities($successmsg); ?>
                  </div>
                <?php } ?>

                <?php if ($errormsg) { ?>
                  <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Error!</b> <?php echo htmlentities($errormsg); ?>
                  </div>
                <?php } ?>

                <form class="form-horizontal style-form" method="post" name="chngpwd" onSubmit="return valid();">
                  <div class="form-group">
                    <label class="control-label">Current Password</label>
                    <div class="password-wrapper">
                      <input type="password" name="password" required="required" class="form-control"
                        id="currentPassword">
                      <span class="toggle-password" onclick="togglePassword('currentPassword', this)">
                        <i class="fa fa-eye"></i>
                      </span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label">New Password</label>
                    <div class="password-wrapper">
                      <input type="password" name="newpassword" required="required" class="form-control" id="newPassword">
                      <span class="toggle-password" onclick="togglePassword('newPassword', this)">
                        <i class="fa fa-eye"></i>
                      </span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label">Confirm Password</label>
                    <div class="password-wrapper">
                      <input type="password" name="confirmpassword" required="required" class="form-control"
                        id="confirmPassword">
                      <span class="toggle-password" onclick="togglePassword('confirmPassword', this)">
                        <i class="fa fa-eye"></i>
                      </span>
                    </div>
                  </div>

                  <div class="form-group text-center" style="margin-top: 30px;">
                    <button type="submit" name="submit" class="btn btn-primary">
                      <i class="fa fa-refresh"></i> Change Password
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </section>
      </section>

      <?php include("includes/footer.php"); ?>
    </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="../assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../assets/js/jquery.scrollTo.min.js"></script>
    <!-- Removed jquery.nicescroll.js to fix passive event listener errors -->
    <!-- <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script> -->

    <!--common script for all pages-->
    <script src="../assets/js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="../assets/js/jquery-ui-1.9.2.custom.min.js"></script>

    <!--custom switch-->
    <script src="../assets/js/bootstrap-switch.js"></script>

    <!--custom tagsinput-->
    <script src="../assets/js/jquery.tagsinput.js"></script>

    <script src="../assets/js/form-component.js"></script>
  </body>

  </html>
<?php } ?>