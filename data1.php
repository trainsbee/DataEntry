<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - macOS + Supabase Style</title>
  <script src="https://unpkg.com/feather-icons"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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
      --danger: #ff453a;

      /* Utilidades */
      --radius: 12px;
      --radius-sm: 8px;
      --transition: all 0.2s ease;
      --shadow-sm: 0 1px 3px rgba(0,0,0,0.1);
      --shadow: 0 4px 12px rgba(0,0,0,0.3);
      --shadow-lg: 0 10px 25px rgba(0,0,0,0.4);
      --focus-ring: 0 0 0 3px rgba(10, 132, 255, 0.3);
    }

    body {
      background-color: var(--bg-primary);
      color: var(--text-primary);
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
      line-height: 1.6;
      font-size: 14px;
      -webkit-font-smoothing: antialiased;
    }

    /* === COMPONENTES MODERNOS (Supabase + Stripe Style) === */

    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      padding: 0.5rem 1rem;
      font-weight: 600;
      font-size: 0.875rem;
      border: none;
      border-radius: var(--radius-sm);
      cursor: pointer;
      transition: var(--transition);
      text-decoration: none;
      white-space: nowrap;
    }

    .btn-primary { background-color: var(--info); color: white; }
    .btn-success { background-color: var(--success); color: white; }
    .btn-warning { background-color: var(--warning); color: white; }
    .btn-danger { background-color: var(--danger); color: white; }
    .btn-secondary { background-color: var(--bg-input); color: var(--text-primary); border: 1px solid var(--border); }
    .btn-outline { background-color: transparent; color: var(--text-primary); border: 1px solid var(--border); }

    .btn:hover { transform: translateY(-1px); box-shadow: var(--shadow); }
    .btn:active { transform: translateY(0); }
    .btn:focus { outline: none; box-shadow: var(--focus-ring); }

    .btn-sm { padding: 0.35rem 0.75rem; font-size: 0.8rem; }
    .btn-lg { padding: 0.75rem 1.5rem; font-size: 1rem; }

    /* Input, Select, Textarea */
    .input, .select, .textarea {
      width: 100%;
      padding: 0.75rem 1rem;
      background-color: var(--bg-input);
      border: 1px solid var(--border);
      border-radius: var(--radius-sm);
      color: var(--text-primary);
      font-size: 0.95rem;
      transition: var(--transition);
    }

    .input::placeholder, .textarea::placeholder {
      color: var(--text-tertiary);
    }

    .input:focus, .select:focus, .textarea:focus {
      outline: none;
      border-color: var(--info);
      box-shadow: var(--focus-ring);
    }

    .textarea { min-height: 100px; resize: vertical; }

    /* Form Group */
    .form-group {
      margin-bottom: 1rem;
    }

    label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
      color: var(--text-secondary);
      font-size: 0.9rem;
    }

    /* Switch */
    .switch {
      position: relative;
      display: inline-block;
      width: 48px;
      height: 28px;
    }

    .switch input { opacity: 0; width: 0; height: 0; }

    .switch-slider {
      position: absolute;
      cursor: pointer;
      top: 0; left: 0; right: 0; bottom: 0;
      background-color: var(--bg-input);
      border: 1px solid var(--border);
      transition: var(--transition);
      border-radius: 34px;
    }

    .switch-slider:before {
      position: absolute;
      content: "";
      height: 22px;
      width: 22px;
      left: 3px;
      bottom: 3px;
      background-color: var(--text-tertiary);
      transition: var(--transition);
      border-radius: 50%;
    }

    input:checked + .switch-slider {
      background-color: var(--success);
      border-color: var(--success);
    }

    input:checked + .switch-slider:before {
      transform: translateX(20px);
      background-color: white;
    }

    /* Dropdown */
    .dropdown {
      position: relative;
      display: inline-block;
    }

    .dropdown-toggle {
      background-color: var(--bg-input);
      border: 1px solid var(--border);
      color: var(--text-primary);
      padding: 0.75rem 1rem;
      border-radius: var(--radius-sm);
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 0.5rem;
      min-width: 180px;
      font-size: 0.95rem;
      font-weight: 500;
    }

    .dropdown-menu {
      position: absolute;
      top: 100%;
      left: 0;
      right: 0;
      background-color: var(--bg-card);
      border: 1px solid var(--border);
      border-radius: var(--radius-sm);
      margin-top: 0.5rem;
      box-shadow: var(--shadow-lg);
      opacity: 0;
      visibility: hidden;
      transform: translateY(-8px);
      transition: var(--transition);
      z-index: 100;
    }

    .dropdown-menu.show {
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
    }

    .dropdown-item {
      padding: 0.75rem 1rem;
      color: var(--text-primary);
      cursor: pointer;
      transition: var(--transition);
      font-size: 0.95rem;
    }

    .dropdown-item:hover {
      background-color: #2c2c2e;
    }

    /* Search */
    .search-input {
      position: relative;
    }

    .search-input input {
      padding-left: 2.75rem;
    }

    .search-input i {
      position: absolute;
      left: 1rem;
      top: 50%;
      transform: translateY(-50%);
      color: var(--text-tertiary);
      font-size: 1.1rem;
      pointer-events: none;
    }

    /* Table */
    .table {
      width: 100%;
      border-collapse: collapse;
      font-size: 0.9rem;
      background-color: var(--bg-card);
      border-radius: var(--radius);
      overflow: hidden;
      box-shadow: var(--shadow);
    }

    .table th {
      text-align: left;
      padding: 1rem;
      background-color: var(--bg-input);
      color: var(--text-secondary);
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      font-size: 0.75rem;
      border-bottom: 1px solid var(--border);
    }

    .table td {
      padding: 1rem;
      border-bottom: 1px solid var(--border);
      color: var(--text-primary);
    }

    .table tr:hover {
      background-color: #2c2c2e;
    }

    .status {
      padding: 0.25rem 0.75rem;
      border-radius: 6px;
      font-size: 0.75rem;
      font-weight: 600;
      text-transform: uppercase;
    }

    .status.active { background-color: rgba(50, 215, 75, 0.15); color: var(--success); }
    .status.inactive { background-color: rgba(99, 99, 102, 0.15); color: var(--text-secondary); }
    .status.pending { background-color: rgba(255, 159, 10, 0.15); color: var(--warning); }

    /* === LAYOUT === */
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
      color: var(--info);
    }

    .header-title {
      font-size: 1.75rem;
      font-weight: 700;
      color: var(--text-primary);
    }

    .header-description {
      max-width: 1200px;
      margin: 0 auto;
      color: var(--text-secondary);
      font-size: 1rem;
    }

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
      font-size: 0.95rem;
      font-weight: 500;
      transition: var(--transition);
      border-bottom: 2px solid transparent;
      margin-bottom: -1px;
    }

    .nav-tab:hover {
      color: var(--text-primary);
    }

    .nav-tab.active {
      color: var(--info);
      border-bottom-color: var(--info);
    }

    .status-badge {
      background-color: var(--bg-input);
      display: flex;
      align-items: center;
      gap: 0.5rem;
      padding: 0.5rem 1rem;
      border-radius: var(--radius-sm);
      font-size: 0.9rem;
      font-weight: 500;
      color: var(--text-primary);
      border: 1px solid var(--border);
    }

    .main-content {
      padding: 2rem;
    }

    .content-container {
      max-width: 1200px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: 1fr 300px;
      gap: 2rem;
    }

    .col-1 { grid-column: 1 / -1; }
    .col-2-left { grid-column: 1; }
    .col-2-right { grid-column: 2; }

    .card {
      background-color: var(--bg-card);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      padding: 1.5rem;
      box-shadow: var(--shadow-sm);
      transition: var(--transition);
    }

    .card:hover {
      box-shadow: var(--shadow);
    }

    .card-title {
      font-size: 1.1rem;
      font-weight: 600;
      margin-bottom: 1rem;
      color: var(--text-primary);
    }

    .stat-card {
      background-color: var(--bg-input);
      border: 1px solid var(--border);
      border-radius: var(--radius-sm);
      padding: 1.25rem;
      display: flex;
      gap: 1rem;
      transition: var(--transition);
    }

    .stat-card:hover {
      border-color: var(--border-light);
      background-color: #333335;
    }

    .stat-icon {
      width: 48px;
      height: 48px;
      background-color: rgba(10, 132, 255, 0.1);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--info);
    }

    .stat-label {
      font-size: 0.85rem;
      color: var(--text-secondary);
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .stat-value {
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--text-primary);
    }

    .stat-desc {
      font-size: 0.8rem;
      color: var(--text-tertiary);
    }

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
      font-weight: 600;
    }

    .sidebar-btn {
      width: 100%;
      background-color: var(--bg-input);
      border: 1px solid var(--border);
      color: var(--text-primary);
      padding: 0.75rem;
      border-radius: var(--radius-sm);
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
      border-color: var(--info);
      color: var(--info);
    }

    .info-item {
      display: flex;
      justify-content: space-between;
      padding: 0.75rem 0;
      border-bottom: 1px solid var(--border);
    }

    .info-item:last-child { border-bottom: none; }

    .info-label { color: var(--text-secondary); font-size: 0.9rem; }
    .info-value { color: var(--text-primary); font-weight: 500; }

    .tab-content { display: none; }
    .tab-content.active { display: block; }

    @media (max-width: 768px) {
      .content-container { grid-template-columns: 1fr; }
      .col-2-left, .col-2-right { grid-column: 1; }
    }
  </style>
</head>
<body>

  <!-- Header -->
  <header class="header">
    <div class="header-container">
      <div class="header-left">
        <svg class="logo-icon" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="12" cy="12" r="10"></circle>
          <polyline points="12 6 12 12 16 14"></polyline>
        </svg>
        <h1 class="header-title">Hibernation</h1>
      </div>
    </div>
    <p class="header-description">Gestión moderna de entornos con componentes reutilizables.</p>
  </header>

  <!-- Navbar -->
  <nav class="navbar">
    <div class="nav-container">
      <div class="nav-tabs">
        <button class="nav-tab active" data-tab="overview">Overview</button>
        <button class="nav-tab" data-tab="logs">Logs</button>
        <button class="nav-tab" data-tab="components">Components</button>
      </div>
      <div class="status-badge">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M12 2L15.09 8.26H22L17.17 12.88L19.34 19.12L12 15.77L4.66 19.12L6.83 12.88L2 8.26H8.91L12 2Z"></path>
        </svg>
        <span>Environment hibernating</span>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="main-content">
    <div class="content-container">

      <!-- Overview -->
      <div id="overview" class="tab-content active">
        <div class="col-1">
          <div class="card">
            <h2 class="card-title">Estado del Sistema</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem;">
              <div class="stat-card">
                <div class="stat-icon"><i data-feather="cpu"></i></div>
                <div>
                  <div class="stat-label">CPU Usage</div>
                  <div class="stat-value">0%</div>
                  <div class="stat-desc">Hibernating</div>
                </div>
              </div>
              <div class="stat-card">
                <div class="stat-icon"><i data-feather="hard-drive"></i></div>
                <div>
                  <div class="stat-label">Memory</div>
                  <div class="stat-value">0MB</div>
                  <div class="stat-desc">Scaled to zero</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Logs -->
      <div id="logs" class="tab-content">
        <div class="col-1">
          <div class="card">
            <h2 class="card-title">Últimos Eventos</h2>
            <div style="display: flex; flex-direction: column; gap: 0.75rem;">
              <div style="padding: 1rem; background: var(--bg-input); border-radius: var(--radius-sm); border: 1px solid var(--border);">
                <div style="display: flex; align-items: center; gap: 1rem; font-family: 'SF Mono', monospace; font-size: 0.85rem;">
                  <span style="color: var(--text-tertiary);">14:32:18</span>
                  <span class="status info" style="background: rgba(10,132,255,0.15); color: var(--info);">INFO</span>
                  <span style="color: var(--text-secondary);">Environment hibernated successfully</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Components Tab -->
      <div id="components" class="tab-content">

        <!-- Columna Izquierda -->
        <div class="col-2-left">
          <div class="card">
            <h2 class="card-title">Botones</h2>
            <div style="display: grid; gap: 0.75rem;">
              <button class="btn btn-primary">Primary</button>
              <button class="btn btn-success">Success</button>
              <button class="btn btn-warning">Warning</button>
              <button class="btn btn-danger">Danger</button>
              <button class="btn btn-secondary">Secondary</button>
              <button class="btn btn-outline">Outline</button>
            </div>
          </div>

          <div class="card">
            <h2 class="card-title">Formulario</h2>
            <form>
              <div class="form-group">
                <label>Nombre</label>
                <input type="text" class="input" placeholder="John Doe">
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="email" class="input" placeholder="john@example.com">
              </div>
              <div class="form-group">
                <label>Mensaje</label>
                <textarea class="textarea" placeholder="Escribe tu mensaje..."></textarea>
              </div>
              <button type="submit" class="btn btn-primary btn-lg">Enviar</button>
            </form>
          </div>

          <div class="card">
            <h2 class="card-title">Search & Dropdown</h2>
            <div class="search-input" style="margin-bottom: 1rem;">
              <i data-feather="search"></i>
              <input type="text" class="input" placeholder="Buscar...">
            </div>
            <div class="dropdown">
              <button class="dropdown-toggle">
                Seleccionar <i data-feather="chevron-down" style="width:16px;"></i>
              </button>
              <div class="dropdown-menu">
                <div class="dropdown-item">Opción 1</div>
                <div class="dropdown-item">Opción 2</div>
                <div class="dropdown-item">Opción 3</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Columna Derecha -->
        <div class="col-2-right">
          <div class="card">
            <h2 class="card-title">Switch</h2>
            <div style="display: flex; align-items: center; gap: 1rem;">
              <label class="switch">
                <input type="checkbox" checked>
                <span class="switch-slider"></span>
              </label>
              <span>Activo</span>
            </div>
          </div>

          <div class="card">
            <h2 class="card-title">Tabla</h2>
            <table class="table">
              <thead>
                <tr>
                  <th>Servicio</th>
                  <th>Estado</th>
                  <th>Actividad</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>API</td>
                  <td><span class="status active">Active</span></td>
                  <td>2 min ago</td>
                </tr>
                <tr>
                  <td>DB</td>
                  <td><span class="status inactive">Hibernating</span></td>
                  <td>26h ago</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Sidebar -->
      <aside class="sidebar">
        <div class="sidebar-section">
          <h3 class="sidebar-title">Acciones</h3>
          <button class="sidebar-btn"><i data-feather="power"></i> Wake Environment</button>
          <button class="sidebar-btn"><i data-feather="refresh-cw"></i> Refresh</button>
        </div>
        <div class="sidebar-section">
          <h3 class="sidebar-title">Info</h3>
          <div class="info-item"><span class="info-label">Entorno</span><span class="info-value">production</span></div>
          <div class="info-item"><span class="info-label">Región</span><span class="info-value">us-east-1</span></div>
        </div>
      </aside>
    </div>
  </main>

  <script>
    feather.replace();

    // Tabs
    document.querySelectorAll('.nav-tab').forEach(tab => {
      tab.addEventListener('click', () => {
        document.querySelectorAll('.nav-tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
        tab.classList.add('active');
        document.getElementById(tab.dataset.tab).classList.add('active');
      });
    });

    // Dropdown
    document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
      toggle.addEventListener('click', () => {
        const menu = toggle.nextElementSibling;
        menu.classList.toggle('show');
      });
    });

    document.addEventListener('click', (e) => {
      if (!e.target.closest('.dropdown')) {
        document.querySelectorAll('.dropdown-menu').forEach(menu => menu.classList.remove('show'));
      }
    });
  </script>
</body>
</html>