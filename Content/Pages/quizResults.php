<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="../../Assets/Scripts/tailwindConfig.js"></script>
    <title>Career Results - CareerPath</title>
</head>
<body class="min-h-screen bg-cream text-dark flex flex-col items-center py-8">

    <!-- Header -->
    <div class="w-full max-w-4xl mx-auto px-4">
        <div class="bg-lime rounded-xl p-6 flex flex-col md:flex-row items-center justify-between shadow-lg mb-8">
            <div>
                <h2 class="text-lg font-semibold text-dark">Your Top Career Recommendations</h2>
                <p class="text-2xl md:text-3xl font-bold mt-1">Based on your profile, here are your best-fit career paths</p>
            </div>
            <div class="mt-4 md:mt-0">
                <i class="fas fa-briefcase text-5xl text-dark/40"></i>
            </div>
        </div>
    </div>

    <!-- Carousel -->
    <div class="w-full max-w-3xl mx-auto px-4">
        <div id="carousel" class="relative">
            <!-- Carousel Cards -->
            <div id="carousel-cards" class="flex transition-transform duration-500 ease-in-out">
                <!-- Example Career Card 1 -->
                <div class="min-w-full px-2">
                    <div class="bg-white rounded-xl shadow-md p-6 flex flex-col h-full">
                        <h3 class="text-xl font-bold mb-2 text-lime">Software Developer</h3>
                        <p class="mb-3 text-gray-700">Designs, builds, and maintains software applications and systems.</p>
                        <div class="mb-3">
                            <span class="font-semibold text-dark">Key Skills:</span>
                            <ul class="list-disc list-inside text-gray-600 text-sm mt-1">
                                <li>Analytical Thinking</li>
                                <li>Problem Solving</li>
                                <li>Programming Languages</li>
                                <li>Attention to Detail</li>
                            </ul>
                        </div>
                        <div class="mt-auto">
                            <p class="text-sm text-gray-500">Why this fits you: Your logical mindset and love for solving complex problems make you a natural fit for software development, where innovation and analytical skills are highly valued.</p>
                        </div>
                    </div>
                </div>
                <!-- Example Career Card 2 -->
                <div class="min-w-full px-2">
                    <div class="bg-white rounded-xl shadow-md p-6 flex flex-col h-full">
                        <h3 class="text-xl font-bold mb-2 text-lime">Data Analyst</h3>
                        <p class="mb-3 text-gray-700">Interprets data and turns it into information to help organizations make informed decisions.</p>
                        <div class="mb-3">
                            <span class="font-semibold text-dark">Key Skills:</span>
                            <ul class="list-disc list-inside text-gray-600 text-sm mt-1">
                                <li>Critical Thinking</li>
                                <li>Statistical Analysis</li>
                                <li>Data Visualization</li>
                                <li>Curiosity</li>
                            </ul>
                        </div>
                        <div class="mt-auto">
                            <p class="text-sm text-gray-500">Why this fits you: Your curiosity and analytical prowess align perfectly with data analysis, where uncovering patterns and insights is key.</p>
                        </div>
                    </div>
                </div>
                <!-- Example Career Card 3 -->
                <div class="min-w-full px-2">
                    <div class="bg-white rounded-xl shadow-md p-6 flex flex-col h-full">
                        <h3 class="text-xl font-bold mb-2 text-lime">Research Scientist</h3>
                        <p class="mb-3 text-gray-700">Conducts experiments and studies to advance knowledge in a specific field.</p>
                        <div class="mb-3">
                            <span class="font-semibold text-dark">Key Skills:</span>
                            <ul class="list-disc list-inside text-gray-600 text-sm mt-1">
                                <li>Scientific Method</li>
                                <li>Attention to Detail</li>
                                <li>Innovative Thinking</li>
                                <li>Persistence</li>
                            </ul>
                        </div>
                        <div class="mt-auto">
                            <p class="text-sm text-gray-500">Why this fits you: Your drive to explore new ideas and your methodical approach make research science a rewarding path for you.</p>
                        </div>
                    </div>
                </div>
                <!-- Example Career Card 4 -->
                <div class="min-w-full px-2">
                    <div class="bg-white rounded-xl shadow-md p-6 flex flex-col h-full">
                        <h3 class="text-xl font-bold mb-2 text-lime">Systems Architect</h3>
                        <p class="mb-3 text-gray-700">Designs and oversees complex IT systems and infrastructure.</p>
                        <div class="mb-3">
                            <span class="font-semibold text-dark">Key Skills:</span>
                            <ul class="list-disc list-inside text-gray-600 text-sm mt-1">
                                <li>Strategic Planning</li>
                                <li>Systems Thinking</li>
                                <li>Technical Expertise</li>
                                <li>Communication</li>
                            </ul>
                        </div>
                        <div class="mt-auto">
                            <p class="text-sm text-gray-500">Why this fits you: Your ability to see the big picture and design logical systems is ideal for a career in systems architecture.</p>
                        </div>
                    </div>
                </div>
                <!-- Example Career Card 5 -->
                <div class="min-w-full px-2">
                    <div class="bg-white rounded-xl shadow-md p-6 flex flex-col h-full">
                        <h3 class="text-xl font-bold mb-2 text-lime">Philosopher / Academic</h3>
                        <p class="mb-3 text-gray-700">Explores fundamental questions about existence, knowledge, and ethics through research and teaching.</p>
                        <div class="mb-3">
                            <span class="font-semibold text-dark">Key Skills:</span>
                            <ul class="list-disc list-inside text-gray-600 text-sm mt-1">
                                <li>Abstract Reasoning</li>
                                <li>Writing & Communication</li>
                                <li>Critical Analysis</li>
                                <li>Intellectual Curiosity</li>
                            </ul>
                        </div>
                        <div class="mt-auto">
                            <p class="text-sm text-gray-500">Why this fits you: Your passion for deep thinking and exploring ideas makes academia or philosophy a natural fit for your personality.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Carousel Controls -->
            <button id="prevBtn" class="absolute left-0 top-1/2 -translate-y-1/2 bg-lime text-dark rounded-full p-2 shadow hover:bg-lime/80 transition disabled:opacity-40" aria-label="Previous">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button id="nextBtn" class="absolute right-0 top-1/2 -translate-y-1/2 bg-lime text-dark rounded-full p-2 shadow hover:bg-lime/80 transition disabled:opacity-40" aria-label="Next">
                <i class="fas fa-chevron-right"></i>
            </button>
            <!-- Carousel Indicators -->
            <div id="carousel-indicators" class="flex justify-center mt-4 gap-2">
                <button class="w-3 h-3 rounded-full bg-lime opacity-80" aria-label="Go to slide 1"></button>
                <button class="w-3 h-3 rounded-full bg-lime/40" aria-label="Go to slide 2"></button>
                <button class="w-3 h-3 rounded-full bg-lime/40" aria-label="Go to slide 3"></button>
                <button class="w-3 h-3 rounded-full bg-lime/40" aria-label="Go to slide 4"></button>
                <button class="w-3 h-3 rounded-full bg-lime/40" aria-label="Go to slide 5"></button>
            </div>
        </div>
    </div>

    <!-- Carousel Script -->
    <script>
        const cards = document.getElementById('carousel-cards');
        const indicators = document.querySelectorAll('#carousel-indicators button');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        let current = 0;
        const total = indicators.length;

        function updateCarousel() {
            cards.style.transform = `translateX(-${current * 100}%)`;
            indicators.forEach((btn, idx) => {
                btn.classList.toggle('opacity-80', idx === current);
                btn.classList.toggle('bg-lime', idx === current);
                btn.classList.toggle('bg-lime/40', idx !== current);
            });
            prevBtn.disabled = current === 0;
            nextBtn.disabled = current === total - 1;
        }

        prevBtn.addEventListener('click', () => {
            if (current > 0) {
                current--;
                updateCarousel();
            }
        });

        nextBtn.addEventListener('click', () => {
            if (current < total - 1) {
                current++;
                updateCarousel();
            }
        });

        indicators.forEach((btn, idx) => {
            btn.addEventListener('click', () => {
                current = idx;
                updateCarousel();
            });
        });

        updateCarousel();
    </script>
</body>
</html>