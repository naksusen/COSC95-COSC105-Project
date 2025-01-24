// Get DOM elements
const carouselList = document.querySelector('.carousel .list');
const items = document.querySelectorAll('.carousel .list .item');
const thumbnails = document.querySelectorAll('.md\\:w-1\\/4 .item');
const prevButton = document.getElementById('prev');
const nextButton = document.getElementById('next');

let currentIndex = 0;
const totalItems = items.length;

// Function to update carousel position
function updateCarousel() {
    if (totalItems === 0) return; // Guard against empty carousel
    
    items.forEach((item, index) => {
        if (index === currentIndex) {
            item.classList.remove('hidden');
        } else {
            item.classList.add('hidden');
        }
    });

    // Update thumbnail styling
    thumbnails.forEach((thumb, index) => {
        const thumbImg = thumb.querySelector('img');
        if (index === currentIndex) {
            thumbImg.classList.remove('border-gray-300', 'border-2');
            thumbImg.classList.add('border-blue-500', 'border-4');
        } else {
            thumbImg.classList.remove('border-blue-500', 'border-4');
            thumbImg.classList.add('border-gray-300', 'border-2');
        }
    });
}

// Next button click handler
nextButton?.addEventListener('click', () => {
    if (totalItems === 0) return;
    currentIndex = (currentIndex + 1) % totalItems;
    updateCarousel();
});

// Previous button click handler
prevButton?.addEventListener('click', () => {
    if (totalItems === 0) return;
    currentIndex = (currentIndex - 1 + totalItems) % totalItems;
    updateCarousel();
});

// Thumbnail click handlers
thumbnails.forEach((thumbnail, index) => {
    thumbnail.addEventListener('click', () => {
        currentIndex = index;
        updateCarousel();
    });
});

// Initialize carousel
updateCarousel();

// Auto-play functionality
let autoPlayInterval;

function startAutoPlay() {
    if (totalItems <= 1) return; // Don't auto-play if there's only one or no items
    
    autoPlayInterval = setInterval(() => {
        currentIndex = (currentIndex + 1) % totalItems;
        updateCarousel();
    }, 5000); // Change slide every 5 seconds
}

function stopAutoPlay() {
    clearInterval(autoPlayInterval);
}

// Start autoplay only if there are multiple items
if (totalItems > 1) {
    startAutoPlay();
    
    // Pause autoplay on hover
    carouselList?.addEventListener('mouseenter', stopAutoPlay);
    carouselList?.addEventListener('mouseleave', startAutoPlay);
}