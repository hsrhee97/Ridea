<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <style> <?php include 'css/styles.css'; ?> </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter&display=swap" rel="stylesheet">

    <title>Document</title>
</head>
<body>
    <main>
=======
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
>>>>>>> Woojin-Choi
        <?php 
            if (isset($_POST['login_submit'])){ 
                $con=mysqli_connect("db.luddy.indiana.edu","i494f22_rheeh","my+sql=i494f22_rheeh","i494f22_rheeh");

                if (mysqli_connect_errno())

                { die("Failed to connect to MySQL: " . mysqli_connect_error()); }

                else

                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                    $email_error = $password_error = $exist_error =  "";
                    //email error check
                    if (empty($_POST["login_email"])) {
                        $email_error = "Email is required!";                    
                    }
                    else {
                        $varemail = mysqli_real_escape_string($con, $_POST['login_email']);
                        if (!filter_var($varemail, FILTER_VALIDATE_EMAIL)) {
                            $email_error = "Invalid email format!";
                        }
                    }

                    //password error check
                    if (empty($_POST["login_password"])) {
                        $password_error = "Password is required!";
                    }
                    else {
                        $varpassword = mysqli_real_escape_string($con, $_POST['login_password']);
                        if(mb_strlen($varpassword)<8){
                            $password_error = "Password should be more than 8 letters!";
                        }        
                    }

                    if (empty($_POST["login_email"]) OR !filter_var($varemail, FILTER_VALIDATE_EMAIL) OR empty($_POST["login_password"]) OR mb_strlen($varpassword)<8) {

                    }
                    else{
                        $email_n = "SELECT * from users where users.email='$varemail'";
                        $sql_email = mysqli_query($con, $email_n);

                        $password_n = "SELECT * from users where users.password=PASSWORD('$varpassword')";
                        $sql_password = mysqli_query($con, $password_n);

                        if(mysqli_num_rows($sql_email)==0) {
                            $email_error = "This email is not registered! Use registration form to create an account.";
                        }
                        else {
                            if(mysqli_num_rows($sql_password)==0) {
                                $password_error = "This password is not registered! Use registration form to create an account.";
                            }
                            else{
                                $_SESSION['login'] = $varemail;
                                echo ("<script>alert('You have been Logged In!')</script>");
                                echo("<script>location.replace('main.php');</script>");
                                exit;
                            }
                        }
    
                    }

                }
            }
        ?>

    <section>
        <div class="imgbox">
            <img src="images/rocket.jpeg" alt="#">
            <div class="imagetext">
                <p>Do not Follow Where the path may lead.<br>Go instead where there is no path and leave a trail.<br><span>- Ralph Waldo Emerson</span></p>
            </div>
        </div>
        <div class="contentbox">
            <div class="formbox">
                <h2>LOGIN</h2>
                <form method="post">
                    <div class="inputbox">
                        <span>Email</span>
                        <input class="reg_box" type='email' name = "login_email" size="40">
                    </div>
                    <div class="inputbox">
                        <span>Password</span>
                        <input class="reg_box" type='password' name = "login_password" size="40">
                    </div>
                    <div class="inputbox">
                        <input class="input_state" type="submit" name="login_submit" value="Login"> 
                    </div>
                    <div class="inputbox">
                        <p>New to RIDEA? <a href="register1.php">Register</a></p>
                    </div>
                    </div>
                </form>
            </div>
    </section>

</body>
</html>


>>>>>>> Woojin-Choi
