<?php
session_start();
error_reporting(0);
include('../config/config.php');
if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
  exit;
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
    <meta name="description" content="Complaint Management System - User Dashboard">
    <meta name="author" content="ResolveX">
    <meta name="keyword" content="Complaint, Management, System, Dashboard, ResolveX">

    <title>ResolveX | Dashboard</title>

    <!-- Bootstrap core CSS -->
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

      .stats-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 30px;
      }

      .stat-card {
        flex: 1;
        min-width: 250px;
        background: white;
        border-radius: 12px;
        /* Optimized box-shadow for better performance */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        padding: 25px;
        border: 1px solid var(--gray-200);
        /* Reduced transition for better performance */
        transition: box-shadow 0.2s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
      }

      .stat-card:hover {
        /* Removed transform for better performance */
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      }

      .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        font-size: 24px;
      }

      .stat-icon.pending {
        background: rgba(245, 158, 11, 0.15);
        color: var(--warning-color);
      }

      .stat-icon.process {
        background: rgba(59, 130, 246, 0.15);
        color: var(--info-color);
      }

      .stat-icon.closed {
        background: rgba(16, 185, 129, 0.15);
        color: var(--success-color);
      }

      .stat-number {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 10px;
        color: var(--gray-900);
      }

      .stat-label {
        font-size: 16px;
        color: var(--gray-600);
        font-weight: 500;
      }

      .recent-activity {
        background: white;
        border-radius: 12px;
        /* Optimized box-shadow for better performance */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        padding: 25px;
        border: 1px solid var(--gray-200);
        margin-top: 20px;
      }

      .recent-activity h3 {
        margin-top: 0;
        padding-bottom: 15px;
        border-bottom: 1px solid var(--gray-200);
        color: var(--gray-900);
      }

      .activity-item {
        display: flex;
        padding: 15px 0;
        border-bottom: 1px solid var(--gray-200);
      }

      .activity-item:last-child {
        border-bottom: none;
      }

      .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--gray-100);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        flex-shrink: 0;
      }

      .activity-content {
        flex: 1;
      }

      .activity-title {
        font-weight: 600;
        margin-bottom: 5px;
      }

      .activity-time {
        font-size: 14px;
        color: var(--gray-500);
      }

      @media (max-width: 768px) {
        #main-content {
          margin-left: 0;
          padding: 15px;
          padding-top: 80px;
        }

        .stats-container {
          flex-direction: column;
        }

        .stat-card {
          min-width: 100%;
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
          <h3 class="header-title"><i class="fa fa-dashboard"></i> Dashboard Overview</h3>

          <div class="stats-container">
            <?php
            // Use the validated user ID
            $userId = $_SESSION['id'];

            // Complaint statuses with icons
            $statuses = [
              "Pending" => ["condition" => "status IS NULL", "icon" => "fa fa-folder-open", "class" => "pending"],
              "In Process" => ["condition" => "status='in process'", "icon" => "fa fa-spinner", "class" => "process"],
              "Closed" => ["condition" => "status='closed'", "icon" => "fa fa-check-circle", "class" => "closed"]
            ];

            foreach ($statuses as $label => $data) {
              $query = "SELECT COUNT(*) AS total FROM tblcomplaints WHERE userId='$userId' AND " . $data['condition'];
              $result = mysqli_query($bd, $query);
              $row = mysqli_fetch_assoc($result);
              $count = $row['total'];
              ?>

              <div class="stat-card">
                <div class="stat-icon <?php echo $data['class']; ?>">
                  <i class="<?php echo $data['icon']; ?>"></i>
                </div>
                <div class="stat-number"><?php echo htmlentities($count); ?></div>
                <div class="stat-label"><?php echo $label; ?></div>
              </div>

            <?php } ?>
          </div>

          <div class="recent-activity">
            <h3><i class="fa fa-history"></i> Recent Complaints</h3>
            <?php
            $recentQuery = "SELECT complaintNumber, regDate, status FROM tblcomplaints WHERE userId='$userId' ORDER BY regDate DESC LIMIT 5";
            $recentResult = mysqli_query($bd, $recentQuery);

            if (mysqli_num_rows($recentResult) > 0) {
              while ($recentRow = mysqli_fetch_array($recentResult)) {
                ?>
                <div class="activity-item">
                  <div class="activity-icon">
                    <i class="fa fa-file-text"></i>
                  </div>
                  <div class="activity-content">
                    <div class="activity-title">Complaint #<?php echo htmlentities($recentRow['complaintNumber']); ?></div>
                    <div class="activity-time">Filed on <?php echo date("M d, Y", strtotime($recentRow['regDate'])); ?></div>
                  </div>
                  <div class="activity-status">
                    <?php
                    $status = $recentRow['status'];
                    if ($status == "" || $status == "NULL") {
                      echo "<span class='badge' style='background-color: #f59e0b; color: white; padding: 5px 10px; border-radius: 20px; font-size: 12px;'>Pending</span>";
                    } elseif (strtolower($status) == "in process") {
                      echo "<span class='badge' style='background-color: #3b82f6; color: white; padding: 5px 10px; border-radius: 20px; font-size: 12px;'>In Process</span>";
                    } else {
                      echo "<span class='badge' style='background-color: #10b981; color: white; padding: 5px 10px; border-radius: 20px; font-size: 12px;'>Closed</span>";
                    }
                    ?>
                  </div>
                </div>
                <?php
              }
            } else {
              echo "<p>No recent complaints found.</p>";
            }
            ?>
          </div>
        </section>
      </section>

      <?php include("includes/footer.php"); ?>
    </section>

    <!-- JS placed at end -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../assets/js/jquery.scrollTo.min.js"></script>
    <!-- <script src="assets/js/jquery.nicescroll.js"></script> -->
    <script src="../assets/js/common-scripts.js"></script>
  </body>

  </html>
<?php } ?>