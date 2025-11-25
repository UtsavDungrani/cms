<?php
session_start();
error_reporting(0);
include('../config/config.php');
if (strlen($_SESSION['login']) == 0) {
  header('location:../index.php');
} else {
  date_default_timezone_set('Asia/Kolkata');
  $currentTime = date('d-m-Y h:i:s A', time());


  if (isset($_POST['submit'])) {
    $fname = $_POST['fullname'];
    $contactno = $_POST['contactno'];
    $address = $_POST['address'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $pincode = $_POST['pincode'];
    $email_data = $_POST['useremail'];
    $aadhar_card = $_POST['aadhar_card'];
    $query = mysqli_query($bd, "update users set fullName='$fname',contactNo='$contactno',address='$address',State='$state',country='$country',pincode='$pincode',aadhar_card='$aadhar_card' where userEmail='" . $_SESSION['login'] . "'");
    if ($query) {
      $successmsg = "Profile Updated Successfully !!";
    } else {
      $errormsg = "Profile not updated !!";
    }
  }
  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Complaint Management System - User Profile">
    <meta name="author" content="ResolveX">
    <meta name="keyword" content="Complaint, Management, System, Profile, ResolveX">

    <title>ResolveX | User Profile</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
    <link rel="stylesheet" type="text/css" href="../assets/js/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="../assets/js/bootstrap-daterangepicker/daterangepicker.css" />

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

      .profile-header {
        display: flex;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid var(--gray-200);
        text-align: left;
        /* Ensure text alignment is consistent */
      }

      .profile-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--gray-200);
        margin-right: 20px;
        flex-shrink: 0;
        /* Prevent avatar from shrinking */
      }

      .profile-name {
        font-size: 24px;
        font-weight: 700;
        color: var(--gray-900);
        margin: 0 0 5px;
      }

      .profile-email {
        color: var(--gray-600);
        font-size: 16px;
        margin: 0 0 10px;
      }

      .profile-last-updated {
        color: var(--gray-500);
        font-size: 14px;
        margin: 0;
      }

      .form-row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -15px;
      }

      .form-group {
        flex: 1 0 300px;
        padding: 0 15px;
        margin-bottom: 25px;
      }

      .control-label {
        font-weight: 600;
        color: var(--gray-700);
        font-size: 16px;
        margin-bottom: 8px;
        display: block;
        text-align: left !important;
        /* Ensure labels are left-aligned with higher specificity */
      }

      .form-control {
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

      .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
        outline: none;
      }

      textarea.form-control {
        min-height: 120px;
        resize: vertical;
      }

      select.form-control {
        background-color: white;
        background-image: none;
        padding-right: 40px;
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

        .form-group {
          flex: 1 0 100%;
        }

        .profile-header {
          flex-direction: column;
          text-align: center;
        }

        .profile-avatar {
          margin-right: 0;
          margin-bottom: 15px;
        }
      }
    </style>
  </head>

  <body>
    <section id="container">
      <?php include("includes/header.php"); ?>
      <?php include("includes/sidebar.php"); ?>

      <section id="main-content">
        <section class="wrapper">
          <h3 class="header-title"><i class="fa fa-user"></i> Profile Information</h3>

          <div class="row mt">
            <div class="col-lg-12">
              <div class="form-panel">
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

                <?php $query = mysqli_query($bd, "select * from users where userEmail='" . $_SESSION['login'] . "'");
                while ($row = mysqli_fetch_array($query)) { ?>

                  <div class="profile-header">
                    <img src="assets/img/ui-sam.jpg" class="profile-avatar" alt="Profile Image">
                    <div>
                      <h2 class="profile-name"><?php echo htmlentities($row['fullName']); ?></h2>
                      <p class="profile-email"><?php echo htmlentities($row['userEmail']); ?></p>
                      <p class="profile-last-updated">Last Updated: <?php echo htmlentities($row['updationDate']); ?></p>
                    </div>
                  </div>

                  <form class="form-horizontal style-form" method="post" name="profile">
                    <div class="form-row">
                      <div class="form-group">
                        <label class="control-label">Full Name</label>
                        <input type="text" name="fullname" required="required"
                          value="<?php echo htmlentities($row['fullName']); ?>" class="form-control">
                      </div>

                      <div class="form-group">
                        <label class="control-label">User Email</label>
                        <input type="email" name="useremail" required="required"
                          value="<?php echo htmlentities($row['userEmail']); ?>" class="form-control" readonly>
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="form-group">
                        <label class="control-label">Contact Number</label>
                        <input type="text" name="contactno" required="required"
                          value="<?php echo htmlentities($row['contactNo']); ?>" class="form-control">
                      </div>

                      <div class="form-group">
                        <label class="control-label">Aadhar Card Number</label>
                        <input type="text" name="aadhar_card" maxlength="12" required="required"
                          value="<?php echo htmlentities($row['aadhar_card']); ?>" class="form-control">
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="form-group">
                        <label class="control-label">Address</label>
                        <textarea name="address" required="required"
                          class="form-control"><?php echo htmlentities($row['address']); ?></textarea>
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="form-group">
                        <label class="control-label">State</label>
                        <select name="state" required="required" class="form-control">
                          <option value="">Select State</option>
                          <?php $sql = mysqli_query($bd, "select stateName from state ");
                          while ($rw = mysqli_fetch_array($sql)) {
                            if ($rw['stateName'] == $row['State']) {
                              ?>
                              <option value="<?php echo htmlentities($rw['stateName']); ?>" selected>
                                <?php echo htmlentities($rw['stateName']); ?>
                              </option>
                              <?php
                            } else {
                              ?>
                              <option value="<?php echo htmlentities($rw['stateName']); ?>">
                                <?php echo htmlentities($rw['stateName']); ?>
                              </option>
                              <?php
                            }
                          }
                          ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label class="control-label">Country</label>
                        <input type="text" name="country" required="required"
                          value="<?php echo htmlentities($row['country']); ?>" class="form-control">
                      </div>

                      <div class="form-group">
                        <label class="control-label">Pincode</label>
                        <input type="text" name="pincode" maxlength="6" required="required"
                          value="<?php echo htmlentities($row['pincode']); ?>" class="form-control">
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="form-group">
                        <label class="control-label">Registration Date</label>
                        <input type="text" name="regdate" required="required"
                          value="<?php echo htmlentities($row['regDate']); ?>" class="form-control" readonly>
                      </div>
                    </div>

                    <div class="form-group text-center" style="margin-top: 30px;">
                      <button type="submit" name="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Update Profile
                      </button>
                    </div>
                  </form>
                <?php } ?>
              </div>
            </div>
          </div>
        </section>
      </section>

      <?php include("includes/footer.php"); ?>
    </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <!-- <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script> -->

    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>

    <!--custom switch-->
    <script src="assets/js/bootstrap-switch.js"></script>

    <script>
      //custom select box
      $(function () {
        $('select.styled').customSelect();
      });

      // Toggle between view and edit modes
      function toggleEditMode() {
        var viewMode = document.querySelector('.detail-row, .detail-group');
        var editForm = document.getElementById('editForm');

        if (editForm.style.display === 'none' || editForm.style.display === '') {
          // Switch to edit mode
          var detailElements = document.querySelectorAll('.detail-row, .detail-group');
          detailElements.forEach(function (element) {
            element.style.display = 'none';
          });
          document.querySelector('.form-group.text-center').style.display = 'none';
          editForm.style.display = 'block';
        } else {
          // Switch to view mode
          var detailElements = document.querySelectorAll('.detail-row, .detail-group');
          detailElements.forEach(function (element) {
            element.style.display = 'flex';
          });
          document.querySelector('.form-group.text-center').style.display = 'block';
          editForm.style.display = 'none';
        }
      }
    </script>
  </body>

  </html>
<?php } ?>