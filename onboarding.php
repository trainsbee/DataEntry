<?php include 'settings.php';?>
<?php include 'template/ui_header.php';?>

<main class="main-content">
    <div class="container">
        <div class="grid grid-cols-2 gap-4">
            <div class="col-span-1">
                <div class="card">
                    <div class="card-header">
                        <div class="control-pause">
                            <div class="box-select select-wrapper">
                                <label for="select-reason" class="select-label">Reason</label>
                                <select name="" id="select-reason">
                                    <option value="">Lunch</option>
                                    <option value="">Break</option>
                                    <option value="">Director meeting</option>
                                    <option value="">Training</option>
                                    <option value="">Supervisor meeting</option>
                                    <option value="">Bathroom Outside</option>
                                    <option value="">Bathroom Office</option>
                                    <option value="">Other</option>
                                </select>
                                
                            </div>

                            <div class="box-toggle toggle-wrapper">
                                <div class="toggle-text">
                                    <h3>Annual billing</h3>
                                    <p>Hoy has estado en pausa: 0h 12m 52s - Excelente</p>
                                </div>
                                <label class="toggle">
                                    <input class="toggle-checkbox" type="checkbox">
                                    <div class="toggle-switch"></div>
                                </label>
                            </div>
                            <div class="box-date-range">
                                <div class="date-range">
                                    <div class="date-range-item input-wrapper">
                                        <input type="date">
                                    </div>
                                    <div class="date-range-item input-wrapper">
                                        <input type="date">
                                    </div>
                                    <div class="date-range-item input-wrapper">
                                        <button class="btn btn-default" type="button">
                                            <span class="icon-filter" icon-data="filter"><i data-feather="filter"></i></span>
                                            <span class="loader"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 <script>
    // Inicializar Feather Icons (¡importante!)
    feather.replace();

    const btnFilter = document.querySelector('.btn-default');
    const iconFilter = document.querySelector('.icon-filter');
    const iconLoader = document.querySelector('.loader');

    btnFilter.addEventListener('click', () => {
        // Ocultar icono filter
        iconFilter.classList.add('hidden');
        // Mostrar loader
        iconLoader.classList.add('active');

        // Simular carga de 2 segundos
        setTimeout(() => {
            // Ocultar loader
            iconLoader.classList.remove('active');
            // Mostrar icono filter de nuevo
            iconFilter.classList.remove('hidden');
            
            // Reemplazar icono (por si se pierde el SVG)
            feather.replace();
        }, 2000);
    });
</script>
                    <div class="card-body">
                        <div class="box-stats">
                            <div class="stats-item">
                                <h3>Horas</h3>
                                <p>0h 12m 52s</p>
                            </div>
                            <div class="stats-item">
                                <h3>Minutos</h3>
                                <p>12m</p>
                            </div>
                            <div class="stats-item">
                                <h3>Segundos</h3>
                                <p>52s</p>
                            </div>
                        </div>
                        <div class="box-stacked">
                            <div class="stacked-item row-active-warning">
                                <div class="info-row">
                                    <div class="info-label">
                                        <h3>Bathroom</h3>
                                    </div>
                                    <div class="info-value">
                                        <p>Time</p>
                                    </div>

                                </div>
                                <div class="info-row time">
                                    <div class="info-label">
                                   &nbsp;   <!-- <span icon-data="clock"><i data-feather="clock"></i></span> -->
                                    </div>
                                    <div class="info-value">
                                        <p>20:41:54 - In progress</p>
                                    </div>
                                </div>
                            </div>
                            <div class="stacked-item">
                                <div class="info-row">
                                    <div class="info-label">
                                        <h3>Bathroom</h3>
                                    </div>
                                    <div class="info-value">
                                        <p>Time</p>
                                        <p>Duration</p>
                                    </div>

                                </div>
                                <div class="info-row time">
                                    <div class="info-label">
                                   &nbsp;   <!-- <span icon-data="clock"><i data-feather="clock"></i></span> -->
                                    </div>
                                    <div class="info-value">
                                        <p>20:41:54 - 20:46:41</p>
                                        <p>4m 47s</p>
                                    </div>
                                </div>
                            </div>
                            <div class="stacked-item">
                                <div class="info-row">
                                    <div class="info-label">
                                        <h3>Bathroom</h3>
                                    </div>
                                    <div class="info-value">
                                        <p>Time</p>
                                        <p>Duration</p>
                                    </div>

                                </div>
                                <div class="info-row time">
                                    <div class="info-label">
                                   &nbsp;   <!-- <span icon-data="clock"><i data-feather="clock"></i></span> -->
                                    </div>
                                    <div class="info-value">
                                        <p>20:41:54 - 20:46:41</p>
                                        <p>4m 47s</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-span-1">
                <div class="card">
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
<script>
  const toggleInput = document.querySelector('.toggle-input');

toggleInput.addEventListener('change', () => {
  if (toggleInput.checked) {
    document.body.classList.add('dark-mode');
  } else {
    document.body.classList.remove('dark-mode');
  }
});

  </script>
  