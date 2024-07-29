function handleLogin(event) {
    event.preventDefault(); // Prevent the default form submission

    // Get the values of the email and password fields
    const email = document.getElementById('email').value;
    const password = document.getElementById('passwd').value;

    // Perform basic validation (could be more comprehensive)
    if (!email || !password) {
      alert('Please fill in both fields.');
      return;
    }

    var Data = {
        email: email,
        passwd: password
    };

    // Here you would typically send the credentials to the server using fetch or AJAX
    fetch('./actions/login_user_action.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(Data)
    })
    .then(response => response.json())
    .then((response) => {
      if (response.status == 1) {
        // Handle successful login
        // window.location.href = '/dashboard';
        console.log(response.message)
      } else {
        // Handle login error
        alert('Login failed: ' + response.message);
      }
    })
    .catch(err => console.log('Error:', err));
}