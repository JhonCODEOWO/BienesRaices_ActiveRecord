document.addEventListener("DOMContentLoaded", function(){
    eventListeners();
    darkMode();
    addClassFooter();
});

function eventListeners(){
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', navegacionResponsive);
}

function darkMode(){
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    //console.log(prefiereDarkMode.matches);
    //Si recibimos un valor true agregamos la clase darkmode de maner automática
    if (prefiereDarkMode.matches) {
        document.body.classList.add('darkmode');
    } else {
        document.body.classList.remove('darkmode');
    };
    
    //El evento escucha por un cambio en las preferencias de usuario
    prefiereDarkMode.addEventListener('change', function(){
        if (prefiereDarkMode.matches) {
            document.body.classList.add('darkmode');
        } else {
            document.body.classList.remove('darkmode');
        }
    });

    const btnDarkMode = document.querySelector('.dark-mode-boton');
    btnDarkMode.addEventListener('click', function(){
        document.body.classList.toggle('darkmode');
    });
}

function navegacionResponsive(){
    const navegacion = document.querySelector('.navegacion');
    if(navegacion.classList.contains('mostrar')) {
        navegacion.classList.remove('mostrar');
    } else {
        navegacion.classList.add('mostrar');
    }

    //O podemos usar toggle que realiza lo mismo, si la clase está opresente la quita y si no, la pone

}

//Evento que escucha el tamaño de la vista del navegador..
window.addEventListener('resize', function(){
    if (verificarViewPort() >= 768) {
        const navegacion = document.querySelector('.navegacion');
        navegacion.classList.remove('mostrar');
    }
});

//Función que retorna el tamaño del viewport del dispositivo
function verificarViewPort() {
    let ancho = window.innerWidth || document.documentElement.clientWidth;
    return ancho;
}

function addClassFooter(){
    const navFooter = document.querySelectorAll('.navegacion');
    navFooter[1].classList.add('navegacion-footer');
}
