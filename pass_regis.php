<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;500;700&family=Roboto:wght@100;400;700&display=swap" rel="stylesheet">
    <!-- icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- another icons -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <style> <?php include 'css/register2.css'; ?> </style>
</head>
<body>
    <div class="ridea">
    <i class="ri-car-line"></i><span>RIDEA</span>
    </div>
        <div class="wrapper">
            <div class="title">
                Create account
            </div>
                <form method="POST">
                    <div class="inputbox">
                        <span>First name</span>
                        <input class="reg_box" type='email' name = "login_email">
                    </div>

                    <div class="inputbox">
                        <span>Last name</span>
                        <input class="reg_box" type='password' name = "login_password">
                    </div>

                    <div class="inputbox">
                        <span>Email</span>
                    <input class="reg_box" type='email' name = "email" >
                    </div>

                    <div class="inputbox">
                        <span>Password </span>
                    <input class="reg_box" type='password' name = "password" >
                    </div>

                    <div class="inputbox">
                        <input type="submit" value="Register" class="btn">
                      </div>
                </form>

        </div>
</body>
</html>