<?php
$careerCards = [
    [
        'bg' => 'bg-white border-2 border-dark text-dark',
        'icon' => 'fas fa-laptop-code text-white',
        'iconBg' => 'bg-crimson_red',
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
        'bg' => 'bg-navy_blue text-white',
        'icon' => 'fas fa-heartbeat text-white',
        'iconBg' => 'bg-crimson_red',
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
        'icon' => 'fas fa-briefcase text-white',
        'iconBg' => 'bg-crimson_red',
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
        'bg' => 'bg-navy_blue text-white',
        'icon' => 'fas fa-palette text-white',
        'iconBg' => 'bg-crimson_red',
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
        'icon' => 'fas fa-graduation-cap text-white',
        'iconBg' => 'bg-crimson_red',
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
        'bg' => 'bg-navy_blue text-white',
        'icon' => 'fas fa-flask text-white',
        'iconBg' => 'bg-crimson_red',
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

function renderCareerCard($card)
{
?>
<div class="carousel-card flex-shrink-0 w-full md:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.5rem)] px-2">
    <div
        class="<?php echo $card['bg']; ?> rounded-3xl p-10 hover:shadow-xl transition-all duration-300 h-full min-h-[420px] flex flex-col">
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