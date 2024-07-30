
function handleSignUp(event) {
    event.preventDefault();

    const email = document.getElementById('email').value;
    const username = document.getElementById('username').value;
    const usertype = document.getElementById('usertype').value;
    const password = document.getElementById('passwd').value;
    const rePassword = document.getElementById('re_passwd').value;

    const Data = {
      email: email,
      username: username,
      usertype: usertype,
      passwd1: password,
      passwd2: rePassword
    };

    fetch('./actions/register_user_action.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(Data)
    })
    .then(response => response.json())
    .then(response => {
      if (response.status === 1) {
        window.location.href = response.redirect;
        console.log(response.message);
      } else {
        alert('Sign Up failed: ' + response.message);
      }
    })
    .catch(err => console.log('Error:', err));
}
