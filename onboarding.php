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
                        </div>
                        
                    </div>
                    <div class="card-body">
                        
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
  