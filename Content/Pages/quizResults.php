<!DOCTYPE html>
<html lang="en">

<?php include "../Includes/quizResultsComponents/quizResultsHeadtag.php" ?>

<body class="min-h-screen bg-white text-gray-800 font-sans antialiased">

  <!-- Main Container -->
  <div class="relative">

    <!-- Main Content -->
    <div class="main-content">

      <?php include "../Includes/quizResultsComponents/quizResultsHeader.php" ?>

      <!-- Section 1: Your Career Path -->
      <?php include "../Includes/quizResultsComponents/quizResultsCareerPath.php" ?>

      <!-- Section 2: Recommended Career Paths -->
      <?php include "../Includes/quizResultsComponents/quizResultsRecommendedCareers.php" ?>

      <!-- Section 3: Personality Traits -->
      <?php include "../Includes/quizResultsComponents/quizResultsPersonalityTraits.php" ?>

      <!-- Section 4: Full Analysis -->
      <?php include "../Includes/quizResultsComponents/quizResultsAnalysis.php" ?>

    </div>

    <!-- Desktop Floating Sidebar -->
    <?php include "../Includes/quizResultsComponents/quizResultsSideBar.php" ?>

  </div>

  <script src="../Scripts/quizResultsScripts/quizResults.js"></script>

</body>

</html>