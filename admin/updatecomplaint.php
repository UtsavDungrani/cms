<?php
session_start();
include('../config/config.php');
if (strlen($_SESSION['alogin']) == 0) {
  header('location:index.php');
} else {
  if (isset($_POST['update'])) {
    $complaintnumber = $_GET['cid'];
    $status = $_POST['status'];
    $remark = $_POST['remark'];
    $query = mysqli_query($bd, "insert into complaintremark(complaintNumber,status,remark) values('$complaintnumber','$status','$remark')");
    $sql = mysqli_query($bd, "update tblcomplaints set status='$status' where complaintNumber='$complaintnumber'");

    echo "<script>alert('Complaint details updated successfully');</script>";

  }

  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Complaint</title>
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

      .form-group {
        margin-bottom: 20px;
      }

      .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--gray-700);
      }

      .form-control {
        width: 100%;
        padding: 12px 15px;
        font-size: 15px;
        line-height: 1.42857143;
        color: var(--gray-700);
        background-color: #fff;
        background-image: none;
        border: 1px solid var(--gray-300);
        border-radius: 6px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
        -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
      }

      .form-control:focus {
        border-color: var(--primary-color);
        outline: 0;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(37, 99, 235, 0.6);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(37, 99, 235, 0.6);
      }

      .form-select {
        height: 45px;
      }

      .form-textarea {
        min-height: 120px;
        resize: vertical;
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

      .btn-primary {
        color: #fff;
        background-color: var(--primary-color);
        border-color: var(--primary-color);
      }

      .btn-primary:hover {
        background-color: var(--secondary-color);
        border-color: var(--secondary-color);
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

      .form-row {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
      }

      .form-col {
        flex: 1;
      }

      .text-center {
        text-align: center;
      }

      @media (max-width: 768px) {
        .container {
          padding: 20px;
          margin: 10px;
        }

        .form-row {
          flex-direction: column;
          gap: 0;
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
      <h3 class="header-title"><i class="icon-edit"></i> Update Complaint</h3>

      <form name="updateticket" id="updatecomplaint" method="post">
        <div class="form-group">
          <label class="form-label" for="complaintNumber"><b>Complaint Number</b></label>
          <div class="form-control-static"><?php echo htmlentities($_GET['cid']); ?></div>
        </div>

        <div class="form-group">
          <label class="form-label" for="status"><b>Status</b></label>
          <select name="status" id="status" class="form-control form-select" required="required">
            <option value="">Select Status</option>
            <option value="in process">In Process</option>
            <option value="closed">Closed</option>
          </select>
        </div>

        <div class="form-group">
          <label class="form-label" for="remark"><b>Remark</b></label>
          <textarea name="remark" id="remark" class="form-control form-textarea" cols="50" rows="10"
            required="required"></textarea>
        </div>

        <div class="form-row">
          <div class="form-col text-center">
            <input type="submit" name="update" value="Submit" class="btn btn-primary">
          </div>
          <div class="form-col text-center">
            <input name="Submit2" type="button" class="btn btn-secondary" value="Close this window" onClick="return f2();"
              style="cursor: pointer;" />
          </div>
        </div>
      </form>
    </div>

  </body>

  </html>

<?php } ?>