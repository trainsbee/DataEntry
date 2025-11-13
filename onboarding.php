<?php include 'settings.php';?>
<?php include 'template/ui_header.php';?>

<main class="main-content">
    <div class="container">
        <div class="grid grid-cols-2 gap-4">
            <div class="col-span-1">
                <div class="card">
                    <div class="card-header">
                        <h3>Horario</h3>
                        
                    </div>
                    <div class="card-body">
                        <div class="control-pause">
                            <div class="select-wrapper">
                                <select name="" id="">
                                    <option value="">Lunes</option>
                                    <option value="">Martes</option>
                                    <option value="">Miercoles</option>
                                    <option value="">Jueves</option>
                                    <option value="">Viernes</option>
                                    <option value="">Sabado</option>
                                    <option value="">Domingo</option>
                                </select>
                            </div>
                            <br>
                            <label class="toggle-wrapper">
                                <input type="checkbox" class="toggle-input" />
                                <div class="toggle-switch">
                                <div class="toggle-circle">
                                    <div class="toggle-icon">
                        <!-- OFF: X (clases svu swk, viewBox 12x12) -->
                            <svg viewBox="0 0 12 12" fill="none" class="svu swk">
                                <path d="M4 8l2-2m0 0l2-2M6 6L4 4m2 2l2 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>

                        <!-- ON: Check (clases feather feather-check, viewBox 24x24) -->
                        <svg viewBox="0 0 12 12" fill="currentColor" class="svu swl">
                        <path d="M3.707 5.293a1 1 0 00-1.414 1.414l1.414-1.414zM5 8l-.707.707a1 1 0 001.414 0L5 8zm4.707-3.293a1 1 0 00-1.414-1.414l1.414 1.414zm-7.414 2l2 2 1.414-1.414-2-2-1.414 1.414zm3.414 2l4-4-1.414-1.414-4 4 1.414 1.414z"></path>
                        </svg>
                        </div>
                    </div>
                    </div>
                    <span>Activar</span>
                </label>
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