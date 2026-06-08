const html = document.querySelector('html');
function alterarTema() {
    const btnModo = document.querySelector('#btnModo')
    html.classList.toggle('dark-mode');
    if(html.classList.contains('dark-mode')) {
        btnModo.textContent = 'Modo Claro';
        localStorage.setItem('modo', 'escuro');
    } else {
        btnModo.textContent = 'Modo Escuro';
        localStorage.setItem('modo', 'claro');
    }
}

if(localStorage.getItem('modo') === 'escuro') {
    let btn = document.querySelector('#btnModo');
    html.classList.add('dark-mode');
    if(btn){
        btn.textContent = 'Modo Claro';
}}