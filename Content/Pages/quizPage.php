<?php
include "../Functions/quizPageFunctions/quizPageFunction.php";
?>

<!DOCTYPE html>
<html lang="en">

<?php include "../Includes/quizPageComponents/quizPageHeadtag.php"; ?>

<body class="min-h-screen bg-gray-50 text-gray-900">

    <input type="hidden" id="quiz-mode" value="<?php echo $quizMode; ?>">
    <input type="hidden" id="user-id" value="<?php echo $isLoggedIn ? $_SESSION['user_id'] : ''; ?>">
    <input type="hidden" id="session-id" value="<?php echo $isLoggedIn ? '' : $_SESSION['guest_session_id']; ?>">

    <!-- Header -->
    <?php include "../Includes/quizPageComponents/quizPageHeader.php"; ?>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Quiz Info Card -->
        <?php include "../Includes/quizPageComponents/quizPageInfoCard.php"; ?>

        <!-- Progress Bar -->
        <?php include "../Includes/quizPageComponents/quizPageProgressBar.php"; ?>

        <!-- Quiz Container for Questions -->
        <?php include "../Includes/quizPageComponents/quizPageQuizContainer.php"; ?>

    </div>

    <!-- Updated Quiz JavaScript -->
    <script src="../Scripts/quizPageScripts/quizPage.js"></script>

</body>

</html>