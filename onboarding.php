<?php include 'settings.php';?>
<?php include 'template/ui_header.php';?>

<main class="main-content">
    <div class="container">
        <div class="grid grid-cols-2 gap-4">
            <div class="col-span-1">
                <div class="card card-onboarding">
                    <div class="card-header">
                        <div class="control-pause">
                            <div class="box-select select-wrapper">
                                <label for="select-reason" class="select-label">Reason</label>
                                <select name="" id="select-reason">
                                    <option value="">Select a reason</option>
                                    <option value="LUNCH">Lunch</option>
                                    <option value="BREAK">Break</option>
                                    <option value="DIRECTOR_MEETING">Director meeting</option>
                                    <option value="TRAINING">Training</option>
                                    <option value="SUPERVISOR_MEETING">Supervisor meeting</option>
                                    <option value="BATHROOM_OUTSIDE">Bathroom Outside</option>
                                    <option value="BATHROOM_OFFICE">Bathroom Office</option>
                                    <option value="OTHER">Other</option>
                                </select>
                                
                            </div>

                            <div class="box-toggle toggle-wrapper">
                                <div class="toggle-text body-update">
                                    <h3>Hello (:</h3>
                                    <p class="message-time-pause" id="message-time-pause">Tu tiempo es optimo puedes crear pausas.</p>
                                </div>
                                <label class="toggle">
                                    <input class="toggle-checkbox" type="checkbox" id="pause-switch" onchange="togglePause()">
                                    <div class="toggle-switch"></div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="separador">
                        <div class="line-left"></div>
                        <div class="line-center">
                            <!-- <span>Stadistics</span> -->
                            <span icon-data="plus"><i data-feather="plus"></i></span>
                        </div>
                        <div class="line-right"></div>
                    </div>
              
                <div class="box-date-range">
                            <div class="date-range">
                                <div class="date-range-item input-wrapper">
                                    <input type="date" id="start-date">
                                </div>
                                <div class="date-range-item input-wrapper">
                                    <input type="date" id="end-date">
                                </div>
                                <div class="date-range-item input-wrapper">
                                    <button class="btn btn-default filter-button" type="button">
                                        <span class="icon-filter" icon-data="filter"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg></span>
                                        <span class="loader_circle"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <div class="card-body">
                        <!-- Fin de la tabla -->
                        <div class="box-stats">
                            <div class="stats-item">
                                <h3>Horas</h3>
                                <p id="total-pauses"></p>
                            </div>
                            <div class="stats-item">
                                <h3>Minutos</h3>
                                <p id="total-pause-time"></p>
                            </div>
                            <div class="stats-item">
                                <h3>Segundos</h3>
                                <p id="total-remaining-time"></p>
                            </div>
                        </div>
                        <div class="loader">
                      <span class="spinner1"></span>
                      <span class="spinner2"></span>
                      <span class="spinner3"></span>
                    </div>
                        <div id="pause-list">
                            
                        </div>
                        <!-- Fin de la tabla -->
                    </div>
<main class="main-content">
      

          <div class="card">
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
   
 
    </main>
                </div>
            </div>
            <div class="col-span-1">
                <div class="card">
                  <div class="box-profile">
                    <div class="box-header">
                      <div class="particle-header">
                        <img src="<?php echo API_PUBLIC ?>img/header-profile.jpg" alt="header-profile">
                      </div>
                    </div>
                    <div class="box-body">
                      <div class="profile-img">
                        <img src="<?php echo API_PUBLIC ?>img/profile.png" alt="profile">
                    </div>
                    <div class="profile-info">
                        <h3>@username</h3>
                        <p>DATA ENTRY</p>
                    </div>
                    </div>
                  </div>
                    <div class="card-temp">
                    <svg fill="none" class="nug nui nuk nva">
                        <defs>
                            <pattern id="pattern-5c1e4f0e-62d5-498b-8ff0-cf77bb448c8e" width="10" height="10" x="0" y="0" patternUnits="userSpaceOnUse">
                                <path d="M-3 13 15-5M-5 5l18-18M-1 21 17 3"></path>
                            </pattern>
                        </defs>
                        <rect width="100%" height="100%" fill="url(#pattern-5c1e4f0e-62d5-498b-8ff0-cf77bb448c8e)" stroke="none"></rect>
                    </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'template/ui_footer.php';?>
<!-- <script>
  const toggleInput = document.querySelector('.toggle-input');

toggleInput.addEventListener('change', () => {
  if (toggleInput.checked) {
    document.body.classList.add('dark-mode');
  } else {
    document.body.classList.remove('dark-mode');
  }
});

  </script> -->
   

<script>
  

    const API_URL = "<?php echo API_URL; ?>";

    const reasons = {
        BREAK: 'Break 15 minutos',
        LUNCH: 'Almuerzo',
        BATHROOM_OUTSIDE: 'Baño afuera',
        BATHROOM_OFFICE: 'Baño oficina',
        MEETING_MANAGER: 'Reunión con gerente',
        MEETING_RRHH: 'Reunión con RRHH',
        MEETING_COUNTRY_MANAGER: 'Reunión con gerente de país',
    }

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
      const reason = document.getElementById('select-reason').value;
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
      const reasonSelect = document.getElementById('select-reason');

      pauseSwitch.checked = isActive;
      
      if (isActive) {
     
        reasonSelect.disabled = true;
      } else {
       
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
        window.location.href = 'signin.php';
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
          pause.reason === 'BATHROOM_OUTSIDE' || pause.reason === 'BREAK' || pause.reason === 'BATHROOM_OFFICE'
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
      pausesContainer.className = 'box-stacked';

      // 🔹 Recorre cada pausa
      dailyPauses.forEach(pause => {
        const card = document.createElement('div');
        card.className = `stacked-item ${!pause.end_time ? 'row-active-warning' : ''}`;

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
                                <div class="info-row">
                                    <div class="info-label">
                                        <h3>${reasonText}</h3>
                                    </div>
                                    <div class="info-value">
                                        <p>Time</p>
                                        <p>${pause.end_time ? 'Duration' : ''}</p>
                                    </div>

                                </div>
                                <div class="info-row time">
                                    <div class="info-label">
                                   &nbsp;   <!-- <span icon-data="clock"><i data-feather="clock"></i></span> -->
                                    </div>
                                    <div class="info-value">
                                        <p>${startTime} - ${pause.end_time ? endText : 'En curso'}</p>
                                        <p>${durationText}</p>
                                    </div>
                                </div>`;

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

       function getLocalDateString() {
  return new Date().toLocaleDateString("sv", {
    timeZone: "America/Tegucigalpa"
  });
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
          //
    const btnFilter = document.querySelector('.btn-default');
    const iconFilter = document.querySelector('.icon-filter');
    const iconLoader = document.querySelector('.loader_circle');
          //
          if (filterButton) {
              // Ocultar icono filter
        iconFilter.classList.add('hidden');
        // Mostrar loader
        iconLoader.classList.add('active');
           
          }

          const startDate = document.getElementById('start-date').value;
          const endDate = document.getElementById('end-date').value;

          if (new Date(startDate) > new Date(endDate)) {
            alert('La fecha de inicio no puede ser mayor que la fecha de fin');
            document.getElementById('end-date').value = startDate;
            if (filterButton) {
              filterButton.disabled = false;
               // Ocultar loader
            iconLoader.classList.remove('active');
            // Mostrar icono filter de nuevo
            iconFilter.classList.remove('hidden');
            }
            isFiltering = false;
            return;
          }

          setTimeout(() => {
            fetchPauses().finally(() => {
              if (filterButton) {
                filterButton.disabled = false;
                  // Ocultar icono filter
            // Ocultar loader
            iconLoader.classList.remove('active');
            // Mostrar icono filter de nuevo
            iconFilter.classList.remove('hidden');
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
            window.location.href = 'signin.php';
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

          const filterForm = document.querySelector('.filter-button');
          if (filterForm) {
            filterForm.removeEventListener('click', handleFilter);
            filterForm.addEventListener('click', handleFilter);

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
          window.location.href = 'signin.php';
        }
  </script>