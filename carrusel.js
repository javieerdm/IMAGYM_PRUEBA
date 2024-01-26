let slides = document.getElementsByClassName("slide");
let currentIndex = 0;
let nextIndex = 1;
let interval;

// Función para cambiar el slide
function changeSlide(next) {
    slides[currentIndex].classList.remove("active");
    slides[currentIndex].classList.add("out");

    currentIndex = next ? (currentIndex + 1) % slides.length : (currentIndex - 1 + slides.length) % slides.length;
    nextIndex = (currentIndex + 1) % slides.length;

    slides[currentIndex].classList.add("active");

    setTimeout(() => {
        slides[currentIndex].classList.remove("out");
    }, 500);
}

// Inicializa el primer slide
slides[currentIndex].classList.add("active");

// Inicia el carrusel automático
function startInterval() {
    interval = setInterval(() => changeSlide(true), 5000);
}
startInterval();

// Event listeners para los botones
document.getElementById("prevButton").addEventListener("click", () => {
    changeSlide(false);
    clearInterval(interval);
    startInterval();
});

document.getElementById("nextButton").addEventListener("click", () => {
    changeSlide(true);
    clearInterval(interval);
    startInterval();
});

