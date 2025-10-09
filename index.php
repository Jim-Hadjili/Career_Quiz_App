<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title>CareerPath - Discover Your Perfect Career</title>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'lime': '#B9FF66',
                        'dark': '#191A23',
                        'cream': '#F3F3F3',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Space Grotesk', sans-serif;
        }
        
        .smooth-scroll {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="min-h-screen bg-cream text-dark smooth-scroll">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-dark rounded-full flex items-center justify-center">
                        <i class="fas fa-compass text-lime text-lg"></i>
                    </div>
                    <span class="text-2xl font-bold">CareerPath</span>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="hover:text-lime transition-colors">Home</a>
                    <a href="#how-it-works" class="hover:text-lime transition-colors">How It Works</a>
                    <a href="#quiz-guide" class="hover:text-lime transition-colors">Quiz Guide</a>
                    <a href="#careers" class="hover:text-lime transition-colors">Careers</a>
                    <button onclick="startQuiz()" class="bg-dark text-white px-6 py-3 rounded-full hover:bg-opacity-90 transition-all">
                        Take Quiz
                    </button>
                </div>
                
                <button id="mobile-menu-btn" class="md:hidden text-2xl">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
        
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t">
            <div class="px-4 py-4 space-y-3">
                <a href="#home" class="block py-2 hover:text-lime transition-colors">Home</a>
                <a href="#how-it-works" class="block py-2 hover:text-lime transition-colors">How It Works</a>
                <a href="#quiz-guide" class="block py-2 hover:text-lime transition-colors">Quiz Guide</a>
                <a href="#careers" class="block py-2 hover:text-lime transition-colors">Careers</a>
                <button onclick="startQuiz()" class="w-full bg-dark text-white px-6 py-3 rounded-full hover:bg-opacity-90 transition-all">
                    Take Quiz
                </button>
            </div>
        </div>
    </nav>

    <section id="home" class="py-16 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6">
                        Discover Your Perfect <span class="text-lime bg-dark px-3 py-1 inline-block rounded">Career Path</span>
                    </h1>
                    <p class="text-lg md:text-xl text-gray-600 mb-8 leading-relaxed">
                        Take our comprehensive personality quiz to uncover career paths that align with your unique traits, interests, and aspirations. Your dream career is just a few questions away.
                    </p>
                    <button onclick="startQuiz()" class="bg-dark text-white px-8 py-4 rounded-full text-lg font-medium hover:bg-opacity-90 transition-all inline-flex items-center space-x-2">
                        <span>Start Your Journey</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
                
                <div class="relative">
                    <img src="https://illustrations.popsy.co/amber/remote-work.svg" alt="Learning Illustration" class="w-full h-auto">
                </div>
            </div>
        </div>
    </section>

    <section id="how-it-works" class="py-16 md:py-24 bg-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4">
                    <span class="bg-lime px-4 py-2 rounded-lg inline-block">How It Works</span>
                </h2>
                <p class="text-lg text-gray-600 mt-6 max-w-2xl mx-auto">
                    Our scientifically-backed process analyzes your personality, interests, and preferences to match you with ideal career paths.
                </p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-3xl p-8 border-2 border-dark shadow-lg hover:shadow-xl transition-shadow">
                    <div class="w-16 h-16 bg-lime rounded-full flex items-center justify-center mb-6">
                        <span class="text-3xl font-bold text-dark">1</span>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Take the Quiz</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Answer thoughtfully crafted questions about your personality, interests, values, and work preferences. The quiz takes about 10-15 minutes to complete.
                    </p>
                </div>
                
                <div class="bg-dark text-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="w-16 h-16 bg-lime rounded-full flex items-center justify-center mb-6">
                        <span class="text-3xl font-bold text-dark">2</span>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">AI Analysis</h3>
                    <p class="text-gray-300 leading-relaxed">
                        Our advanced algorithm analyzes your responses, identifying patterns and matching them with career profiles from our extensive database of professions.
                    </p>
                </div>
                
                <div class="bg-white rounded-3xl p-8 border-2 border-dark shadow-lg hover:shadow-xl transition-shadow">
                    <div class="w-16 h-16 bg-lime rounded-full flex items-center justify-center mb-6">
                        <span class="text-3xl font-bold text-dark">3</span>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Get Results</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Receive personalized career recommendations with detailed insights about why each path suits you, including required skills and growth potential.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="quiz-guide" class="py-16 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4">
                    <span class="bg-lime px-4 py-2 rounded-lg inline-block">Quiz Guide</span>
                </h2>
                <p class="text-lg text-gray-600 mt-6 max-w-2xl mx-auto">
                    Explore our comprehensive personality assessment designed to uncover your ideal career path.
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-8 mb-12">
                <div class="bg-cream rounded-3xl p-8 border-2 border-dark">
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <span class="bg-lime text-dark px-4 py-1 rounded-full text-sm font-medium">Personality traits</span>
                            <h3 class="text-2xl font-bold mt-4">Personality Assessment</h3>
                        </div>
                        <div class="w-12 h-12 bg-dark rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-lime text-xl"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">20 questions exploring your character traits, work style, and interpersonal preferences.</p>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-check-circle text-lime"></i>
                            <span>Introversion vs. Extroversion</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-check-circle text-lime"></i>
                            <span>Analytical vs. Creative thinking</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-check-circle text-lime"></i>
                            <span>Leadership qualities</span>
                        </li>
                    </ul>
                </div>
                
                <div class="bg-dark text-white rounded-3xl p-8">
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <span class="bg-lime text-dark px-4 py-1 rounded-full text-sm font-medium">Interests</span>
                            <h3 class="text-2xl font-bold mt-4">Interests & Hobbies</h3>
                        </div>
                        <div class="w-12 h-12 bg-lime rounded-full flex items-center justify-center">
                            <i class="fas fa-heart text-dark text-xl"></i>
                        </div>
                    </div>
                    <p class="text-gray-300 mb-4">15 questions about your passions, hobbies, and what energizes you.</p>
                    <ul class="space-y-2 text-gray-300">
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-check-circle text-lime"></i>
                            <span>Creative pursuits</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-check-circle text-lime"></i>
                            <span>Technical interests</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-check-circle text-lime"></i>
                            <span>Social activities</span>
                        </li>
                    </ul>
                </div>
                
                <div class="bg-dark text-white rounded-3xl p-8">
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <span class="bg-lime text-dark px-4 py-1 rounded-full text-sm font-medium">Values</span>
                            <h3 class="text-2xl font-bold mt-4">Work Values</h3>
                        </div>
                        <div class="w-12 h-12 bg-lime rounded-full flex items-center justify-center">
                            <i class="fas fa-star text-dark text-xl"></i>
                        </div>
                    </div>
                    <p class="text-gray-300 mb-4">12 questions about what matters most to you in a career.</p>
                    <ul class="space-y-2 text-gray-300">
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-check-circle text-lime"></i>
                            <span>Work-life balance</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-check-circle text-lime"></i>
                            <span>Financial stability</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-check-circle text-lime"></i>
                            <span>Making an impact</span>
                        </li>
                    </ul>
                </div>
                
                <div class="bg-cream rounded-3xl p-8 border-2 border-dark">
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <span class="bg-lime text-dark px-4 py-1 rounded-full text-sm font-medium">Abilities</span>
                            <h3 class="text-2xl font-bold mt-4">Skills & Strengths</h3>
                        </div>
                        <div class="w-12 h-12 bg-dark rounded-full flex items-center justify-center">
                            <i class="fas fa-bolt text-lime text-xl"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">13 questions assessing your natural abilities and learned skills.</p>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-check-circle text-lime"></i>
                            <span>Problem-solving abilities</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-check-circle text-lime"></i>
                            <span>Communication skills</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-check-circle text-lime"></i>
                            <span>Technical proficiency</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="bg-lime rounded-3xl p-8 md:p-12">
                <div class="max-w-3xl mx-auto text-center">
                    <h3 class="text-3xl font-bold mb-6">Tips for Best Results</h3>
                    <div class="grid md:grid-cols-3 gap-6 text-left">
                        <div>
                            <div class="w-12 h-12 bg-dark rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-lightbulb text-lime text-xl"></i>
                            </div>
                            <h4 class="font-bold mb-2">Be Honest</h4>
                            <p class="text-sm">Answer based on who you are, not who you think you should be.</p>
                        </div>
                        <div>
                            <div class="w-12 h-12 bg-dark rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-clock text-lime text-xl"></i>
                            </div>
                            <h4 class="font-bold mb-2">Take Your Time</h4>
                            <p class="text-sm">Don't rush. Reflect on each question carefully.</p>
                        </div>
                        <div>
                            <div class="w-12 h-12 bg-dark rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-brain text-lime text-xl"></i>
                            </div>
                            <h4 class="font-bold mb-2">Trust Your Instinct</h4>
                            <p class="text-sm">Your first answer is usually the most accurate.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="careers" class="py-16 md:py-24 bg-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4">
                    <span class="bg-lime px-4 py-2 rounded-lg inline-block">Career Paths</span>
                </h2>
                <p class="text-lg text-gray-600 mt-6 max-w-2xl mx-auto">
                    Explore diverse career fields matched to different personality types and interests.
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-3xl p-8 border-2 border-dark hover:shadow-xl transition-all">
                    <div class="w-16 h-16 bg-lime rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-laptop-code text-dark text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-3">Technology</h3>
                    <p class="text-gray-600 mb-4">Perfect for analytical minds who love problem-solving and innovation.</p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li>• Software Developer</li>
                        <li>• Data Scientist</li>
                        <li>• UX/UI Designer</li>
                        <li>• Cybersecurity Analyst</li>
                    </ul>
                </div>
                
                <div class="bg-dark text-white rounded-3xl p-8 hover:shadow-xl transition-all">
                    <div class="w-16 h-16 bg-lime rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-heartbeat text-dark text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-3">Healthcare</h3>
                    <p class="text-gray-300 mb-4">Ideal for compassionate individuals who want to help others.</p>
                    <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Medical Doctor</li>
                        <li>• Nurse Practitioner</li>
                        <li>• Physical Therapist</li>
                        <li>• Mental Health Counselor</li>
                    </ul>
                </div>
                
                <div class="bg-white rounded-3xl p-8 border-2 border-dark hover:shadow-xl transition-all">
                    <div class="w-16 h-16 bg-lime rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-briefcase text-dark text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-3">Business</h3>
                    <p class="text-gray-600 mb-4">Great for strategic thinkers with leadership potential.</p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li>• Marketing Manager</li>
                        <li>• Financial Analyst</li>
                        <li>• Business Consultant</li>
                        <li>• Entrepreneur</li>
                    </ul>
                </div>
                
                <div class="bg-dark text-white rounded-3xl p-8 hover:shadow-xl transition-all">
                    <div class="w-16 h-16 bg-lime rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-palette text-dark text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-3">Creative Arts</h3>
                    <p class="text-gray-300 mb-4">Perfect for imaginative souls who express through creativity.</p>
                    <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Graphic Designer</li>
                        <li>• Content Creator</li>
                        <li>• Art Director</li>
                        <li>• Photographer</li>
                    </ul>
                </div>
                
                <div class="bg-white rounded-3xl p-8 border-2 border-dark hover:shadow-xl transition-all">
                    <div class="w-16 h-16 bg-lime rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-graduation-cap text-dark text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-3">Education</h3>
                    <p class="text-gray-600 mb-4">Ideal for patient mentors who love sharing knowledge.</p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li>• Teacher</li>
                        <li>• Educational Consultant</li>
                        <li>• School Counselor</li>
                        <li>• Curriculum Developer</li>
                    </ul>
                </div>
                
                <div class="bg-dark text-white rounded-3xl p-8 hover:shadow-xl transition-all">
                    <div class="w-16 h-16 bg-lime rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-flask text-dark text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-3">Science & Research</h3>
                    <p class="text-gray-300 mb-4">For curious minds driven by discovery and understanding.</p>
                    <ul class="space-y-2 text-sm text-gray-300">
                        <li>• Research Scientist</li>
                        <li>• Environmental Scientist</li>
                        <li>• Lab Technician</li>
                        <li>• Biotech Specialist</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-cream rounded-3xl p-8 md:p-16 text-center">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6">
                    Ready to Find Your Path?
                </h2>
                <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                    Join thousands of students who have discovered their ideal career direction. Your future starts with understanding yourself.
                </p>
                <button onclick="startQuiz()" class="bg-dark text-white px-10 py-5 rounded-full text-lg font-medium hover:bg-opacity-90 transition-all inline-flex items-center space-x-3">
                    <span>Take the Free Quiz Now</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
                
                <div class="mt-12 grid grid-cols-3 gap-8 max-w-3xl mx-auto">
                    <div>
                        <div class="text-4xl font-bold text-lime mb-2">50K+</div>
                        <div class="text-gray-600">Students Helped</div>
                    </div>
                    <div>
                        <div class="text-4xl font-bold text-lime mb-2">95%</div>
                        <div class="text-gray-600">Satisfaction Rate</div>
                    </div>
                    <div>
                        <div class="text-4xl font-bold text-lime mb-2">200+</div>
                        <div class="text-gray-600">Career Paths</div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div id="quiz-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-3xl max-w-3xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-8">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-3xl font-bold">Career Personality Quiz</h2>
                    <button onclick="closeQuiz()" class="text-3xl hover:text-lime transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <div class="mb-8">
                    <div class="flex justify-between text-sm mb-2">
                        <span>Progress</span>
                        <span id="progress-text">0/15</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div id="progress-bar" class="bg-lime h-3 rounded-full transition-all duration-300" style="width: 0%"></div>
                    </div>
                </div>
                
                <div id="quiz-content">
                     Questions will be inserted here 
                </div>
                
                <div id="quiz-results" class="hidden">
                    <div class="text-center mb-8">
                        <div class="w-24 h-24 bg-lime rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-trophy text-dark text-4xl"></i>
                        </div>
                        <h3 class="text-3xl font-bold mb-4">Your Results Are Ready!</h3>
                        <p class="text-gray-600 mb-6">Based on your responses, here are your top career matches:</p>
                    </div>
                    
                    <div id="career-matches" class="space-y-4 mb-8">
                         Career matches will be inserted here 
                    </div>
                    
                    <div class="bg-lime rounded-2xl p-6 mb-6">
                        <h4 class="font-bold text-lg mb-2">Your Personality Profile</h4>
                        <p id="personality-description" class="text-sm"></p>
                    </div>
                    
                    <button onclick="closeQuiz()" class="w-full bg-dark text-white py-4 rounded-full font-medium hover:bg-opacity-90 transition-all">
                        Explore More Careers
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Quiz data
        const quizQuestions = [
            {
                question: "How do you prefer to spend your free time?",
                options: [
                    { text: "Reading, writing, or learning new things", traits: ["analytical", "creative"] },
                    { text: "Socializing with friends and meeting new people", traits: ["social", "extroverted"] },
                    { text: "Working on hands-on projects or hobbies", traits: ["practical", "technical"] },
                    { text: "Helping others or volunteering", traits: ["caring", "service"] }
                ]
            },
            {
                question: "In a group project, you typically:",
                options: [
                    { text: "Take the lead and organize everyone", traits: ["leadership", "organized"] },
                    { text: "Come up with creative ideas and solutions", traits: ["creative", "innovative"] },
                    { text: "Focus on the details and execution", traits: ["analytical", "practical"] },
                    { text: "Support team members and maintain harmony", traits: ["social", "caring"] }
                ]
            },
            {
                question: "What motivates you most in your work?",
                options: [
                    { text: "Solving complex problems", traits: ["analytical", "technical"] },
                    { text: "Making a positive impact on others", traits: ["caring", "service"] },
                    { text: "Creating something new and original", traits: ["creative", "innovative"] },
                    { text: "Achieving goals and recognition", traits: ["leadership", "ambitious"] }
                ]
            },
            {
                question: "How do you handle stress?",
                options: [
                    { text: "Analyze the situation logically", traits: ["analytical", "calm"] },
                    { text: "Talk it through with others", traits: ["social", "extroverted"] },
                    { text: "Take action and stay busy", traits: ["practical", "active"] },
                    { text: "Take time alone to reflect", traits: ["introverted", "thoughtful"] }
                ]
            },
            {
                question: "Which environment appeals to you most?",
                options: [
                    { text: "Fast-paced, dynamic workplace", traits: ["active", "ambitious"] },
                    { text: "Collaborative, team-oriented setting", traits: ["social", "cooperative"] },
                    { text: "Quiet, focused workspace", traits: ["introverted", "analytical"] },
                    { text: "Creative, flexible environment", traits: ["creative", "innovative"] }
                ]
            },
            {
                question: "What's your approach to learning new skills?",
                options: [
                    { text: "Hands-on practice and experimentation", traits: ["practical", "technical"] },
                    { text: "Reading and researching thoroughly", traits: ["analytical", "studious"] },
                    { text: "Learning from others and collaboration", traits: ["social", "cooperative"] },
                    { text: "Finding creative ways to apply concepts", traits: ["creative", "innovative"] }
                ]
            },
            {
                question: "Which statement resonates with you most?",
                options: [
                    { text: "I love working with data and numbers", traits: ["analytical", "technical"] },
                    { text: "I enjoy expressing myself creatively", traits: ["creative", "artistic"] },
                    { text: "I'm passionate about helping people", traits: ["caring", "service"] },
                    { text: "I thrive on challenges and competition", traits: ["ambitious", "leadership"] }
                ]
            },
            {
                question: "How do you make important decisions?",
                options: [
                    { text: "Based on logic and facts", traits: ["analytical", "rational"] },
                    { text: "Following my intuition and feelings", traits: ["intuitive", "emotional"] },
                    { text: "Consulting with others for input", traits: ["social", "cooperative"] },
                    { text: "Considering practical outcomes", traits: ["practical", "realistic"] }
                ]
            },
            {
                question: "What type of tasks do you enjoy most?",
                options: [
                    { text: "Strategic planning and organizing", traits: ["organized", "leadership"] },
                    { text: "Creative design and innovation", traits: ["creative", "innovative"] },
                    { text: "Technical problem-solving", traits: ["technical", "analytical"] },
                    { text: "Interpersonal communication", traits: ["social", "communicative"] }
                ]
            },
            {
                question: "How important is work-life balance to you?",
                options: [
                    { text: "Extremely important - I need personal time", traits: ["balanced", "self-care"] },
                    { text: "Important, but I'm willing to work hard", traits: ["ambitious", "dedicated"] },
                    { text: "Flexible - depends on the project", traits: ["adaptable", "flexible"] },
                    { text: "Work is a big part of my identity", traits: ["career-focused", "driven"] }
                ]
            },
            {
                question: "Which best describes your communication style?",
                options: [
                    { text: "Direct and to the point", traits: ["assertive", "efficient"] },
                    { text: "Warm and empathetic", traits: ["caring", "emotional"] },
                    { text: "Detailed and thorough", traits: ["analytical", "precise"] },
                    { text: "Enthusiastic and expressive", traits: ["extroverted", "energetic"] }
                ]
            },
            {
                question: "What role do you naturally take in social situations?",
                options: [
                    { text: "The organizer who plans activities", traits: ["leadership", "organized"] },
                    { text: "The listener who supports others", traits: ["caring", "supportive"] },
                    { text: "The entertainer who energizes the group", traits: ["extroverted", "social"] },
                    { text: "The observer who contributes thoughtfully", traits: ["introverted", "thoughtful"] }
                ]
            },
            {
                question: "How do you prefer to receive feedback?",
                options: [
                    { text: "Direct and constructive criticism", traits: ["resilient", "growth-minded"] },
                    { text: "Positive reinforcement with suggestions", traits: ["sensitive", "motivated"] },
                    { text: "Detailed analysis of performance", traits: ["analytical", "perfectionist"] },
                    { text: "Collaborative discussion", traits: ["cooperative", "open-minded"] }
                ]
            },
            {
                question: "What's your ideal work schedule?",
                options: [
                    { text: "Structured 9-5 with clear boundaries", traits: ["organized", "balanced"] },
                    { text: "Flexible hours based on productivity", traits: ["flexible", "autonomous"] },
                    { text: "Varied schedule with different activities", traits: ["adaptable", "dynamic"] },
                    { text: "Intensive periods with breaks in between", traits: ["focused", "project-based"] }
                ]
            },
            {
                question: "Which achievement would make you most proud?",
                options: [
                    { text: "Developing an innovative solution", traits: ["innovative", "creative"] },
                    { text: "Leading a successful team", traits: ["leadership", "collaborative"] },
                    { text: "Mastering a complex skill", traits: ["technical", "dedicated"] },
                    { text: "Making a difference in people's lives", traits: ["caring", "impactful"] }
                ]
            }
        ];

        const careerProfiles = {
            technology: {
                name: "Technology & Engineering",
                icon: "fa-laptop-code",
                traits: ["analytical", "technical", "innovative", "problem-solver"],
                careers: ["Software Developer", "Data Scientist", "Systems Engineer", "UX Designer"],
                description: "You have a strong analytical mind and love solving complex technical problems. Technology careers offer you the perfect blend of creativity and logic."
            },
            healthcare: {
                name: "Healthcare & Wellness",
                icon: "fa-heartbeat",
                traits: ["caring", "service", "empathetic", "detail-oriented"],
                careers: ["Medical Doctor", "Nurse", "Therapist", "Healthcare Administrator"],
                description: "Your compassionate nature and desire to help others make you ideal for healthcare. You find fulfillment in making a direct positive impact on people's lives."
            },
            business: {
                name: "Business & Management",
                icon: "fa-briefcase",
                traits: ["leadership", "organized", "ambitious", "strategic"],
                careers: ["Business Manager", "Marketing Director", "Financial Analyst", "Entrepreneur"],
                description: "You're a natural leader with strong organizational skills. Business careers allow you to leverage your strategic thinking and drive for success."
            },
            creative: {
                name: "Creative Arts & Design",
                icon: "fa-palette",
                traits: ["creative", "innovative", "artistic", "expressive"],
                careers: ["Graphic Designer", "Content Creator", "Art Director", "Photographer"],
                description: "Your creative spirit and innovative thinking set you apart. You thrive when you can express yourself and bring original ideas to life."
            },
            education: {
                name: "Education & Training",
                icon: "fa-graduation-cap",
                traits: ["caring", "patient", "communicative", "organized"],
                careers: ["Teacher", "Professor", "Corporate Trainer", "Educational Consultant"],
                description: "You have a gift for sharing knowledge and nurturing growth in others. Education careers let you make a lasting impact on future generations."
            },
            science: {
                name: "Science & Research",
                icon: "fa-flask",
                traits: ["analytical", "curious", "methodical", "detail-oriented"],
                careers: ["Research Scientist", "Lab Technician", "Environmental Scientist", "Biotech Specialist"],
                description: "Your curiosity and analytical mind drive you to understand how things work. Research careers satisfy your need for discovery and innovation."
            }
        };

        let currentQuestion = 0;
        let userTraits = {};

        function startQuiz() {
            currentQuestion = 0;
            userTraits = {};
            document.getElementById('quiz-modal').classList.remove('hidden');
            document.getElementById('quiz-modal').classList.add('flex');
            document.getElementById('quiz-results').classList.add('hidden');
            document.getElementById('quiz-content').classList.remove('hidden');
            showQuestion();
        }

        function closeQuiz() {
            document.getElementById('quiz-modal').classList.add('hidden');
            document.getElementById('quiz-modal').classList.remove('flex');
        }

        function showQuestion() {
            const question = quizQuestions[currentQuestion];
            const progressPercent = (currentQuestion / quizQuestions.length) * 100;
            
            document.getElementById('progress-bar').style.width = progressPercent + '%';
            document.getElementById('progress-text').textContent = currentQuestion + '/' + quizQuestions.length;
            
            const quizContent = document.getElementById('quiz-content');
            quizContent.innerHTML = `
                <div class="mb-8">
                    <h3 class="text-2xl font-bold mb-6">${question.question}</h3>
                    <div class="space-y-4">
                        ${question.options.map((option, index) => `
                            <button onclick="selectAnswer(${index})" class="w-full text-left p-6 rounded-2xl border-2 border-gray-200 hover:border-lime hover:bg-lime hover:bg-opacity-10 transition-all">
                                <div class="flex items-center space-x-4">
                                    <div class="w-8 h-8 rounded-full border-2 border-gray-300 flex items-center justify-center flex-shrink-0">
                                        <span class="font-bold">${String.fromCharCode(65 + index)}</span>
                                    </div>
                                    <span class="font-medium">${option.text}</span>
                                </div>
                            </button>
                        `).join('')}
                    </div>
                </div>
            `;
        }

        function selectAnswer(optionIndex) {
            const question = quizQuestions[currentQuestion];
            const selectedOption = question.options[optionIndex];
            
            // Record traits
            selectedOption.traits.forEach(trait => {
                userTraits[trait] = (userTraits[trait] || 0) + 1;
            });
            
            currentQuestion++;
            
            if (currentQuestion < quizQuestions.length) {
                showQuestion();
            } else {
                showResults();
            }
        }

        function showResults() {
            document.getElementById('quiz-content').classList.add('hidden');
            document.getElementById('quiz-results').classList.remove('hidden');
            document.getElementById('progress-bar').style.width = '100%';
            document.getElementById('progress-text').textContent = quizQuestions.length + '/' + quizQuestions.length;
            
            // Calculate career matches
            const careerScores = {};
            
            Object.keys(careerProfiles).forEach(careerKey => {
                const profile = careerProfiles[careerKey];
                let score = 0;
                
                profile.traits.forEach(trait => {
                    if (userTraits[trait]) {
                        score += userTraits[trait];
                    }
                });
                
                careerScores[careerKey] = score;
            });
            
            // Sort careers by score
            const sortedCareers = Object.keys(careerScores).sort((a, b) => careerScores[b] - careerScores[a]);
            const topCareers = sortedCareers.slice(0, 3);
            
            // Display results
            const careerMatchesDiv = document.getElementById('career-matches');
            careerMatchesDiv.innerHTML = topCareers.map((careerKey, index) => {
                const profile = careerProfiles[careerKey];
                const matchPercent = Math.min(95, 70 + (3 - index) * 10);
                
                return `
                    <div class="bg-${index === 0 ? 'lime' : 'cream'} rounded-2xl p-6 ${index === 0 ? 'border-4 border-dark' : ''}">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-dark rounded-xl flex items-center justify-center">
                                    <i class="fas ${profile.icon} text-lime text-xl"></i>
                                </div>
                                <div>
                                    <div class="flex items-center space-x-2">
                                        <h4 class="font-bold text-lg">${profile.name}</h4>
                                        ${index === 0 ? '<span class="bg-dark text-lime px-3 py-1 rounded-full text-xs font-bold">TOP MATCH</span>' : ''}
                                    </div>
                                    <p class="text-sm text-gray-600 mt-1">${matchPercent}% Match</p>
                                </div>
                            </div>
                        </div>
                        <p class="text-sm mb-4">${profile.description}</p>
                        <div class="flex flex-wrap gap-2">
                            ${profile.careers.map(career => `
                                <span class="bg-white px-3 py-1 rounded-full text-xs font-medium">${career}</span>
                            `).join('')}
                        </div>
                    </div>
                `;
            }).join('');
            
            // Personality description
            const topTraits = Object.keys(userTraits).sort((a, b) => userTraits[b] - userTraits[a]).slice(0, 4);
            const personalityDesc = `You are ${topTraits.slice(0, -1).join(', ')} and ${topTraits[topTraits.length - 1]}. These qualities make you well-suited for careers that value your unique combination of skills and personality traits.`;
            document.getElementById('personality-description').textContent = personalityDesc;
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    // Close mobile menu if open
                    document.getElementById('mobile-menu').classList.add('hidden');
                }
            });
        });

        // Close modal when clicking outside
        document.getElementById('quiz-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeQuiz();
            }
        });
    </script>

</body>

</html>
