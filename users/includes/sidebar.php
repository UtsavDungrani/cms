<aside>
    <div id="sidebar">
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
            }

            #sidebar {
                width: 260px;
                height: 100%;
                position: fixed;
                background: var(--sidebar-bg);
                /* Optimized box-shadow for better performance */
                box-shadow: 2px 0 5px rgba(0, 0, 0, 0.08);
                z-index: 1000;
                padding: 0;
                /* Changed from overflow-y: auto to overflow-y: hidden for better performance */
                overflow-y: hidden;
                border-right: 1px solid var(--sidebar-border);
                display: flex;
                flex-direction: column;
                top: 60px;
                /* Add this to push sidebar below header */
                /* Added for better scrolling performance */
                transform: translateZ(0);
                -webkit-transform: translateZ(0);
            }

            .user-info {
                text-align: center;
                padding: 25px 10px 15px;
                border-bottom: 1px solid var(--sidebar-border);
            }

            .user-avatar {
                width: 60px;
                height: 60px;
                border-radius: 50%;
                object-fit: cover;
                border: 2px solid var(--sidebar-border);
                margin: 0 auto 12px;
                display: block;
            }

            .user-name {
                font-weight: 600;
                color: #334155;
                font-size: 16px;
                margin: 0 0 5px;
            }

            .user-role {
                font-size: 13px;
                color: var(--sidebar-text);
                font-weight: 500;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .sidebar-menu {
                margin: 20px 0;
                padding: 0;
                list-style: none;
                flex-grow: 1;
                /* Added for better scrolling performance */
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
                margin: 0;
            }

            .sidebar-menu li a {
                display: flex;
                align-items: center;
                padding: 14px 25px;
                color: var(--sidebar-text);
                font-size: 15px;
                font-weight: 500;
                text-decoration: none;
                /* Reduced transition for better performance */
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
                margin-right: 15px;
                width: 24px;
                text-align: center;
                color: #94a3b8;
                /* Reduced transition for better performance */
                transition: color 0.2s ease;
            }

            .sidebar-menu li a:hover i,
            .sidebar-menu li a.active i {
                color: var(--sidebar-accent);
            }

            .sidebar-menu li.sub-menu>a::after {
                content: "\f105";
                font-family: "FontAwesome";
                margin-left: auto;
                /* Reduced transition for better performance */
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
                padding: 12px 25px 12px 65px;
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

            .sidebar-footer {
                padding: 20px;
                text-align: center;
                background: var(--sidebar-header);
                border-top: 1px solid var(--sidebar-border);
                font-size: 13px;
                color: var(--sidebar-text);
                flex-shrink: 0;
            }

            @media (max-width: 768px) {
                #sidebar {
                    width: 260px;
                }
            }
        </style>

        <!-- sidebar menu start-->

        <div class="user-info">
            <?php $query = mysqli_query($bd, "select fullName from users where userEmail='" . $_SESSION['login'] . "'");
            while ($row = mysqli_fetch_array($query)) {
                ?>
                <img src="../assets/img/ui-sam.jpg" class="user-avatar" alt="User Avatar">
                <h4 class="user-name"><?php echo htmlentities($row['fullName']); ?></h4>
                <div class="user-role">User Panel</div>
            <?php } ?>
        </div>

        <ul class="sidebar-menu" id="nav-accordion">
            <li class="menu-title">Main</li>
            <li>
                <a href="dashboard.php">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-title">Account</li>
            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-cogs"></i>
                    <span>Settings</span>
                </a>
                <ul class="sub">
                    <li><a href="profile.php"><i class="fa fa-user"></i> Profile</a></li>
                    <li><a href="change-password.php"><i class="fa fa-lock"></i> Security</a></li>
                </ul>
            </li>

            <li class="menu-title">Complaints</li>
            <li>
                <a href="register-complaint.php">
                    <i class="fa fa-plus-circle"></i>
                    <span>New Complaint</span>
                </a>
            </li>

            <li>
                <a href="complaint-history.php">
                    <i class="fa fa-history"></i>
                    <span>My History</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-footer">
            © 2025 ResolveX v1.0
        </div>
        <!-- sidebar menu end-->
    </div>

    <script>
        // Toggle sub-menu
        document.addEventListener('DOMContentLoaded', function () {
            var subMenus = document.querySelectorAll('.sub-menu > a');
            subMenus.forEach(function (menu) {
                menu.addEventListener('click', function (e) {
                    e.preventDefault();
                    var parent = this.parentNode;
                    parent.classList.toggle('open');
                });
            });
        });
    </script>
</aside>