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

          <!-- NAVBAR -->

           
               
          <div class="form-container form-switch">
    <div class="form-header">
        <h2><i data-feather="pause"></i> Administrador de Pausas</h2>
    </div>
    <div class="form-body body-update">
        <p id="message-time-pause">
            Puedes crear tus pausas aquí, recuerda organizarte bien para que no te quedes sin pausa (:
        </p>
    </div>
    <div class="form-footer" id="footer-switch">
        <div class="form-group">
            <label for="reason">Razón de la pausa</label>
            <select id="reason" required>
                <option value="" disabled selected>Selecciona una razón</option>
                <option value="break">Break 15 minutos</option>
                <option value="lunch">Almuerzo</option>
                <option value="bathroom_outside">Baño afuera</option>
                <option value="bathroom_office">Baño oficina</option>
                <option value="meeting_manager">Reunión con gerente</option>
                <option value="meeting_rrhh">Reunión con RRHH</option>
                <option value="meeting_country_manager">Reunión con gerente de país</option>
            </select>
        </div>

        <div class="form-group">
            <label class="switch">
                <input type="checkbox" id="pause-switch" onchange="togglePause()">
                <span class="slider"></span>
            </label>
            <span id="switch-status" class="switch-status inactive">Inactiva</span>
        </div>
    </div>
</div>
                  <div id="metrics" class="tab-content">
                    <div class="metrics-container">
                        <div class="metric-box">
                            <h3 class="metric-title">Pausas</h3>
                            <p class="metric-value" id="total-pauses"></p>
                            <p class="metric-desc">Total de pausas</p>
                        </div>
                        <div class="metric-box">
                            <h3 class="metric-title">Tiempo en pausa</h3>
                            <p class="metric-value" id="total-pause-time"></p>
                            <p class="metric-desc">Total de tiempo en pausa</p>
                        </div>
                        <div class="metric-box">
                            <h3 class="metric-title">Tiempo restante</h3>
                            <p class="metric-value" id="total-remaining-time"></p>
                            <p class="metric-desc">Tiempo restante</p>
                        </div>
                    </div>
                </div>
     <div class="card-filter">
    <div class="form-header">
        <h3>Estadísticas por Fecha</h3>
    </div>

    <form class="filter-date range-container" id="filter-form">
        <div class="form-body">
            <div class="form-group">
                <label for="start-date">Desde</label>
                <input type="date" id="start-date" value="<?php 
                    $today = new DateTime('now', new DateTimeZone(TIMEZONE));
                    echo $today->format('Y-m-d');
                ?>">
            </div>
            <div class="form-group">
                <label for="end-date">Hasta</label>
                <input type="date" id="end-date" value="<?php 
                    $today = new DateTime('now', new DateTimeZone(TIMEZONE));
                    echo $today->format('Y-m-d');
                ?>">
            </div>
        </div>
        <div class="form-footer">
            <button type="submit" class="filter-button">
                <i data-feather="filter"></i>
                Filtrar
            </button>
        </div>
    </form>
</div>

                <div id="logs" class="tab-content">
                    <div class="loader">
                      <span class="spinner1"></span>
                      <span class="spinner2"></span>
                      <span class="spinner3"></span>
                    </div>
                    <div class="logs-list" id="pause-list">
                       
                    </div>
                </div>

</div>
          <div class="card" hidden>
                <h3>Actividad <span id="user-name"></span> <span id="user-role"></span><span id="user-department"></span></h3>
              <div class="info-row">
                    <span class="info-label">Sesiones hoy:</span>
                    <span class="info-value">342</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Nuevos registros:</span>
                    <span class="info-value">28</span>
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

           
        </div>
    </main>
      <script>
  

    const API_URL = "<?php echo API_URL; ?>";
    const reasons = {
      break: 'Break 15 minutos',
      lunch: 'Almuerzo',
      bathroom_outside: 'Baño afuera',
      bathroom_office: 'Baño oficina',
      meeting_manager: 'Reunión con gerente',
      meeting_rrhh: 'Reunión con RRHH',
      meeting_country_manager: 'Reunión con gerente de país',
    };

    let currentPause = null;
    let currentUser = null;

    function getCurrentEmployeeId() {
      if (!currentUser) {
        console.error('No se encontraron datos de usuario');
        return null;
      }
      if (currentUser.id) {
        return currentUser.id;
      }
      console.error('El objeto de usuario no tiene un ID válido:', currentUser);
      return null;
    }

    async function togglePause() {
      const pauseSwitch = document.getElementById('pause-switch');
      const isChecked = pauseSwitch.checked;

      if (isChecked) {
        // Iniciar pausa
        await startPause();
      } else {
        // Detener pausa
        await stopPause();
      }
    }

    async function startPause() {
      const reason = document.getElementById('reason').value;
      if (!reason) {
        alert('Por favor, selecciona una razón');
        // Revertir el switch si no hay razón seleccionada
        document.getElementById('pause-switch').checked = false;
        return;
      }

      const employeeId = getCurrentEmployeeId();
      if (!employeeId) {
        alert('Error: No se pudo identificar al empleado. Por favor, inicia sesión nuevamente.');
        document.getElementById('pause-switch').checked = false;
        window.location.href = 'login.html';
        return;
      }

      const startTime = new Date();
      startTime.setHours(startTime.getHours() - 6);

      try {
        const response = await fetch(`${API_URL}/set_pauses.php`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            employee_id: employeeId,
            reason: reason,
            start_time: startTime.toISOString()
          })
        });

        const data = await response.json();

        if (data.success) {
          currentPause = {
            id: data.pause_id,
            reason: reason,
            start_time: startTime.toISOString(),
            status: 'in_progress'
          };

          updateSwitchState(true);
          await fetchPauses();
        } else {
          throw new Error(data.message || 'Error al iniciar la pausa');
        }
      } catch (error) {
        console.error('Error al iniciar la pausa:', error);
        alert('Error al iniciar la pausa: ' + error.message);
        // Revertir el switch en caso de error
        document.getElementById('pause-switch').checked = false;
      }
    }

    async function stopPause() {
      if (!currentPause) {
        console.error('No hay pausa activa para detener');
        document.getElementById('pause-switch').checked = true;
        return;
      }

      const employeeId = getCurrentEmployeeId();
      if (!employeeId) {
        alert('Error: No se pudo identificar al empleado. Por favor, inicia sesión nuevamente.');
        document.getElementById('pause-switch').checked = true;
        window.location.href = 'login.html';
        return;
      }

      const endTime = new Date();
      endTime.setHours(endTime.getHours() - 6);

      try {
        const requestData = {
          employee_id: employeeId,
          end_time: endTime.toISOString()
        };

        console.log('Sending stop request with data:', requestData);

        const response = await fetch(`${API_URL}/set_pauses.php`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(requestData)
        });

        const responseText = await response.text();
        console.log('Raw response:', responseText);

        if (!responseText) {
          throw new Error('Respuesta vacía del servidor');
        }

        const data = JSON.parse(responseText);

        if (data.success) {
          currentPause = null;
          updateSwitchState(false);
          await fetchPauses();
        } else {
          throw new Error(data.message || 'Error al detener la pausa');
        }
      } catch (error) {
        console.error('Error al detener la pausa:', error);
        alert('Error al detener la pausa: ' + error.message);
        // Revertir el switch en caso de error
        document.getElementById('pause-switch').checked = true;
      }
    }

    function updateSwitchState(isActive) {
      const pauseSwitch = document.getElementById('pause-switch');
      const switchStatus = document.getElementById('switch-status');
      const reasonSelect = document.getElementById('reason');

      pauseSwitch.checked = isActive;
      
      if (isActive) {
      //   switchStatus.textContent = 'Activa';
        switchStatus.className = 'switch-status active';
        switchStatus.textContent = 'Activa';
        reasonSelect.disabled = true;
      } else {
        // switchStatus.textContent = 'Inactiva';
        switchStatus.className = 'switch-status inactive';
        switchStatus.textContent = 'Inactiva';
        reasonSelect.disabled = false;
        reasonSelect.value = '';
      }
    }

    function updatePauseControls(hasActivePause) {
      updateSwitchState(hasActivePause);
    }

    function showLoading(show) {
      const loader = document.querySelector('.loader');
      const pauseList = document.getElementById('pause-list');
      if (show) {
        loader.style.display = 'flex';
        loader.style.opacity = '1';
        pauseList.style.display = 'none';
      } else {
        loader.style.opacity = '0';
        setTimeout(() => {
          loader.style.display = 'none';
          pauseList.style.display = 'grid';
        }, 400);
      }
    }

    function formatDate(date) {
      const d = new Date(date);
      return d.toISOString().split('T')[0];
    }

    function getSecondsDiff(start, end) {
      console.log(start);
      console.log(end);
      const startDate = new Date(start);
      const endDate = new Date(end);
      return (endDate - startDate) / 1000;
    }

    async function fetchPauses() {
      if (!currentUser) {
        console.error('Usuario no definido, no se pueden cargar las pausas');
        showLoading(false);
        const pauseList = document.getElementById('pause-list');
        pauseList.innerHTML = '<div class="error">Error: Sesión no iniciada. Por favor, inicia sesión nuevamente.</div>';
        window.location.href = 'auth.php';
        return;
      }

      try {
        showLoading(true);

        const startDate = document.getElementById('start-date').value;
        const endDate = document.getElementById('end-date').value;

        const response = await fetch(`${API_URL}/get_pauses.php?employee_id=${currentUser.id}&start_date=${startDate}&end_date=${endDate}`);

        if (!response.ok) {
          throw new Error('Error en la red al cargar las pausas');
        }

        const data = await response.json();

        const importantPauses = data.data.filter(pause =>
          pause.reason === 'bathroom_outside' || pause.reason === 'break' || pause.reason === 'bathroom_office'
        );

        const hondurasDate = new Date().toLocaleDateString("es-HN", {
          timeZone: "America/Tegucigalpa",
          year: "numeric",
          month: "2-digit",
          day: "2-digit"
        });
        const parts = hondurasDate.split("/");
        const formattedDate = `${parts[2]}-${parts[1]}-${parts[0]}`;

        const todayPauses = importantPauses.filter(pause =>
          pause.end_time != null &&
          pause.start_time.startsWith(formattedDate)
        );

        const totalSeconds = todayPauses.reduce(
          (total, pause) => total + Math.round(getSecondsDiff(pause.start_time, pause.end_time)),
          0
        );

        const hours = Math.floor(totalSeconds / 3600);
        const minutes = Math.floor((totalSeconds % 3600) / 60);
        const seconds = Math.floor(totalSeconds % 60);

        const totalPauseTime = `${hours}h ${minutes}m ${seconds}s`;
        const totalPauseElementTwo = document.getElementById('message-time-pause');
        const bodyUpdate = document.querySelector('.body-update');
        let TimeAuthorized = 80;
        // Restar 15 minutos de la pausa total
        let totalPauseTimeAuthorized = 90 * 60 - totalSeconds;
        let hoursAuthorized = Math.floor(totalPauseTimeAuthorized / 3600);
        let minutesAuthorized = Math.floor((totalPauseTimeAuthorized % 3600) / 60);
        let secondsAuthorized = Math.floor(totalPauseTimeAuthorized % 60);

     
        document.getElementById('total-remaining-time').textContent = `${hoursAuthorized}h ${minutesAuthorized}m ${secondsAuthorized}s`;


     
        let totalTimeConsumed = 0;
        let hoursConsumed = 0;
        let minutesConsumed = 0;
        let secondsConsumed = 0;
        //CONTAR DE PAUSAS IMPORTANTES 
        importantPauses.forEach(element => {
          // sumar en totalSeconds
          totalTimeConsumed += Math.round(getSecondsDiff(element.start_time, element.end_time));
          hoursConsumed = Math.floor(totalTimeConsumed / 3600);
          minutesConsumed = Math.floor((totalTimeConsumed % 3600) / 60);
          secondsConsumed = Math.floor(totalTimeConsumed % 60);
        });
          
          const totalPauseTimeConsumed = `${hoursConsumed}h ${minutesConsumed}m ${secondsConsumed}s`;
         
          


      if (totalSeconds < 40 * 60) {
        bodyUpdate.classList.add('bg-body-update-success');
        totalPauseElementTwo.className = 'total-pause-time-two clr-success';
        totalPauseElementTwo.textContent = `Hoy has estado en pausa: ${totalPauseTime} - Excelente`;

      } else if (totalSeconds >= 40 * 60 && totalSeconds < 70 * 60) {
        bodyUpdate.classList.add('bg-body-update-warning');
        totalPauseElementTwo.className = 'total-pause-time-two';
        totalPauseElementTwo.textContent = `Tu tiempo de pausa ha llegado a: ${totalPauseTime} - Cuida tu tiempo de pausa`;

      } else if (totalSeconds >= 70 * 60) {
        bodyUpdate.classList.add('bg-body-update-danger');
        totalPauseElementTwo.className = 'total-pause-time-two clr-danger';
        totalPauseElementTwo.textContent = `Excediste el tiempo de pausa: ${totalPauseTime} - Por favor, detén la pausa`;

        document.getElementById('footer-switch').style.display = 'none';
      }


        if (!data.success) {
          throw new Error(data.message || 'Error al cargar las pausas');
        }

        const pauses = data.data || [];
        const pauseList = document.getElementById('pause-list');
        pauseList.innerHTML = '';

        const activePause = pauses.find(pause => !pause.end_time);
        if (activePause) {
          currentPause = {
            id: activePause.pause_id,
            reason: activePause.reason,
            start_time: activePause.start_time,
            status: 'in_progress'
          };
          updatePauseControls(true);
        } else {
          currentPause = null;
          updatePauseControls(false);
        }

        showLoading(false);

        pauses.sort((a, b) => new Date(b.start_time) - new Date(a.start_time));

        let totalPauseSeconds = 0;

        const pausesByDate = {};
        pauses.forEach(pause => {
          const date = new Date(pause.start_time).toLocaleDateString('es-HN', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            timeZone: 'America/Tegucigalpa'
          });

          if (!pausesByDate[date]) {
            pausesByDate[date] = [];
          }
          pausesByDate[date].push(pause);
        });
        let totalPauses = 0;
        for (const [date, dailyPauses] of Object.entries(pausesByDate)) {
  // 🔹 Crea un contenedor general para cada grupo (fecha + pausas)
  const dateContainer = document.createElement('div');
  dateContainer.className = 'date-container';

  // 🔹 Agrega el encabezado de la fecha
  const dateHeader = document.createElement('div');
  dateHeader.className = 'date-header';
  dateHeader.textContent = date;

  dateContainer.appendChild(dateHeader);

  // 🔹 Contador total de pausas
  totalPauses += dailyPauses.length;

  // 🔹 Crea un sub-contenedor para las pausas de esa fecha
  const pausesContainer = document.createElement('div');
  pausesContainer.className = 'pauses-container';

  // 🔹 Recorre cada pausa
  dailyPauses.forEach(pause => {
    const card = document.createElement('div');
    card.className = `log-entry ${!pause.end_time ? 'in-progress' : ''}`;

    let endText = '';
    let durationText = '';

    if (pause.end_time) {
      endText = new Date(pause.end_time).toLocaleTimeString('es-HN', {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false,
        timeZone: 'America/Tegucigalpa'
      });

      const duration = Math.round((new Date(pause.end_time) - new Date(pause.start_time)) / 1000);
      const hours = Math.floor(duration / 3600);
      const minutes = Math.floor((duration % 3600) / 60);
      const seconds = duration % 60;

      durationText = [
        hours > 0 ? `${hours}h` : '',
        minutes > 0 ? `${minutes}m` : '',
        `${seconds}s`
      ].filter(Boolean).join(' ');

      totalPauseSeconds += duration;
    }

    const reasonText = reasons[pause.reason] || pause.reason;
    const startTime = new Date(pause.start_time).toLocaleTimeString('es-HN', {
      hour: '2-digit',
      minute: '2-digit',
      second: '2-digit',
      hour12: false,
      timeZone: 'America/Tegucigalpa'
    });

    card.innerHTML = `
      <h3>${reasonText}</h3>
      <div class="info-row">
        <span class="info-label">Inicio:</span>
        <span class="info-value">${startTime} - ${pause.end_time ? endText : 'En curso'}</span>
      </div>
      ${pause.end_time ? `<div class="info-row"><span class="info-label">Duración:</span><span class="info-value">${durationText}</span></div>` : ''}
    `;

    pausesContainer.appendChild(card);
  });

  // 🔹 Agrega el sub-contenedor de pausas al contenedor de la fecha
  dateContainer.appendChild(pausesContainer);

  // 🔹 Finalmente, agrega todo al contenedor principal
  pauseList.appendChild(dateContainer);
}


        const totalPauseElement = document.getElementById('total-pause-time');
        const totalPausesElement = document.getElementById('total-pauses');
        totalPausesElement.textContent = totalPauses;
      
        if (totalPauseSeconds > 0) {
          const hours = Math.floor(totalPauseSeconds / 3600);
          const minutes = Math.floor((totalPauseSeconds % 3600) / 60);
          const seconds = totalPauseSeconds % 60;

          let timeString = [];
          if (hours > 0) timeString.push(`${hours}h`);
          if (minutes > 0 || hours > 0) timeString.push(`${minutes}m`);
          timeString.push(`${seconds}s`);

          totalPauseElement.textContent = `${timeString.join(' ')}`;
        } else {
          totalPauseElement.textContent = '0';
        }
      } catch (error) {
        console.error('Error fetching pauses:', error);
        const pauseList = document.getElementById('pause-list');
        pauseList.innerHTML = '<div class="error">Error al cargar las pausas. Intente de nuevo más tarde.</div>';
        showLoading(false);
      }
    }

    function getLocalDateString(date) {
      const d = new Date(date);
      const year = d.getFullYear();
      const month = String(d.getMonth() + 1).padStart(2, '0');
      const day = String(d.getDate()).padStart(2, '0');
      const localDateStr = `${year}-${month}-${day}`;

      const today = new Date();
      if (d.toDateString() === today.toDateString()) {
        const localOffset = today.getTimezoneOffset();
        const hondurasOffset = 360;
        const totalOffset = (hondurasOffset - localOffset) * 60000;
        const adjustedDate = new Date(today.getTime() + totalOffset);
        return adjustedDate.toISOString().split('T')[0];
      }

      return localDateStr;
    }

    let isFiltering = false;

    function handleFilter(event) {
      if (isFiltering) {
        event.preventDefault();
        return;
      }

      if (event) {
        event.preventDefault();
        event.stopPropagation();
      }

      isFiltering = true;

      const filterButton = document.querySelector('.filter-button');
      if (filterButton) {
        filterButton.disabled = true;
        filterButton.innerHTML = '<i data-feather="filter" style="width: 1rem; height: 1rem;"></i> Filtrando...';
        feather.replace();
      }

      const startDate = document.getElementById('start-date').value;
      const endDate = document.getElementById('end-date').value;

      if (new Date(startDate) > new Date(endDate)) {
        alert('La fecha de inicio no puede ser mayor que la fecha de fin');
        document.getElementById('end-date').value = startDate;
        if (filterButton) {
          filterButton.disabled = false;
          filterButton.innerHTML = '<i data-feather="filter" style="width: 1rem; height: 1rem;"></i> Filtrar';
          feather.replace();
        }
        isFiltering = false;
        return;
      }

      setTimeout(() => {
        fetchPauses().finally(() => {
          if (filterButton) {
            filterButton.disabled = false;
            filterButton.innerHTML = '<i data-feather="filter" style="width: 1rem; height: 1rem;"></i> Filtrar';
            feather.replace();
          }
          isFiltering = false;
        });
      }, 100);
    }

    let pageInitialized = false;

    document.addEventListener('DOMContentLoaded', () => {
      if (pageInitialized) return;

      currentUser = JSON.parse(localStorage.getItem('currentUser'));

      if (!currentUser) {
        window.location.href = 'auth.php';
        return;
      }

      document.getElementById('user-name').textContent = currentUser.name;
      document.getElementById('user-role').textContent = currentUser.role.charAt(0).toUpperCase() + currentUser.role.slice(1);

      if (currentUser.department) {
        document.getElementById('user-department').textContent = currentUser.department;
      } else {
        document.getElementById('user-department').style.display = 'none';
      }

      const today = getLocalDateString(new Date());
      const startDateInput = document.getElementById('start-date');
      const endDateInput = document.getElementById('end-date');

      if (!startDateInput.value) {
        startDateInput.value = today;
      }
      if (!endDateInput.value) {
        endDateInput.value = today;
      }

      const filterForm = document.querySelector('.range-container');
      if (filterForm) {
        filterForm.removeEventListener('submit', handleFilter);
        filterForm.addEventListener('submit', handleFilter);

        if (!pageInitialized) {
          fetchPauses();
          pageInitialized = true;
        }
      }

      const dateInputs = document.querySelectorAll('input[type="date"]');
      dateInputs.forEach(input => {
        input.removeEventListener('keydown', handleDateInputKeydown);
        input.addEventListener('keydown', handleDateInputKeydown);
      });
    });

    function handleDateInputKeydown(e) {
      if (e.key === 'Enter') {
        e.preventDefault();
        handleFilter(e);
      }
    }

    function logout() {
      localStorage.removeItem('currentUser');
      window.location.href = router + 'auth.php';
    }
  </script>
<?php include 'template/footer.php';?>