<?php
session_start();
error_reporting(0);
include('../config/config.php');
if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
} else {

  if (isset($_POST['submit'])) {
    $uid = $_SESSION['id'];
    $category = $_POST['category'];
    $subcat = $_POST['subcategory'];
    $area_id = $_POST['area_id'];
    $complaintype = $_POST['complaintype'];
    $state_id = $_POST['state'];
    $city_id = $_POST['city_id'];
    $noc = $_POST['noc'];
    $complaintdetials = $_POST['complaindetails'];
    $compfile = $_FILES["compfile"]["name"];

    // Fetch state name
    $state_query = mysqli_query($bd, "select stateName from state where id='$state_id'");
    $state_row = mysqli_fetch_array($state_query);
    $state_name = $state_row['stateName'];

    move_uploaded_file($_FILES["compfile"]["tmp_name"], "complaintdocs/" . $_FILES["compfile"]["name"]);
    $query = mysqli_query($bd, "insert into tblcomplaints(userId,category,subcategory,complaintType,state,city,area,noc,complaintDetails,complaintFile) values('$uid','$category','$subcat','$complaintype','$state_name','$city_id','$area_id','$noc','$complaintdetials','$compfile')");

    if ($query) {
      $sql = mysqli_query($bd, "select complaintNumber from tblcomplaints  order by complaintNumber desc limit 1");
      while ($row = mysqli_fetch_array($sql)) {
        $cmpn = $row['complaintNumber'];
      }
      $complainno = $cmpn;
      $successmsg = "Your complaint has been successfully filed and your complaint number is " . $complainno;
    } else {
      $errormsg = "Error filing complaint: " . mysqli_error($bd);
    }
  }
  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Complaint Management System - Register Complaint">
    <meta name="author" content="ResolveX">
    <meta name="keyword" content="Complaint, Management, System, Register, ResolveX">

    <title>ResolveX | User Register Complaint</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
    <!--external css-->
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
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
        --navbar-bg: #2c3e50;
      }

      body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f1f5f9;
        color: #334155;
        line-height: 1.6;
      }

      #main-content {
        margin-left: 260px;
        padding: 20px 15px;
        padding-top: 80px;
        /* Add padding to prevent content from being hidden under header */
      }

      .header-title {
        color: var(--dark-color);
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
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        padding: 30px;
        margin-bottom: 30px;
        border: 1px solid #e2e8f0;
      }

      .form-group {
        margin-bottom: 25px;
      }

      .control-label {
        font-weight: 600;
        color: #334155;
        font-size: 16px;
        margin-bottom: 8px;
      }

      .form-control {
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        padding: 12px 15px;
        font-size: 16px;
        transition: all 0.3s ease;
        height: auto;
      }

      .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
        outline: none;
      }

      select.form-control {
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        padding: 12px 15px;
        font-size: 16px;
        transition: all 0.3s ease;
        height: auto;
        background-color: white;
      }

      select.form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
        outline: none;
      }

      textarea.form-control {
        min-height: 150px;
        resize: vertical;
      }

      .btn-primary {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border: none;
        color: white;
        padding: 14px 25px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
      }

      .btn-primary:hover {
        transform: translateY(-2px);
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

      .page-header {
        margin: 0 0 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid #e2e8f0;
      }

      @media (max-width: 768px) {
        #main-content {
          margin-left: 0;
          padding: 15px;
        }

        .form-panel {
          padding: 20px;
        }
      }
    </style>

    <script>
      function getCat(val) {
        //alert('val');

        $.ajax({
          type: "POST",
          url: "getsubcat.php",
          data: 'catid=' + val,
          success: function (data) {
            $("#subcategory").html(data);

          }
        });
      }

      function getCity(val) {
        $.ajax({
          type: "POST",
          url: "getcity.php",
          data: 'stateid=' + val,
          success: function (data) {
            $("#city_id").html(data);
          }
        });
      }

      function getArea(val) {
        $.ajax({
          type: "POST",
          url: "getarea.php",
          data: 'cityid=' + val,
          success: function (data) {
            $("#area_id").html(data);
          }
        });
      }
    </script>

  </head>

  <body>

    <section id="container">
      <?php include("includes/header.php"); ?>
      <?php include("includes/sidebar.php"); ?>
      <section id="main-content">
        <section class="wrapper">
          <h3 class="header-title"><i class="fa fa-edit"></i> Register New Complaint</h3>

          <!-- BASIC FORM ELELEMNTS -->
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

                <form class="form-horizontal style-form" method="post" name="complaint" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">Category</label>
                        <select name="category" id="category" class="form-control" onChange="getCat(this.value);"
                          required="">
                          <option value="">Select Category</option>
                          <?php $sql = mysqli_query($bd, "select id,categoryName from category ");
                          while ($rw = mysqli_fetch_array($sql)) {
                            ?>
                            <option value="<?php echo htmlentities($rw['id']); ?>">
                              <?php echo htmlentities($rw['categoryName']); ?>
                            </option>
                            <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">Sub Category</label>
                        <select name="subcategory" id="subcategory" class="form-control">
                          <option value="">Select Subcategory</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">Complaint Type</label>
                        <select name="complaintype" class="form-control" required="">
                          <option value="Complaint">Complaint</option>
                          <option value="General Query">General Query</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">State</label>
                        <select name="state" id="state" required="required" class="form-control"
                          onChange="getCity(this.value);">
                          <option value="">Select State</option>
                          <?php $sql = mysqli_query($bd, "select id, stateName from state ");
                          while ($rw = mysqli_fetch_array($sql)) {
                            ?>
                            <option value="<?php echo htmlentities($rw['id']); ?>">
                              <?php echo htmlentities($rw['stateName']); ?>
                            </option>
                            <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">Nature of Complaint</label>
                        <input type="text" name="noc" required="required" value="" class="form-control"
                          placeholder="Enter nature of complaint">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">Select City</label>
                        <select name="city_id" id="city_id" class="form-control" onChange="getArea(this.value);">
                          <option value="">Select City</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">Select Area</label>
                        <select name="area_id" id="area_id" class="form-control" required="">
                          <option value="">Select Area</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label">Complaint Details (max 2000 words)</label>
                    <textarea name="complaindetails" required="required" class="form-control" maxlength="2000"
                      placeholder="Describe your complaint in detail..."></textarea>
                  </div>

                  <div class="form-group">
                    <label class="control-label">Complaint Related Document (if any)</label>
                    <input type="file" name="compfile" class="form-control">
                  </div>

                  <div class="form-group text-center">
                    <button type="submit" name="submit" class="btn btn-primary">
                      <i class="fa fa-paper-plane"></i> Submit Complaint
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
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>

    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>

    <!--custom switch-->
    <script src="assets/js/bootstrap-switch.js"></script>

    <!--custom tagsinput-->
    <script src="assets/js/jquery.tagsinput.js"></script>

    <!--custom checkbox & radio-->
    <script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-daterangepicker/date.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
    <script src="assets/js/form-component.js"></script>

    <script>
      //custom select box
      $(function () {
        $('select.styled').customSelect();
      });
    </script>

  </body>

  </html>
<?php } ?>