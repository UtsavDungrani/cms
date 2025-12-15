<header class="header">
	<style>
		:root {
			--header-bg: #ffffff;
			--header-border: #e2e8f0;
			--header-text: #334155;
			--header-accent: #2563eb;
			--header-shadow: rgba(0, 0, 0, 0.08);
		}

		.header {
			background: var(--header-bg);
			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
			padding: 0 20px;
			height: 60px;
			position: fixed;
			top: 0;
			left: 0;
			right: 0;
			z-index: 1000;
			display: flex;
			align-items: center;
			border-bottom: 1px solid var(--header-border);
			transform: translateZ(0);
			-webkit-transform: translateZ(0);
		}

		/* Mobile / sidebar toggle button */
		.sidebar-toggle {
			margin-right: 20px;
			cursor: pointer;
			padding: 10px;
			border-radius: 6px;
			transition: background-color 0.2s ease;
			border: none;
			background: transparent;
			display: none;
			align-items: center;
			justify-content: center;
		}

		.sidebar-toggle:hover {
			background: #f1f5f9;
		}

		.sidebar-toggle .icon-reorder {
			font-size: 20px;
			color: var(--header-text);
		}

		.logo {
			font-size: 20px;
			font-weight: 700;
			color: var(--header-text);
			text-decoration: none;
			display: flex;
			align-items: center;
		}

		.logo-icon {
			width: 32px;
			height: 32px;
			background: #2563eb;
			border-radius: 8px;
			display: flex;
			align-items: center;
			justify-content: center;
			margin-right: 10px;
			color: white;
			font-size: 16px;
		}

		.logo-text {
			letter-spacing: -0.3px;
		}

		.logo-text span {
			color: var(--header-accent);
		}

		.top-menu {
			margin-left: auto;
			margin-right: 20px;
			/* Move the menu more to the left */
		}

		.nav.pull-right.top-menu {
			display: flex;
			list-style: none;
		}

		.nav.pull-right.top-menu li {
			margin-left: 15px;
		}

		.nav.pull-right.top-menu li a {
			display: flex;
			align-items: center;
			padding: 8px 15px;
			background: #f8fafc;
			color: var(--header-text);
			text-decoration: none;
			border-radius: 6px;
			font-weight: 500;
			transition: background-color 0.2s ease, box-shadow 0.2s ease;
			border: 1px solid var(--header-border);
		}

		.nav.pull-right.top-menu li a:hover {
			background: #f1f5f9;
			box-shadow: 0 2px 3px rgba(0, 0, 0, 0.05);
		}

		.nav.pull-right.top-menu li a.logout {
			background: #ef4444;
			color: white;
			border: none;
		}

		.nav.pull-right.top-menu li a.logout:hover {
			background: #dc2626;
			box-shadow: 0 2px 3px rgba(239, 68, 68, 0.3);
		}

		.nav.pull-right.top-menu li a i {
			margin-right: 8px;
			font-size: 16px;
		}

		/* Dropdown menu styles */
		.nav-user.dropdown {
			position: relative;
		}

		.nav-user.dropdown .dropdown-toggle {
			display: flex;
			align-items: center;
			padding: 8px 15px;
			background: #f8fafc;
			color: var(--header-text);
			text-decoration: none;
			border-radius: 6px;
			font-weight: 500;
			transition: background-color 0.2s ease, box-shadow 0.2s ease;
			border: 1px solid var(--header-border);
			cursor: pointer;
		}

		.nav-user.dropdown .dropdown-toggle:hover {
			background: #f1f5f9;
			box-shadow: 0 2px 3px rgba(0, 0, 0, 0.05);
		}

		.nav-user.dropdown .dropdown-toggle i {
			margin-right: 8px;
			font-size: 16px;
		}

		.nav-user.dropdown .dropdown-toggle .caret {
			margin-left: 8px;
			border-top: 4px solid;
			border-right: 4px solid transparent;
			border-left: 4px solid transparent;
			transition: transform 0.2s ease;
		}

		/* Rotate caret when dropdown is open */
		.nav-user.dropdown.open .dropdown-toggle .caret {
			transform: rotate(180deg);
		}

		.nav-user.dropdown .dropdown-menu {
			position: absolute;
			top: 100%;
			right: 0;
			z-index: 1000;
			display: none;
			float: left;
			min-width: 160px;
			padding: 5px 0;
			margin: 2px 0 0;
			font-size: 14px;
			text-align: left;
			list-style: none;
			background-color: #fff;
			-webkit-background-clip: padding-box;
			background-clip: padding-box;
			border: 1px solid rgba(0, 0, 0, .15);
			border-radius: 4px;
			-webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
			box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
		}

		.nav-user.dropdown.open .dropdown-menu {
			display: block;
		}

		.nav-user.dropdown .dropdown-menu li a {
			display: block;
			padding: 8px 15px;
			clear: both;
			font-weight: 400;
			line-height: 1.42857143;
			color: #333;
			white-space: nowrap;
			text-decoration: none;
			border-radius: 0;
			background: transparent;
			border: none;
			margin: 0;
		}

		.nav-user.dropdown .dropdown-menu li a:hover {
			background: #f5f5f5;
			box-shadow: none;
		}

		.nav-user.dropdown .dropdown-menu .divider {
			height: 1px;
			margin: 9px 0;
			overflow: hidden;
			background-color: #e5e5e5;
		}

		@media (max-width: 768px) {
			.header {
				padding: 0 15px;
			}

			.logo {
				font-size: 18px;
			}

			.top-menu {
				margin-right: 10px;
			}

			/* Show sidebar toggle button on mobile */
			.sidebar-toggle {
				display: inline-flex;
			}
		}
	</style>

	<!--logo start-->
	<button class="sidebar-toggle" aria-label="Toggle navigation">
		<i class="icon-reorder"></i>
	</button>
	<a href="dashboard.php" class="logo">
		<div class="logo-icon">
			<i class="icon-cog"></i>
		</div>
		<div class="logo-text">Resolve<span>X</span> Admin Panel</div>
	</a>

	<div class="top-menu">
		<ul class="nav pull-right top-menu" style="margin-top: 20px;">
			<li class="nav-user dropdown" id="userDropdownContainer">
				<a href="javascript:void(0)" class="dropdown-toggle" id="userDropdown">
					<i class="icon-user"></i>
					Admin
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu" id="userDropdownMenu">
					<li><a href="change-password.php">Change Password</a></li>
					<li class="divider"></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</li>
		</ul>
	</div>
</header>

<script>
	// Toggle dropdown menu
	document.addEventListener('DOMContentLoaded', function () {
		// Get dropdown elements
		var dropdownContainer = document.getElementById('userDropdownContainer');
		var dropdownToggle = document.getElementById('userDropdown');
		var dropdownMenu = document.getElementById('userDropdownMenu');

		// Check if elements exist
		if (dropdownContainer && dropdownToggle && dropdownMenu) {
			// Add click event to toggle
			dropdownToggle.addEventListener('click', function (e) {
				e.preventDefault();
				e.stopPropagation();
				dropdownContainer.classList.toggle('open');
			});

			// Close dropdown when clicking outside
			document.addEventListener('click', function (e) {
				if (!dropdownContainer.contains(e.target)) {
					dropdownContainer.classList.remove('open');
				}
			});
		}
	});
</script>