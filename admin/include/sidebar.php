<aside>
	<div id="sidebar" class="nav-collapse">
		<style>
			:root {
				--sidebar-bg: #ffffff;
				--sidebar-header: #f8fafc;
				--sidebar-border: #e2e8f0;
				--sidebar-text: #64748b;
				--sidebar-text-active: #2563eb;
				--sidebar-hover: #f1f5f9;
				--sidebar-accent: #3b82f6;
				--sidebar-shadow: rgba(0, 0, 0, 0.08);
				--label-orange: #f97316;
				--label-green: #10b981;
			}

			#sidebar {
				width: 260px;
				height: 100%;
				position: fixed;
				left: 0;
				background: var(--sidebar-bg);
				box-shadow: 2px 0 5px rgba(0, 0, 0, 0.08);
				z-index: 1000;
				padding: 0;
				overflow-y: hidden;
				border-right: 1px solid var(--sidebar-border);
				display: flex;
				flex-direction: column;
				top: 60px;
				transform: translateZ(0);
				-webkit-transform: translateZ(0);
				transition: transform 0.25s ease-out;
			}

			.sidebar-menu {
				margin: 20px 0;
				padding: 0;
				list-style: none;
				flex-grow: 1;
				overflow-y: auto;
				-webkit-overflow-scrolling: touch;
			}

			.menu-title {
				padding: 15px 25px 8px;
				font-size: 12px;
				font-weight: 700;
				text-transform: uppercase;
				letter-spacing: 1px;
				color: #94a3b8;
			}

			.sidebar-menu li {
				margin-left: -10px;
			}

			.sidebar-menu li a {
				display: flex;
				align-items: center;
				padding: 14px 25px;
				color: var(--sidebar-text);
				font-size: 15px;
				font-weight: 500;
				text-decoration: none;
				transition: background-color 0.2s ease, color 0.2s ease;
				position: relative;
				margin: 0 10px;
				border-radius: 8px;
			}

			.sidebar-menu li a:hover {
				color: var(--sidebar-text-active);
				background: var(--sidebar-hover);
			}

			.sidebar-menu li a.active {
				color: var(--sidebar-text-active);
				background: rgba(37, 99, 235, 0.1);
			}

			.sidebar-menu li a.active::before {
				content: '';
				position: absolute;
				left: 0;
				top: 0;
				height: 100%;
				width: 3px;
				background: var(--sidebar-accent);
				border-radius: 0 3px 3px 0;
			}

			.sidebar-menu li a i {
				font-size: 18px;
				margin-right: 10px;
				width: 24px;
				text-align: center;
				color: #94a3b8;
				transition: color 0.2s ease;
			}

			.sidebar-menu li a:hover i,
			.sidebar-menu li a.active i {
				color: var(--sidebar-accent);
			}

			.sidebar-menu li.sub-menu>a::after {
				content: "\f105";
				font-family: "FontAwesome";
				margin-left: 15px;
				transition: transform 0.2s ease;
				font-size: 14px;
			}

			.sidebar-menu li.sub-menu.open>a::after {
				transform: rotate(90deg);
			}

			.sidebar-menu ul.sub {
				display: none;
				list-style: none;
				background: rgba(241, 245, 249, 0.6);
				margin: 0 10px;
				padding: 8px 0;
				border-radius: 8px;
			}

			.sidebar-menu li.sub-menu.open ul.sub {
				display: block;
			}

			.sidebar-menu ul.sub li a {
				padding: 12px 10px 12px 45px;
				;
				font-size: 14px;
				color: var(--sidebar-text);
			}

			.sidebar-menu ul.sub li a:hover {
				color: var(--sidebar-text-active);
				background: rgba(37, 99, 235, 0.08);
			}

			.sidebar-menu ul.sub li a.active {
				background: rgba(37, 99, 235, 0.15);
			}

			.label {
				background: #888;
				box-shadow: 0 0 2px rgba(0, 0, 0, 0.4) inset;
				border-radius: 12px;
				line-height: 18px;
				padding: 2px 8px;
				font-size: 12px;
				font-weight: 600;
				margin-left: auto;
			}

			.label.orange {
				background: var(--label-orange);
			}

			.label.green {
				background: var(--label-green);
			}

			.sidebar-footer {
				padding: 20px;
				text-align: center;
				background: var(--sidebar-header);
				border-top: 1px solid var(--sidebar-border);
				font-size: 13px;
				color: var(--sidebar-text);
				flex-shrink: 0;
			}

			/* Mobile: hide sidebar off-canvas by default, slide in when open */
			@media (max-width: 768px) {
				#sidebar {
					transform: translateX(-100%);
				}

				body.sidebar-open #sidebar {
					transform: translateX(0);
				}

				/* Ensure menu is visible on mobile even if JS sets display:none inline */
				#sidebar ul.sidebar-menu#nav-accordion {
					display: block !important;
				}
			}

			/* Dark overlay behind sidebar on mobile */
			#sidebar-overlay {
				position: fixed;
				inset: 0;
				background: rgba(15, 23, 42, 0.45);
				z-index: 900;
				opacity: 0;
				visibility: hidden;
				transition: opacity 0.25s ease-out, visibility 0.25s ease-out;
			}

			body.sidebar-open #sidebar-overlay {
				opacity: 1;
				visibility: visible;
			}
		</style>

		<ul class="sidebar-menu" id="nav-accordion">
			<li>
				<a href="dashboard.php">
					<i class="icon-dashboard"></i>
					<span>Dashboard</span>
				</a>
			</li>

			<li class="menu-title">Complaint Management</li>
			<li class="sub-menu">
				<a href="javascript:;">
					<i class="icon-cog"></i>
					<span>Manage Complaint</span>
				</a>
				<ul class="sub">
					<li>
						<a href="notprocess-complaint.php">
							<i class="icon-tasks"></i>
							Not Processed Complaint
							<?php
							$rt = mysqli_query($bd, "SELECT * FROM tblcomplaints where status is null");
							$num1 = mysqli_num_rows($rt); { ?>
								<b class="label orange"><?php echo htmlentities($num1); ?></b>
							<?php } ?>
						</a>
					</li>
					<li>
						<a href="inprocess-complaint.php">
							<i class="icon-tasks"></i>
							Pending Complaint
							<?php
							$status = "in Process";
							$rt = mysqli_query($bd, "SELECT * FROM tblcomplaints where status='$status'");
							$num1 = mysqli_num_rows($rt); { ?>
								<b class="label orange"><?php echo htmlentities($num1); ?></b>
							<?php } ?>
						</a>
					</li>
					<li>
						<a href="closed-complaint.php">
							<i class="icon-inbox"></i>
							Closed Complaints
							<?php
							$status = "closed";
							$rt = mysqli_query($bd, "SELECT * FROM tblcomplaints where status='$status'");
							$num1 = mysqli_num_rows($rt); { ?>
								<b class="label green"><?php echo htmlentities($num1); ?></b>
							<?php } ?>
						</a>
					</li>
				</ul>
			</li>

			<li class="menu-title">User Management</li>
			<li class="sub-menu">
				<a href="javascript:;">
					<i class="icon-cog"></i>
					<span>Manage User</span>
				</a>
				<ul class="sub">
					<li>
						<a href="manage-users.php">
							<i class="icon-group"></i>
							<span>User list</span>
						</a>
					</li>
					<li>
						<a href="user-logs.php">
							<i class="icon-tasks"></i>
							<span>User Login Log</span>
						</a>
					</li>
				</ul>
			</li>

			<li class="menu-title">System Configuration</li>
			<li class="sub-menu">
				<a href="javascript:;">
					<i class="icon-cog"></i>
					<span>Manage Category</span>
				</a>
				<ul class="sub">
					<li>
						<a href="category.php">
							<i class="icon-tasks"></i>
							<span>Add Category</span>
						</a>
					</li>
					<li>
						<a href="subcategory.php">
							<i class="icon-tasks"></i>
							<span>Add Sub-Category</span>
						</a>
					</li>
				</ul>
			</li>

			<li class="sub-menu">
				<a href="javascript:;">
					<i class="icon-cog"></i>
					<span>Manage City</span>
				</a>
				<ul class="sub">
					<li>
						<a href="state.php">
							<i class="icon-paste"></i>
							<span>Add State</span>
						</a>
					</li>
					<li>
						<a href="city.php">
							<i class="icon-paste"></i>
							<span>Add city</span>
						</a>
					</li>
					<li>
						<a href="area.php">
							<i class="icon-paste"></i>
							<span>Add area</span>
						</a>
					</li>

				</ul>
			</li>

			<li class="menu-title">Security</li>
			<li>
				<a href="change-password.php">
					<i class="icon-key"></i>
					<span>Change Password</span>
				</a>
			</li>
			<li>
				<a href="logout.php">
					<i class="icon-signout"></i>
					<span>Logout</span>
				</a>
			</li>
		</ul>

		<div class="sidebar-footer">
			© 2025 ResolveX v1.0
		</div>
	</div>

	<div id="sidebar-overlay"></div>

	<script>
		// Toggle sub-menu + mobile sidebar behavior
		document.addEventListener('DOMContentLoaded', function () {
			// Sub-menus
			var subMenus = document.querySelectorAll('.sub-menu > a');
			subMenus.forEach(function (menu) {
				menu.addEventListener('click', function (e) {
					e.preventDefault();
					var parent = this.parentNode;
					parent.classList.toggle('open');
				});
			});

			// Mobile sidebar toggle
			var toggleBtn = document.querySelector('.sidebar-toggle');
			var overlay = document.getElementById('sidebar-overlay');
			var body = document.body;

			if (toggleBtn) {
				toggleBtn.addEventListener('click', function () {
					body.classList.toggle('sidebar-open');
				});
			}

			if (overlay) {
				overlay.addEventListener('click', function () {
					body.classList.remove('sidebar-open');
				});
			}

			// Close sidebar when a menu link is clicked on mobile,
			// but keep it open when tapping a parent "sub-menu" toggle
			var sidebarLinks = document.querySelectorAll('#sidebar a');
			sidebarLinks.forEach(function (link) {
				link.addEventListener('click', function () {
					if (window.innerWidth <= 768) {
						if (this.parentElement && this.parentElement.classList.contains('sub-menu')) {
							return;
						}
						body.classList.remove('sidebar-open');
					}
				});
			});

			// Reset sidebar state if window resized to desktop
			window.addEventListener('resize', function () {
				if (window.innerWidth > 768) {
					body.classList.remove('sidebar-open');
				}
			});
		});
	</script>
</aside>