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
            /* Optimized box-shadow for better performance */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
            padding: 0 20px;
            height: 60px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            /* Increased z-index to be above sidebar */
            display: flex;
            align-items: center;
            border-bottom: 1px solid var(--header-border);
            /* Added for better scrolling performance */
            transform: translateZ(0);
            -webkit-transform: translateZ(0);
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
            /* Replaced gradient with solid color for better performance */
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
        }

        /* Mobile sidebar toggle button */
        .sidebar-toggle {
            display: none;
            border: none;
            background: transparent;
            color: var(--header-text);
            font-size: 22px;
            margin-right: 12px;
            cursor: pointer;
            padding: 6px;
        }

        .sidebar-toggle:focus {
            outline: none;
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
            /* Reduced transition for better performance */
            transition: background-color 0.2s ease, box-shadow 0.2s ease;
            border: 1px solid var(--header-border);
        }

        .nav.pull-right.top-menu li a:hover {
            background: #f1f5f9;
            /* Removed transform for better performance */
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.05);
        }

        .nav.pull-right.top-menu li a.logout {
            /* Replaced gradient with solid color for better performance */
            background: #ef4444;
            color: white;
            border: none;
        }

        .nav.pull-right.top-menu li a.logout:hover {
            /* Replaced gradient with solid color for better performance */
            background: #dc2626;
            box-shadow: 0 2px 3px rgba(239, 68, 68, 0.3);
        }

        .nav.pull-right.top-menu li a i {
            margin-right: 8px;
            font-size: 16px;
        }

        @media (max-width: 768px) {
            .header {
                padding: 0 15px;
            }

            .logo {
                font-size: 18px;
            }

            .sidebar-toggle {
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }
        }
    </style>

    <!--logo start-->
    <button class="sidebar-toggle" aria-label="Toggle navigation">
        <!-- Use a different icon than .fa-bars to avoid legacy JS sidebar toggle conflicts -->
        <i class="fa fa-navicon"></i>
    </button>
    <a href="dashboard.php" class="logo">
        <div class="logo-icon">
            <i class="fa fa-user"></i>
        </div>
        <div class="logo-text">Resolve<span>X</span> User Panel</div>
    </a>

    <div class="top-menu">
        <ul class="nav pull-right top-menu">
            <li>
                <?php
                $query = mysqli_query($bd, "select fullName from users where userEmail='" . $_SESSION['login'] . "'");
                while ($row = mysqli_fetch_array($query)) {
                    ?>
                    <a href="profile.php">
                        <i class="fa fa-user"></i>
                        <?php echo htmlentities($row['fullName']); ?>
                    </a>
                <?php } ?>
            </li>
            <li><a class="logout" href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
        </ul>
    </div>
</header>