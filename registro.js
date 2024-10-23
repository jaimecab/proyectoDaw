document.querySelector('.layout__form').addEventListener('submit', function (event) {
    
    event.preventDefault();

    
    const name = document.querySelector('.form__name').value.trim();
    const email = document.querySelector('.form__mail').value.trim();
    const password = document.querySelector('.form__password').value.trim();
    const repeatPassword = document.querySelector('.form__repeat--password').value.trim();

    
    if (!name || !email || !password || !repeatPassword) {
        alert('Todos los campos son obligatorios.');
        return;
    }

    
    if (password !== repeatPassword) {
        alert('Las contraseñas no coinciden.');
        return;
    }

    
    this.submit();
});