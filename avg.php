<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Token Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 960px;
        }

        .card {
            background: #1a1a1a;
            border-radius: 24px;
            border: 1px solid #333333;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        }

        /* Header Section */
        .card-header {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            border-bottom: 1px solid #333333;
        }

        .header-left {
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            border-right: 1px solid #333333;
        }

        .label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #888888;
            margin-bottom: 16px;
            font-weight: 500;
        }

        .amount-section {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .amount {
            font-size: 56px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: -1px;
        }

        .badge {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #2a2a2a;
            border: 1px solid #444444;
            border-radius: 20px;
            padding: 8px 16px;
            font-size: 14px;
            color: #cccccc;
        }

        .badge-icon {
            width: 16px;
            height: 16px;
            color: #1abc9c;
        }

        .header-right {
            padding: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-primary {
            background: #1abc9c;
            color: #000000;
            border: none;
            border-radius: 24px;
            padding: 14px 32px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 24px rgba(26, 188, 156, 0.3);
        }

        .btn-primary:hover {
            background: #16a085;
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(26, 188, 156, 0.4);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-icon {
            width: 18px;
            height: 18px;
        }

        /* Footer Section */
        .card-footer {
            padding: 40px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
        }

        .date-item {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .date-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #666666;
            font-weight: 600;
        }

        .date-value {
            font-size: 18px;
            color: #ffffff;
            font-weight: 500;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .card-header {
                grid-template-columns: 1fr;
            }

            .header-left {
                border-right: none;
                border-bottom: 1px solid #333333;
            }

            .card-footer {
                gap: 24px;
                padding: 24px;
            }

            .header-left,
            .header-right {
                padding: 24px;
            }

            .amount {
                font-size: 40px;
            }

            .amount-section {
                flex-wrap: wrap;
            }
        }

        @media (max-width: 480px) {
            .card-footer {
                grid-template-columns: 1fr;
            }

            .header-left,
            .header-right {
                padding: 20px;
            }

            .amount {
                font-size: 32px;
            }

            .btn-primary {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <!-- Header Section -->
            <div class="card-header">
                <div class="header-left">
                    <span class="label">Daily Summary - Average & Deals</span>
                    <div class="amount-section">
                        <span class="amount" style="display: flex;"><span style="color: orange;">26&nbsp;</span>  DEALS</span>
                        <div class="badge">
                            <svg class="badge-icon" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                            <span>Total for Today</span>
                        </div>
                    </div>
                </div>
                <div class="header-right">
                    <button class="btn-primary" id="claimBtn">
                        <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <polyline points="7 10 12 15 17 10"/>
                            <line x1="12" y1="15" x2="12" y2="3"/>
                        </svg>
                        Claim earned tokens
                    </button>
                </div>
            </div>
            <style>
            .date-item {
                border: 1px solid #333333;
                padding: 12px;
                border-radius: 10px;
                
            }
            .table {
                border-collapse: collapse;
            }
            .table th {
                border: 1px solid #333333;
            }
            .table td {
                border: 1px solid #333333;
            }
            .date-item .date-label {
                border-bottom: 1px solid #333333;
            }
            .date-item .date-value {
                border-bottom: 1px solid #333333;
            }
            </style>
            <!-- Footer Section -->
            <div class="card-footer">
                <div class="date-item table">
                        <table>
                            <thead>
                                <tr>
                                    <th colspan="3">TM LEADS SP</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    
                                    <td>DEALS</td>
                                    <td>23</td>
                                </tr>
                                <tr>
                                    <td>AVERAGE</td>
                                    <td>$17,500</td>
                                </tr>
                        </table>
                </div>

                <div class="date-item">
                    <span class="date-label">TM LEADS SP</span>
                    <span class="date-value">DEALS &nbsp; 12</span>
                    <span class="date-value">AVERAGE &nbsp; $17,500</span>
                </div>
                <div class="date-item">
                    <span class="date-label">TTS DEBT CPA</span>
                    <span class="date-value">DEALS &nbsp; 12</span>
                    <span class="date-value">AVERAGE &nbsp; $17,500</span>
                </div>
                <div class="date-item">
                    <span class="date-label">TOTAL ALL CAMPAIGNS</span>
                    <span class="date-value">DEALS &nbsp; 24</span>
                    <span class="date-value">AVERAGE &nbsp; $17,500</span>
                </div>
            </div>
        </div>
    </div>

<script>
  feather.replace();

  const claimBtn = document.getElementById('claimBtn');
  claimBtn.addEventListener('click', () => {
    fetch("https://script.google.com/macros/s/AKfycbwIRmpZ4OCwSs1NRvqq3sbDj1XeTc96iIk99NhOUNs_tg-twBPl2zSo0eaNkom9dr2h/exec")
      .then(res => res.json())
      .then(data => {
        const allRows = data.values;

        // Filtrar filas donde la columna H (índice 6) diga "TM Leads SP"
        const filtered = allRows.filter(row => row[6] === "TM Leads SP");

        // Calcular total de deals (cantidad de filas)
        const totalDeals = filtered.length;

        // Calcular promedio de la columna G (índice 5)
        const totalValue = filtered.reduce((sum, row) => sum + Number(row[5] || 0), 0);
        const avgValue = totalDeals > 0 ? (totalValue / totalDeals).toFixed(2) : 0;

        // Mostrar resultados
        console.log("Filtradas:", filtered);
        console.log("Total deals:", totalDeals);
        console.log("Promedio total:", avgValue);

        // Ejemplo: mostrar en alert o en el HTML
        alert(`Total Deals: ${totalDeals}\nPromedio: ${avgValue}`);
      })
      .catch(err => console.error("Error:", err));
  });
  
</script>
<button id="filterBtn">
    Filter
</button>
<script>
  const filterBtn = document.getElementById('filterBtn');
  filterBtn.addEventListener('click', () => {
    const fecha = "2025-11-04"; // YYYY-MM-DD
    fetch(`https://script.google.com/macros/s/AKfycbwLC15qDiJasEYBKgNyoUi80NxTNHRiQbeR5jK8j7grPHEa-e2U3gkwy6edradAqurXFg/exec?fecha=${fecha}`)
      .then(res => res.json())
      .then(data => {
        const result = calculateTotals(data);
        console.log("Total Deals (Active / 3 Day Waiting):", result.totalDeals);
console.log("Total DOC Sent:", result.totalDocSent);
console.log("Campañas:", result.campaigns);
      })
      .catch(err => console.error(err));
  });

  function calculateTotals(data) {
  const rows = data.values;

  // Inicializamos contadores
  let totalDeals = 0;
  let totalDocSent = 0;
  const campaigns = {
    "TM Leads SP": { deals: 0, totalValue: 0 },
    "TTS Debt CPA": { deals: 0, totalValue: 0 }
  };

  rows.forEach(row => {
    const status = row[11]; // columna de estado (CLIENT - ACTIVE / 3 DAY WAITING / DOCS SENT)
    const campaign = row[9]; // columna de campaña
    const value = Number(row[6] || 0); // columna valor numérico (F en tu hoja)

    // Total DOC SENT
    if (status === "DOCS SENT") {
      totalDocSent += 1;
    }

    // Solo considerar ACTIVE o 3DAYWAITING
    if (status === "CLIENT - ACTIVE" || status === "3 DAY WAITING") {
      totalDeals += 1;

      // Por campaña
      if (campaigns[campaign]) {
        campaigns[campaign].deals += 1;
        campaigns[campaign].totalValue += value;
      }
    }
  });

  // Calcular promedio por campaña
  for (let key in campaigns) {
    const c = campaigns[key];
    c.avgValue = c.deals > 0 ? (c.totalValue / c.deals).toFixed(2) : 0;
  }

  return { totalDeals, totalDocSent, campaigns };
}


</script>

</body>
</html>