// Get DOM elements
const nextDom = document.getElementById('next');
const prevDom = document.getElementById('prev');
const carouselDom = document.querySelector('.carousel');
const sliderDom = carouselDom.querySelector('.list');
const thumbnailItems = document.querySelectorAll('.md\\:w-1\\/4 .item');

let currentIndex = 0;
const slides = document.querySelectorAll('.carousel .list .item');
const timeAutoNext = 7000;

// Function to show specific slide
function showSlide(index) {
    // Hide all slides
    slides.forEach(slide => {
        slide.style.display = 'none';
    });
    
    // Show the selected slide
    if (slides[index]) {
        slides[index].style.display = 'block';
    }
    
    currentIndex = index;
}

// Next button click handler
nextDom.onclick = function() {
    currentIndex = (currentIndex + 1) % slides.length;
    showSlide(currentIndex);
};

// Previous button click handler
prevDom.onclick = function() {
    currentIndex = (currentIndex - 1 + slides.length) % slides.length;
    showSlide(currentIndex);
};

// Thumbnail click handlers
thumbnailItems.forEach((thumbnail, index) => {
    thumbnail.addEventListener('click', () => {
        showSlide(index);
    });
});

// Auto-advance carousel
setInterval(() => {
    nextDom.click();
}, timeAutoNext);

// Show first slide initially
showSlide(0);