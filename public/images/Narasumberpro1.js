let currentIndex = 0;

function navigate(direction) {
  const slides = document.querySelectorAll('.narsum-slide');
  const totalSlides = slides.length;

  currentIndex = (currentIndex + direction + totalSlides) % totalSlides;

  slides.forEach((slide, index) => {
    slide.style.display = index === currentIndex ? 'block' : 'none';
  });

  updateIndicators();
}

function jumpTo(index) {
  currentIndex = index;
  navigate(0); // Memperbarui tampilan tanpa menggeser
}

function updateIndicators() {
  const indicators = document.querySelectorAll('.narsum-indicator');
  indicators.forEach((indicator, index) => {
    indicator.classList.toggle('active', index === currentIndex);
  });
}

// Inisialisasi
document.addEventListener('DOMContentLoaded', () => {
  const slides = document.querySelectorAll('.narsum-slide');
  slides.forEach((slide, index) => {
    slide.style.display = index === currentIndex ? 'block' : 'none';
  });

  updateIndicators();
});
