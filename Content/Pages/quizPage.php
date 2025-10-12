<?php 
include "../Functions/quizPageFunctions/quizPageFunction.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="../../Assets/Scripts/tailwindConfig.js"></script>
    <link rel="stylesheet" href="../../Assets/Styles/index.css">
    <title>Career Quiz - <?php echo $quizMode === 'user' ? 'Registered User' : 'Guest Mode'; ?></title>
</head>
<body class="min-h-screen bg-cream text-dark">

    <script src="../Scripts/quizPageScripts/quizPage.js"></script>
</body>
</html>