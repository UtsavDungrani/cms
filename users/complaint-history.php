<?php
session_start();
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
    <meta name="description" content="Complaint Management System - Complaint History">
    <meta name="author" content="ResolveX">
    <meta name="keyword" content="Complaint, Management, System, History, ResolveX">

    <title>ResolveX | Complaint History</title>

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

      .content-panel {
        background: white;
        border-radius: 12px;
        /* Optimized box-shadow for better performance */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        padding: 25px;
        border: 1px solid var(--gray-200);
        margin-bottom: 30px;
      }

      .table-container {
        overflow-x: auto;
      }

      .table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        /* Optimized box-shadow for better performance */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
      }

      .table thead th {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        font-weight: 600;
        padding: 15px;
        text-align: center;
        border: none;
      }

      .table tbody td {
        padding: 15px;
        text-align: center;
        border-bottom: 1px solid var(--gray-200);
        vertical-align: middle;
      }

      .table tbody tr:last-child td {
        border-bottom: none;
      }

      .table tbody tr:hover {
        background-color: var(--gray-100);
      }

      .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 500;
        display: inline-block;
        min-width: 120px;
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

      .btn-view {
        /* Replaced gradient with solid color for better performance */
        background: #2563eb;
        border: none;
        color: white;
        padding: 8px 15px;
        font-size: 14px;
        font-weight: 500;
        border-radius: 6px;
        /* Reduced transition for better performance */
        transition: box-shadow 0.2s ease;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
      }

      .btn-view:hover {
        /* Removed transform for better performance */
        box-shadow: 0 3px 8px rgba(37, 99, 235, 0.3);
      }

      @media (max-width: 768px) {
        #main-content {
          margin-left: 0;
          padding: 15px;
          padding-top: 80px;
        }

        .content-panel {
          padding: 15px;
        }

        .table thead th,
        .table tbody td {
          padding: 10px 8px;
          font-size: 14px;
        }

        .status-badge {
          padding: 4px 8px;
          font-size: 12px;
          min-width: 90px;
        }
      }
    </style>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <section id="container">
      <?php include("includes/header.php"); ?>
      <?php include("includes/sidebar.php"); ?>

      <section id="main-content">
        <section class="wrapper">
          <h3 class="header-title"><i class="fa fa-history"></i> Your Complaint History</h3>
          <div class="row mt">
            <div class="col-lg-12">
              <div class="content-panel">
                <div class="table-container">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Complaint Number</th>
                        <th>Reg Date</th>
                        <th>Last Update</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      // Use the validated user ID
                      $userId = $_SESSION['id'];
                      $query = mysqli_query($bd, "select * from tblcomplaints where userId='$userId'");
                      while ($row = mysqli_fetch_array($query)) {
                        ?>
                        <tr>
                          <td><?php echo htmlentities($row['complaintNumber']); ?></td>
                          <td><?php echo date("M d, Y", strtotime($row['regDate'])); ?></td>
                          <td>
                            <?php echo $row['lastUpdationDate'] ? date("M d, Y", strtotime($row['lastUpdationDate'])) : 'N/A'; ?>
                          </td>
                          <td>
                            <?php
                            $status = $row['status'];
                            if ($status == "" or $status == "NULL") { ?>
                              <span class="status-badge status-pending">Not Processed</span>
                            <?php } elseif (strtolower($status) == "in process") { ?>
                              <span class="status-badge status-process">In Process</span>
                            <?php } elseif (strtolower($status) == "closed") { ?>
                              <span class="status-badge status-closed">Closed</span>
                            <?php } else { ?>
                              <span class="status-badge status-pending"><?php echo htmlentities($status); ?></span>
                            <?php } ?>
                          </td>
                          <td>
                            <a href="complaint-details.php?cid=<?php echo htmlentities($row['complaintNumber']); ?>"
                              class="btn-view">
                              <i class="fa fa-eye"></i> View Details
                            </a>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div><!-- /content-panel -->
            </div><!-- /col-lg-12 -->
          </div><!-- /row -->
        </section><!-- /wrapper -->
      </section><!-- /MAIN CONTENT -->

      <?php include("includes/footer.php"); ?>
    </section><!-- /container -->

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="../assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../assets/js/jquery.scrollTo.min.js"></script>
    <!-- <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script> -->
    <script src="../assets/js/common-scripts.js"></script>
  </body>

  </html>
<?php } ?>