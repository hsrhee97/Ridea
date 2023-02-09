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
                    echo $login;
                    if (isset($_POST['registration_submit'])){ 
                        $con=mysqli_connect("db.luddy.indiana.edu","i494f22_rheeh","my+sql=i494f22_rheeh","i494f22_rheeh");

                        if (mysqli_connect_errno())

                        { die("Failed to connect to MySQL: " . mysqli_connect_error()); }

                        else


                        
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {

                            $fname_error = $lname_error = $address_error = $phone_error = $email_error = $password_error = $biography_error = $card_error  =  "";

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

                            //address error check
                            if (empty($_POST["address"])) {
                                $address_error = "address is required!";
                            }
                            else {
                                $varaddress = mysqli_real_escape_string($con, $_POST['address']);
                            }

                            //phone error check
                            if (empty($_POST["phone"])) {
                                $phone_error = "Phone is required!";
                            }
                            else {
                                $varphone = mysqli_real_escape_string($con, $_POST['phone']);
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

                            //biography error check
                            if (empty($_POST["biography"])) {
                                $biography_error = "Biography is required!";
                            }
                            else {
                                $varbiography = mysqli_real_escape_string($con, $_POST['biography']);
                            }

                            //credit card error check
                            if (empty($_POST["card"])) {
                                $card_error = "Credit-card is required!";
                            }
                            else {
                                $varcard = mysqli_real_escape_string($con, $_POST['card']);
                            }
                            

                            if (empty($_POST["fname"]) OR empty($_POST["lname"]) OR empty($_POST["address"]) OR empty($_POST["phone"]) OR empty($_POST["email"]) OR !filter_var($varemail, FILTER_VALIDATE_EMAIL) OR empty($_POST["password"]) OR mb_strlen($varpassword)<8 OR empty($_POST["card"])) {

                            }
                            else{
                                $email_n = "SELECT * from PASSENGER where PASSENGER.email='$varemail'";
                                $sql_email = mysqli_query($con, $email_n);

                                if(mysqli_num_rows($sql_email)>0) {
                                    $email_error = "This email is already registered!";
                                }
                                else {
                                    mysqli_query($con,("INSERT INTO PASSENGER (fname, lname, address, phone, email, password, biography, credit_card) VALUES ('$varfname', '$varlname', '$varaddress', '$varphone', '$varemail', PASSWORD('$varpassword'),'$varbiography' ,'$varcard')"));
                                    echo ("<script>alert('You have been registered!')</script>");
                                    echo("<script>location.replace('home_afterlogin.php');</script>");
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

                    <span class="reg_form">Address: </span>
                    <input class="reg_box" type='text' name = "address" size="40">
                    <span class="error_message">* <br> <?php echo $address_error;?> </span> 
                    <br> 

                    <span class="reg_form">Phone: </span>
                    <input class="reg_box" type='tel' name = "phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" size="40">
                    <span class="error_message">* <br> <?php echo $phone_error;?> </span> 
                    <br> 

                    <span class="reg_form">Email: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
                    <input class="reg_box" type='email' name = "email" size="40">
                    <span class="error_message">* <br> <?php echo $email_error;?> </span> 
                    <br>

                    <span class="reg_form">Password: &nbsp; </span>
                    <input class="reg_box" type='password' name = "password" size="40">
                    <span class="error_message">* <br> <?php echo $password_error;?> </span> 
                    <br>

                    <span class="reg_form">Biography: </span>
                    <input class="reg_box" type='text' name = "biography" size="40">
                    <span class="error_message">* <br> <?php echo $biography_error;?> </span> 
                    <br> 

                    <span class="reg_form">Credit Card: </span>
                    <input class="reg_box" type='text' name = "card" size="40">
                    <span class="error_message">* <br> <?php echo $card_error;?> </span> 
                    <br> 


                    <input class="input_state" type="submit" name="registration_submit" value="Submit" style="float: right;"/> 

                </form>
            </div>
        </div>
    </main>
</body>
</html>