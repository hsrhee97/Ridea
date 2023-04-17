<?php
    session_start();
    $login = $_SESSION['login'];
    if (!isset($login)) {
    header('Location: home.php');
    exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help</title>

    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;500;700&family=Roboto:wght@100;400;700&display=swap" rel="stylesheet">
    <!-- icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- another icons -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <style>  <?php include 'css/help.css'; ?>  </style>
    
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

</head>

<body>

<?php include 'includes/nav.php'; ?>

<main>

    <div class="container">

        <div class="heading">
            <h2>RIDEA Customer Service</h2>
        </div>

        <div class="content_container">

        <div class="content" onclick="location.href='lostandfound.php';" style="cursor: pointer;">
        <div class="words">
            <p>Lost and Found</p>
            </div>
        </div>

        <div class="content" onclick="location.href='emergency.php';" style="cursor: pointer;">
        <div class="words">
            <p>Emergency</p>
            </div>
        </div>

        <div class="content" onclick="location.href='otherproblems.php';" style="cursor: pointer;">
        <div class="words">
            <p>Other Problems</p>
            </div>

        </div>
    </div>
    </div>

</main>
</body>
</html>



