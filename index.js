document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Credenciales predefinidas
    const validUsername = "usuario";
    const validPassword = "1234";

    if (username === validUsername && password === validPassword) {
        // Redirigir al quiz si el login es exitoso
        window.location.href = "quiz.html";
    } else {
        // Mostrar mensaje de error
        document.getElementById('loginMessage').innerText = "Usuario o contraseña incorrectos.";
    }
});
