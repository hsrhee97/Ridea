<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style> <?php include 'css/style.css'; ?> </style>

    <title>RIDEA</title>
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;500;700&family=Roboto:wght@100;400;700&display=swap" rel="stylesheet">
    <!-- icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- another icons -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    

</head>

</head>

<body>
    <?php 
        $login = $_SESSION['login'];
        if(!$login) {
          ?>

            <nav>
            <a href="home.php" class="logo text-decoration-none"><i class="ri-car-line"></i><span>RIDEA</span></a>

                <div class="main">
                    <a href="loginform.php" class="user"><i class="ri-user-fill"></i>Sign in</a>
                    <a href="register1.php">Register</a>
                    <div class="bx bx-menu" id="menu-icon"></div>
                </div>
            </nav>
          <?
        }

        else{
            ?>

            <nav>
            <a href="home.php" class="logo"><i class="ri-car-line"></i><span>RIDEA</span></a>
                <ul class="navbar">
                    <li><a href="usersurvey.php">Schedule a Ride</a></li>
                    <li><a href="ride-history.php">My Rides</a></li>
                    <li><a href="calendar.php">Calendar</a></li>
                    <li><a href="help.php">Help</a></li>
                    <li><a href="chat_before.php">Chat</a></li>
                </ul>
                <div class="main">
                    <a href="profile.php" class="user"><i class="ri-user-fill"></i>My Profile</a>
                    <a href="logout.php" class="user"><i class="ri-logout-box-r-line"></i>Log Out</a>
                </div>
            </nav>
            <?
        }
    ?>


    <script> <?php include 'js/site.js'; ?> </script>
</body>
</html>