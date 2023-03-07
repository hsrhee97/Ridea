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
            Create passenger account
        </div>
        <?php
            $login = $_SESSION['username'];
            echo $login;
            if (isset($_POST['registration_submit'])){ 
                // $con=mysqli_connect("db.luddy.indiana.edu","i494f22_rheeh","my+sql=i494f22_rheeh","i494f22_rheeh");
                $con=mysqli_connect("db.luddy.indiana.edu","i494f22_team06","my+sql=i494f22_team06","i494f22_team06");

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

                    //address error check
                    if (empty($_POST["address"])) {
                        $address_error = "address is required!";
                    }
                    else {
                        $varaddress = mysqli_real_escape_string($con, $_POST['address']);
                    }

                    //phone error check
                    if (empty($_POST["phone"])) {
                        $phone_error = "Phone number is required!";
                    }
                    else {
                        $varphone = mysqli_real_escape_string($con, $_POST['phone']);
                    }



                    //biography error check
                    if (empty($_POST["biography"])) {
                        $biography_error = "Biography is required!";
                    }
                    else {
                        $varbiography = mysqli_real_escape_string($con, $_POST['biography']);
                    }

                    //credit card error check
                    // if (empty($_POST["card"])) {
                    //     $card_error = "Credit-card is required!";
                    // }
                    // else {
                    //     $varcard = mysqli_real_escape_string($con, $_POST['card']);
                    // }
                    

                    if (empty($_POST["fname"]) OR empty($_POST["lname"]) OR empty($_POST["address"]) OR empty($_POST["phone"]) OR empty($_POST["email"]) OR !filter_var($varemail, FILTER_VALIDATE_EMAIL) OR empty($_POST["password"]) OR mb_strlen($varpassword)<8 ) {

                    }
                    else{
                        $email_n = "SELECT * from PASSENGER where PASSENGER.email='$varemail'";
                        $sql_email = mysqli_query($con, $email_n);

                        if(mysqli_num_rows($sql_email)>0) {
                            $email_error = "This email is already registered!";
                        }
                        else {
                            mysqli_query($con,("INSERT INTO PASSENGER (fname, lname, address, phone, email, password, biography) VALUES ('$varfname', '$varlname', '$varaddress', '$varphone', '$varemail', PASSWORD('$varpassword'),'$varbiography')"));
                            echo ("<script>alert('You have been registered!')</script>");
                            echo("<script>location.replace('home.php');</script>");
                        }
    
                        mysqli_close($con);
                    }
                    
                }
            }
        ?>

        <form method="POST">
            <div class="inputbox">
                <span>First name</span>
                <input class="reg_box" type='text' name = "fname" placeholder="<?php echo $fname_error;?>">
            </div>

            <div class="inputbox">
                <span>Last name</span>
                <input class="reg_box" type='text' name = "lname" placeholder="<?php echo $lname_error;?>">
            </div>

            <div class="inputbox">
                <span>Email</span>
            <input class="reg_box" type='email' name = "email" placeholder="<?php echo $email_error;?>">
            </div>

            <div class="inputbox">
                <span>Password </span>
            <input class="reg_box" type='password' name = "password" placeholder="<?php echo $password_error;?>">
            </div>
            
            <div class="inputbox">
                <span>Address </span>
            <input class="reg_box" type='text' name = "address" size="40" placeholder="<?php echo $address_error;?>">
            </div>

            <div class="inputbox">
                <span>Phone</span>
            <input class="reg_box" type='tel' name = "phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" size="40" placeholder="<?php echo $phone_error;?>">
            </div>

            <div class="inputbox">
                <span>Biography</span>
            <input class="reg_box" type='text' name = "biography" size="40" placeholder="<?php echo $biography_error;?>">
            </div>

            <!-- <div class="inputbox">
                <span>Credit Card</span>
            <input class="reg_box" type='text' name = "card" size="40">
            </div> -->

            <div class="inputbox">
                <input type="submit" name="registration_submit" value="Register" class="btn">
            </div>
        </form>

    </div>
</body>
</html>