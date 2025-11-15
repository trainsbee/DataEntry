<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Factura Honduras - Interfaz Completa</title>
<style>
  body { font-family: Arial, sans-serif; max-width: 1000px; margin: 20px auto; }
  h1, h2 { text-align: center; }
  label { display: block; margin-top: 10px; }
  input { width: 100%; padding: 5px; margin-top: 2px; }
  button { margin-top: 10px; padding: 8px 12px; }
  table { width: 100%; border-collapse: collapse; margin-top: 10px; }
  th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
  th { background-color: #f0f0f0; }
  .totales { text-align: right; margin-top: 10px; }
  .factura { border: 2px solid #000; padding: 20px; margin-top: 20px; }
  .factura h2 { text-align: center; margin-bottom: 10px; }
  .factura p { margin: 2px 0; }
</style>
</head>
<body>

<h1>Factura Honduras - Generador Completo</h1>

<!-- Configuración de Empresa y Facturación -->
<h2>Configuración</h2>
<div>
  <label>Nombre Empresa:</label>
  <input type="text" id="empresa-nombre" value="Trainsbee">
  <label>RTN:</label>
  <input type="text" id="empresa-rtn" value="08011985123945">
  <label>Dirección:</label>
  <input type="text" id="empresa-direccion" value="Tegucigalpa, Honduras">
  <label>Teléfono:</label>
  <input type="text" id="empresa-telefono" value="+504 9999-9999">
  <label>Correo:</label>
  <input type="text" id="empresa-correo" value="contacto@trainsbee.com">
  <hr>
  <label>CAI:</label>
  <input type="text" id="fact-cai" value="1234567890ABCDEFG">
  <label>Fecha Vencimiento CAI:</label>
  <input type="date" id="fact-fecha">
  <label>Rango Inicial:</label>
  <input type="number" id="fact-rango-inicial" value="1">
  <label>Rango Final:</label>
  <input type="number" id="fact-rango-final" value="1000">
  <label>ISV (%):</label>
  <input type="number" id="fact-isv" value="15">
  <label>Número Actual de Factura:</label>
  <input type="number" id="fact-numero" value="1">
</div>

<!-- Datos Cliente -->
<h2>Datos del Cliente</h2>
<div>
  <label>Nombre:</label>
  <input type="text" id="cliente-nombre">
  <label>RTN:</label>
  <input type="text" id="cliente-rtn">
</div>

<!-- Productos -->
<h2>Productos</h2>
<table id="tabla-productos">
  <thead>
    <tr>
      <th>Descripción</th>
      <th>Cantidad</th>
      <th>Precio Unitario</th>
      <th>Subtotal</th>
      <th>Acción</th>
    </tr>
  </thead>
  <tbody></tbody>
</table>
<button id="agregar-producto">Agregar Producto</button>

<div class="totales">
  <p>SubTotal: <span id="subtotal">0.00</span></p>
  <p>ISV: <span id="isv">0.00</span></p>
  <p>Total: <span id="total">0.00</span></p>
</div>

<button id="generar-factura">Generar Factura</button>

<!-- Div para mostrar factura -->
<div id="mostrar-factura"></div>

<script>
let productos = [];

function actualizarTotales() {
  let subtotal = 0;
  productos.forEach(p => subtotal += p.cantidad * p.precio);
  let isv = subtotal * (parseFloat(document.getElementById('fact-isv').value)/100);
  let total = subtotal + isv;
  document.getElementById('subtotal').textContent = subtotal.toFixed(2);
  document.getElementById('isv').textContent = isv.toFixed(2);
  document.getElementById('total').textContent = total.toFixed(2);
}

function renderTabla() {
  const tbody = document.querySelector('#tabla-productos tbody');
  tbody.innerHTML = "";
  productos.forEach((p,i)=>{
    let row = document.createElement('tr');
    row.innerHTML = `
      <td contenteditable="true">${p.descripcion}</td>
      <td contenteditable="true">${p.cantidad}</td>
      <td contenteditable="true">${p.precio.toFixed(2)}</td>
      <td>${(p.cantidad*p.precio).toFixed(2)}</td>
      <td><button onclick="eliminarProducto(${i})">Eliminar</button></td>
    `;
    tbody.appendChild(row);
  });
  actualizarTotales();
}

function eliminarProducto(i){
  productos.splice(i,1);
  renderTabla();
}

document.getElementById('agregar-producto').addEventListener('click', ()=>{
  productos.push({descripcion:"Producto",cantidad:1,precio:0});
  renderTabla();
});

document.getElementById('generar-factura').addEventListener('click', ()=>{
  // Actualizar productos editables
  const rows = document.querySelectorAll('#tabla-productos tbody tr');
  rows.forEach((row,i)=>{
    const cells = row.querySelectorAll('td');
    productos[i].descripcion = cells[0].textContent;
    productos[i].cantidad = parseFloat(cells[1].textContent)||0;
    productos[i].precio = parseFloat(cells[2].textContent)||0;
  });
  actualizarTotales();

  const factura = {
    numero: parseInt(document.getElementById('fact-numero').value),
    fecha: new Date().toLocaleDateString('es-HN'),
    empresa: {
      nombre: document.getElementById('empresa-nombre').value,
      rtn: document.getElementById('empresa-rtn').value,
      direccion: document.getElementById('empresa-direccion').value,
      telefono: document.getElementById('empresa-telefono').value,
      correo: document.getElementById('empresa-correo').value
    },
    facturacion: {
      cai: document.getElementById('fact-cai').value,
      isv: parseFloat(document.getElementById('fact-isv').value)/100
    },
    cliente: {
      nombre: document.getElementById('cliente-nombre').value,
      rtn: document.getElementById('cliente-rtn').value
    },
    productos,
    subtotal: parseFloat(document.getElementById('subtotal').textContent),
    isv: parseFloat(document.getElementById('isv').textContent),
    total: parseFloat(document.getElementById('total').textContent)
  };

  // Renderizar factura visualmente
  let html = `<div class="factura">
    <h2>Factura #${factura.numero}</h2>
    <p><strong>Empresa:</strong> ${factura.empresa.nombre}</p>
    <p><strong>RTN:</strong> ${factura.empresa.rtn}</p>
    <p><strong>Dirección:</strong> ${factura.empresa.direccion}</p>
    <p><strong>Tel:</strong> ${factura.empresa.telefono} | <strong>Correo:</strong> ${factura.empresa.correo}</p>
    <p><strong>CAI:</strong> ${factura.facturacion.cai} | <strong>Fecha:</strong> ${factura.fecha}</p>
    <hr>
    <p><strong>Cliente:</strong> ${factura.cliente.nombre} | <strong>RTN:</strong> ${factura.cliente.rtn}</p>
    <table>
      <thead><tr><th>Descripción</th><th>Cantidad</th><th>Precio Unitario</th><th>Subtotal</th></tr></thead>
      <tbody>`;
  factura.productos.forEach(p=>{
    html += `<tr>
      <td>${p.descripcion}</td>
      <td>${p.cantidad}</td>
      <td>${p.precio.toFixed(2)}</td>
      <td>${(p.cantidad*p.precio).toFixed(2)}</td>
    </tr>`;
  });
  html += `</tbody></table>
    <div class="totales">
      <p>SubTotal: ${factura.subtotal.toFixed(2)}</p>
      <p>ISV: ${factura.isv.toFixed(2)}</p>
      <p>Total: ${factura.total.toFixed(2)}</p>
    </div>
  </div>`;
  document.getElementById('mostrar-factura').innerHTML = html;

  // Incrementar número de factura
  document.getElementById('fact-numero').value = factura.numero +1;
});
</script>

</body>
</html>
