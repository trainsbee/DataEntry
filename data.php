
<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

:root {
  /* Fondo: negro mate puro (como el aluminio del MacBook) */
  --bg-primary: #000000;
  --bg-card: #1c1c1e;
  --bg-input: #2c2c2e;
  --border: #3a3a3c;
  --border-light: #48484a;

  /* Texto */
  --text-primary: #f5f5f7;
  --text-secondary: #aeaeb2;
  --text-tertiary: #636366;

  /* Acentos: blanco suave (sin plateado brillante) */
  --accent: #f5f5f7;
  --accent-hover: #ffffff;

  /* Estados (colores oficiales de macOS) */
  --info: #0a84ff;
  --warning: #ff9f0a;
  --success: #32d74b;

  --radius: 12px;
  --transition: all 0.2s ease;
}

body {
  background-color: var(--bg-primary);
  color: var(--text-primary);
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
  line-height: 1.6;
  font-feature-settings: "kern" 1;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

/* Header */
.header {
  padding: 2rem;
  border-bottom: 1px solid var(--border);
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
  color: var(--accent);
  opacity: 0.9;
}

.header-title {
  font-size: 1.75rem;
  font-weight: 600;
  color: var(--text-primary);
  letter-spacing: -0.5px;
}

.header-description {
  max-width: 1200px;
  margin: 0 auto;
  color: var(--text-secondary);
  font-size: 1rem;
  line-height: 1.6;
}

/* Navbar */
.navbar {
  background-color: var(--bg-card);
  padding: 1rem 2rem;
  border-bottom: 1px solid var(--border);
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
  border-bottom: 1px solid var(--border);
}

.nav-tab {
  background: none;
  border: none;
  color: var(--text-secondary);
  padding: 0.75rem 1.25rem;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.95rem;
  font-weight: 500;
  transition: var(--transition);
  border-bottom: 2px solid transparent;
  margin-bottom: -1px;
}

.nav-tab svg {
  width: 18px;
  height: 18px;
  opacity: 0.8;
}

.nav-tab:hover {
  color: var(--accent);
}

.nav-tab.active {
  color: var(--accent);
  border-bottom-color: var(--accent);
}

.nav-tab.active svg {
  opacity: 1;
}

/* Status Badge */
.status-badge {
  background-color: var(--bg-input);
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem 1rem;
  border-radius: 8px;
  font-size: 0.9rem;
  font-weight: 500;
  color: var(--text-primary);
  white-space: nowrap;
  border: 1px solid var(--border-light);
}

.status-badge svg {
  color: var(--accent);
  width: 16px;
  height: 16px;
}

/* Alert Card */
.alert-card {
  background-color: var(--bg-card);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  padding: 1.2rem;
  min-width: 240px;
}

.alert-text {
  font-size: 0.9rem;
  color: var(--text-secondary);
  margin-bottom: 0.75rem;
}

.alert-text strong {
  color: var(--text-primary);
  font-weight: 600;
}

.wake-up-btn {
  width: 100%;
  padding: 0.75rem;
  background-color: var(--accent);
  color: #000;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-weight: 600;
  font-size: 0.9rem;
  transition: var(--transition);
  text-transform: none;
  letter-spacing: normal;
}

.wake-up-btn:hover {
  background-color: var(--accent-hover);
  transform: translateY(-1px);
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
  background-color: var(--bg-card);
  border: 1px solid var(--border);
  border-radius: var(--radius);
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
  color: var(--text-primary);
}

.panel-action-btn {
  background: none;
  border: none;
  color: var(--text-secondary);
  cursor: pointer;
  padding: 0.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: var(--transition);
  border-radius: 6px;
}

.panel-action-btn:hover {
  background-color: var(--bg-input);
  color: var(--accent);
}

/* Tab Content */
.tab-content {
  display: none;
  animation: fadeIn 0.2s ease;
}

.tab-content.active {
  display: block;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

/* Cards Grid */
.cards-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 1.5rem;
}

.stat-card {
  background-color: var(--bg-input);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  padding: 1.5rem;
  display: flex;
  gap: 1rem;
  transition: var(--transition);
  cursor: pointer;
}

.stat-card:hover {
  border-color: var(--border-light);
  background-color: #333335;
}

.stat-icon {
  flex-shrink: 0;
  width: 48px;
  height: 48px;
  background-color: rgba(255, 255, 255, 0.08);
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--accent);
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
  color: var(--text-secondary);
  text-transform: uppercase;
  letter-spacing: 0.5px;
  font-weight: 500;
}

.stat-value {
  font-size: 1.75rem;
  font-weight: 700;
  color: var(--text-primary);
}

.stat-desc {
  font-size: 0.8rem;
  color: var(--text-tertiary);
}

/* Logs */
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
  background-color: var(--bg-input);
  border-radius: 10px;
  border: 1px solid var(--border);
  transition: var(--transition);
}

.log-entry:hover {
  border-color: var(--border-light);
}

.log-time {
  font-family: "SF Mono", Monaco, monospace;
  font-size: 0.85rem;
  color: var(--text-tertiary);
  min-width: 70px;
}

.log-status {
  font-size: 0.75rem;
  font-weight: 700;
  padding: 0.25rem 0.75rem;
  border-radius: 6px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.log-status.info {
  background-color: rgba(10, 132, 255, 0.15);
  color: var(--info);
}

.log-status.warning {
  background-color: rgba(255, 159, 10, 0.15);
  color: var(--warning);
}

.log-status.success {
  background-color: rgba(50, 215, 75, 0.15);
  color: var(--success);
}

.log-message {
  color: var(--text-secondary);
  flex: 1;
  font-size: 0.95rem;
}

/* Metrics */
.metrics-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 1.5rem;
}

.metric-box {
  background-color: var(--bg-input);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  padding: 1.5rem;
  text-align: center;
  transition: var(--transition);
}

.metric-box:hover {
  border-color: var(--border-light);
}

.metric-title {
  font-size: 0.9rem;
  color: var(--text-secondary);
  margin-bottom: 0.75rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  font-weight: 500;
}

.metric-value {
  font-size: 2rem;
  font-weight: 700;
  color: var(--accent);
  margin-bottom: 0.5rem;
}

.metric-desc {
  font-size: 0.85rem;
  color: var(--text-tertiary);
}

/* Sidebar */
.sidebar {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.sidebar-section {
  background-color: var(--bg-card);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  padding: 1.5rem;
}

.sidebar-title {
  font-size: 0.9rem;
  color: var(--text-secondary);
  margin-bottom: 1rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  font-weight: 500;
}

.sidebar-btn {
  width: 100%;
  background-color: var(--bg-input);
  border: 1px solid var(--border);
  color: var(--text-primary);
  padding: 0.75rem;
  border-radius: 10px;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 0.75rem;
  transition: var(--transition);
  margin-bottom: 0.75rem;
  font-size: 0.9rem;
  font-weight: 500;
}

.sidebar-btn:hover {
  background-color: #333335;
  border-color: var(--border-light);
  color: var(--accent);
}

.sidebar-btn svg {
  width: 18px;
  height: 18px;
  color: var(--accent);
  opacity: 0.9;
}

.info-item {
  display: flex;
  justify-content: space-between;
  padding: 0.75rem 0;
  border-bottom: 1px solid var(--border);
}

.info-item:last-child {
  border-bottom: none;
}

.info-label {
  color: var(--text-secondary);
  font-size: 0.9rem;
}

.info-value {
  color: var(--text-primary);
  font-weight: 500;
}

/* Responsive */
@media (max-width: 768px) {
  .content-container {
    grid-template-columns: 1fr;
  }
  .cards-grid, .metrics-container {
    grid-template-columns: 1fr;
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
  