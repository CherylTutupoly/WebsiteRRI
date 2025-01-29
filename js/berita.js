// Inisialisasi variabel untuk slide carousel
let currentSlide = 1;
const slides = document.querySelectorAll('.carousel-item');
const indicators = document.querySelectorAll('.carousel-indicators span');

// Fungsi untuk memperbarui slide
function updateCarousel() {
    slides.forEach((slide, index) => {
        slide.classList.remove('active');
        if (index === currentSlide) {
            slide.classList.add('active');
        }
    });
    indicators.forEach((indicator, index) => {
        indicator.style.backgroundColor = index === currentSlide ? '#000' : '#ccc';
    });
}

// Fungsi untuk ke slide berikutnya
function nextSlide() {
    currentSlide = (currentSlide + 1) % slides.length;
    updateCarousel();
}

// Fungsi untuk ke slide sebelumnya
function prevSlide() {
    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
    updateCarousel();
}

// Fungsi untuk mengatur slide langsung
function setSlide(index) {
    currentSlide = index;
    updateCarousel();
}