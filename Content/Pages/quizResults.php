<?php
// Add this at the very beginning of quizResultsHeadtag.php if not already present
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
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

  <!-- Pass PHP session data to JavaScript -->
  <script>
    window.APP_CONFIG = {
      userId: <?php echo json_encode($_SESSION['user_id'] ?? null); ?>,
      userName: <?php echo json_encode($_SESSION['userName'] ?? null); ?>,
      userEmail: <?php echo json_encode($_SESSION['userEmail'] ?? null); ?>,
      isLoggedIn: <?php echo json_encode(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])); ?>
    };
  </script>

  <script type="module" src="../Scripts/quizResultsScripts/quizResults.js"></script>

</body>

</html>