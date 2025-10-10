<?php
$careerCards = [
    [
        'bg' => 'bg-white border-2 border-dark text-dark',
        'icon' => 'fas fa-laptop-code',
        'iconBg' => 'bg-lime',
        'title' => 'Technology',
        'desc' => 'Perfect for analytical minds who love problem-solving and innovation.',
        'text' => 'text-gray-600',
        'roles' => [
            'Software Developer',
            'Data Scientist',
            'UX/UI Designer',
            'Cybersecurity Analyst'
        ]
    ],
    [
        'bg' => 'bg-dark text-white',
        'icon' => 'fas fa-heartbeat',
        'iconBg' => 'bg-lime',
        'title' => 'Healthcare',
        'desc' => 'Ideal for compassionate individuals who want to help others.',
        'text' => 'text-gray-300',
        'roles' => [
            'Medical Doctor',
            'Nurse Practitioner',
            'Physical Therapist',
            'Mental Health Counselor'
        ]
    ],
    [
        'bg' => 'bg-white border-2 border-dark text-dark',
        'icon' => 'fas fa-briefcase',
        'iconBg' => 'bg-lime',
        'title' => 'Business',
        'desc' => 'Great for strategic thinkers with leadership potential.',
        'text' => 'text-gray-600',
        'roles' => [
            'Marketing Manager',
            'Financial Analyst',
            'Business Consultant',
            'Entrepreneur'
        ]
    ],
    [
        'bg' => 'bg-dark text-white',
        'icon' => 'fas fa-palette',
        'iconBg' => 'bg-lime',
        'title' => 'Creative Arts',
        'desc' => 'Perfect for imaginative souls who express through creativity.',
        'text' => 'text-gray-300',
        'roles' => [
            'Graphic Designer',
            'Content Creator',
            'Art Director',
            'Photographer'
        ]
    ],
    [
        'bg' => 'bg-white border-2 border-dark text-dark',
        'icon' => 'fas fa-graduation-cap',
        'iconBg' => 'bg-lime',
        'title' => 'Education',
        'desc' => 'Ideal for patient mentors who love sharing knowledge.',
        'text' => 'text-gray-600',
        'roles' => [
            'Teacher',
            'Educational Consultant',
            'School Counselor',
            'Curriculum Developer'
        ]
    ],
    [
        'bg' => 'bg-dark text-white',
        'icon' => 'fas fa-flask',
        'iconBg' => 'bg-lime',
        'title' => 'Science & Research',
        'desc' => 'For curious minds driven by discovery and understanding.',
        'text' => 'text-gray-300',
        'roles' => [
            'Research Scientist',
            'Environmental Scientist',
            'Lab Technician',
            'Biotech Specialist'
        ]
    ]
];

function renderCareerCard($card) {
    ?>
    <div class="carousel-card flex-shrink-0 w-full md:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.5rem)] px-2">
        <div class="<?php echo $card['bg']; ?> rounded-3xl p-10 hover:shadow-xl transition-all duration-300 h-full min-h-[420px] flex flex-col">
            <div class="w-20 h-20 <?php echo $card['iconBg']; ?> rounded-2xl flex items-center justify-center mb-8">
                <i class="<?php echo $card['icon']; ?> text-dark text-3xl"></i>
            </div>
            <h3 class="text-3xl font-bold mb-4"><?php echo $card['title']; ?></h3>
            <p class="<?php echo $card['text']; ?> mb-6 text-base leading-relaxed"><?php echo $card['desc']; ?></p>
            <ul class="space-y-3 text-base <?php echo $card['text']; ?> mt-auto">
                <?php foreach ($card['roles'] as $role): ?>
                    <li class="flex items-start">
                        <span class="mr-2">•</span>
                        <span><?php echo $role; ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <?php
}
?>

<section id="careers" class="py-16 md:py-24 bg-white overflow-hidden">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4">
                <span class="bg-lime px-4 py-2 rounded-lg inline-block">Career Paths</span>
            </h2>
            <p class="text-lg text-gray-600 mt-6 max-w-2xl mx-auto">
                Explore diverse career fields matched to different personality types and interests.
            </p>
        </div>

        <div class="relative">
            <div class="flex items-center gap-4">
                <button id="prevBtn" class="md:hidden flex-shrink-0 bg-dark text-white w-12 h-12 rounded-full flex items-center justify-center shadow-lg hover:bg-lime hover:text-dark transition-all duration-300 z-10 hidden">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <div id="careerCarousel" class="flex-1 overflow-hidden cursor-grab active:cursor-grabbing md:cursor-grab">
                    <div id="careerTrack" class="flex transition-transform duration-500 ease-out gap-4">
                        <?php foreach ($careerCards as $card) {
                            renderCareerCard($card);
                        } ?>
                    </div>
                </div>

                <button id="nextBtn" class="md:hidden flex-shrink-0 bg-dark text-white w-12 h-12 rounded-full flex items-center justify-center shadow-lg hover:bg-lime hover:text-dark transition-all duration-300 z-10">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

            <div id="carouselIndicators" class="flex justify-center gap-2 mt-8">
                 Indicators will be generated by JavaScript 
            </div>
        </div>
    </div>
</section>

<style>
    .carousel-card {
        scroll-snap-align: start;
    }

    #careerCarousel.dragging {
        cursor: grabbing;
        user-select: none;
    }

    #careerCarousel.dragging * {
        pointer-events: none;
    }

    .indicator {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: #d1d5db;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .indicator.active {
        background-color: #84cc16;
        width: 32px;
        border-radius: 6px;
    }

    @media (min-width: 768px) {
        #prevBtn, #nextBtn {
            display: none;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.getElementById('careerCarousel');
    const track = document.getElementById('careerTrack');
    const cards = document.querySelectorAll('.carousel-card');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const indicatorsContainer = document.getElementById('carouselIndicators');
    
    let currentIndex = 0;
    let isDragging = false;
    let startPos = 0;
    let currentTranslate = 0;
    let prevTranslate = 0;
    let animationID = 0;
    
    let isScrolling = false;
    let scrollTimeout;
    let accumulatedDelta = 0;
    
    // Calculate cards per view based on screen size
    function getCardsPerView() {
        if (window.innerWidth >= 1024) return 3;
        if (window.innerWidth >= 768) return 2;
        return 1;
    }
    
    // Calculate total pages
    function getTotalPages() {
        return Math.ceil(cards.length / getCardsPerView());
    }
    
    function updateButtonVisibility() {
        const cardsPerView = getCardsPerView();
        const maxIndex = cards.length - cardsPerView;
        
        // Hide prev button if at the start
        if (currentIndex === 0) {
            prevBtn.classList.add('hidden');
        } else {
            prevBtn.classList.remove('hidden');
        }
        
        // Hide next button if at the end
        if (currentIndex >= maxIndex) {
            nextBtn.classList.add('hidden');
        } else {
            nextBtn.classList.remove('hidden');
        }
    }
    
    // Create indicators
    function createIndicators() {
        indicatorsContainer.innerHTML = '';
        const totalPages = getTotalPages();
        for (let i = 0; i < totalPages; i++) {
            const indicator = document.createElement('div');
            indicator.classList.add('indicator');
            if (i === 0) indicator.classList.add('active');
            indicator.addEventListener('click', () => goToSlide(i));
            indicatorsContainer.appendChild(indicator);
        }
    }
    
    // Update indicators
    function updateIndicators() {
        const indicators = document.querySelectorAll('.indicator');
        const currentPage = Math.floor(currentIndex / getCardsPerView());
        indicators.forEach((indicator, index) => {
            indicator.classList.toggle('active', index === currentPage);
        });
    }
    
    // Go to specific slide
    function goToSlide(index) {
        const cardsPerView = getCardsPerView();
        const maxIndex = cards.length - cardsPerView;
        currentIndex = Math.max(0, Math.min(index * cardsPerView, maxIndex));
        updateCarousel();
    }
    
    function updateCarousel() {
        // Update button visibility first
        updateButtonVisibility();
        
        // Use requestAnimationFrame to ensure DOM has settled after button visibility changes
        requestAnimationFrame(() => {
            // Get fresh measurements after layout changes
            const cardWidth = cards[0].offsetWidth;
            const gap = 16; // gap-4 = 1rem = 16px
            const offset = -(currentIndex * (cardWidth + gap));
            
            track.style.transform = `translateX(${offset}px)`;
            updateIndicators();
        });
    }
    
    prevBtn.addEventListener('click', () => {
        const cardsPerView = getCardsPerView();
        currentIndex = Math.max(0, currentIndex - cardsPerView);
        // Reset drag state
        currentTranslate = 0;
        prevTranslate = 0;
        updateCarousel();
    });
    
    nextBtn.addEventListener('click', () => {
        const cardsPerView = getCardsPerView();
        const maxIndex = cards.length - cardsPerView;
        currentIndex = Math.min(maxIndex, currentIndex + cardsPerView);
        // Reset drag state
        currentTranslate = 0;
        prevTranslate = 0;
        updateCarousel();
    });
    
    function handleWheel(event) {
        // Only enable on desktop/tablet (768px and above)
        if (window.innerWidth < 768) return;
        
        // Detect horizontal scroll (touchpad gesture)
        const deltaX = event.deltaX;
        const deltaY = event.deltaY;
        
        // Check if it's a horizontal scroll or if user is scrolling horizontally with shift key
        if (Math.abs(deltaX) > Math.abs(deltaY) || event.shiftKey) {
            event.preventDefault();
            
            // Accumulate scroll delta
            accumulatedDelta += (deltaX !== 0 ? deltaX : deltaY);
            
            // Clear existing timeout
            clearTimeout(scrollTimeout);
            
            // Set scrolling flag
            isScrolling = true;
            
            // Threshold for triggering navigation (adjust for sensitivity)
            const threshold = 100;
            
            if (Math.abs(accumulatedDelta) >= threshold) {
                const cardsPerView = getCardsPerView();
                const maxIndex = cards.length - cardsPerView;
                
                if (accumulatedDelta > 0 && currentIndex < maxIndex) {
                    // Scroll right - next card
                    currentIndex = Math.min(maxIndex, currentIndex + 1);
                    updateCarousel();
                } else if (accumulatedDelta < 0 && currentIndex > 0) {
                    // Scroll left - previous card
                    currentIndex = Math.max(0, currentIndex - 1);
                    updateCarousel();
                }
                
                // Reset accumulated delta after navigation
                accumulatedDelta = 0;
            }
            
            // Reset scrolling flag after a delay
            scrollTimeout = setTimeout(() => {
                isScrolling = false;
                accumulatedDelta = 0;
            }, 150);
        }
    }
    
    // Add wheel event listener for touchpad scrolling
    carousel.addEventListener('wheel', handleWheel, { passive: false });
    
    // Desktop drag functionality
    function touchStart(index) {
        return function(event) {
            if (window.innerWidth < 768) return; // Disable drag on mobile
            
            isDragging = true;
            startPos = getPositionX(event);
            animationID = requestAnimationFrame(animation);
            carousel.classList.add('dragging');
        }
    }
    
    function touchMove(event) {
        if (isDragging && window.innerWidth >= 768) {
            const currentPosition = getPositionX(event);
            currentTranslate = prevTranslate + currentPosition - startPos;
        }
    }
    
    function touchEnd() {
        if (!isDragging || window.innerWidth < 768) return;
        
        isDragging = false;
        cancelAnimationFrame(animationID);
        carousel.classList.remove('dragging');
        
        const movedBy = currentTranslate - prevTranslate;
        const cardWidth = cards[0].offsetWidth;
        const threshold = cardWidth / 4;
        
        if (movedBy < -threshold && currentIndex < cards.length - getCardsPerView()) {
            currentIndex += 1;
        }
        
        if (movedBy > threshold && currentIndex > 0) {
            currentIndex -= 1;
        }
        
        currentTranslate = 0;
        prevTranslate = 0;
        updateCarousel();
    }
    
    function getPositionX(event) {
        return event.type.includes('mouse') ? event.pageX : event.touches[0].clientX;
    }
    
    function animation() {
        if (isDragging) {
            const cardWidth = cards[0].offsetWidth;
            const gap = 16;
            const baseOffset = -(currentIndex * (cardWidth + gap));
            track.style.transform = `translateX(${baseOffset + currentTranslate}px)`;
            requestAnimationFrame(animation);
        }
    }
    
    // Add event listeners for drag
    carousel.addEventListener('mousedown', touchStart(0));
    carousel.addEventListener('touchstart', touchStart(0));
    carousel.addEventListener('mousemove', touchMove);
    carousel.addEventListener('touchmove', touchMove);
    carousel.addEventListener('mouseup', touchEnd);
    carousel.addEventListener('mouseleave', touchEnd);
    carousel.addEventListener('touchend', touchEnd);
    
    // Prevent context menu on long press
    carousel.addEventListener('contextmenu', (e) => {
        if (isDragging) e.preventDefault();
    });
    
    // Handle window resize
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            currentIndex = 0;
            createIndicators();
            updateCarousel();
        }, 250);
    });
    
    // Initialize
    createIndicators();
    updateCarousel();
});
</script>
