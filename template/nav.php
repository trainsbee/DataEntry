    <!-- Header -->
    <header class="header">
        <div class="header-container">
            <div class="header-left">
                <svg class="logo-icon" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                <h1 class="header-title">Hibernation</h1>
            </div>
        </div>
        <p class="header-description">Hibernation kicks in to save costs when requests are low. Your app will wake up automatically when traffic returns.</p>
    </header>

    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-tabs">
                <?php 
                $current_page = basename($_SERVER['REQUEST_URI']);
                ?>
                <a href="dashboard.php" class="nav-tab <?php echo $current_page == 'dashboard.php' ? 'active' : ''; ?>" data-tab="overview">
                    <i data-feather="grid"></i>
                    <span>Overview</span>
                </a>
                <a href="logs.php" class="nav-tab <?php echo $current_page == 'logs.php' ? 'active' : ''; ?>" data-tab="logs">
                    <i data-feather="list"></i>
                    <span>Logs</span>
                </a>
                <a href="metrics.php" class="nav-tab <?php echo $current_page == 'metrics.php' ? 'active' : ''; ?>" data-tab="metrics">
                    <i data-feather="bar-chart-2"></i>
                    <span>Metrics</span>
                </a>
                <a href="averages.php" class="nav-tab <?php echo $current_page == 'averages.php' ? 'active' : ''; ?>" data-tab="averages">
                    <i data-feather="bar-chart-2"></i>
                    <span>Averages</span>
                </a>
            </div>

            <!-- Status Badge -->
            <!-- <div class="status-badge">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: #a78bfa;">
                    <path d="M12 2L15.09 8.26H22L17.17 12.88L19.34 19.12L12 15.77L4.66 19.12L6.83 12.88L2 8.26H8.91L12 2Z"></path>
                </svg>
                <span>Environment hibernating</span>
            </div> -->

            <!-- Alert Card -->
            <!-- <div class="alert-card">
                <p class="alert-text">Your environment has been scaled to zero for <strong>26hrs 32mins</strong>.</p>
                <button class="wake-up-btn">Wake up</button>
            </div> -->
        </div>
    </nav>