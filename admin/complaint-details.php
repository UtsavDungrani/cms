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
		<title>Admin| Complaint Details</title>
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

			.btn-primary {
				background: var(--primary-color);
				border: none;
				padding: 8px 16px;
				border-radius: 6px;
				font-weight: 500;
				font-size: 14px;
				margin-right: 10px;
				margin-bottom: 10px;
			}

			.btn-primary:hover {
				background: var(--secondary-color);
				text-decoration: none;
			}

			.btn-success {
				background: var(--success-color);
				border: none;
				padding: 8px 16px;
				border-radius: 6px;
				font-weight: 500;
				font-size: 14px;
				margin-right: 10px;
				margin-bottom: 10px;
			}

			.btn-success:hover {
				background: #059669;
				text-decoration: none;
			}

			.status-badge {
				padding: 5px 12px;
				border-radius: 20px;
				font-size: 13px;
				font-weight: 600;
			}

			.status-pending {
				background: rgba(245, 158, 11, 0.15);
				color: var(--warning-color);
			}

			.status-process {
				background: rgba(59, 130, 246, 0.15);
				color: var(--info-color);
			}

			.status-closed {
				background: rgba(16, 185, 129, 0.15);
				color: var(--success-color);
			}

			a {
				color: var(--primary-color);
				text-decoration: none;
				font-weight: 500;
			}

			a:hover {
				color: var(--secondary-color);
				text-decoration: underline;
			}

			@media (max-width: 768px) {
				#main-content {
					margin-left: 260px;
					padding: 15px;
					padding-top: 80px;
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
			var popUpWin = 0;
			function popUpWindow(URLStr, left, top, width, height) {
				if (popUpWin) {
					if (!popUpWin.closed) popUpWin.close();
				}
				popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width=' + 600 + ',height=' + 600 + ',left=' + left + ', top=' + top + ',screenX=' + left + ',screenY=' + top + '');
			}

		</script>

	</head>

	<body>
		<section id="container">
			<?php include('include/header.php'); ?>
			<?php include('include/sidebar.php'); ?>

			<section id="main-content">
				<section class="wrapper">
					<h3 class="header-title"><i class="icon-file-text"></i> Complaint Details</h3>

					<div class="module">
						<div class="module-head">
							<h3>Complaint Information</h3>
						</div>
						<div class="module-body">
							<?php
							$query = mysqli_query($bd, "select t.*,u.fullName as name,cat.categoryName as catname from tblcomplaints t join users u on u.id=t.userId join category cat on cat.id=t.category where t.complaintNumber='" . $_GET['cid'] . "'");
							while ($row = mysqli_fetch_array($query)) {
								?>

								<div class="detail-section">
									<h4>Basic Information</h4>
									<div class="detail-row">
										<div class="detail-label">Complaint Number:</div>
										<div class="detail-value"><?php echo htmlentities($row['complaintNumber']); ?></div>
									</div>
									<div class="detail-row">
										<div class="detail-label">Complainant Name:</div>
										<div class="detail-value"><?php echo htmlentities($row['name']); ?></div>
									</div>
									<div class="detail-row">
										<div class="detail-label">Registration Date:</div>
										<div class="detail-value"><?php echo htmlentities($row['regDate']); ?></div>
									</div>
								</div>

								<div class="detail-section">
									<h4>Category Information</h4>
									<div class="detail-row">
										<div class="detail-label">Category:</div>
										<div class="detail-value"><?php echo htmlentities($row['catname']); ?></div>
									</div>
									<div class="detail-row">
										<div class="detail-label">SubCategory:</div>
										<div class="detail-value"><?php echo htmlentities($row['subcategory']); ?></div>
									</div>
									<div class="detail-row">
										<div class="detail-label">Complaint Type:</div>
										<div class="detail-value"><?php echo htmlentities($row['complaintType']); ?></div>
									</div>
								</div>

								<div class="detail-section">
									<h4>Complaint Details</h4>
									<div class="detail-row">
										<div class="detail-label">State:</div>
										<div class="detail-value">
											<?php echo htmlentities($row['state']); ?>
										</div>
									</div>
									<div class="detail-row">
										<div class="detail-label">City:</div>
										<div class="detail-value">
											<?php echo htmlentities($row['city']); ?>
										</div>
									</div>
									<div class="detail-row">
										<div class="detail-label">Area:</div>
										<div class="detail-value">
											<?php echo htmlentities($row['area']); ?>
										</div>
									</div>
									<div class="detail-row">
										<div class="detail-label">Nature of Complaint:</div>
										<div class="detail-value"><?php echo htmlentities($row['noc']); ?></div>
									</div>
									<div class="detail-row">
										<div class="detail-label">Complaint Details:</div>
										<div class="detail-value"><?php echo htmlentities($row['complaintDetails']); ?></div>
									</div>
									<div class="detail-row">
										<div class="detail-label">Attached File:</div>
										<div class="detail-value">
											<?php $cfile = $row['complaintFile'];
											if ($cfile == "" || $cfile == "NULL") {
												echo "No file attached";
											} else { ?>
												<a href="../users/complaintdocs/<?php echo htmlentities($row['complaintFile']); ?>"
													target="_blank">View File</a>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						</div>

						<?php $ret = mysqli_query($bd, "select complaintremark.remark as remark,complaintremark.status as sstatus,complaintremark.remarkDate as rdate from complaintremark join tblcomplaints on tblcomplaints.complaintNumber=complaintremark.complaintNumber where complaintremark.complaintNumber='" . $_GET['cid'] . "'");
						while ($rw = mysqli_fetch_array($ret)) {
							?>
							<div class="detail-section">
								<h4>Remark History</h4>
								<div class="detail-row">
									<div class="detail-label">Remark:</div>
									<div class="detail-value"><?php echo htmlentities($rw['remark']); ?></div>
								</div>
								<div class="detail-row">
									<div class="detail-label">Remark Date:</div>
									<div class="detail-value"><?php echo htmlentities($rw['rdate']); ?></div>
								</div>
								<div class="detail-row">
									<div class="detail-label">Status:</div>
									<div class="detail-value">
										<?php
										$status = htmlentities($rw['sstatus']);
										if ($status == "" || $status == "NULL") {
											echo "<span class='status-badge status-pending'>Pending</span>";
										} elseif (strtolower($status) == "in process") {
											echo "<span class='status-badge status-process'>In Process</span>";
										} else {
											echo "<span class='status-badge status-closed'>Closed</span>";
										}
										?>
									</div>
								</div>
							</div>
						<?php } ?>

						<div class="detail-section">
							<h4>Final Status</h4>
							<div class="detail-row">
								<div class="detail-label">Current Status:</div>
								<div class="detail-value">
									<?php
									$finalStatus = $row['status'];
									if ($finalStatus == "" || $finalStatus == "NULL") {
										echo "<span class='status-badge status-pending'>Not Processed Yet</span>";
									} elseif (strtolower($finalStatus) == "in process") {
										echo "<span class='status-badge status-process'>In Process</span>";
									} else {
										echo "<span class='status-badge status-closed'>Closed</span>";
									}
									?>
								</div>
							</div>
						</div>

						<div class="detail-section">
							<h4>Actions</h4>
							<div class="detail-row">
								<div class="detail-label">Available Actions:</div>
								<div class="detail-value">
									<?php if ($row['status'] == "closed") {
										echo "<span class='status-badge status-closed'>Complaint is closed</span>";
									} else { ?>
										<a href="javascript:void(0);"
											onClick="popUpWindow('updatecomplaint.php?cid=<?php echo htmlentities($row['complaintNumber']); ?>');"
											title="Update order">
											<button type="button" class="btn btn-primary">Take Action</button>
										</a>
									<?php } ?>

									<a href="javascript:void(0);"
										onClick="popUpWindow('userprofile.php?uid=<?php echo htmlentities($row['userId']); ?>');"
										title="Update order">
										<button type="button" class="btn btn-primary">View User Details</button>
									</a>
								</div>
							</div>
						</div>

					<?php } ?>
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