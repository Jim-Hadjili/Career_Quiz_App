<?php include "Content/Scripts/careerSectionScripts/careerData.php" ?>

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
            <div id="careerCarousel" class="overflow-hidden cursor-grab active:cursor-grabbing md:cursor-grab">
                <div id="careerTrack" class="flex transition-transform duration-500 ease-out gap-4">
                    <?php foreach ($careerCards as $card) {
                        renderCareerCard($card);
                    } ?>
                </div>
            </div>

            <div class="flex justify-center items-center gap-4 mt-6 md:hidden">
                <button id="prevBtn" class="bg-dark text-white w-12 h-12 rounded-full flex items-center justify-center shadow-lg hover:bg-lime hover:text-dark transition-all duration-300 hidden">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button id="nextBtn" class="bg-dark text-white w-12 h-12 rounded-full flex items-center justify-center shadow-lg hover:bg-lime hover:text-dark transition-all duration-300">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

            <div id="carouselIndicators" class="flex justify-center gap-2 mt-4">
                
            </div>
        </div>
    </div>
</section>

