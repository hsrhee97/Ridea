<?php
    $conn = mysqli_connect("db.luddy.indiana.edu","i494f22_team06","my+sql=i494f22_team06","i494f22_team06");
    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $user_type = $_POST['user_type'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        
        if($new_password != $confirm_password) {
            echo ("<script>alert('Password does not match')</script>");
            echo("<script>location.replace('reset_password.php');</script>");
            exit();
        }

        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        if($user_type == 'driver') {
            $sql_e = "SELECT COUNT(*) FROM DRIVER WHERE email='$email'";
            $result = mysqli_query($conn, $sql_e);
            $count = mysqli_fetch_array($result)[0];
            if($count == 0) {
                echo ("<script>alert('The user with the provided email and user type does not exist.')</script>");
                echo("<script>location.replace('reset_password.php');</script>");
                exit();
            }

            $sql = "UPDATE DRIVER SET password='$hashed_password' WHERE email='$email'";
        } 
        
        elseif($user_type == 'passenger') {
            $sql_e = "SELECT COUNT(*) FROM PASSENGER WHERE email='$email'";
            $result = mysqli_query($conn, $sql_e);
            $count = mysqli_fetch_array($result)[0];
            if($count == 0) {
                echo ("<script>alert('The user with the provided email and user type does not exist.')</script>");
                echo("<script>location.replace('reset_password.php');</script>");
                exit();
            }
            $sql = "UPDATE PASSENGER SET password='$hashed_password' WHERE email='$email'";
        } 
        
        else {
            echo ("<script>alert('Invalid user type.')</script>");
            echo("<script>location.replace('reset_password.php');</script>");
            exit();
        }

        mysqli_query($conn, $sql);
        echo ("<script>alert('The password has been reset successfully.')</script>");
        echo("<script>location.replace('home.php');</script>");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style> <?php include 'css/loginform.css'; ?> </style>
    
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

</head>
<body>
<section>
        <div class="imgbox">
            <img src="images/rocket.jpeg" alt="#">
            <div class="imagetext">
            </div>
        </div>
        <div class="contentbox">
            <div class="formbox">
                <h2>Reset Password</h2>
                <form method="post">

                <label>
                    <input type="radio" name="user_type" value="driver" required>
                    <span>Driver</span>
                </label>

                <label>
                    <input type="radio" name="user_type" value="passenger" required>
                    <span>Passenger</span>
                </label>

                    <div class="inputbox">
                        <span>Email</span>
                        <input class="reg_box" type='email' name="email" size="40" required>
                    </div>
                    <div class="inputbox">
                        <span>New Password</span>
                        <input class="reg_box" type='password' name="new_password" size="40" required>
                    </div>

                    <div class="inputbox">
                        <span>Confirm New Password</span>
                        <input class="reg_box" type='password' name="confirm_password" size="40" required>
                    </div>

                    <div class="inputbox">
                        <input class="input_state" type="submit" value="Reset Password"> 
                    </div>
                </form>
            </div>
        </div>
    </section>

</body>
</html>
