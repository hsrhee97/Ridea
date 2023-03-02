<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment</title>
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;500;700&family=Roboto:wght@100;400;700&display=swap" rel="stylesheet">
    <!-- icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- another icons -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <style> <?php include 'css/matching.css'; ?> </style>
    
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

</head>
<?php include 'includes/nav.php'; ?>
<body>
    <main>
        <?php
            $user_id = $_SESSION["id"];
            $user_survey_id = $_GET["user_survey_id"];
            $pass_survey_id = $_GET["pass_survey_id"];

            echo "U_survey:", $user_survey_id;
            echo "<br>";
            echo "P_survey:", $pass_survey_id;
            echo "<br>";
            echo "user id:", $user_id;
            echo "<br>";

            echo "<a class='last_btn' href='confirm.php?user_survey_id=".$user_survey_id."&pass_survey_id=".$pass_survey_id."'>Pay & Confirm</a>";
        
        ?>
    </main>
</body>
</html>
