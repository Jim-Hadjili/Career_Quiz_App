<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="Assets/Scripts/tailwindConfig.js"></script>
    <link rel="stylesheet" href="Assets/Styles/index.css">
    <link rel="stylesheet" href="Assets/Styles/careerSectionCarousel.css">
    <title>CareerPath - Discover Your Perfect Career</title>
</head>

<?php include 'Assets/Components/floatingButton.php'; ?>

<body class="min-h-screen bg-cream text-dark smooth-scroll">

    <!-- Navigation Header -->
    <?php include 'Content/Sections/navHeader.php'; ?>

    <!-- Hero Section -->
    <?php include 'Content/Sections/heroSection.php'; ?>

    <!-- About Section -->
    <?php include 'Content/Sections/aboutSection.php'; ?>

    <!-- How It Works Section -->
    <?php include 'Content/Sections/howItWorkSection.php'; ?>

    <!-- Quiz Guide Section -->
    <?php include 'Content/Sections/quizGuideSection.php' ?>

    <!-- Career Paths Section -->
    <?php include 'Content/Sections/careerSection.php'; ?>

    <!-- Footer CTA Section -->
    <?php include 'Content/Sections/footerCTA_Section.php'; ?>

    <!-- Sign Up Modal -->
    <?php include 'Assets/Components/authModal.php'; ?>

    <!-- Logout Confirmation Modal -->
    <?php include 'Assets/Components/logoutModal.php'; ?>

    <!-- Quiz Access Modal -->
    <?php include 'Assets/Components/quizAccessModal.php'; ?>

    <!-- Mobile menu toggle -->
    <script src="Content/Scripts/mobileMenuToggle.js"></script>

    <!-- Carousel Script for Career Section -->
    <script src="Content/Scripts/careerSectionScripts/careerScript.js"></script>

    <script src="Assets/Scripts/floatingButtonScript.js"></script>

    <!-- Sign Up Modal Script -->
    <script src="Assets/Scripts/authModal.js"></script>

    <!-- Logout Modal Script -->
    <script src="Assets/Scripts/logoutModal.js"></script>

    <!-- Quiz Access Modal Script -->
    <script src="Assets/Scripts/quizAccessModal.js"></script>
</body>

</html>