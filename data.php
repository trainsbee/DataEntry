
<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

:root {
  --color-dark-bg: #0f0f1e;
  --color-darker-bg: #1a1f3a;
  --color-card-bg: #1e2139;
  --color-input-bg: #2a2f4a;
  --color-border: #3a3f5a;
  --color-text-primary: #f5f5f5;
  --color-text-secondary: #a0a0b0;
  --color-text-tertiary: #7a7a8a;
  --color-accent-purple: #a78bfa;
  --color-accent-blue: #60a5fa;
  --color-status-info: #3b82f6;
  --color-status-warning: #f59e0b;
  --color-status-success: #10b981;
  --transition: all 0.3s ease;
}

body {
  background-color: var(--color-dark-bg);
  color: var(--color-text-primary);
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
  line-height: 1.6;
}

/* Header */
.header {
  padding: 2rem;
  border-bottom: 1px solid var(--color-border);
}

.header-container {
  max-width: 1200px;
  margin: 0 auto;
  display: flex;
  align-items: center;
  gap: 1rem;
  margin-bottom: 1.5rem;
}

.header-left {
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

.logo-icon {
  width: 32px;
  height: 32px;
  color: var(--color-accent-purple);
}

.header-title {
  font-size: 1.75rem;
  font-weight: 600;
  color: var(--color-text-primary);
}

.header-description {
  max-width: 1200px;
  margin: 0 auto;
  color: var(--color-text-secondary);
  font-size: 1rem;
  line-height: 1.6;
}

/* Navigation Bar */
.navbar {
  background-color: var(--color-card-bg);
  padding: 1rem 2rem;
  border-bottom: 1px solid var(--color-border);
  position: sticky;
  top: 0;
  z-index: 10;
}

.nav-container {
  max-width: 1200px;
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 2rem;
}

.nav-tabs {
  display: flex;
  gap: 0;
  border-bottom: 1px solid var(--color-border);
}

.nav-tab {
  background: none;
  border: none;
  color: var(--color-text-secondary);
  padding: 0.75rem 1.25rem;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.95rem;
  position: relative;
  transition: var(--transition);
  border-bottom: 2px solid transparent;
  margin-bottom: -1px;
}

.nav-tab svg {
  width: 18px;
  height: 18px;
}

.nav-tab:hover {
  color: var(--color-text-primary);
}

.nav-tab.active {
  color: var(--color-accent-blue);
  border-bottom-color: var(--color-accent-blue);
}

/* Status Badge */
.status-badge {
  background-color: var(--color-darker-bg);
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem 1rem;
  border-radius: 6px;
  font-size: 0.9rem;
  font-weight: 500;
  color: var(--color-text-primary);
  white-space: nowrap;
}

/* Alert Card */
.alert-card {
  background-color: var(--color-card-bg);
  border: 1px solid var(--color-border);
  border-radius: 8px;
  padding: 1rem;
  min-width: 240px;
}

.alert-text {
  font-size: 0.9rem;
  color: var(--color-text-secondary);
  margin-bottom: 0.75rem;
}

.alert-text strong {
  color: var(--color-text-primary);
}

.wake-up-btn {
  width: 100%;
  padding: 0.65rem;
  background-color: var(--color-accent-blue);
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-weight: 500;
  font-size: 0.9rem;
  transition: var(--transition);
}

.wake-up-btn:hover {
  background-color: #0ea5e9;
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(96, 165, 250, 0.3);
}

.wake-up-btn:active {
  transform: translateY(0);
}

/* Main Content */
.main-content {
  padding: 2rem;
}

.content-container {
  max-width: 1200px;
  margin: 0 auto;
  display: grid;
  grid-template-columns: 1fr 280px;
  gap: 2rem;
}

/* Content Panel */
.content-panel {
  background-color: var(--color-card-bg);
  border: 1px solid var(--color-border);
  border-radius: 8px;
  padding: 2rem;
}

.panel-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
}

.panel-title {
  font-size: 1.5rem;
  font-weight: 600;
}

.panel-action-btn {
  background: none;
  border: none;
  color: var(--color-text-secondary);
  cursor: pointer;
  padding: 0.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: var(--transition);
}

.panel-action-btn:hover {
  color: var(--color-text-primary);
}

.panel-action-btn svg {
  width: 20px;
  height: 20px;
}

/* Tab Content */
.tab-content {
  display: none;
  animation: fadeIn 0.3s ease;
}

.tab-content.active {
  display: block;
}

@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

/* Cards Grid */
.cards-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 1.5rem;
}

.stat-card {
  background-color: var(--color-input-bg);
  border: 1px solid var(--color-border);
  border-radius: 8px;
  padding: 1.5rem;
  display: flex;
  gap: 1rem;
  transition: var(--transition);
  cursor: pointer;
}

.stat-card:hover {
  border-color: var(--color-accent-blue);
  background-color: rgba(96, 165, 250, 0.05);
  transform: translateY(-2px);
}

.stat-icon {
  flex-shrink: 0;
  width: 48px;
  height: 48px;
  background-color: rgba(96, 165, 250, 0.15);
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--color-accent-blue);
}

.stat-icon svg {
  width: 24px;
  height: 24px;
}

.stat-info {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.stat-label {
  font-size: 0.85rem;
  color: var(--color-text-secondary);
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.stat-value {
  font-size: 1.75rem;
  font-weight: 700;
  color: var(--color-text-primary);
}

.stat-desc {
  font-size: 0.8rem;
  color: var(--color-text-tertiary);
}

/* Logs List */
.logs-list {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.log-entry {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding: 1rem;
  background-color: var(--color-input-bg);
  border-radius: 6px;
  border: 1px solid var(--color-border);
  transition: var(--transition);
}

.log-entry:hover {
  border-color: var(--color-accent-blue);
}

.log-time {
  font-family: "Monaco", "Menlo", monospace;
  font-size: 0.85rem;
  color: var(--color-text-tertiary);
  min-width: 70px;
}

.log-status {
  font-size: 0.75rem;
  font-weight: 700;
  padding: 0.25rem 0.75rem;
  border-radius: 4px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.log-status.info {
  background-color: rgba(59, 130, 246, 0.15);
  color: var(--color-status-info);
}

.log-status.warning {
  background-color: rgba(245, 158, 11, 0.15);
  color: var(--color-status-warning);
}

.log-status.success {
  background-color: rgba(16, 185, 129, 0.15);
  color: var(--color-status-success);
}

.log-message {
  color: var(--color-text-secondary);
  flex: 1;
}

/* Metrics Container */
.metrics-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 1.5rem;
}

.metric-box {
  background-color: var(--color-input-bg);
  border: 1px solid var(--color-border);
  border-radius: 8px;
  padding: 1.5rem;
  text-align: center;
  transition: var(--transition);
}

.metric-box:hover {
  border-color: var(--color-accent-purple);
  background-color: rgba(167, 139, 250, 0.05);
}

.metric-title {
  font-size: 0.9rem;
  color: var(--color-text-secondary);
  margin-bottom: 0.75rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.metric-value {
  font-size: 2rem;
  font-weight: 700;
  color: var(--color-accent-purple);
  margin-bottom: 0.5rem;
}

.metric-desc {
  font-size: 0.85rem;
  color: var(--color-text-tertiary);
}

/* Sidebar */
.sidebar {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.sidebar-section {
  background-color: var(--color-card-bg);
  border: 1px solid var(--color-border);
  border-radius: 8px;
  padding: 1.5rem;
}

.sidebar-title {
  font-size: 0.9rem;
  color: var(--color-text-secondary);
  margin-bottom: 1rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.sidebar-btn {
  width: 100%;
  background-color: var(--color-input-bg);
  border: 1px solid var(--color-border);
  color: var(--color-text-primary);
  padding: 0.75rem;
  border-radius: 6px;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 0.75rem;
  transition: var(--transition);
  margin-bottom: 0.75rem;
  font-size: 0.9rem;
}

.sidebar-btn:hover {
  background-color: var(--color-border);
  border-color: var(--color-accent-blue);
  color: var(--color-accent-blue);
}

.sidebar-btn svg {
  width: 18px;
  height: 18px;
}

.info-item {
  display: flex;
  justify-content: space-between;
  padding: 0.75rem 0;
  border-bottom: 1px solid var(--color-border);
}

.info-item:last-child {
  border-bottom: none;
}

.info-label {
  color: var(--color-text-secondary);
  font-size: 0.9rem;
}

.info-value {
  color: var(--color-text-primary);
  font-weight: 500;
}

/* Responsive */
@media (max-width: 768px) {
  .nav-container {
    flex-direction: column;
    gap: 1rem;
    align-items: stretch;
  }

  .nav-tabs {
    width: 100%;
  }

  .alert-card {
    min-width: unset;
  }

  .content-container {
    grid-template-columns: 1fr;
  }

  .cards-grid {
    grid-template-columns: 1fr;
  }

  .metrics-container {
    grid-template-columns: 1fr;
  }

  .panel-title {
    font-size: 1.25rem;
  }
}

</style>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Environment Hibernation</title>
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>
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
                <button class="nav-tab active" data-tab="overview">
                    <i data-feather="grid"></i>
                    <span>Overview</span>
                </button>
                <button class="nav-tab" data-tab="logs">
                    <i data-feather="list"></i>
                    <span>Logs</span>
                </button>
                <button class="nav-tab" data-tab="metrics">
                    <i data-feather="bar-chart-2"></i>
                    <span>Metrics</span>
                </button>
                <button class="nav-tab" data-tab="averages">
                    <i data-feather="bar-chart-2"></i>
                    <span>Averages</span>
                </button>
            </div>

            <!-- Status Badge -->
            <div class="status-badge">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: #a78bfa;">
                    <path d="M12 2L15.09 8.26H22L17.17 12.88L19.34 19.12L12 15.77L4.66 19.12L6.83 12.88L2 8.26H8.91L12 2Z"></path>
                </svg>
                <span>Environment hibernating</span>
            </div>

            <!-- Alert Card -->
            <div class="alert-card">
                <p class="alert-text">Your environment has been scaled to zero for <strong>26hrs 32mins</strong>.</p>
                <button class="wake-up-btn">Wake up</button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="content-container">
            <!-- Content Panel -->
            <div class="content-panel">
                <div class="panel-header">
                    <h2 class="panel-title">Environment Status</h2>
                    <button class="panel-action-btn">
                        <i data-feather="more-horizontal"></i>
                    </button>
                </div>

                <!-- Tab Content -->
                <div id="overview" class="tab-content active">
                    <div class="cards-grid">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i data-feather="cpu"></i>
                            </div>
                            <div class="stat-info">
                                <span class="stat-label">CPU Usage</span>
                                <span class="stat-value">0%</span>
                                <span class="stat-desc">Hibernating</span>
                            </div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon">
                                <i data-feather="hard-drive"></i>
                            </div>
                            <div class="stat-info">
                                <span class="stat-label">Memory</span>
                                <span class="stat-value">0MB</span>
                                <span class="stat-desc">Scaled to zero</span>
                            </div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon">
                                <i data-feather="zap"></i>
                            </div>
                            <div class="stat-info">
                                <span class="stat-label">Last Activity</span>
                                <span class="stat-value">26h 32m</span>
                                <span class="stat-desc">Ago</span>
                            </div>
                        </div>
                    </div>
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

                <div id="metrics" class="tab-content">
                    <div class="metrics-container">
                        <div class="metric-box">
                            <h3 class="metric-title">Costs Saved</h3>
                            <p class="metric-value">$12.45</p>
                            <p class="metric-desc">In the last 7 days</p>
                        </div>
                        <div class="metric-box">
                            <h3 class="metric-title">Hibernations</h3>
                            <p class="metric-value">8</p>
                            <p class="metric-desc">This month</p>
                        </div>
                        <div class="metric-box">
                            <h3 class="metric-title">Avg Duration</h3>
                            <p class="metric-value">18h 24m</p>
                            <p class="metric-desc">Per hibernation</p>
                        </div>
                    </div>
                </div>
                <div id="averages" class="tab-content">
                    <div class="metrics-container">
                        <div class="metric-box">
                            <h3 class="metric-title">Costs Saved</h3>
                            <p class="metric-value">$12.45</p>
                            <p class="metric-desc">In the last 7 days</p>
                        </div>
                        <div class="metric-box">
                            <h3 class="metric-title">Hibernations</h3>
                            <p class="metric-value">8</p>
                            <p class="metric-desc">This month</p>
                        </div>
                        <div class="metric-box">
                            <h3 class="metric-title">Avg Duration</h3>
                            <p class="metric-value">18h 24m</p>
                            <p class="metric-desc">Per hibernation</p>
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

    <script>
// Import Feather Icons


// Feather Icons
feather.replace()

// Tab Navigation
const navTabs = document.querySelectorAll(".nav-tab")
const tabContents = document.querySelectorAll(".tab-content")

navTabs.forEach((tab) => {
  tab.addEventListener("click", () => {
    // Remove active class from all tabs
    navTabs.forEach((t) => t.classList.remove("active"))
    tabContents.forEach((content) => content.classList.remove("active"))

    // Add active class to clicked tab
    tab.classList.add("active")

    // Show corresponding content
    const tabId = tab.getAttribute("data-tab")
    const tabContent = document.getElementById(tabId)
    if (tabContent) {
      tabContent.classList.add("active")
    }
  })
})

// Wake Up Button
const wakeUpBtn = document.querySelector(".wake-up-btn")
if (wakeUpBtn) {
  wakeUpBtn.addEventListener("click", () => {
    console.log("[v0] Wake up button clicked")
    const alertCard = document.querySelector(".alert-card")
    alertCard.style.opacity = "0.6"
    wakeUpBtn.textContent = "Waking up..."
    wakeUpBtn.disabled = true

    setTimeout(() => {
      alertCard.style.opacity = "1"
      wakeUpBtn.textContent = "Wake up"
      wakeUpBtn.disabled = false
      console.log("[v0] Environment woken up")
    }, 2000)
  })
}

// Sidebar Buttons
const sidebarBtns = document.querySelectorAll(".sidebar-btn")
sidebarBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    const action = btn.textContent.trim()
    console.log("[v0] Action:", action)
  })
})

// Stat Cards Click
const statCards = document.querySelectorAll(".stat-card")
statCards.forEach((card) => {
  card.addEventListener("click", () => {
    card.style.transform = "scale(0.98)"
    setTimeout(() => {
      card.style.transform = ""
    }, 150)
  })
})

console.log("[v0] Hibernation Dashboard loaded")

    </script>
</body>
</html>
