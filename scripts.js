let indice = 0;

function mover(paso) {
    const slides = document.querySelectorAll('.carousel img');
    if (slides.length === 0) return;
    slides[indice].classList.remove('active');
    indice = (indice + paso + slides.length) % slides.length;
    slides[indice].classList.add('active');
}

function eliminarActiva() {
    const slides = document.querySelectorAll('.carousel img');
    if (slides.length === 0) return;
    const imagenActiva = slides[indice];
    const src = imagenActiva.getAttribute('data-src');
    const input = document.getElementById('archivoInput');
    input.value = src;
    document.getElementById('deleteForm').submit();
}

setInterval(() => mover(1), 5000);