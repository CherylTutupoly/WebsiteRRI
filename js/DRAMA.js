const sliderTrack = document.querySelector('.slider-track');
const sliderItems = document.querySelectorAll('.slider-item');
const itemWidth = sliderItems[0].offsetWidth + 15; // Slide width + gap
let currentPosition = 0; // Track current position

// Function to move the slider left or right
function moveSlide(direction) {
    currentPosition += direction * itemWidth;

    // Limit the movement to avoid empty spaces
    const maxPosition = -(sliderItems.length - 3) * itemWidth; // Assuming 3 slides visible
    if (currentPosition > 0) currentPosition = 0;
    if (currentPosition < maxPosition) currentPosition = maxPosition;

    sliderTrack.style.transform = `translateX(${currentPosition}px)`; // Move the track
}

// Adds hover effect to individual slides
sliderItems.forEach(item => {
    item.addEventListener('mouseenter', () => {
        item.style.transform = 'scale(1.1)';
        item.style.zIndex = 10;
    });
    item.addEventListener('mouseleave', () => {
        item.style.transform = 'scale(1)';
        item.style.zIndex = 1;
    });
});