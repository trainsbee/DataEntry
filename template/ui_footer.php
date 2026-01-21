<script>
      function logout() {
            localStorage.removeItem('currentUser');
            window.location.href = 'signin.php';
            }
      feather.replace();
</script>