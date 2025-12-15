<?php
session_start();
include('../config/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
	date_default_timezone_set('Asia/Kolkata');// change according timezone
	$currentTime = date('d-m-Y h:i:s A', time());


	?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin| Not Processed Complaints</title>
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
				margin-left: 20px;
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

			.dataTables_wrapper {
				margin-top: 20px;
			}

			table.datatable-1 {
				width: 100% !important;
				border-collapse: collapse;
				background: white;
				border-radius: 8px;
				overflow: hidden;
				box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
				border: 1px solid var(--gray-200);
			}

			table.datatable-1 thead {
				background: var(--gray-100);
			}

			table.datatable-1 thead th {
				padding: 15px;
				text-align: left;
				font-weight: 600;
				color: var(--gray-700);
				border-bottom: 1px solid var(--gray-200);
			}

			table.datatable-1 tbody td {
				padding: 15px;
				border-bottom: 1px solid var(--gray-200);
				color: var(--gray-600);
			}

			table.datatable-1 tbody tr:last-child td {
				border-bottom: none;
			}

			table.datatable-1 tbody tr:hover {
				background: var(--gray-100);
			}

			.btn-danger {
				background: var(--danger-color);
				border: none;
				padding: 6px 12px;
				border-radius: 6px;
				font-weight: 500;
				font-size: 13px;
				color: white;
			}

			.btn-danger:hover {
				background: #dc2626;
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

			.dataTables_paginate {
				margin-top: 20px;
				display: flex;
				justify-content: flex-end;
			}

			.dataTables_paginate .btn-group {
				display: flex;
				gap: 5px;
			}

			.dataTables_paginate .btn-group a {
				padding: 8px 12px;
				background: white;
				border: 1px solid var(--gray-300);
				border-radius: 6px;
				color: var(--gray-700);
				text-decoration: none;
				font-weight: normal;
			}

			.dataTables_paginate .btn-group a:hover {
				background: var(--gray-100);
				text-decoration: none;
			}

			.dataTables_paginate .btn-group a.active {
				background: var(--primary-color);
				color: white;
				border-color: var(--primary-color);
			}

			.icon-chevron-left,
			.icon-chevron-right {
				font-size: 12px;
			}

			@media (max-width: 768px) {
				#main-content {
					margin-left: 0;
					padding: 15px;
					padding-top: 80px;
				}

				table.datatable-1 thead th,
				table.datatable-1 tbody td {
					padding: 10px 8px;
					font-size: 14px;
				}
			}
		</style>

		<script language="javascript" type="text/javascript">
			var popUpWin = 0;
			function popUpWindow(URLStr, left, top, width, height) {
				if (popUpWin) {
					if (!popUpWin.closed) popUpWin.close();
				}
				popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width=' + 500 + ',height=' + 600 + ',left=' + left + ', top=' + top + ',screenX=' + left + ',screenY=' + top + '');
			}

		</script>
	</head>

	<body>
		<section id="container">
			<?php include('include/header.php'); ?>
			<?php include('include/sidebar.php'); ?>

			<section id="main-content">
				<section class="wrapper">
					<h3 class="header-title"><i class="icon-time"></i> Not Processed Complaints</h3>

					<div class="module">
						<div class="module-head">
							<h3>Not Processed Complaints List</h3>
						</div>
						<div class="module-body table">
							<table cellpadding="0" cellspacing="0" border="0"
								class="datatable-1 table table-bordered table-striped	 display">
								<thead>
									<tr>
										<th>Complaint No</th>
										<th>Complainant Name</th>
										<th>Reg Date</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>

								<tbody>
									<?php
									$query = mysqli_query($bd, "select t.*,u.fullName as name from tblcomplaints t join users u on u.id=t.userId where t.status is null ");
									while ($row = mysqli_fetch_array($query)) {
										?>
										<tr>
											<td><?php echo htmlentities($row['complaintNumber']); ?></td>
											<td><?php echo htmlentities($row['name']); ?></td>
											<td><?php echo htmlentities($row['regDate']); ?></td>
											<td><button type="button" class="btn btn-danger">Not Processed</button></td>
											<td><a
													href="complaint-details.php?cid=<?php echo htmlentities($row['complaintNumber']); ?>">View
													Details</a></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</section>
			</section>
		</section>

		<?php include('include/footer.php'); ?>

		<script src="../assets/scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
		<script src="../assets/scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
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