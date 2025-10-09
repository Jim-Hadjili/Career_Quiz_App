<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="Assets/Scripts/tailwindConfig.js"></script>
    <link rel="stylesheet" href="Assets/Styles/index.css">
    <title>CareerPath - Discover Your Perfect Career</title>
</head>

<?php include 'Components/floatingButton.php'; ?>

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

    <!-- Mobile menu toggle -->
    <script src="Content/Scripts/mobileMenuToggle.js"></script>

    <script src="Assets/Scripts/floatingButtonScript.js"></script>
</body>

</html>