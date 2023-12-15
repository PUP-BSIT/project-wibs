async function register() {
    const regUsername = document.querySelector('#reg_username').value;
    const regPassword = document.querySelector('#reg_password').value;

    try {
        const response = await fetch('http://wibs.tech/register.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `username=${regUsername}&password=${regPassword}`,
        });

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const data = await response.json();
        const errorMessage = document.querySelector('#error-message');
        errorMessage.innerText = data.message;
        errorMessage.className = data.success ? 'success' : 'error';
    } catch (error) {
        console.error('Fetch error: ', error);
    }
}
