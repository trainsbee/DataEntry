<script>
    // Eliminar formulario anterior si existe
document.getElementById("audioFormContainer")?.remove();

// Crear el contenedor flotante
const formContainer = document.createElement('div');
formContainer.id = "audioFormContainer";
formContainer.innerHTML = `
  <div id="audioForm" style="
    position: fixed;
    top: 10px;
    right: 10px;
    z-index: 999999;
    background: rgba(255, 255, 255, 0.97);
    padding: 12px 16px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    font-family: sans-serif;
    width: 270px;
  ">
    <h4 style="margin: 0 0 10px 0; text-align: center;">🎧 Grabaciones</h4>

    <label style="font-size: 13px;">Teléfono:</label><br>
    <input type="text" id="phoneNumber" value="8132309957"
      style="width: 100%; padding: 5px; margin-bottom: 6px; border-radius: 4px; border: 1px solid #ccc;"><br>

    <label style="font-size: 13px;">Fecha inicio:</label><br>
    <input type="date" id="startDate" value="2025-11-03"
      style="width: 100%; padding: 5px; margin-bottom: 6px; border-radius: 4px; border: 1px solid #ccc;"><br>

    <label style="font-size: 13px;">Fecha fin:</label><br>
    <input type="date" id="endDate" value="2025-11-05"
      style="width: 100%; padding: 5px; margin-bottom: 8px; border-radius: 4px; border: 1px solid #ccc;"><br>

    <button id="searchBtn" style="
      width: 100%;
      padding: 8px;
      background: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    ">Buscar</button>

    <div id="results" style="margin-top: 10px; max-height: 200px; overflow-y: auto; font-size: 13px;"></div>
  </div>
`;

// Insertar el formulario en la página
document.body.appendChild(formContainer);

// Función de búsqueda
async function buscarGrabaciones() {
  const phoneNumber = document.getElementById("phoneNumber").value.trim();
  const startDate = document.getElementById("startDate").value.replace(/-/g, "/");
  const endDate = document.getElementById("endDate").value.replace(/-/g, "/");
  const resultsDiv = document.getElementById("results");

  resultsDiv.innerHTML = "<p>🔄 Buscando grabaciones...</p>";

  try {
    const response = await fetch("http://qd-us-east-1.infusedai.io:6699/v2/stats/queues/phone", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: new URLSearchParams({
        buildingList: 1,
        phoneNumber,
        startDate,
        endDate
      })
    });

    const html = await response.text();
    const parser = new DOMParser();
    const doc = parser.parseFromString(html, "text/html");

    const elements = doc.querySelectorAll('[id^="audio_container_"]');
    const baseUrl = "http://qd-us-east-1.infusedai.io:6699/static/recordings/";
    const links = [...elements].map(el => {
      const id = el.id.replace("audio_container_", "");
      return `${baseUrl}${id}.mp3`;
    });

    if (links.length === 0) {
      resultsDiv.innerHTML = "<p>❌ No se encontraron grabaciones.</p>";
      return;
    }

    resultsDiv.innerHTML = `
      <p><b>${links.length}</b> grabaciones encontradas:</p>
      <ul style="padding-left: 16px;">
        ${links.map(link => `<li><a href="${link}" target="_blank">${link.split("/").pop()}</a></li>`).join("")}
      </ul>
    `;
  } catch (error) {
    resultsDiv.innerHTML = `<p style="color:red;">⚠️ Error: ${error.message}</p>`;
    console.error(error);
  }
}

// Escuchar clic en el botón, sin submit
document.getElementById("searchBtn").addEventListener("click", buscarGrabaciones);

</script>