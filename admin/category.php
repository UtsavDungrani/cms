<?php
session_start();
include('../config/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {

	if (isset($_POST['submit'])) {
		$category = $_POST['category'];
		$description = $_POST['description'];
		$sql = mysqli_query($bd, "insert into category(categoryName,categoryDescription) values('$category','$description')");
		$_SESSION['msg'] = "Category Created !!";

	}

	if (isset($_GET['del'])) {
		mysqli_query($bd, "delete from category where id = '" . $_GET['id'] . "'");
		$_SESSION['delmsg'] = "Category deleted !!";
	}

	?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin | Category</title>
		<link rel="icon" type="image/x-icon" href="../img/favicon.ico">
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

			.page-header {
				margin-bottom: 30px;
			}

			.page-header h1 {
				font-size: 28px;
				font-weight: 700;
				color: var(--gray-900);
				margin: 0;
				padding-bottom: 15px;
				border-bottom: 3px solid var(--primary-color);
				display: inline-block;
			}

			.card {
				background: white;
				border-radius: 12px;
				box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
				padding: 25px;
				border: 1px solid var(--gray-200);
				margin-bottom: 30px;
				transition: transform 0.3s ease, box-shadow 0.3s ease;
			}

			.card:hover {
				transform: translateY(-5px);
				box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
			}

			.card-header {
				padding-bottom: 20px;
				margin-bottom: 25px;
				border-bottom: 2px solid var(--primary-color);
			}

			.card-header h3 {
				margin: 0;
				font-size: 22px;
				font-weight: 700;
				color: var(--gray-900);
				display: flex;
				align-items: center;
				gap: 10px;
			}

			.form-group {
				margin-bottom: 25px;
			}

			.form-label {
				display: block;
				font-weight: 600;
				color: var(--gray-700);
				margin-bottom: 10px;
				font-size: 16px;
			}

			.form-control {
				width: 100%;
				padding: 14px 16px;
				border: 2px solid var(--gray-300);
				border-radius: 8px;
				font-size: 16px;
				transition: all 0.3s ease;
				background-color: white;
				color: var(--gray-700);
			}

			.form-control:focus {
				border-color: var(--primary-color);
				box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.2);
				outline: none;
			}

			.btn {
				display: inline-flex;
				align-items: center;
				justify-content: center;
				padding: 14px 24px;
				font-size: 16px;
				font-weight: 600;
				border-radius: 8px;
				cursor: pointer;
				transition: all 0.3s ease;
				border: none;
				gap: 8px;
			}

			.btn-primary {
				background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
				color: white;
			}

			.btn-primary:hover {
				transform: translateY(-2px);
				box-shadow: 0 6px 12px rgba(37, 99, 235, 0.3);
			}

			.btn-danger {
				background: linear-gradient(135deg, var(--danger-color), #dc2626);
				color: white;
			}

			.btn-danger:hover {
				transform: translateY(-2px);
				box-shadow: 0 6px 12px rgba(239, 68, 68, 0.3);
			}

			.alert {
				padding: 16px 20px;
				border-radius: 8px;
				margin-bottom: 25px;
				font-weight: 500;
				display: flex;
				align-items: center;
				gap: 12px;
			}

			.alert-success {
				background-color: rgba(16, 185, 129, 0.15);
				border: 1px solid var(--success-color);
				color: #047857;
			}

			.alert-error {
				background-color: rgba(239, 68, 68, 0.15);
				border: 1px solid var(--danger-color);
				color: #b91c1c;
			}

			.close {
				float: right;
				font-size: 21px;
				font-weight: bold;
				line-height: 1;
				color: #000;
				text-shadow: 0 1px 0 #fff;
				opacity: 0.2;
				cursor: pointer;
				background: transparent;
				border: 0;
			}

			.table-container {
				background: white;
				border-radius: 12px;
				box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
				padding: 25px;
				border: 1px solid var(--gray-200);
				overflow-x: auto;
			}

			.table-header {
				padding-bottom: 20px;
				margin-bottom: 25px;
				border-bottom: 2px solid var(--primary-color);
			}

			.table-header h3 {
				margin: 0;
				font-size: 22px;
				font-weight: 700;
				color: var(--gray-900);
				display: flex;
				align-items: center;
				gap: 10px;
			}

			table {
				width: 100%;
				border-collapse: collapse;
			}

			thead {
				background-color: var(--gray-100);
			}

			th {
				padding: 16px 15px;
				text-align: left;
				font-weight: 600;
				color: var(--gray-700);
				border-bottom: 2px solid var(--gray-300);
			}

			td {
				padding: 14px 15px;
				border-bottom: 1px solid var(--gray-200);
				color: var(--gray-600);
			}

			tr:hover td {
				background-color: var(--gray-50);
			}

			.action-links a {
				margin-right: 15px;
				color: var(--primary-color);
				text-decoration: none;
				font-size: 18px;
				transition: color 0.2s ease;
			}

			.action-links a:hover {
				color: var(--secondary-color);
			}

			.action-links .delete-link {
				color: var(--danger-color);
			}

			.action-links .delete-link:hover {
				color: #dc2626;
			}

			.breadcrumb {
				display: flex;
				align-items: center;
				gap: 10px;
				margin-bottom: 25px;
				padding: 12px 15px;
				background: var(--white);
				border-radius: 8px;
				box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
				border: 1px solid var(--gray-200);
			}

			.breadcrumb a {
				color: var(--primary-color);
				text-decoration: none;
				font-weight: 500;
			}

			.breadcrumb a:hover {
				text-decoration: underline;
			}

			.breadcrumb .divider {
				color: var(--gray-400);
			}

			.breadcrumb .active {
				color: var(--gray-600);
				font-weight: 500;
			}

			@media (max-width: 768px) {
				#main-content {
					margin-left: 260px;
					padding: 15px;
					padding-top: 80px;
				}

				.card,
				.table-container {
					padding: 20px;
				}

				.page-header h1 {
					font-size: 24px;
				}

				.card-header h3,
				.table-header h3 {
					font-size: 20px;
				}

				th,
				td {
					padding: 12px 10px;
				}
			}
		</style>
	</head>

	<body>
		<section id="container">
			<?php include('include/header.php'); ?>
			<?php include('include/sidebar.php'); ?>

			<section id="main-content">
				<div class="container-fluid">
					<div class="row">
						<div class="span12">

							<!-- Page Header -->
							<div class="page-header">
								<h1><i class="icon-folder-open"></i> Manage Categories</h1>
							</div>

							<!-- Add Category Form -->
							<div class="card">
								<div class="card-header">
									<h3><i class="icon-plus"></i> Add New Category</h3>
								</div>
								<div class="card-body">
									<?php if (isset($_POST['submit'])) { ?>
										<div class="alert alert-success">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<i class="icon-ok"></i>
											<strong>Success!</strong>
											<?php echo htmlentities($_SESSION['msg']); ?>
											<?php echo htmlentities($_SESSION['msg'] = ""); ?>
										</div>
									<?php } ?>

									<?php if (isset($_GET['del'])) { ?>
										<div class="alert alert-error">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<i class="icon-remove"></i>
											<strong>Deleted!</strong>
											<?php echo htmlentities($_SESSION['delmsg']); ?>
											<?php echo htmlentities($_SESSION['delmsg'] = ""); ?>
										</div>
									<?php } ?>

									<form class="form-horizontal" name="Category" method="post">
										<div class="form-group">
											<label class="form-label" for="category">
												<i class="icon-tag"></i> Category Name
											</label>
											<div class="controls">
												<input type="text" placeholder="Enter category name" name="category"
													id="category" class="form-control" required>
											</div>
										</div>

										<div class="form-group">
											<label class="form-label" for="description">
												<i class="icon-align-left"></i> Description
											</label>
											<div class="controls">
												<input type="text" placeholder="Enter category description"
													name="description" id="description" class="form-control" required>
											</div>
										</div>

										<div class="form-group">
											<div class="controls">
												<button type="submit" name="submit" class="btn btn-primary">
													<i class="icon-save"></i> Create Category
												</button>
												<button type="reset" class="btn"
													style="background-color: var(--gray-200); color: var(--gray-700);">
													<i class="icon-refresh"></i> Reset Form
												</button>
											</div>
										</div>
									</form>
								</div>
							</div>

							<!-- Manage Categories Table -->
							<div class="table-container">
								<div class="table-header">
									<h3><i class="icon-tasks"></i> Category List</h3>
								</div>
								<div class="table-body">
									<table class="datatable-1 table table-bordered table-striped display" width="100%">
										<thead>
											<tr>
												<th width="5%">#</th>
												<th>Category Name</th>
												<th>Description</th>
												<th>Creation Date</th>
												<th>Last Updated</th>
												<th width="15%">Actions</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$query = mysqli_query($bd, "select * from category");
											$cnt = 1;
											while ($row = mysqli_fetch_array($query)) {
												?>
												<tr>
													<td><?php echo htmlentities($cnt); ?></td>
													<td><?php echo htmlentities($row['categoryName']); ?></td>
													<td><?php echo htmlentities($row['categoryDescription']); ?></td>
													<td><?php echo htmlentities($row['creationDate']); ?></td>
													<td><?php echo htmlentities($row['updationDate']); ?></td>
													<td class="action-links">
														<a href="edit-category.php?id=<?php echo $row['id'] ?>" title="Edit">
															<i class="icon-edit"></i>
														</a>
														<a href="category.php?id=<?php echo $row['id'] ?>&del=delete"
															class="delete-link"
															onClick="return confirm('Are you sure you want to delete this category?')"
															title="Delete">
															<i class="icon-remove-sign"></i>
														</a>
													</td>
												</tr>
												<?php
												$cnt = $cnt + 1;
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div><!--/.span9-->
					</div>
				</div><!--/.container-->
			</section><!--/#main-content-->
		</section><!--/#container-->

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

				// Close alert functionality
				$('.close').click(function () {
					$(this).parent().fadeOut();
				});
			});
		</script>
	</body>
<?php } ?>

</html>