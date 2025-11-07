<div class="signin">
    <form onsubmit="handleLogin(event)">
        <input type="text" id="username" placeholder="Usuario">
        <input type="password" id="password" placeholder="Password">
        <button type="submit">Iniciar Sesión</button>
    </form>
</div>
<script>
    const UR_API = 'http://localhost/DataEntry/api/';
  // Check if user is already logged in
  document.addEventListener('DOMContentLoaded', () => {
    const user = localStorage.getItem('currentUser');
    if (user) {
      window.location.href = 'dashboard.php';
    }
  });

  async function handleLogin(event) {
    event.preventDefault();
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const errorMessage = document.getElementById('error-message');

    try {
      const response = await fetch(UR_API + 'auth.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ username, password })
      });

      const data = await response.json();
      
      if (data.success) {
        // Store user data in localStorage
        localStorage.setItem('currentUser', JSON.stringify(data.user));
       
        alert('Inicio de sesión exitoso');
        setTimeout(() => {
          window.location.href = 'dashboard.php';
        }, 4000);
      } else {
        alert(data.message);

      }
    } catch (error) {
      alert('Error al conectar con el servidor');
    }
  }
</script>