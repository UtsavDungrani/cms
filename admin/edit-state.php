<?php
session_start();
include('../config/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
	date_default_timezone_set('Asia/Kolkata');// change according timezone
	$currentTime = date('d-m-Y h:i:s A', time());


	if (isset($_POST['submit'])) {
		$state = $_POST['state'];
		$description = $_POST['description'];
		$id = intval($_GET['id']);
		$sql = mysqli_query($bd, "update state set stateName='$state',stateDescription='$description',updationDate='$currentTime' where id='$id'");
		$_SESSION['msg'] = "State info Updated !!";

	}

	?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin| Edit State</title>
		<link rel="icon" type="image/x-icon" href="../img/favicon.ico">
		<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link type="text/css" href="../assets/css/theme.css" rel="stylesheet">
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

			.module {
				background: white;
				border-radius: 12px;
				box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
				padding: 25px;
				border: 1px solid var(--gray-200);
				margin-bottom: 30px;
				transition: box-shadow 0.2s ease;
			}

			.module:hover {
				box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
			}

			.module-head {
				margin-top: 0;
				padding-bottom: 15px;
				border-bottom: 1px solid var(--gray-200);
				color: var(--gray-900);
				display: flex;
				justify-content: space-between;
				align-items: center;
			}

			.module-head h3 {
				margin: 0;
				font-size: 24px;
				font-weight: 700;
			}

			.alert {
				padding: 15px;
				border-radius: 8px;
				margin-bottom: 20px;
				font-weight: 500;
			}

			.alert-success {
				background: rgba(16, 185, 129, 0.15);
				color: var(--success-color);
				border: 1px solid var(--success-color);
			}

			.alert .close {
				float: right;
				font-size: 21px;
				line-height: 1;
				color: inherit;
				text-shadow: 0 1px 0 #fff;
				opacity: 0.5;
				cursor: pointer;
				background: transparent;
				border: 0;
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

			@media (max-width: 768px) {
				#main-content {
					margin-left: 260px;
					padding: 15px;
					padding-top: 80px;
				}
			}
		</style>
	</head>

	<body>
		<section id="container">
			<?php include('include/header.php'); ?>
			<?php include('include/sidebar.php'); ?>

			<section id="main-content">
				<section class="wrapper">
					<h3 class="header-title"><i class="icon-edit"></i> Edit State</h3>

					<div class="module">
						<div class="module-head">
							<h3>Edit State</h3>
						</div>
						<div class="module-body">
							<?php if (isset($_POST['submit'])) { ?>
								<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>
									<?php echo htmlentities($_SESSION['msg']); ?>
									<?php echo htmlentities($_SESSION['msg'] = ""); ?>
								</div>
							<?php } ?>

							<form class="form-horizontal row-fluid" name="Category" method="post">
								<?php
								$id = intval($_GET['id']);
								$query = mysqli_query($bd, "select * from state where id='$id'");
								while ($row = mysqli_fetch_array($query)) {
									?>
									<div class="form-group">
										<label class="form-label" for="basicinput">State Name</label>
										<div class="controls">
											<input type="text" placeholder="Enter State Name" name="state"
												value="<?php echo htmlentities($row['stateName']); ?>" class="form-control"
												required>
										</div>
									</div>

									<div class="form-group">
										<label class="form-label" for="basicinput">Description</label>
										<div class="controls">
											<textarea class="form-control form-textarea" name="description"
												rows="5"><?php echo htmlentities($row['stateDescription']); ?></textarea>
										</div>
									</div>
								<?php } ?>

								<div class="form-group">
									<div class="controls">
										<button type="submit" name="submit" class="btn btn-primary">Update</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</section>
			</section>
		</section>

		<?php include('include/footer.php'); ?>

		<script src="../assets/scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
		<script src="../assets/scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
		<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="../assets/scripts/flot/jquery.flot.js" type="text/javascript"></script>
		<script src="../assets/scripts/datatables/jquery.dataTables.js"></script>
		<script>
			$(document).ready(function () {
				$('.datatable-1').dataTable();
				$('.dataTables_paginate').addClass("btn-group datatable-pagination");
				$('.dataTables_paginate > a').wrapInner('<span />');
				$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
				$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
			});
		</script>
	</body>
<?php } ?>