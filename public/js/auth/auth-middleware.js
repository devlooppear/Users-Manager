function checkAuthToken() {
    const authToken = localStorage.getItem('authToken');
    const currentPath = window.location.pathname;

    if (currentPath === '/login') {
      return;
    }

    if (!authToken || authToken.length === 0 || authToken.length < 20) {
      window.location.href = '/login';
      return;
    }
  }

  checkAuthToken();