<?php include 'settings.php';?>
<?php include 'template/ui_header.php';?>

<?php require_once __DIR__ . '/supabase/users.php';?>
<?php $users_json = json_encode($users);?>

 <div class="main-content">
  <div class="container">
    <div class="grid grid-cols-1 gap-4">
      <div class="col-span-1">
        <div class="card">
          <div class="box-date-range">
              <div class="date-range">
                  <div class="date-range-item input-wrapper">
                      <input type="date" id="start-date" value="<?php 
                                  $today = new DateTime('now', new DateTimeZone(TIMEZONE));
                                  echo $today->format('Y-m-d');
                              ?>">
                  </div>
                  <div class="date-range-item input-wrapper">
                      <input type="date" id="end-date" value="<?php 
                                  $today = new DateTime('now', new DateTimeZone(TIMEZONE));
                                  echo $today->format('Y-m-d');
                              ?>">
                  </div>
                  <div class="date-range-item input-wrapper">
                      <button class="btn btn-default filter-button" onclick="loadEmployees()" type="button">
                          <span class="icon-filter" icon-data="filter"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg></span>
                          <span class="loader_circle"></span>
                      </button>
                  </div>
              </div>
          </div>
          <div class="card-body">
            <div class="box-stats">
              <div class="stats-item">
                  <h3>Pausas</h3>
                  <p id="total-pauses"></p>
              </div>
              <div class="stats-item">
                  <h3>Tiempo</h3>
                  <p id="total-consumed-time"></p>
              </div>
              <div class="stats-item">
                  <h3>Activas</h3>
                  <p id="total-pause-active"></p>
              </div>
            </div>

<!--==== Fin de la card ===-->
          <div class="table-container">
            <div class="table-header">
              <h3><i data-feather="clock"></i> Pausas Activas</h3>
            </div>
            <div class="table-wrapper">
              <table class="table">
                <thead>
                    <tr>
                        <th>Empleado</th>
                        <th>Departamento</th>
                        <th>Inicio</th>
                        <th>Transcurrido</th>
                        <th>Razón</th>
                    </tr>
                </thead>
                <tbody id="active-pauses-list"></tbody>
              </table>
            </div>
          </div>

              <!-- TABLA DE EMPLEADOS -->
          <div class="table-container">
            <div class="table-header">
              <h3><i data-feather="users"></i> Empleados</h3>
            </div>
            <div class="table-wrapper">
              <table class="table" id="employees-table">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>ID</th>
                    <th>Pausas Activas</th>
                    <th>Total Pausas</th>
                    <th>Tiempo Total</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody id="employees-list">
                  <tr><td colspan="6">Cargando...</td></tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-span-1">
          <div class="profile navbar-brand">
                        <h3>Actividad <span id="user-name"></span> <span id="user-role"></span><span id="user-department"></span></h3>
 <h2 class="panel-title">Gestión de Pausas</h2>
          </div>
      </div>
      <div class="col-span-1">
        
      </div>
      
    </div>
  </div>
 </div>

<div class="modal-overlay" id="pauses-modal">
    <div class="modal-center">
        <div class="modal-content">
            <div class="modal-header">
                <h2><i data-feather="user"></i> Pausas de <span id="employee-name"></span></h2>
                <button class="close-btn" onclick="closeModal()"><i data-feather="x"></i></button>
            </div>
            <div class="modal-body">

                <!-- Resumen -->
                <div class="metrics-container" id="pauses-summary">
                    
                </div>

                <!-- Pausas Activas -->
                <div class="table-container">
                    <div class="table-header">
                        <h3><i data-feather="clock"></i> Pausas Activas</h3>
                    </div>
                    <div class="table-wrapper">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Razón</th>
                                    <th>Inicio</th>
                                    <th>Transcurrido</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody id="active-pauses"></tbody>
                        </table>
                    </div>
                </div>

                <!-- Historial -->
                <div class="table-container">
                    <div class="table-header">
                        <h3><i data-feather="history"></i> Historial</h3>
                    </div>
                    <div class="table-wrapper">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Razón</th>
                                    <th>Inicio</th>
                                    <th>Fin</th>
                                    <th>Duración</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody id="pauses-history"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
      <script>
    // Global variables
    const users = <?php echo $users_json; ?>;
    let currentUser = null;
    let currentEmployeeId = '';

    const reasons = {
        LUNCH: 'Lunch',
        BREAK: 'Break 15 minutes',
        BATHROOM_OFFICE: 'Bathroom Office',
        BATHROOM_HOME: 'Bathroom Home',

        AUTHORIZED_PAUSE: 'Authorized pause',
        SUPERVISOR_MEETING: 'Supervisor meeting',
        MEETING_IT: 'Meeting IT',
        DIRECTOR_MEETING: 'Director meeting',
        TRAINING: 'Training',
        MEETING_RRHH: 'Meeting RRHH',
    }

    // Check authentication
    function checkAuth() {
      const userData = localStorage.getItem('currentUser');
      if (!userData) {
        window.location.href = 'auth.php';
        return false;
      }
      
      try {
        currentUser = JSON.parse(userData);
        let userFound = false;
        let isAdmin = currentUser.role === 'admin';
        
        for (const managerId in users) {
          const manager = users[managerId];
          
          if (manager.id === currentUser.id) {
            userFound = true;
            currentUser.employees = manager.employees || [];
            break;
          }
          
          const employee = manager.employees.find(emp => emp.id === currentUser.id);
          if (employee) {
            userFound = true;
            currentUser.department = manager.DEPARTMENT || '';
            break;
          }
        }
        
        if (!userFound || !isAdmin) {
          window.location.href = 'signin.php';
          return false;
        }
        
        return true;
      } catch (e) {
        console.error('Error parsing user data:', e);
        window.location.href = 'signin.php';
        return false;
      }
    }

    // Logout function
    function logout() {
      localStorage.removeItem('currentUser');
      window.location.href = 'signin.php';
    }

    // Toggle navbar for mobile
    function toggleNavbar() {
      const navbarLinks = document.querySelector('.navbar-links');
      navbarLinks.classList.toggle('active');
    }

    document.addEventListener('DOMContentLoaded', function() {
      if (checkAuth()) {
        const department = currentUser.DEPARTMENT || currentUser.department || 'Administración';
        const userInfo = `Usuario: ${currentUser.name} (${currentUser.role === 'admin' ? 'Administrador' : 'Empleado'})`;
        document.querySelector('.navbar-brand').textContent = `Gestión de Pausas - ${department}`;
       // document.querySelector('.card .profile p').textContent = userInfo;
        loadEmployees();
        feather.replace();
      }

      // Add event listener for menu toggle
      const menuToggle = document.querySelector('.menu-toggle');
      if (menuToggle) {
        menuToggle.addEventListener('click', toggleNavbar);
      }
    });

    async function loadEmployees() {
      const startDate = document.getElementById('start-date').value;
      const endDate = document.getElementById('end-date').value;
      const employeesList = document.getElementById('employees-list');
      const activePausesList = document.getElementById('active-pauses-list');
      
      let employees = [];
      for (const managerId in users) {
        const manager = users[managerId];
        if (manager.id === currentUser.id) {
          employees = manager.employees || [];
          break;
        }
        if (manager.employees.some(e => e.id === currentUser.id)) {
          employees = manager.employees;
          currentUser.department = manager.DEPARTMENT || '';
          document.querySelector('.navbar-brand').textContent = `Gestión de Pausas - ${currentUser.department}`;
          break;
        }
      }
      
      employeesList.innerHTML = `
        <tr>
          <td colspan="6"><div class="loader">
                <span class="spinner1"></span>
                <span class="spinner2"></span>
                <span class="spinner3"></span>
              </div></td>
        </tr>`;
      activePausesList.innerHTML =`
        <tr>
          <td colspan="6"><div class="loader">
                <span class="spinner1"></span>
                <span class="spinner2"></span>
                <span class="spinner3"></span>
              </div></td>
        </tr>`;
      
      if (employees.length === 0) {
        employeesList.innerHTML = `
          <tr>
            <td colspan="6">No hay empleados asignados.</td>
          </tr>`;
        activePausesList.innerHTML = '<p>No hay empleados para mostrar.</p>';
        return;
      }
      
      try {
        const employeeIds = employees.map(e => e.id).join(',');
        const response = await fetch(`api/get_employee_stats.php?employee_ids=${employeeIds}&start_date=${startDate}&end_date=${endDate}`);
        const result = await response.json();
        
        if (!result.success) {
          throw new Error(result.message || 'Error al cargar estadísticas');
        }
        
        const stats = result.data || {};
        renderEmployeesTable(employees, stats);
        renderActivePausesSummary(employees, stats);
        
      } catch (error) {
        console.error('Error loading employee stats:', error);
        employeesList.innerHTML = `
          <tr>
            <td colspan="6" class="error-cell">
              Error al cargar las estadísticas: ${error.message}
            </td>
          </tr>`;
        activePausesList.innerHTML = '<p class="error-text">Error al cargar las pausas activas.</p>';
        showNotification('error', 'Error al cargar las estadísticas');
      }
      
      feather.replace();
    }

function renderEmployeesTable(employees, stats) {
  const employeesList = document.getElementById('employees-list');
  const totalPauses = document.getElementById('total-pauses');
  const totalPauseTimeConsumed = document.getElementById('total-consumed-time');
  const totalPauseActive = document.getElementById('total-pause-active');
  
  employeesList.innerHTML = '';
  let totalPauseTimeConsumedGlobal = 0;
  let totalPausesGlobal = 0;
  let totalPauseActiveGlobal = 0;

  employees.forEach(employee => {
    const employeeStats = stats[employee.id] || {
      active_pauses: 0,
      total_pauses: 0,
      total_pause_time: '00:00:00'
    };

    // Convertir tiempo a segundos y sumar
    totalPauseTimeConsumedGlobal += timeToSeconds(employeeStats.total_pause_time);
    totalPausesGlobal += employeeStats.total_pauses;
    totalPauseActiveGlobal += employeeStats.active_pauses;

    const row = document.createElement('tr');
    row.innerHTML = `
      <td>${employee.name || 'N/A'}</td>
      <td>${employee.id || 'N/A'}</td>
      <td class="${employeeStats.active_pauses > 0 ? 'clr-danger' : ''}">
        ${employeeStats.active_pauses}
      </td>
      <td>${employeeStats.total_pauses}</td>
      <td>${employeeStats.total_pause_time || '00:00:00'}</td>
      <td>
        <button class="btn-primary" onclick="viewPauses('${employee.id}', '${(employee.name || '').replace(/'/g, "\\'")}')"><i data-feather="eye"></i> Ver</button>
      </td>
    `;
    employeesList.appendChild(row);
  });

  // Convertir total global de segundos a HH:MM:SS
  totalPauseTimeConsumed.textContent = secondsToTime(totalPauseTimeConsumedGlobal);
  totalPauses.textContent = totalPausesGlobal;
  totalPauseActive.textContent = totalPauseActiveGlobal;
}

// Funciones auxiliares
function timeToSeconds(time) {
  const [h, m, s] = time.split(':').map(Number);
  return h * 3600 + m * 60 + s;
}

function secondsToTime(totalSeconds) {
  const h = String(Math.floor(totalSeconds / 3600)).padStart(2, '0');
  const m = String(Math.floor((totalSeconds % 3600) / 60)).padStart(2, '0');
  const s = String(totalSeconds % 60).padStart(2, '0');
  return `${h}:${m}:${s}`;
}


    function renderActivePausesSummary(employees, stats) {
      const activePausesList = document.getElementById('active-pauses-list');
      const employeesWithPauses = [];
      
      for (const employeeId in stats) {
        const employeeStats = stats[employeeId];
        if (employeeStats.active_pauses > 0) {
          const employee = employees.find(e => e.id === employeeId);
          if (employee) {
            employeesWithPauses.push({
              ...employee,
              ...employeeStats
            });
          }
        }
      }
      
      if (employeesWithPauses.length === 0) {
        activePausesList.innerHTML = '<p>No hay pausas activas en este momento.</p>';
        return;
      }
      
      let tableHTML = ``;
      
      employeesWithPauses.forEach(emp => {
        if (emp.pauses && emp.pauses.length > 0) {
          emp.pauses.forEach((pause, index) => {
            const isFirst = index === 0;
            const displayTime = pause.display_time || (pause.start_time.includes('T') 
              ? pause.start_time.split('T')[1].split('.')[0] 
              : pause.start_time);
            
            tableHTML += `
              <tr class="clickable-row" onclick="viewPauses('${emp.id}', '${emp.name.replace(/'/g, "\\'")}')">                
                <td>${isFirst ? emp.name : ''}</td>
                <td>${isFirst ? (emp.department || 'N/A') : ''}</td>
                <td>${displayTime}</td>
                <td class="elapsed-time clr-warning" data-start="${pause.start_time}">00:00:00</td>
                <td class="clr-warning" >${reasons[pause.reason] || 'Sin razón'}</td>
              </tr>
            `;
          });
        }
      });
      
      
      activePausesList.innerHTML = tableHTML;
    }

    function viewPauses(employeeId, employeeName) {
      currentEmployeeId = employeeId;
      document.getElementById('employee-name').textContent = employeeName;
      const modal = document.getElementById('pauses-modal');
      modal.classList.add('show');
      document.querySelector('.modal-center').classList.add('show');
      loadPauses();
    }

    function closeModal() {
      const modal = document.getElementById('pauses-modal');
      modal.classList.remove('show');
      document.querySelector('.modal-center').classList.remove('show');
    }

    function formatDuration(startTime) {
      let start = new Date(startTime);
      if (isNaN(start.getTime())) {
        const timeParts = startTime.match(/(\d{2}):(\d{2}):(\d{2})/);
        if (timeParts) {
          const now = new Date();
          start = new Date(
            now.getFullYear(),
            now.getMonth(),
            now.getDate(),
            parseInt(timeParts[1]),
            parseInt(timeParts[2]),
            parseInt(timeParts[3])
          );
          if (start > now) {
            start.setDate(start.getDate() - 1);
          }
        }
      }
      
      const now = new Date();
      const diffMs = now - start;
      const totalSeconds = Math.floor(diffMs / 1000);
      const hours = Math.floor(totalSeconds / 3600);
      const minutes = Math.floor((totalSeconds % 3600) / 60);
      const seconds = totalSeconds % 60;
      
      return `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    }

    function updateElapsedTimes() {
      document.querySelectorAll('.elapsed-time').forEach(element => {
        const startTime = element.getAttribute('data-start');
        element.textContent = formatDuration(startTime);
      });
    }

    setInterval(updateElapsedTimes, 1000);
    updateElapsedTimes();

    async function loadPauses() {
      const startDate = document.getElementById('start-date').value;
      const endDate = document.getElementById('end-date').value;
      const activePausesList = document.getElementById('active-pauses');
      const pausesHistoryList = document.getElementById('pauses-history');
      
      activePausesList.innerHTML = `
        <tr>
          <td colspan="6"><div class="loader">
                <span class="spinner1"></span>
                <span class="spinner2"></span>
                <span class="spinner3"></span>
              </div></td>
        </tr>`;
      pausesHistoryList.innerHTML = `
        <tr>
          <td colspan="6"><div class="loader">
                <span class="spinner1"></span>
                <span class="spinner2"></span>
                <span class="spinner3"></span>
              </div></td>
        </tr>`;
      
      try {
        const response = await fetch(`api/get_pauses.php?employee_id=${currentEmployeeId}&start_date=${startDate}&end_date=${endDate}`);
        const result = await response.json();
        let allPauses = Array.isArray(result) ? result : (result.data || []);
        
        if (!Array.isArray(allPauses)) {
          console.error('Invalid pauses data:', result);
          allPauses = [];
        }
        
        const activePauses = allPauses.filter(pause => pause.end_time === null);
        const totalPauseSeconds = allPauses.reduce((total, pause) => {
          if (pause.end_time) {
            const start = new Date(pause.start_time);
            const end = new Date(pause.end_time);
            return total + Math.round((end - start) / 1000);
          }
          return total;
        }, 0);
        
        const hours = Math.floor(totalPauseSeconds / 3600);
        const minutes = Math.floor((totalPauseSeconds % 3600) / 60);
        //redondea 
        const seconds = totalPauseSeconds % 60;
        const formattedPauseTime = `${hours}h ${minutes}m ${seconds}s`;
        
        document.getElementById('pauses-summary').innerHTML = `
                        <div class="metric-box">
                            <h3 class="metric-title">Pausas</h3>
                            <p class="metric-value" id="total-pauses"> ${allPauses.length}</p>
                            <p class="metric-desc">In the last 7 days</p>
                        </div>
                        <div class="metric-box">
                            <h3 class="metric-title">Tiempo</h3>
                            <p class="metric-value" id="total-pause-time">${formattedPauseTime}</p>
                            <p class="metric-desc">This month</p>
                        </div>
                        <div class="metric-box">
                            <h3 class="metric-title">Activas</h3>
                            <p class="metric-value" id="total-remaining-time">${activePauses.length}</p>
                            <p class="metric-desc">Per hibernation</p>
                        </div>
        `;
        
        if (activePauses.length === 0) {
          activePausesList.innerHTML = '<p>No hay pausas activas</p>';
        } else {
          activePausesList.innerHTML = `
                ${activePauses.map(pause => {
                  const startTime = new Date(pause.start_time);
                  const formattedTime = startTime.toLocaleTimeString('es-HN', { 
                    hour: '2-digit', 
                    minute: '2-digit',
                    second: '2-digit',
                    hour12: true 
                  });
                  return `
                    <tr>
                      <td>${reasons[pause.reason] || 'Sin razón'}</td>
                      <td>${formattedTime}</td>
                      <td>
                        <span class="elapsed-time" data-start="${pause.start_time}">${formatDuration(pause.start_time)}</span>
                      </td>
                      <td class="clr-warning">En progreso</td>
                    </tr>
                  `;
                }).join('')}
          `;
        }
        
        const historicalPauses = allPauses.filter(pause => pause.end_time !== null)
          .sort((a, b) => new Date(b.start_time) - new Date(a.start_time));
        
        if (historicalPauses.length === 0) {
          pausesHistoryList.innerHTML = '<p>No hay historial de pausas</p>';
        } else {
          pausesHistoryList.innerHTML = `
                ${historicalPauses.map(pause => {
                  const startTime = new Date(pause.start_time);
                  const endTime = new Date(pause.end_time);
                  const durationMs = endTime - startTime;
                  const totalSeconds = Math.round(durationMs / 1000);
                  const hours = Math.floor(totalSeconds / 3600);
                  const minutes = Math.floor((totalSeconds % 3600) / 60);
                  const seconds = totalSeconds % 60;
                  const reasonText = reasons[pause.reason] || pause.reason;
                  return `
                    <tr>
                      <td>${reasonText || 'Sin razón'}</td>
                      <td>${startTime.toLocaleTimeString('es-HN', { hour: '2-digit', minute: '2-digit', second: '2-digit' })}</td>
                      <td>${endTime.toLocaleTimeString('es-HN', { hour: '2-digit', minute: '2-digit', second: '2-digit' })}</td>
                      <td>${hours}h ${minutes}m ${seconds}s</td>
                      <td class="clr-success">Completada</td>
                    </tr>
                  `;
                }).join('')}
          `;
        }
        
      } catch (error) {
        console.error('Error loading pauses:', error);
        activePausesList.innerHTML = '<p>Error al cargar las pausas</p>';
        pausesHistoryList.innerHTML = '<p>Error al cargar el historial</p>';
        showNotification('error', 'Error al cargar las pausas');
      } finally {
        feather.replace();
        updateElapsedTimes();
      }
    }

    function showNotification(type, message) {
      const notification = document.createElement('div');
      notification.className = `notification ${type} show`;
      notification.innerHTML = `<i data-feather="${type === 'error' ? 'alert-circle' : 'info'}"></i> ${message}`;
      document.body.appendChild(notification);
      setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => notification.remove(), 400);
      }, 3000);
      feather.replace();
    }

    window.onclick = function(event) {
      const modal = document.getElementById('pauses-modal');
      if (event.target === modal) {
        closeModal();
      }
    };
  </script>
  <script>
    feather.replace();
  </script>
<?php include 'template/footer.php';?>