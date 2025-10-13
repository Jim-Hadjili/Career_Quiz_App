<?php
include "../Functions/quizPageFunctions/quizPageFunction.php";
?>

<!DOCTYPE html>
<html lang="en">

<?php include "../Includes/quizPageComponents/quizPageHeadtag.php"; ?>

<body class="min-h-screen bg-cream text-dark font-sans">

    <!-- Header -->
    <?php include "../Includes/quizPageComponents/quizPageHeader.php"; ?>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        <!-- Quiz Info Card -->
        <div class="bg-white rounded-3xl shadow-lg p-8 mb-6 border-2 border-dark">
            <?php include "../Includes/quizPageComponents/quizPageInfoCard.php"; ?>
        </div>

        <!-- Progress Bar -->
        <?php include "../Includes/quizPageComponents/quizPageProgressBar.php"; ?>

        <!-- Quiz Container for Questions -->
        <div class="bg-white rounded-3xl shadow-lg p-8 mt-6 border-2 border-dark">
            <?php include "../Includes/quizPageComponents/quizPageQuizContainer.php"; ?>
        </div>

    </div>

    <!-- Updated Quiz JavaScript -->
    <script src="../Scripts/quizPageScripts/quizPage.js"></script>

</body>

</html>