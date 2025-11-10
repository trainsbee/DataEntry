<div id="navbar-container"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const currentUser = JSON.parse(localStorage.getItem('currentUser'));
    const navbarContainer = document.getElementById('navbar-container');

    // Si no hay usuario autenticado, redirigir a la página de autenticación
    if (!currentUser) {
        window.location.href = 'auth.php';
        return;
    }

    const isAdmin = currentUser.role === 'admin';

    // Detectar la página actual (sin PHP)
    const currentPage = window.location.pathname.split('/').pop();

    // Construcción dinámica del menú
    let navbarHTML = `
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

    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-tabs">
                <a href="dashboard.php" class="nav-tab ${currentPage === 'dashboard.php' ? 'active' : ''}">
                    <i data-feather="grid"></i>
                    <span>Overview</span>
                </a>`;

    // Agregar "Pausas" solo si es admin
    if (isAdmin) {
        navbarHTML += `
                <a href="pauses.php" class="nav-tab ${currentPage === 'pauses.php' ? 'active' : ''}">
                    <i data-feather="clock"></i>
                    <span>Pausas</span>
                </a>`;
    }

    // Agregar el resto de tabs
    navbarHTML += `
                <a href="logs.php" class="nav-tab ${currentPage === 'logs.php' ? 'active' : ''}">
                    <i data-feather="list"></i>
                    <span>Logs</span>
                </a>
                <a href="metrics.php" class="nav-tab ${currentPage === 'metrics.php' ? 'active' : ''}">
                    <i data-feather="bar-chart-2"></i>
                    <span>Metrics</span>
                </a>
                <a href="averages.php" class="nav-tab ${currentPage === 'averages.php' ? 'active' : ''}">
                    <i data-feather="bar-chart-2"></i>
                    <span>Averages</span>
                </a>
            </div>
        </div>
    </nav>`;

    navbarContainer.innerHTML = navbarHTML;

    // Reemplazar iconos Feather
    feather.replace();
});

// Cerrar sesión
function logout() {
    localStorage.removeItem('currentUser');
    window.location.href = 'auth.php';
}
</script>
