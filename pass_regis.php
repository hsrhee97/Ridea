<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style> <?php include 'css/styles.css'; ?> </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter&display=swap" rel="stylesheet">

    <title>Document</title>
</head>

<body>
    <main class = "registration">           
        <div class = "reg_line">

            <h2 class="reg_h2">Registration Form</h2>
            <div class = "registration">
                <?php
                    $login = $_SESSION['username'];
                    if (isset($_POST['registration_submit'])){ 
                        $con=mysqli_connect("db.luddy.indiana.edu","i494f22_rheeh","my+sql=i494f22_rheeh","i494f22_rheeh");

                        if (mysqli_connect_errno())

                        { die("Failed to connect to MySQL: " . mysqli_connect_error()); }

                        else


                        
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {

                            $fname_error = $lname_error = $email_error = $password_error = $gender_error = $exist_error =  "";

                            //fname error check
                            if (empty($_POST["fname"])) {
                                $fname_error = "First Name is required!";
                            }
                            else {
                                $varfname = mysqli_real_escape_string($con, $_POST['fname']);
                            }

                            //lanme error check
                            if (empty($_POST["lname"])) {
                                $lname_error = "Last Name is required!";
                            }
                            else {
                                $varlname = mysqli_real_escape_string($con, $_POST['lname']);
                            }

                            //email error check
                            if (empty($_POST["email"])) {
                                $email_error = "Email is required!";
                                
                            }
                            else {
                                $varemail = mysqli_real_escape_string($con, $_POST['email']);
                                if (!filter_var($varemail, FILTER_VALIDATE_EMAIL)) {
                                    $email_error = "Invalid email format!";
                                }
                            }

                            //password error check
                            if (empty($_POST["password"])) {
                                $password_error = "Password is required!";
                            }
                            else {
                                $varpassword = mysqli_real_escape_string($con, $_POST['password']);
                                if(mb_strlen($varpassword)<8){
                                    $password_error = "Password should be more than 8 letters!";
                                }        
                            }

                            //gender error check
                            if (empty($_POST["gender"])) {
                                $gender_error = "Gender is required!";
                            }
                            else {
                                $vargender = mysqli_real_escape_string($con, $_POST['gender']);
                            }
                            

                            if (empty($_POST["fname"]) OR empty($_POST["lname"]) OR empty($_POST["email"]) OR empty($_POST["gender"]) OR !filter_var($varemail, FILTER_VALIDATE_EMAIL) OR empty($_POST["password"]) OR mb_strlen($varpassword)<8) {

                            }
                            else{
                                $email_n = "SELECT * from users where users.email='$varemail'";
                                $sql_email = mysqli_query($con, $email_n);

                                if(mysqli_num_rows($sql_email)>0) {
                                    $email_error = "This email is already registered!";
                                }
                                else {
                                    mysqli_query($con,("INSERT INTO users (fname, lname, email, password, gender) VALUES ('$varfname', '$varlname', '$varemail', PASSWORD('$varpassword'),'$vargender')"));
                                    echo ("<script>alert('You have been registered!')</script>");
                                }
            
                                mysqli_close($con);
                            }
                            
                        }
                    }


                ?>
                <form class = "registration_form" method="post">

                    <span class="reg_form">First Name:</span> 
                    <input class="reg_box" type='text' name = "fname" size="40">
                    <span class="error_message">* <br> <?php echo $fname_error;?> </span> 
                    <br> 

                    <span class="reg_form">Last Name: </span>
                    <input class="reg_box" type='text' name = "lname" size="40">
                    <span class="error_message">* <br> <?php echo $lname_error;?> </span> 
                    <br> 

                    <span class="reg_form">Email: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
                    <input class="reg_box" type='email' name = "email" size="40">
                    <span class="error_message">* <br> <?php echo $email_error;?> </span> 
                    <br>

                    <span class="reg_form">Password: &nbsp; </span>
                    <input class="reg_box" type='password' name = "password" size="40">
                    <span class="error_message">* <br> <?php echo $password_error;?> </span> 
                    <br>

                    <span class="reg_form">Phone Number: &nbsp; </span>
                    <input class="reg_box" type='phone' name = "phone" size="40">
                    <span class="error_message">* <br> <?php echo $phone_error;?> </span> 
                    <br>


                    <span class="reg_form">Gender: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <input type="radio" name="gender" value="Male"> Male
                    <input type="radio" name="gender" value="Female"> Female
                    <input type="radio" name="gender" value="Female"> Other
                    <span class="error_message">* <br> <?php echo $gender_error;?> </span> 
                    <br>

                    <input class="input_state" type="submit" name="registration_submit" value="Submit" style="float: right;"/> 

                </form>
            </div>
        </div>
    </main>
</body>
</html>