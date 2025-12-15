<?php session_start();
error_reporting(0);
include('../config/config.php');
if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
} else {
  // Ensure user ID is properly set in session
  if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
    // If user ID is not set, retrieve it from database
    $userEmail = $_SESSION['login'];
    $userQuery = mysqli_query($bd, "SELECT id FROM users WHERE userEmail='$userEmail'");
    $userResult = mysqli_fetch_array($userQuery);
    if ($userResult) {
      $_SESSION['id'] = $userResult['id'];
    } else {
      // If user not found, redirect to login
      header('location:index.php');
      exit();
    }
  }
  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Complaint Management System - Complaint Details">
    <meta name="author" content="ResolveX">
    <meta name="keyword" content="Complaint, Management, System, Details, ResolveX">

    <title>ResolveX | Complaint Details</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">

    <!-- Bootstrap core CSS -->
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

      .content-panel {
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        padding: 30px;
        border: 1px solid var(--gray-200);
        margin-bottom: 30px;
      }

      .detail-row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -15px 20px;
      }

      .detail-group {
        flex: 1 0 300px;
        padding: 0 15px;
        margin-bottom: 20px;
      }

      .detail-label {
        font-weight: 600;
        color: var(--gray-600);
        margin-bottom: 8px;
        font-size: 15px;
      }

      .detail-value {
        font-size: 16px;
        color: var(--gray-800);
        padding: 12px 15px;
        background: var(--gray-100);
        border-radius: 8px;
        border: 1px solid var(--gray-200);
      }

      .status-badge {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
        display: inline-block;
      }

      .status-pending {
        background-color: rgba(245, 158, 11, 0.15);
        color: var(--warning-color);
        border: 1px solid var(--warning-color);
      }

      .status-process {
        background-color: rgba(59, 130, 246, 0.15);
        color: var(--info-color);
        border: 1px solid var(--info-color);
      }

      .status-closed {
        background-color: rgba(16, 185, 129, 0.15);
        color: var(--success-color);
        border: 1px solid var(--success-color);
      }

      .remark-card {
        background: var(--gray-100);
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        border-left: 4px solid var(--primary-color);
      }

      .remark-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
      }

      .remark-date {
        color: var(--gray-500);
        font-size: 14px;
      }

      .remark-content {
        margin-bottom: 15px;
      }

      .remark-status {
        font-weight: 600;
        color: var(--primary-color);
      }

      hr {
        border: 0;
        height: 1px;
        background: var(--gray-200);
        margin: 30px 0;
      }

      @media (max-width: 768px) {
        #main-content {
          margin-left: 0;
          padding: 15px;
        }

        .content-panel {
          padding: 20px;
        }

        .detail-group {
          flex: 1 0 100%;
        }
      }
    </style>
  </head>

  <body>
    <section id="container">
      <?php include('includes/header.php'); ?>
      <?php include('includes/sidebar.php'); ?>

      <section id="main-content">
        <section class="wrapper">
          <h3 class="header-title"><i class="fa fa-file-text"></i> Complaint Details</h3>

          <div class="content-panel">
            <?php
            // Use the validated user ID
            $userId = $_SESSION['id'];
            $query = mysqli_query($bd, "select t.*, cat.categoryName as catname from tblcomplaints t join category cat on cat.id=t.category where t.userId='$userId' and t.complaintNumber='" . $_GET['cid'] . "'");
            while ($row = mysqli_fetch_array($query)) { ?>

              <div class="detail-row">
                <div class="detail-group">
                  <div class="detail-label">Complaint Number</div>
                  <div class="detail-value"><?php echo htmlentities($row['complaintNumber']); ?></div>
                </div>

                <div class="detail-group">
                  <div class="detail-label">Registration Date</div>
                  <div class="detail-value"><?php echo date("M d, Y h:i A", strtotime($row['regDate'])); ?></div>
                </div>
              </div>

              <div class="detail-row">
                <div class="detail-group">
                  <div class="detail-label">Category</div>
                  <div class="detail-value"><?php echo htmlentities($row['catname']); ?></div>
                </div>

                <div class="detail-group">
                  <div class="detail-label">Sub Category</div>
                  <div class="detail-value"><?php echo htmlentities($row['subcategory']); ?></div>
                </div>
              </div>

              <div class="detail-row">
                <div class="detail-group">
                  <div class="detail-label">Complaint Type</div>
                  <div class="detail-value"><?php echo htmlentities($row['complaintType']); ?></div>
                </div>

                <div class="detail-group">
                  <div class="detail-label">State</div>
                  <div class="detail-value"><?php echo htmlentities($row['state']); ?></div>
                </div>
              </div>

              <div class="detail-row">
                <div class="detail-group">
                  <div class="detail-label">City</div>
                  <div class="detail-value"><?php echo htmlentities($row['city']); ?></div>
                </div>
                <div class="detail-group">
                  <div class="detail-label">Area</div>
                  <div class="detail-value"><?php echo htmlentities($row['area']); ?></div>
                </div>
              </div>

              <div class="detail-row">
                <div class="detail-group">
                  <div class="detail-label">Nature of Complaint</div>
                  <div class="detail-value"><?php echo htmlentities($row['noc']); ?></div>
                </div>
              </div>
              <div class="detail-value">
                <?php $cfile = $row['complaintFile'];
                if ($cfile == "" || $cfile == "NULL") {
                  echo "No file attached";
                } else { ?>
                  <a href="complaintdocs/<?php echo htmlentities($row['complaintFile']); ?>" target="_blank" class="btn-view">
                    <i class="fa fa-download"></i> Download File
                  </a>
                <?php } ?>
              </div>
            </div>
            </div>

            <div class="detail-group" style="flex: 1 0 100%;">
              <div class="detail-label">Complaint Details</div>
              <div class="detail-value" style="white-space: pre-wrap;">
                <?php echo htmlentities($row['complaintDetails']); ?>
              </div>
            </div>

            <hr>

            <h4 style="color: var(--gray-900); margin-bottom: 20px;"><i class="fa fa-comments"></i> Administrator Remarks
            </h4>

            <?php
            $ret = mysqli_query($bd, "select complaintremark.remark as remark,complaintremark.status as sstatus,complaintremark.remarkDate as rdate from complaintremark join tblcomplaints on tblcomplaints.complaintNumber=complaintremark.complaintNumber where complaintremark.complaintNumber='" . $_GET['cid'] . "'");
            $hasRemarks = false;
            while ($rw = mysqli_fetch_array($ret)) {
              $hasRemarks = true;
              ?>
              <div class="remark-card">
                <div class="remark-header">
                  <div class="remark-content"><?php echo htmlentities($rw['remark']); ?></div>
                  <div class="remark-date"><?php echo date("M d, Y h:i A", strtotime($rw['rdate'])); ?></div>
                </div>
                <div class="remark-status">Status: <?php echo htmlentities($rw['sstatus']); ?></div>
              </div>
            <?php }
            if (!$hasRemarks) {
              echo "<p>No remarks available for this complaint.</p>";
            }
            ?>

            <hr>

            <h4 style="color: var(--gray-900); margin-bottom: 20px;"><i class="fa fa-info-circle"></i> Final Status</h4>

            <div class="detail-group">
              <div class="detail-label">Current Status</div>
              <div class="detail-value">
                <?php
                if ($row['status'] == "NULL" || $row['status'] == "") {
                  echo "<span class='status-badge status-pending'>Not Processed Yet</span>";
                } else {
                  $status = $row['status'];
                  if (strtolower($status) == "in process") {
                    echo "<span class='status-badge status-process'>In Process</span>";
                  } elseif (strtolower($status) == "closed") {
                    echo "<span class='status-badge status-closed'>Closed</span>";
                  } else {
                    echo "<span class='status-badge status-pending'>" . htmlentities($status) . "</span>";
                  }
                }
                ?>
              </div>
            </div>

          <?php } ?>
          </div>
        </section>
      </section>

      <?php include('includes/footer.php'); ?>
    </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
    <script class="include" type="text/javascript" src="../assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../assets/js/jquery.scrollTo.min.js"></script>
    <!-- Removed jquery.nicescroll.js to fix passive event listener errors -->
    <!-- <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script> -->

    <!--common script for all pages-->
    <script src="../assets/js/common-scripts.js"></script>
  </body>

  </html>
<?php } ?>