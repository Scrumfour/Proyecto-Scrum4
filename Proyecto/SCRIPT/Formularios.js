function Iniciosesion() {
    document.getElementById('Form_registro').style.display = 'none';
    document.getElementById('Form_iniciosesion').style.display = 'block';
}

function Registro() {
    document.getElementById('Form_iniciosesion').style.display = 'none';
    document.getElementById('Form_registro').style.display = 'block';
    document.getElementById('Form_iniciosesion').reset();
}