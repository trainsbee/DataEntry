<?php include 'settings.php';?>
<?php include 'template/header.php';?>
<?php include 'template/nav.php';?>
   <!-- Main Content -->
    <main class="main-content">
        <div class="content-container">
            <!-- Content Panel -->
            <div class="content-panel">
                <div class="panel-header">
                    <h2 class="panel-title">Environment Status</h2>
                    <!-- <button class="panel-action-btn">
                        <i data-feather="more-horizontal"></i>
                    </button> -->
                </div>
                
                <div id="logs" class="tab-content">
                    <div class="logs-list">
                        <div class="log-entry">
                            <span class="log-time">14:32:18</span>
                            <span class="log-status info">INFO</span>
                            <span class="log-message">Environment hibernated successfully</span>
                        </div>
                        <div class="log-entry">
                            <span class="log-time">14:32:05</span>
                            <span class="log-status warning">WARNING</span>
                            <span class="log-message">Scaling down resources</span>
                        </div>
                        <div class="log-entry">
                            <span class="log-time">14:31:50</span>
                            <span class="log-status info">INFO</span>
                            <span class="log-message">No requests detected in last 5 minutes</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="sidebar">
                <div class="sidebar-section">
                    <h3 class="sidebar-title">Quick Actions</h3>
                    <button class="sidebar-btn">
                        <i data-feather="power"></i>
                        <span>Wake Environment</span>
                    </button>
                    <button class="sidebar-btn">
                        <i data-feather="refresh-cw"></i>
                        <span>Refresh Status</span>
                    </button>
                </div>

                <div class="sidebar-section">
                    <h3 class="sidebar-title">Info</h3>
                    <div class="info-item">
                        <span class="info-label">Environment</span>
                        <span class="info-value">production</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Region</span>
                        <span class="info-value">us-east-1</span>
                    </div>
                </div>
            </aside>
        </div>
    </main>
<?php include 'template/footer.php';?>