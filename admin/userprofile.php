<?php
session_start();
include('../config/config.php');
if (strlen($_SESSION['alogin']) == 0) {
  header('location:index.php');
} else {

  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link type="text/css" href="../assets/css/theme.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
    <link type="text/css" href="../assets/icons/css/font-awesome.css" rel="stylesheet">
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
        padding: 20px;
      }

      .container {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        padding: 30px;
        border: 1px solid var(--gray-200);
      }

      .header-title {
        color: var(--gray-900);
        font-weight: 700;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--primary-color);
        text-align: center;
      }

      .header-title i {
        color: var(--primary-color);
        margin-right: 10px;
      }

      .profile-header {
        text-align: center;
        margin-bottom: 30px;
      }

      .profile-name {
        font-size: 24px;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 5px;
      }

      .profile-email {
        color: var(--gray-600);
        font-size: 16px;
      }

      .detail-section {
        margin-bottom: 30px;
        padding: 20px;
        background: var(--gray-100);
        border-radius: 8px;
        border: 1px solid var(--gray-200);
      }

      .detail-section h4 {
        margin-top: 0;
        padding-bottom: 10px;
        border-bottom: 1px solid var(--gray-300);
        color: var(--gray-800);
      }

      .detail-row {
        display: flex;
        flex-wrap: wrap;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid var(--gray-200);
      }

      .detail-row:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
      }

      .detail-label {
        font-weight: 600;
        color: var(--gray-700);
        min-width: 200px;
        flex: 1;
      }

      .detail-value {
        flex: 2;
        color: var(--gray-600);
      }

      .status-active {
        background: rgba(16, 185, 129, 0.15);
        color: var(--success-color);
        padding: 5px 12px;
        border-radius: 20px;
        font-weight: 600;
      }

      .status-blocked {
        background: rgba(239, 68, 68, 0.15);
        color: var(--danger-color);
        padding: 5px 12px;
        border-radius: 20px;
        font-weight: 600;
      }

      .btn {
        display: inline-block;
        padding: 10px 20px;
        font-size: 15px;
        font-weight: 500;
        line-height: 1.42857143;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        cursor: pointer;
        border: 1px solid transparent;
        border-radius: 6px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      .btn-secondary {
        color: #fff;
        background-color: var(--gray-600);
        border-color: var(--gray-600);
      }

      .btn-secondary:hover {
        background-color: var(--gray-700);
        border-color: var(--gray-700);
      }

      .text-center {
        text-align: center;
      }

      @media (max-width: 768px) {
        .container {
          padding: 20px;
          margin: 10px;
        }

        .detail-label {
          min-width: 150px;
        }

        .detail-row {
          flex-direction: column;
        }
      }
    </style>

    <script language="javascript" type="text/javascript">
      function f2() {
        window.close();
      }

      function f3() {
        window.print();
      }
    </script>
  </head>

  <body>

    <div class="container">
      <h3 class="header-title"><i class="icon-user"></i> User Profile</h3>

      <?php
      $ret1 = mysqli_query($bd, "select * FROM users where id='" . $_GET['uid'] . "'");
      while ($row = mysqli_fetch_array($ret1)) {
        ?>

        <div class="profile-header">
          <div class="profile-name"><?php echo $row['fullName']; ?>'s Profile</div>
          <div class="profile-email"><?php echo htmlentities($row['userEmail']); ?></div>
        </div>

        <div class="detail-section">
          <h4>Personal Information</h4>
          <div class="detail-row">
            <div class="detail-label">Registration Date:</div>
            <div class="detail-value"><?php echo htmlentities($row['regDate']); ?></div>
          </div>

          <div class="detail-row">
            <div class="detail-label">Contact Number:</div>
            <div class="detail-value"><?php echo htmlentities($row['contactNo']); ?></div>
          </div>

          <div class="detail-row">
            <div class="detail-label">Address:</div>
            <div class="detail-value"><?php echo htmlentities($row['address']); ?></div>
          </div>

          <div class="detail-row">
            <div class="detail-label">State:</div>
            <div class="detail-value"><?php echo htmlentities($row['State']); ?></div>
          </div>

          <div class="detail-row">
            <div class="detail-label">Country:</div>
            <div class="detail-value"><?php echo htmlentities($row['country']); ?></div>
          </div>

          <div class="detail-row">
            <div class="detail-label">Pincode:</div>
            <div class="detail-value"><?php echo htmlentities($row['pincode']); ?></div>
          </div>
        </div>

        <div class="detail-section">
          <h4>Account Information</h4>
          <div class="detail-row">
            <div class="detail-label">Last Updated:</div>
            <div class="detail-value"><?php echo htmlentities($row['updationDate']); ?></div>
          </div>

          <div class="detail-row">
            <div class="detail-label">Status:</div>
            <div class="detail-value">
              <?php if ($row['status'] == 1) {
                echo "<span class='status-active'>Active</span>";
              } else {
                echo "<span class='status-blocked'>Blocked</span>";
              } ?>
            </div>
          </div>
        </div>

        <div class="text-center">
          <input name="Submit2" type="button" class="btn btn-secondary" value="Close this window" onClick="return f2();"
            style="cursor: pointer;" />
        </div>

      <?php } ?>
    </div>

  </body>

  </html>

<?php } ?>