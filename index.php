<?php
require('conn.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>G! Arat Na</title>
    <link rel="icon" type="image/x-icon" href="images/G!.png" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <style>
/* Hide scrollbar for Chrome, Safari and Opera */
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.scrollbar-hide {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
}
</style>

</head>

<body class="bg-gray-50">
    <!-- Gradient Background -->
    <div class="blob w-full h-full rounded-[999px] absolute top-0 right-0 -z-10 blur-3xl bg-opacity-60 bg-gradient-to-r from-indigo-200 via-purple-200 to-pink-200"></div>
    <div class="blob w-[1000px] h-[1000px] rounded-[999px] absolute bottom-0 left-0 -z-10 blur-3xl bg-opacity-60 bg-gradient-to-r from-red-200 via-gray-100 to-blue-100"></div>
    <div class="blob w-[600px] h-[600px] rounded-[999px] absolute bottom-0 left-0 -z-10 blur-3xl bg-opacity-60 bg-gradient-to-r from-slate-100 via-teal-100 to-blue-100"></div>
    <div class="blob w-[300px] h-[300px] rounded-[999px] absolute bottom-[10px] left-0 -z-10 blur-3xl bg-opacity-60 bg-gradient-to-r from-green-200 via-cyan-200 to-Fuchsia-300"></div>

   <!-- Header -->
   <header class="fixed top-0 w-full bg-white/80 backdrop-blur-md shadow-sm z-50">
    <div class="blob w-full h-full rounded-[999px] absolute top-0 right-0 -z-10 blur-3xl bg-opacity-60 bg-gradient-to-r from-indigo-200 via-purple-200 to-pink-200"></div>
    <div class="blob w-[1000px] h-[1000px] rounded-[999px] absolute bottom-0 left-0 -z-10 blur-3xl bg-opacity-60 bg-gradient-to-r from-red-200 via-gray-100 to-blue-100"></div>
    <div class="blob w-[600px] h-[600px] rounded-[999px] absolute bottom-0 left-0 -z-10 blur-3xl bg-opacity-60 bg-gradient-to-r from-slate-100 via-teal-100 to-blue-100"></div>
    <div class="blob w-[300px] h-[300px] rounded-[999px] absolute bottom-[10px] left-0 -z-10 blur-3xl bg-opacity-60 bg-gradient-to-r from-green-200 via-cyan-200 to-Fuchsia-300"></div>

        <nav class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="index.php" class="flex items-center space-x-4">
                    <img src="images/G!.png" class="w-10 h-auto" alt="G! Arat Na" />G! Arat Na
                </a>
                
                <!-- Mobile menu button -->
                <button id="mobile-menu-button" class="md:hidden p-2 rounded-lg hover:bg-gray-100">
                    <i class="fas fa-bars text-gray-600 text-xl"></i>
                </button>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="index.php" class="text-gray-800 hover:text-blue-600 font-bold transition-colors">Home</a>
                    <a href="events.php" class="text-gray-800 hover:text-blue-600 font-medium transition-colors">Events</a>
                    <a href="events.php" class="text-gray-800 hover:text-blue-600 font-medium transition-colors">About</a>
                    <?php
                    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                        echo '<a href="logout.php" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">Logout</a>';
                    } else {
                        echo '<a href="login.php" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">Login</a>';
                    }
                    ?>
                </div>
            </div>

            <!-- Mobile Navigation -->
            <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4">
                <div class="flex flex-col space-y-4">
                    <a href="index.php" class="text-gray-800 hover:text-blue-600 font-medium transition-colors">Home</a>
                    <a href="events.php" class="text-gray-800 hover:text-blue-600 font-medium transition-colors">Events</a>
                    <a href="userAbout.php" class="text-gray-800 hover:text-blue-600 font-medium transition-colors">About</a>
                    <?php
                    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                        echo '<a href="logout.php" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors text-center">Logout</a>';
                    } else {
                        echo '<a href="login.php" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors text-center">Login</a>';
                    }
                    ?>
                </div>
            </div>
        </nav>
    </header>


    <!-- Main Content -->
    <main class="pt-28 pb-6">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="flex flex-col lg:flex-row gap-8 lg:gap-20">
                <!-- Left Column - Main Carousel -->
                <div class="lg:w-3/4">
                    <div class="carousel relative">
                        <div class="list overflow-hidden rounded-2xl shadow-xl">
                            <?php
                            $sql = "SELECT * FROM events ORDER BY `event-id` DESC";
                            $query = mysqli_query($conn, $sql);
                            $events = mysqli_fetch_all($query, MYSQLI_ASSOC);
                            $totalEvents = count($events);

                            foreach ($events as $index => $event) {
                                $imagePath = 'uploads/' . ($event['image'] ? $event['image'] : 'default-event.jpg');
                                ?>
                                <div class="item relative <?= $index === 0 ? '' : 'hidden'; ?>" data-index="<?= $index ?>">
                                    <img src="<?= htmlspecialchars($imagePath); ?>" 
                                         alt="<?= htmlspecialchars($event['title']); ?>" 
                                         class="w-full h-[400px] lg:h-[550px] object-cover" />
                                    <div class="content absolute inset-0 bg-gradient-to-t from-black/80 to-transparent flex items-end">
                                        <div class="p-4 lg:p-8 text-white max-w-2xl">
                                            <div class="text-blue-400 font-medium mb-2"><?= htmlspecialchars($event['author']); ?></div>
                                            <h2 class="text-2xl lg:text-4xl font-bold mb-2 lg:mb-2 line-clamp-2"><?= htmlspecialchars($event['title']); ?></h2>
                                            <p class="text-sm lg:text-lg mb-4 lg:mb-4 line-clamp-2 mr-12"><?= htmlspecialchars($event['description']); ?></p>
                                            <button onclick="location.href='regform.php?event_id=<?= $event['event-id']; ?>'" 
                                                    class="px-4 py-2 lg:px-6 lg:py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                                                Register Now
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                        <!-- Navigation Arrows -->
                        <button id="prev" class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-white/80 p-2 lg:p-3 rounded-full shadow-lg hover:bg-white transition-colors">
                            <i class="fas fa-chevron-left text-gray-800"></i>
                        </button>
                        <button id="next" class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-white/80 p-2 lg:p-3 rounded-full shadow-lg hover:bg-white transition-colors">
                            <i class="fas fa-chevron-right text-gray-800"></i>
                        </button>
                    </div>
                </div>


<!-- Right Column - Thumbnails -->
<div class="lg:w-1/4">
    <div class="sticky top-24">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Event Preview</h3>
            <div class="flex space-x-2">
                <button id="prev-thumb" class="bg-white/80 p-2 rounded-full shadow-lg hover:bg-white transition-colors">
                    <i class="fas fa-chevron-up text-gray-800"></i>
                </button>
                <button id="next-thumb" class="bg-white/80 p-2 rounded-full shadow-lg hover:bg-white transition-colors">
                    <i class="fas fa-chevron-down text-gray-800"></i>
                </button>
            </div>
        </div>
        <div class="relative overflow-hidden h-[480px] scrollbar-hide">
            <div class="thumbnails-container flex flex-col transition-transform duration-500">
                <?php 
                // Create three sets of thumbnails for truly continuous scrolling
                for ($set = 0; $set < 3; $set++) {
                    foreach ($events as $index => $event) {
                        $thumbnailPath = 'uploads/' . ($event['image'] ? $event['image'] : 'default-event.jpg');
                    ?>
                    <div class="thumbnail-item cursor-pointer transform hover:scale-105 transition-all duration-300 mb-4"
                        data-index="<?= $index ?>">
                        <img src="<?= htmlspecialchars($thumbnailPath); ?>" 
                            alt="<?= htmlspecialchars($event['title']); ?>" 
                            class="w-full h-32 object-cover rounded-lg border-2 border-gray-300" />
                        <p class="mt-1 text-sm font-medium truncate px-2"><?= htmlspecialchars($event['title']); ?></p>
                    </div>
                    <?php 
                    }
                } 
                ?>
            </div>
        </div>
    </div>
</div>
            </div>
        </div>
    </main>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    const carouselList = document.querySelector('.carousel .list');
    const items = document.querySelectorAll('.carousel .list .item');
    const thumbnails = document.querySelectorAll('.thumbnail-item');
    const prevButton = document.getElementById('prev');
    const nextButton = document.getElementById('next');
    const prevThumbButton = document.getElementById('prev-thumb');
    const nextThumbButton = document.getElementById('next-thumb');
    const thumbnailsContainer = document.querySelector('.thumbnails-container');

    let currentIndex = 0;
    const totalItems = items.length;
    const thumbnailHeight = 144; // Height of thumbnail + margin
    const singleSetHeight = thumbnailHeight * totalItems;
    
    // Start in the middle set
    let thumbnailScrollPosition = singleSetHeight;
    thumbnailsContainer.style.transform = `translateY(-${thumbnailScrollPosition}px)`;

    // Initialize the first thumbnail highlight
    updateHighlights(0);

    function updateHighlights(index) {
        // Remove highlight from all thumbnails first
        thumbnails.forEach(thumb => {
            const img = thumb.querySelector('img');
            img.classList.remove('border-blue-500');
            img.classList.add('border-gray-300');
        });

        // Add highlight to corresponding thumbnails in all sets
        thumbnails.forEach((thumb, thumbIndex) => {
            if (thumbIndex % totalItems === index) {
                const img = thumb.querySelector('img');
                img.classList.remove('border-gray-300');
                img.classList.add('border-blue-500');
            }
        });
    }

    function updateCarousel(newIndex, scroll = true) {
        currentIndex = newIndex;
        
        // Update main carousel
        items.forEach((item, index) => {
            item.classList.toggle('hidden', index !== currentIndex);
        });

        // Update highlights
        updateHighlights(currentIndex);

        if (scroll) {
            adjustScroll();
        }
    }

    function adjustScroll() {
        const middleSetStart = singleSetHeight;
        const targetScroll = middleSetStart + (currentIndex * thumbnailHeight);
        
        thumbnailsContainer.style.transition = 'transform 500ms ease';
        thumbnailScrollPosition = targetScroll;
        thumbnailsContainer.style.transform = `translateY(-${thumbnailScrollPosition}px)`;

        // Check boundaries and reset if needed
        setTimeout(() => {
            if (thumbnailScrollPosition >= singleSetHeight * 2 - thumbnailHeight) {
                thumbnailsContainer.style.transition = 'none';
                thumbnailScrollPosition -= singleSetHeight;
                thumbnailsContainer.style.transform = `translateY(-${thumbnailScrollPosition}px)`;
                thumbnailsContainer.offsetHeight;
                thumbnailsContainer.style.transition = 'transform 500ms ease';
            } else if (thumbnailScrollPosition <= thumbnailHeight) {
                thumbnailsContainer.style.transition = 'none';
                thumbnailScrollPosition += singleSetHeight;
                thumbnailsContainer.style.transform = `translateY(-${thumbnailScrollPosition}px)`;
                thumbnailsContainer.offsetHeight;
                thumbnailsContainer.style.transition = 'transform 500ms ease';
            }
        }, 500);
    }

    function smoothScroll(direction) {
        const newIndex = direction === 'up' 
            ? (currentIndex - 1 + totalItems) % totalItems 
            : (currentIndex + 1) % totalItems;
        
        updateCarousel(newIndex, true);
    }

    // Event listeners
    nextButton?.addEventListener('click', () => {
        stopAutoPlay();
        smoothScroll('down');
        startAutoPlay();
    });

    prevButton?.addEventListener('click', () => {
        stopAutoPlay();
        smoothScroll('up');
        startAutoPlay();
    });

    prevThumbButton?.addEventListener('click', () => smoothScroll('up'));
    nextThumbButton?.addEventListener('click', () => smoothScroll('down'));

    thumbnails.forEach((thumbnail, index) => {
        thumbnail.addEventListener('click', () => {
            const actualIndex = index % totalItems;
            stopAutoPlay();
            updateCarousel(actualIndex);
            startAutoPlay();
        });
    });

    // Auto-play
    let autoPlayInterval;

    function startAutoPlay() {
        if (totalItems <= 1) return;
        autoPlayInterval = setInterval(() => {
            smoothScroll('down');
        }, 5000);
    }

    function stopAutoPlay() {
        clearInterval(autoPlayInterval);
    }

    // Start auto-play
    startAutoPlay();

    // Pause on hover
    const carouselContainer = document.querySelector('.carousel');
    carouselContainer?.addEventListener('mouseenter', stopAutoPlay);
    carouselContainer?.addEventListener('mouseleave', startAutoPlay);

    thumbnailsContainer.addEventListener('mouseenter', stopAutoPlay);
    thumbnailsContainer.addEventListener('mouseleave', startAutoPlay);

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') {
            stopAutoPlay();
            smoothScroll('up');
            startAutoPlay();
        } else if (e.key === 'ArrowRight') {
            stopAutoPlay();
            smoothScroll('down');
            startAutoPlay();
        }
    });

    // Touch events
    let touchStartX = 0;
    let touchEndX = 0;

    carouselList?.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
        stopAutoPlay();
    });

    carouselList?.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        if (touchEndX < touchStartX - 50) {
            smoothScroll('down');
        } else if (touchEndX > touchStartX + 50) {
            smoothScroll('up');
        }
        startAutoPlay();
    });
});
</script>
</body>
</html>