<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LogoWear - Ropa Personalizada con Tu Logo</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.1/fabric.min.js"></script>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    :root {
      --lw-bg-primary: #f8f9fa;
      --lw-bg-secondary: #ffffff;
      --lw-text-primary: #1a1a1a;
      --lw-text-secondary: #555555;
      --lw-accent: #d4a574;
      --lw-accent-dark: #b8935f;
      --lw-border: #e0e0e0;
    }
    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background-color: var(--lw-bg-primary);
      color: var(--lw-text-primary);
      line-height: 1.6;
      overflow-x: hidden;
    }

    /* Header */
    .lw-header {
      position: fixed;
      top: 0; left: 0; right: 0;
      background-color: rgba(248, 249, 250, 0.95);
      backdrop-filter: blur(10px);
      z-index: 1000;
      border-bottom: 1px solid var(--lw-border);
    }
    .lw-nav {
      max-width: 1400px;
      margin: 0 auto;
      padding: 0.5rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .lw-logo {
      font-size: 1.6rem;
      font-weight: 300;
      letter-spacing: 3px;
      text-transform: uppercase;
      color: var(--lw-text-primary);
    }
    .lw-nav-links {
      display: flex;
      gap: 2rem;
      list-style: none;
    }
    .lw-nav-links a {
      color: var(--lw-text-secondary);
      text-decoration: none;
      font-size: 0.9rem;
      letter-spacing: 1px;
      transition: color 0.3s ease;
    }
    .lw-nav-links a:hover { color: var(--lw-accent); }
    .lw-menu-toggle {
      display: none;
      flex-direction: column;
      gap: 5px;
      cursor: pointer;
      background: none;
      border: none;
    }
    .lw-menu-toggle span {
      width: 25px;
      height: 2px;
      background-color: var(--lw-text-primary);
      transition: all 0.3s ease;
    }

  
 /* Hero */
    .lw-hero {
      margin-top: 80px;
      min-height: 90vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      padding: 4rem 2rem;
      
      background-image: url('shop.jpg');
      background-size: cover;
      background-position: center;
    }
    .lw-hero-content {
      max-width: 900px;
      background: #232731;
      padding: 2rem;
      border-radius: 10px;
    }
    .lw-hero-title {
      font-size: clamp(2.5rem, 8vw, 5rem);
      font-weight: 300;
      letter-spacing: -2px;
      line-height: 1.1;
      margin-bottom: 1.5rem;
      color : white;
    }
    .lw-hero-subtitle {
      font-size: clamp(1rem, 2vw, 1.25rem);
      color: var(--lw-text-secondary);
      margin-bottom: 3rem;
      font-weight: 300;
      color : white;
    }
    .lw-hero-cta {
      display: inline-block;
      padding: 1rem 3rem;
      background-color: var(--lw-text-primary);
      color: white;
      text-decoration: none;
      font-size: 0.9rem;
      letter-spacing: 2px;
      text-transform: uppercase;
      transition: all 0.3s ease;
      border: 2px solid var(--lw-text-primary);
    }
    .lw-hero-cta:hover {
      background-color: transparent;
      color: var(--lw-text-primary);
    }

    /* Search & Categories */
    .lw-search-section {
      max-width: 1400px;
      margin: 4rem auto;
      padding: 0 2rem;
    }
    .lw-search-container {
      max-width: 600px;
      margin: 0 auto 3rem;
      position: relative;
    }
    .lw-search-input {
      width: 100%;
      padding: 1rem 3rem 1rem 1.5rem;
      border: 1px solid var(--lw-border);
      background-color: white;
      font-size: 1rem;
      outline: none;
      transition: border-color 0.3s ease;
    }
    .lw-search-input:focus { border-color: var(--lw-accent); }
    .lw-search-icon {
      position: absolute;
      right: 1.5rem;
      top: 50%;
      transform: translateY(-50%);
      color: var(--lw-text-secondary);
    }
    .lw-categories {
      display: flex;
      justify-content: center;
      gap: 1rem;
      flex-wrap: wrap;
      margin-bottom: 4rem;
    }
    .lw-category-btn {
      padding: 0.75rem 2rem;
      background-color: transparent;
      border: 1px solid var(--lw-border);
      color: var(--lw-text-secondary);
      font-size: 0.9rem;
      letter-spacing: 1px;
      cursor: pointer;
      transition: all 0.3s ease;
      text-transform: capitalize;
    }
    .lw-category-btn:hover,
    .lw-category-btn.lw-active {
      background-color: var(--lw-text-primary);
      color: white;
      border-color: var(--lw-text-primary);
    }

    /* Products Grid */
    .lw-store {
      max-width: 1400px;
      margin: 0 auto;
      padding: 4rem 2rem;
    }
    .lw-section-title {
      font-size: clamp(2rem, 5vw, 3rem);
      font-weight: 300;
      text-align: center;
      margin-bottom: 3rem;
      letter-spacing: -1px;
    }
    .lw-products-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 2rem;
      margin-bottom: 4rem;
    }
    .lw-product-card {
      background-color: white;
      border: 1px solid var(--lw-border);
      overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      display: flex;
      flex-direction: column;
      cursor: pointer;
    }
    .lw-product-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    }
    .lw-product-image {
      width: 100%;
      height: 320px;
      object-fit: cover;
      background-color: #f5f5f5;
    }
    .lw-product-info {
      padding: 1.5rem;
      flex: 1;
      display: flex;
      flex-direction: column;
    }
    .lw-product-category {
      font-size: 0.75rem;
      color: var(--lw-text-secondary);
      text-transform: uppercase;
      letter-spacing: 1.5px;
      margin-bottom: 0.5rem;
    }
    .lw-product-name {
      font-size: 1.1rem;
      font-weight: 400;
      margin-bottom: 0.5rem;
    }
    .lw-product-description {
      font-size: 0.85rem;
      color: var(--lw-text-secondary);
      margin-bottom: 1rem;
      line-height: 1.5;
      flex: 1;
    }
    .lw-product-price {
      font-size: 1.25rem;
      color: var(--lw-accent);
      font-weight: 500;
      margin-bottom: 1rem;
    }
    .lw-product-actions {
      display: flex;
      flex-direction: column;
      gap: 0.75rem;
    }
    .lw-btn {
      padding: 0.75rem 1.5rem;
      border: none;
      font-size: 0.85rem;
      letter-spacing: 1px;
      text-transform: uppercase;
      cursor: pointer;
      transition: all 0.3s ease;
      text-align: center;
      text-decoration: none;
      display: inline-block;
    }
    .lw-btn-primary {
      background-color: var(--lw-text-primary);
      color: white;
    }
    .lw-btn-primary:hover {
      background-color: var(--lw-accent-dark);
    }
    .lw-btn-custom {
      background-color: var(--lw-accent);
      color: white;
    }
    .lw-btn-custom:hover {
      background-color: var(--lw-accent-dark);
    }
    .lw-btn-whatsapp {
      background-color: #25d366;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
    }
    .lw-btn-whatsapp:hover {
      background-color: #20ba5a;
    }
    .lw-btn-whatsapp svg {
      width: 18px;
      height: 18px;
      fill: currentColor;
    }
    .lw-no-results {
      text-align: center;
      padding: 4rem 2rem;
      color: var(--lw-text-secondary);
      font-size: 1.1rem;
    }

    /* Carrito */
    .lw-cart-button {
      position: fixed;
      bottom: 2rem;
      right: 6rem;
      width: 60px;
      height: 60px;
      background-color: var(--lw-text-primary);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
      cursor: pointer;
      transition: transform 0.3s ease;
      z-index: 999;
      border: none;
    }
    .lw-cart-button:hover {
      transform: scale(1.1);
    }
    .lw-cart-button svg {
      width: 28px;
      height: 28px;
      fill: white;
    }
    .lw-cart-badge {
      position: absolute;
      top: -5px;
      right: -5px;
      background-color: var(--lw-accent);
      color: white;
      width: 24px;
      height: 24px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.75rem;
      font-weight: 600;
    }
    .lw-cart-panel {
      position: fixed;
      top: 0;
      right: -100%;
      width: 100%;
      max-width: 450px;
      height: 100vh;
      background-color: white;
      box-shadow: -4px 0 20px rgba(0, 0, 0, 0.1);
      z-index: 1001;
      transition: right 0.3s ease;
      display: flex;
      flex-direction: column;
    }
    .lw-cart-panel.lw-active { right: 0; }
    .lw-cart-overlay {
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100vh;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 1000;
      opacity: 0;
      visibility: hidden;
      transition: opacity 0.3s ease;
    }
    .lw-cart-overlay.lw-active {
      opacity: 1;
      visibility: visible;
    }
    .lw-cart-header {
      padding: 2rem;
      border-bottom: 1px solid var(--lw-border);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .lw-cart-title {
      font-size: 1.5rem;
      font-weight: 300;
      letter-spacing: 1px;
    }
    .lw-cart-close {
      background: none;
      border: none;
      font-size: 1.5rem;
      cursor: pointer;
      color: var(--lw-text-secondary);
    }
    .lw-cart-close:hover { color: var(--lw-text-primary); }
    .lw-cart-items {
      flex: 1;
      overflow-y: auto;
      padding: 1.5rem;
    }
    .lw-cart-item {
      display: flex;
      gap: 1rem;
      padding: 1rem;
      border: 1px solid var(--lw-border);
      margin-bottom: 1rem;
      background-color: #f9f9f9;
    }
    .lw-cart-item-image {
      width: 80px;
      height: 80px;
      object-fit: cover;
      background-color: white;
    }
    .lw-cart-item-info {
      flex: 1;
    }
    .lw-cart-item-name {
      font-size: 0.95rem;
      font-weight: 500;
      margin-bottom: 0.25rem;
    }
    .lw-cart-item-category {
      font-size: 0.75rem;
      color: var(--lw-text-secondary);
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-bottom: 0.5rem;
    }
    .lw-cart-item-price {
      font-size: 1rem;
      color: var(--lw-accent);
      font-weight: 500;
    }
    .lw-cart-item-custom {
      font-size: 0.85rem;
      color: var(--lw-text-secondary);
      margin-top: 0.5rem;
    }
    .lw-cart-item-remove {
      background: none;
      border: none;
      color: var(--lw-text-secondary);
      cursor: pointer;
      font-size: 1.2rem;
    }
    .lw-cart-item-remove:hover { color: #e74c3c; }
    .lw-cart-empty {
      text-align: center;
      padding: 3rem 2rem;
      color: var(--lw-text-secondary);
    }
    .lw-cart-footer {
      padding: 1.5rem 2rem;
      border-top: 1px solid var(--lw-border);
      background-color: #f9f9f9;
    }
    .lw-cart-total {
      display: flex;
      justify-content: space-between;
      margin-bottom: 1.5rem;
      font-size: 1.25rem;
    }
    .lw-cart-total-label { font-weight: 300; }
    .lw-cart-total-amount { font-weight: 500; color: var(--lw-accent); }
    .lw-cart-checkout {
      width: 100%;
      padding: 1rem;
      background-color: #25d366;
      color: white;
      border: none;
      font-size: 0.9rem;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.75rem;
    }
    .lw-cart-checkout:hover { background-color: #20ba5a; }

    /* WhatsApp Button */
    .lw-whatsapp-btn {
      position: fixed;
      bottom: 2rem;
      right: 2rem;
      width: 60px;
      height: 60px;
      background-color: #25d366;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
      cursor: pointer;
      transition: transform 0.3s ease;
      z-index: 999;
      text-decoration: none;
    }
    .lw-whatsapp-btn:hover { transform: scale(1.1); }
    .lw-whatsapp-icon {
      width: 32px;
      height: 32px;
      fill: white;
    }

    /* Footer */
    .lw-footer {
      background-color: var(--lw-text-primary);
      color: white;
      padding: 3rem 2rem 2rem;
      text-align: center;
    }
    .lw-footer-content {
      max-width: 1400px;
      margin: 0 auto;
    }
    .lw-footer-text {
      font-size: 0.9rem;
      letter-spacing: 1px;
      opacity: 0.8;
    }

    /* Modal de Detalle de Producto */
    .lw-product-modal {
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      z-index: 1002;
      display: none;
      align-items: center;
      justify-content: center;
    }
    .lw-product-modal.lw-active {
      display: flex;
    }
    .lw-modal-overlay {
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background-color: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(5px);
    }
    .lw-modal-content {
      position: relative;
      background-color: white;
      max-width: 900px;
      width: 90%;
      max-height: 90vh;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
      animation: lwModalFadeIn 0.3s ease;
    }
    @keyframes lwModalFadeIn {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }
    .lw-modal-close {
      position: absolute;
      top: 1rem;
      right: 1rem;
      width: 40px;
      height: 40px;
      background-color: rgba(0, 0, 0, 0.1);
      border: none;
      border-radius: 50%;
      font-size: 1.5rem;
      color: white;
      cursor: pointer;
      z-index: 10;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
    }
    .lw-modal-close:hover {
      background-color: var(--lw-accent);
      transform: rotate(90deg);
    }
    .lw-modal-body {
      display: flex;
      flex-direction: row;
      max-height: 80vh;
      overflow-y: auto;
    }
    .lw-modal-image-container {
      flex: 1;
      min-width: 300px;
      background-color: #f5f5f5;
    }
    .lw-modal-image {
      width: 100%;
      height: 100%;
      min-height: 400px;
      object-fit: cover;
    }
    .lw-modal-info {
      flex: 1;
      padding: 2rem;
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }
    .lw-modal-category {
      font-size: 0.75rem;
      color: var(--lw-text-secondary);
      text-transform: uppercase;
      letter-spacing: 1.5px;
    }
    .lw-modal-title {
      font-size: 1.8rem;
      font-weight: 400;
      margin: 0;
      line-height: 1.2;
    }
    .lw-modal-description {
      color: var(--lw-text-secondary);
      line-height: 1.7;
      font-size: 0.95rem;
    }
    .lw-modal-price {
      font-size: 1.8rem;
      color: var(--lw-accent);
      font-weight: 500;
    }
    .lw-modal-features h4 {
      margin: 1rem 0 0.5rem;
      font-size: 1rem;
      font-weight: 500;
    }
    .lw-modal-features ul {
      list-style: disc;
      padding-left: 1.2rem;
      color: var(--lw-text-secondary);
      font-size: 0.9rem;
      line-height: 1.6;
    }
    .lw-modal-actions {
      display: flex;
      flex-direction: column;
      gap: 0.75rem;
      margin-top: 1.5rem;
    }
    .lw-modal-actions .lw-btn {
      width: 100%;
    }

    /* Modal de Personalización */
    .lw-custom-modal {
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      z-index: 1003;
      display: none;
      align-items: center;
      justify-content: center;
    }
    .lw-custom-modal.lw-active {
      display: flex;
    }
    .lw-custom-overlay {
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background-color: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(5px);
    }
    .lw-custom-content {
      position: relative;
      background-color: white;
      max-width: 900px;
      width: 90%;
      max-height: 90vh;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
      animation: lwModalFadeIn 0.3s ease;
      padding: 2rem;
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }
    .lw-custom-close {
      position: absolute;
      top: 1rem;
      right: 1rem;
      width: 40px;
      height: 40px;
      background-color: rgba(0, 0, 0, 0.1);
      border: none;
      border-radius: 50%;
      font-size: 1.5rem;
      color: white;
      cursor: pointer;
      z-index: 10;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
    }
    .lw-custom-close:hover {
      background-color: var(--lw-accent);
      transform: rotate(90deg);
    }
    .lw-custom-canvas-container {
      border: 1px solid var(--lw-border);
      background-color: #f5f5f5;
      height: 400px;
      width: 100%;
      position: relative;
    }
    #lwCustomCanvas {
      width: 100%;
      height: 100%;
    }
    .lw-custom-tools {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }
    .lw-custom-upload {
      padding: 0.75rem;
      background-color: var(--lw-bg-secondary);
      border: 1px solid var(--lw-border);
      cursor: pointer;
    }
    .lw-custom-size-label {
      font-size: 1rem;
      font-weight: 500;
    }
    .lw-custom-size-buttons {
      display: flex;
      gap: 0.5rem;
    }
    .lw-custom-size-btn {
      padding: 0.5rem 1rem;
      background-color: transparent;
      border: 1px solid var(--lw-border);
      color: var(--lw-text-primary);
      cursor: pointer;
      transition: all 0.3s ease;
    }
    .lw-custom-size-btn.active {
      background-color: var(--lw-text-primary);
      color: white;
    }
    .lw-custom-actions {
      display: flex;
      gap: 1rem;
      margin-top: 1rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .lw-nav-links {
        position: fixed;
        top: 80px; left: 0; right: 0;
        background-color: white;
        flex-direction: column;
        padding: 2rem;
        gap: 1.5rem;
        transform: translateX(-100%);
        transition: transform 0.3s ease;
        border-bottom: 1px solid var(--lw-border);
      }
      .lw-nav-links.lw-active { transform: translateX(0); }
      .lw-menu-toggle { display: flex; }
      .lw-menu-toggle.lw-active span:nth-child(1) { transform: rotate(45deg) translate(5px, 5px); }
      .lw-menu-toggle.lw-active span:nth-child(2) { opacity: 0; }
      .lw-menu-toggle.lw-active span:nth-child(3) { transform: rotate(-45deg) translate(7px, -7px); }
      .lw-products-grid { grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); }
      .lw-whatsapp-btn, .lw-cart-button { width: 55px; height: 55px; }
      .lw-cart-button { right: 5rem; }
      .lw-modal-body { flex-direction: column; }
      .lw-modal-image-container { min-height: 300px; }
      .lw-modal-info { padding: 1.5rem; }
      .lw-modal-title { font-size: 1.5rem; }
      .lw-custom-content { padding: 1.5rem; }
      .lw-custom-canvas-container { height: 300px; }
    }
    @media (max-width: 480px) {
      .lw-products-grid { grid-template-columns: 1fr; }
      .lw-nav { padding: 1rem 1.5rem; }
      .lw-hero { padding: 3rem 1.5rem; }
      .lw-store { padding: 3rem 1.5rem; }
    }
  </style>
</head>
<body>

  <!-- Header -->
  <header class="lw-header">
    <nav class="lw-nav">
      <div class="lw-logo">LogoWear</div>
      <ul class="lw-nav-links" id="lwNavLinks">
        <li><a href="#home">Inicio</a></li>
        <li><a href="#store">Tienda</a></li>
        <li><a href="#about">Nosotros</a></li>
        <li><a href="#contact">Contacto</a></li>
      </ul>
      <button class="lw-menu-toggle" id="lwMenuToggle" aria-label="Toggle menu">
        <span></span><span></span><span></span>
      </button>
    </nav>
  </header>

  <!-- Hero -->
  <section class="lw-hero" id="home">
    <div class="lw-hero-content">
      <h1 class="lw-hero-title">Tu Logo, Tu Estilo</h1>
      <p class="lw-hero-subtitle">Personalizamos camisetas, polos, gorras y más con tu marca. Calidad premium, entrega rápida.</p>
      <a href="#store" class="lw-hero-cta">Ver Catálogo</a>
    </div>
  </section>

  <!-- Search & Categories -->
  <section class="lw-search-section">
    <div class="lw-search-container">
      <input type="text" class="lw-search-input" id="lwSearchInput" placeholder="Buscar por prenda o logo..." aria-label="Buscar">
      <svg class="lw-search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="11" cy="11" r="8"></circle>
        <path d="m21 21-4.35-4.35"></path>
      </svg>
    </div>
    <div class="lw-categories" id="lwCategories">
      <button class="lw-category-btn lw-active" data-category="todos">Todos</button>
      <button class="lw-category-btn" data-category="camisetas">Camisetas</button>
      <button class="lw-category-btn" data-category="polos">Polos</button>
      <button class="lw-category-btn" data-category="gorras">Gorras</button>
      <button class="lw-category-btn" data-category="sudaderas">Sudaderas</button>
    </div>
  </section>

  <!-- Store -->
  <section class="lw-store" id="store">
    <h2 class="lw-section-title">Catálogo de Personalización</h2>
    <div class="lw-products-grid" id="lwProductsGrid">
      <!-- Productos por JS -->
    </div>
  </section>

  <!-- Carrito -->
  <button class="lw-cart-button" id="lwCartButton" aria-label="Carrito">
    <svg viewBox="0 0 24 24" fill="currentColor">
      <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/>
    </svg>
    <span class="lw-cart-badge" id="lwCartBadge">0</span>
  </button>

  <div class="lw-cart-overlay" id="lwCartOverlay"></div>
  <div class="lw-cart-panel" id="lwCartPanel">
    <div class="lw-cart-header">
      <h3 class="lw-cart-title">Mi Cotización</h3>
      <button class="lw-cart-close" id="lwCartClose" aria-label="Cerrar">&times;</button>
    </div>
    <div class="lw-cart-items" id="lwCartItems">
      <div class="lw-cart-empty">Tu cotización está vacía</div>
    </div>
    <div class="lw-cart-footer" id="lwCartFooter" style="display: none;">
      <div class="lw-cart-total">
        <span class="lw-cart-total-label">Total estimado:</span>
        <span class="lw-cart-total-amount" id="lwCartTotal">$0.00</span>
      </div>
      <button class="lw-cart-checkout" id="lwCartCheckout">
        <svg viewBox="0 0 24 24" fill="currentColor">
          <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
        </svg>
        Enviar Cotización
      </button>
    </div>
  </div>

  <!-- WhatsApp -->
  <a href="https://wa.me/50433158947?text=¡Hola!%20Quiero%20personalizar%20ropa%20con%20mi%20logo" class="lw-whatsapp-btn" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp">
    <svg class="lw-whatsapp-icon" viewBox="0 0 24 24" fill="currentColor">
      <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
    </svg>
  </a>

  <!-- Modal de Detalle de Producto -->
  <div class="lw-product-modal" id="lwProductModal">
    <div class="lw-modal-overlay" id="lwModalOverlay"></div>
    <div class="lw-modal-content">
      <button class="lw-modal-close" id="lwModalClose" aria-label="Cerrar modal">&times;</button>
      
      <div class="lw-modal-body">
        <div class="lw-modal-image-container">
          <img id="lwModalImage" src="" alt="" class="lw-modal-image">
        </div>
        
        <div class="lw-modal-info">
          <div class="lw-modal-category" id="lwModalCategory"></div>
          <h2 class="lw-modal-title" id="lwModalTitle"></h2>
          <p class="lw-modal-description" id="lwModalDescription"></p>
          
          <div class="lw-modal-price" id="lwModalPrice"></div>
          
          <div class="lw-modal-features">
            <h4>Características:</h4>
            <ul id="lwModalFeatures"></ul>
          </div>
          
          <div class="lw-modal-actions">
            <button class="lw-btn lw-btn-primary" id="lwModalAddToCart">Añadir a Cotización</button>
            <a href="#" class="lw-btn lw-btn-whatsapp" id="lwModalWhatsApp" target="_blank" rel="noopener noreferrer">
              <svg viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
              Cotizar por WhatsApp
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal de Personalización -->
  <div class="lw-custom-modal" id="lwCustomModal">
    <div class="lw-custom-overlay" id="lwCustomOverlay"></div>
    <div class="lw-custom-content">
      <button class="lw-custom-close" id="lwCustomClose" aria-label="Cerrar modal">&times;</button>
      <h2 class="lw-modal-title" id="lwCustomTitle">Personalizar Producto</h2>
      <div class="lw-custom-canvas-container">
        <canvas id="lwCustomCanvas"></canvas>
      </div>
      <div class="lw-custom-tools">
        <label for="lwLogoUpload" class="lw-custom-upload lw-btn lw-btn-primary">Subir Logo</label>
        <input type="file" id="lwLogoUpload" accept="image/*" style="display: none;">
        <div class="lw-custom-size">
          <label class="lw-custom-size-label">Seleccionar Talla:</label>
          <div class="lw-custom-size-buttons" id="lwSizeButtons">
            <!-- Generados por JS -->
          </div>
        </div>
      </div>
      <div class="lw-custom-actions">
        <button class="lw-btn lw-btn-primary" id="lwCustomSave">Guardar y Añadir a Cotización</button>
        <button class="lw-btn" id="lwCustomCancel" style="background-color: #e0e0e0; color: #333;">Cancelar</button>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="lw-footer">
    <div class="lw-footer-content">
      <p class="lw-footer-text">© 2025 LogoWear. Todos los derechos reservados.</p>
    </div>
  </footer>

  <script>
    const lwProducts = [
      { 
        id: 1, 
        name: 'Camiseta Básica Personalizada', 
        category: 'camisetas', 
        price: 15.00, 
        priceFormatted: '$15.00', 
        description: 'Camiseta 100% algodón, ideal para logos en serigrafía o bordado.', 
        image: 'https://m.media-amazon.com/images/I/71YeO2k8cPL._AC_SX466_.jpg',
        features: ['100% algodón peinado', 'Cuello redondo reforzado', 'Disponible en 8 colores', 'Tallas S-3XL', 'Serigrafía o bordado'],
        sizes: ['S', 'M', 'L']
      },
      { 
        id: 2, 
        name: 'Polo Premium con Logo Bordado', 
        category: 'polos', 
        price: 28.00, 
        priceFormatted: '$28.00', 
        description: 'Polo piqué de alta calidad con logo bordado en el pecho.', 
        image: 'https://m.media-amazon.com/images/I/71c6SQsYxdL._AC_SX466_.jpg',
        features: ['Tela piqué 100% algodón', 'Bordado profesional', '3 botones nacarados', 'Tallas S-2XL', 'Antienvejecimiento'],
        sizes: ['S', 'M', 'L']
      },
      { 
        id: 3, 
        name: 'Gorra Trucker Personalizada', 
        category: 'gorras', 
        price: 18.00, 
        priceFormatted: '$18.00', 
        description: 'Gorra trucker con logo bordado o impreso en frente.', 
        image: 'https://m.media-amazon.com/images/I/91lmR4Rw8eL._AC_SX466_.jpg',
        features: ['Malla transpirable', 'Bordado 3D', 'Ajuste snapback', '6 paneles', 'Ideal para eventos'],
        sizes: ['S', 'M', 'L']
      },
      { 
        id: 4, 
        name: 'Sudadera con Capucha y Logo', 
        category: 'sudaderas', 
        price: 35.00, 
        priceFormatted: '$35.00', 
        description: 'Sudadera cálida con logo en serigrafía o bordado.', 
        image: 'https://m.media-amazon.com/images/I/71SBB7VJ4mL._AC_SX466_.jpg',
        features: ['50% algodón / 50% poliéster', 'Capucha con cordón', 'Bolsillo canguro', 'Puños y cintura reforzados', 'Tallas S-3XL'],
        sizes: ['S', 'M', 'L']
      },
      { 
        id: 5, 
        name: 'Camiseta Dry Fit Deportiva', 
        category: 'camisetas', 
        price: 22.00, 
        priceFormatted: '$22.00', 
        description: 'Tela transpirable, ideal para eventos deportivos.', 
        image: 'https://m.media-amazon.com/images/I/61Nj2950rYL._AC_SX466_.jpg',
        features: ['Tela Dry-Fit', 'Secado rápido', 'Protección UV', 'Costuras planas', 'Tallas S-2XL'],
        sizes: ['S', 'M', 'L']
      },
      { 
        id: 6, 
        name: 'Polo Manga Larga Corporativo', 
        category: 'polos', 
        price: 32.00, 
        priceFormatted: '$32.00', 
        description: 'Perfecto para uniformes empresariales con logo bordado.', 
        image: 'https://m.media-amazon.com/images/I/51WMGsCHjrL._AC_SX466_.jpg',
        features: ['Manga larga', 'Tela piqué premium', 'Bordado en pecho y manga', 'Antiolor', 'Tallas S-3XL'],
        sizes: ['S', 'M', 'L']
      }
    ];

    let lwCart = [];
    let lwCurrentCategory = 'todos';
    let lwSearchQuery = '';
    let lwCurrentProduct = null;
    let lwCurrentCustomProduct = null;
    let fabricCanvas = null;
    let selectedSize = null;

    const lwProductsGrid = document.getElementById('lwProductsGrid');
    const lwSearchInput = document.getElementById('lwSearchInput');
    const lwCategoryButtons = document.querySelectorAll('.lw-category-btn');
    const lwMenuToggle = document.getElementById('lwMenuToggle');
    const lwNavLinks = document.getElementById('lwNavLinks');
    const lwCartButton = document.getElementById('lwCartButton');
    const lwCartPanel = document.getElementById('lwCartPanel');
    const lwCartOverlay = document.getElementById('lwCartOverlay');
    const lwCartClose = document.getElementById('lwCartClose');
    const lwCartBadge = document.getElementById('lwCartBadge');
    const lwCartItems = document.getElementById('lwCartItems');
    const lwCartFooter = document.getElementById('lwCartFooter');
    const lwCartTotal = document.getElementById('lwCartTotal');
    const lwCartCheckout = document.getElementById('lwCartCheckout');
    const WHATSAPP_NUMBER = '50433158947';

    // Modal Elements
    const lwProductModal = document.getElementById('lwProductModal');
    const lwModalOverlay = document.getElementById('lwModalOverlay');
    const lwModalClose = document.getElementById('lwModalClose');
    const lwModalAddToCart = document.getElementById('lwModalAddToCart');
    const lwModalWhatsApp = document.getElementById('lwModalWhatsApp');

    // Custom Modal Elements
    const lwCustomModal = document.getElementById('lwCustomModal');
    const lwCustomOverlay = document.getElementById('lwCustomOverlay');
    const lwCustomClose = document.getElementById('lwCustomClose');
    const lwCustomTitle = document.getElementById('lwCustomTitle');
    const lwCustomCanvas = document.getElementById('lwCustomCanvas');
    const lwLogoUpload = document.getElementById('lwLogoUpload');
    const lwSizeButtons = document.getElementById('lwSizeButtons');
    const lwCustomSave = document.getElementById('lwCustomSave');
    const lwCustomCancel = document.getElementById('lwCustomCancel');

    function lwGenerateWhatsAppMessage(product) {
      const message = `Hola! Quiero cotizar:%0A%0A` +
        `Prenda: *${product.name}*%0A` +
        `Categoría: ${product.category}%0A` +
        `Precio base: ${product.priceFormatted}%0A%0A` +
        `${product.description}%0A%0A` +
        `¿Cuánto sería con mi logo?`;
      return `https://wa.me/${WHATSAPP_NUMBER}?text=${message}`;
    }

    function lwGenerateCartWhatsAppMessage() {
      let message = `Hola! Quiero cotizar los siguientes productos:%0A%0A`;
      lwCart.forEach((item, i) => {
        message += `${i + 1}. *${item.product.name}*%0A`;
        message += `   Categoría: ${item.product.category}%0A`;
        message += `   Precio base: ${item.product.priceFormatted}%0A`;
        if (item.custom) {
          message += `   Talla: ${item.custom.size}%0A`;
          message += `   Imagen personalizada: ${item.custom.imageLink}%0A`;
        }
        message += `%0A`;
      });
      const total = lwCart.reduce((sum, item) => sum + item.product.price, 0);
      message += `━━━━━━━━━━━━━━━━%0A`;
      message += `Total base: *$${total.toFixed(2)}*%0A%0A`;
      message += `¿Cuánto sería con mi logo y cantidades?`;
      return `https://wa.me/${WHATSAPP_NUMBER}?text=${message}`;
    }

    function lwAddToCart(productId, custom = null) {
      const product = lwProducts.find(p => p.id === productId);
      if (product) {
        lwCart.push({product, custom});
        lwUpdateCart();
      }
    }

    function lwRemoveFromCart(index) {
      lwCart.splice(index, 1);
      lwUpdateCart();
    }

    function lwUpdateCart() {
      lwCartBadge.textContent = lwCart.length;
      if (lwCart.length === 0) {
        lwCartItems.innerHTML = '<div class="lw-cart-empty">Tu cotización está vacía</div>';
        lwCartFooter.style.display = 'none';
      } else {
        lwCartItems.innerHTML = lwCart.map((item, index) => `
          <div class="lw-cart-item">
            <img src="${item.custom ? item.custom.imageLink : item.product.image}" alt="${item.product.name}" class="lw-cart-item-image">
            <div class="lw-cart-item-info">
              <div class="lw-cart-item-name">${item.product.name}${item.custom ? ' (Personalizada)' : ''}</div>
              <div class="lw-cart-item-category">${item.product.category}</div>
              <div class="lw-cart-item-price">${item.product.priceFormatted}</div>
              ${item.custom ? `<div class="lw-cart-item-custom">Talla: ${item.custom.size}</div>` : ''}
            </div>
            <button class="lw-cart-item-remove" onclick="lwRemoveFromCart(${index})" aria-label="Eliminar">×</button>
          </div>
        `).join('');
        const total = lwCart.reduce((sum, item) => sum + item.product.price, 0);
        lwCartTotal.textContent = `$${total.toFixed(2)}`;
        lwCartFooter.style.display = 'block';
      }
    }

    function lwToggleCart() {
      lwCartPanel.classList.toggle('lw-active');
      lwCartOverlay.classList.toggle('lw-active');
      document.body.style.overflow = lwCartPanel.classList.contains('lw-active') ? 'hidden' : '';
    }

    // Modal Functions
    function lwOpenProductModal(productId) {
      const product = lwProducts.find(p => p.id === productId);
      if (!product) return;

      lwCurrentProduct = product;

      document.getElementById('lwModalImage').src = product.image;
      document.getElementById('lwModalTitle').textContent = product.name;
      document.getElementById('lwModalCategory').textContent = product.category;
      document.getElementById('lwModalDescription').textContent = product.description;
      document.getElementById('lwModalPrice').textContent = product.priceFormatted;

      const featuresList = document.getElementById('lwModalFeatures');
      featuresList.innerHTML = product.features.map(f => `<li>${f}</li>`).join('');

      lwModalWhatsApp.href = lwGenerateWhatsAppMessage(product);
      lwModalAddToCart.onclick = () => {
        lwAddToCart(product.id);
        lwCloseProductModal();
      };

      lwProductModal.classList.add('lw-active');
      document.body.style.overflow = 'hidden';
    }

    function lwCloseProductModal() {
      lwProductModal.classList.remove('lw-active');
      document.body.style.overflow = '';
      lwCurrentProduct = null;
    }

    // Custom Modal Functions
    function lwOpenCustomModal(productId) {
      const product = lwProducts.find(p => p.id === productId);
      if (!product) return;

      lwCurrentCustomProduct = product;
      lwCustomTitle.textContent = `Personalizar ${product.name}`;
      selectedSize = product.sizes[0]; // Default

      // Render size buttons
      lwSizeButtons.innerHTML = product.sizes.map(size => `
        <button class="lw-custom-size-btn ${size === selectedSize ? 'active' : ''}" onclick="lwSelectSize('${size}')">${size}</button>
      `).join('');

      // Init Fabric.js
      fabricCanvas = new fabric.Canvas('lwCustomCanvas', {
        width: 400,
        height: 400
      });

      // Load background
      fabric.Image.fromURL(product.image, function(img) {
        const scale = Math.min(fabricCanvas.width / img.width, fabricCanvas.height / img.height);
        img.set({ scaleX: scale, scaleY: scale, selectable: false });
        fabricCanvas.setBackgroundImage(img, fabricCanvas.renderAll.bind(fabricCanvas));
      });

      // Upload logo
      lwLogoUpload.value = '';
      lwLogoUpload.onchange = function(e) {
        const reader = new FileReader();
        reader.onload = function(event) {
          fabric.Image.fromURL(event.target.result, function(oImg) {
            oImg.set({ left: 100, top: 100, scaleX: 0.5, scaleY: 0.5 });
            fabricCanvas.add(oImg);
            fabricCanvas.setActiveObject(oImg);
            fabricCanvas.renderAll();
          });
        };
        if (e.target.files[0]) reader.readAsDataURL(e.target.files[0]);
      };

      lwCustomModal.classList.add('lw-active');
      document.body.style.overflow = 'hidden';
    }

    function lwSelectSize(size) {
      selectedSize = size;
      const buttons = lwSizeButtons.querySelectorAll('.lw-custom-size-btn');
      buttons.forEach(btn => {
        btn.classList.toggle('active', btn.textContent === size);
      });
    }

    async function lwSaveCustom() {
      if (!lwCurrentCustomProduct) return;

      const dataURL = fabricCanvas.toDataURL({ format: 'png', quality: 1 });

      try {
        const response = await fetch(dataURL);
        const blob = await response.blob();

        const formData = new FormData();
        formData.append('file', blob, 'custom.png');

        const uploadRes = await fetch('https://file.io', {
          method: 'POST',
          body: formData
        });

        const json = await uploadRes.json();
        if (json.success) {
          const imageLink = json.link;
          lwAddToCart(lwCurrentCustomProduct.id, { size: selectedSize, imageLink });
          lwCloseCustomModal();
        } else {
          alert('Error al subir la imagen. Intenta de nuevo.');
        }
      } catch (error) {
        console.error(error);
        alert('Error al procesar la imagen.');
      }
    }

    function lwCloseCustomModal() {
      lwCustomModal.classList.remove('lw-active');
      document.body.style.overflow = '';
      if (fabricCanvas) {
        fabricCanvas.dispose();
        fabricCanvas = null;
      }
      lwCurrentCustomProduct = null;
      selectedSize = null;
    }

    function lwRenderProducts() {
      const filtered = lwProducts.filter(p => {
        const matchCat = lwCurrentCategory === 'todos' || p.category === lwCurrentCategory;
        const matchSearch = p.name.toLowerCase().includes(lwSearchQuery.toLowerCase()) || p.description.toLowerCase().includes(lwSearchQuery.toLowerCase());
        return matchCat && matchSearch;
      });

      lwProductsGrid.innerHTML = filtered.length === 0
        ? '<div class="lw-no-results">No se encontraron productos</div>'
        : filtered.map(p => `
          <div class="lw-product-card" onclick="lwOpenProductModal(${p.id})">
            <img src="${p.image}" alt="${p.name}" class="lw-product-image">
            <div class="lw-product-info">
              <div class="lw-product-category">${p.category}</div>
              <h3 class="lw-product-name">${p.name}</h3>
              <p class="lw-product-description">${p.description}</p>
              <div class="lw-product-price">${p.priceFormatted}</div>
              <div class="lw-product-actions">
                <button class="lw-btn lw-btn-primary" onclick="event.stopPropagation(); lwAddToCart(${p.id})">Añadir a Cotización</button>
                ${p.category === 'camisetas' ? `<button class="lw-btn lw-btn-custom" onclick="event.stopPropagation(); lwOpenCustomModal(${p.id})">Personalizar</button>` : ''}
                <a href="${lwGenerateWhatsAppMessage(p)}" class="lw-btn lw-btn-whatsapp" target="_blank" rel="noopener noreferrer" onclick="event.stopPropagation();">
                  <svg viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                  Cotizar Ahora
                </a>
              </div>
            </div>
          </div>
        `).join('');
    }

    // Eventos
    lwCategoryButtons.forEach(btn => {
      btn.addEventListener('click', () => {
        lwCategoryButtons.forEach(b => b.classList.remove('lw-active'));
        btn.classList.add('lw-active');
        lwCurrentCategory = btn.dataset.category;
        lwRenderProducts();
      });
    });

    lwSearchInput.addEventListener('input', e => {
      lwSearchQuery = e.target.value;
      lwRenderProducts();
    });

    lwMenuToggle.addEventListener('click', () => {
      lwMenuToggle.classList.toggle('lw-active');
      lwNavLinks.classList.toggle('lw-active');
    });

    lwCartButton.addEventListener('click', lwToggleCart);
    lwCartClose.addEventListener('click', lwToggleCart);
    lwCartOverlay.addEventListener('click', lwToggleCart);
    lwCartCheckout.addEventListener('click', () => {
      if (lwCart.length > 0) {
        window.open(lwGenerateCartWhatsAppMessage(), '_blank');
      }
    });

    // Modal Events
    lwModalOverlay.addEventListener('click', lwCloseProductModal);
    lwModalClose.addEventListener('click', lwCloseProductModal);

    // Custom Modal Events
    lwCustomOverlay.addEventListener('click', lwCloseCustomModal);
    lwCustomClose.addEventListener('click', lwCloseCustomModal);
    lwCustomCancel.addEventListener('click', lwCloseCustomModal);
    lwCustomSave.addEventListener('click', lwSaveCustom);

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({ behavior: 'smooth' });
      });
    });

    window.lwSelectSize = lwSelectSize; // Make global for onclick

    // Init
    lwRenderProducts();
    lwUpdateCart();
  </script>
</body>
</html>