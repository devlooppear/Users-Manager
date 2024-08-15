<!-- resources/views/common/navbar.blade.php -->
<nav class="navbar navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Users Manager</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Menu</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <!-- Home Link -->
          <li class="nav-item">
            <a class="nav-link" href="/">Home</a>
          </li>
          <!-- Logout Link -->
          <li class="nav-item">
            <a class="nav-link" href="/login" id="logout-link">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const logoutLink = document.getElementById('logout-link');

    if (logoutLink) {
      logoutLink.addEventListener('click', function (event) {
        event.preventDefault(); 
        
        const authToken = localStorage.getItem('authToken');

        if (!authToken) {
          console.error('No auth token found');
          return;
        }

        fetch(`${window.location.origin}/api/logout`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${authToken}` 
          },
          credentials: 'include' 
        })
        .then(response => {
          if (response.ok) {
            localStorage.removeItem('authToken');
            window.location.href = '/login';
          } else {
            console.error('Logout failed');
          }
        })
        .catch(error => {
          console.error('Error:', error);
        });
      });
    }
  });
</script>
