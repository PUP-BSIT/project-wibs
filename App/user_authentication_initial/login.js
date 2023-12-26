async function login() {
    const username = document.querySelector('#username').value;
    const password = document.querySelector('#password').value;

    try {
        const response = await fetch('http://wibs.tech/login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `username=${username}&password=${password}`,
        });

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const data = await response.json();
        const errorMessage = document.querySelector('#error-message');
        errorMessage.innerText = data.message;
        errorMessage.className = data.success ? 'success' : 'error';

        if (data.success) {
            // Redirect to dashboard or some other page on successful login
            window.location.href = 'dashboard.php';
        }
    } catch (error) {
        console.error('Fetch error: ', error);
    }
}
