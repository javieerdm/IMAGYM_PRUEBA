document.addEventListener("DOMContentLoaded", function() {
    var slides = document.querySelectorAll("#carousel .slide");
    var captions = document.querySelectorAll("#carousel .slide-caption");
    var currentSlide = 0;
    var slideInterval;

    function startCarousel() {
        for (var i = 0; i < slides.length; i++) {
            slides[i].style.display = 'none';
            captions[i].style.display = 'none';
        }
        slides[currentSlide].style.display = 'block';
        captions[currentSlide].style.display = 'block';
        slideInterval = setInterval(nextSlide, 5000);
    }

    function nextSlide() {
        slides[currentSlide].style.display = 'none';
        captions[currentSlide].style.display = 'none';
        currentSlide = (currentSlide + 1) % slides.length;
        slides[currentSlide].style.display = 'block';
        captions[currentSlide].style.display = 'block';
    }

    document.getElementById('prevButton').addEventListener('click', function() {
        clearInterval(slideInterval);
        slides[currentSlide].style.display = 'none';
        captions[currentSlide].style.display = 'none';
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        slides[currentSlide].style.display = 'block';
        captions[currentSlide].style.display = 'block';
        startCarousel();
    });

    document.getElementById('nextButton').addEventListener('click', function() {
        clearInterval(slideInterval);
        nextSlide();
        startCarousel();
    });

    startCarousel();
});
