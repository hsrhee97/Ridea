<?php
    session_start();
    $login = $_SESSION['login'];
    if (!isset($login)) {
    header('Location: home.php');
    exit;
    }
?>
 <?php

//Include Configuration File
include_once 'paymentconfig.php';

$user_id = $_SESSION["id"];
$user_survey_id = $_GET["user_survey_id"];
$pass_survey_id = $_GET["pass_survey_id"];

//Inlcude Database Connection File
$conn = mysqli_connect("db.luddy.indiana.edu", "i494f22_team06", "my+sql=i494f22_team06", "i494f22_team06");
            if (!$conn) {
                die("Failed to connect to MySQL: " . mysqli_connect_error());
            } else {
                
            }
//If Transaction Data is Available in the URL
if(!empty($_GET['item_name']) && !empty($_GET['txn_id']) && !empty($_GET['payment_gross']) && !empty($_GET['mc_currency']) && !empty($_GET['payment_status'])){
    //Get Transaction Information from URL
    $item_name = $_GET['item_name'];
    $item_name = intval($item_name);
    $txn_id = $_GET['txn_id'];
    $payment_gross = $_GET['payment_gross'];
    $currency_code = $_GET['mc_currency'];
    $payment_status = $_GET['payment_status'];

    //Include Configuration File
    include_once 'paymentconfig.php';
    $user_survey_id = $_SESSION["user_survey_id"];  
    $pass_survey_id = $_SESSION["pass_survey_id"];

    echo "U_survey:", $user_survey_id;
    echo "Hi";
    echo "<br>";
    echo "P_survey:", $pass_survey_id;
    echo "<br>";
    echo "user id:", $user_id;
    echo "<br>";
    //Inlcude Database Connection File
    $conn = mysqli_connect("db.luddy.indiana.edu", "i494f22_team06", "my+sql=i494f22_team06", "i494f22_team06");
                if (!$conn) {
                    die("Failed to connect to MySQL: " . mysqli_connect_error());
                } else {
                    
                }
    //If Transaction Data is Available in the URL

    if(!empty($_GET['item_name']) && !empty($_GET['txn_id']) && !empty($_GET['payment_gross']) && !empty($_GET['mc_currency']) && !empty($_GET['payment_status'])){
        //Get Transaction Information from URL
        $item_name = $_GET['item_name'];
        $item_name = intval($item_name);
        $txn_id = $_GET['txn_id'];
        $payment_gross = $_GET['payment_gross'];
        $currency_code = $_GET['mc_currency'];
        $payment_status = $_GET['payment_status'];
        // $user_survey_id = $_GET["user_survey_id"];
        // $pass_survey_id = $_GET["pass_survey_id"];


        //Get SURVEY infomation from the database
        $SURVEYResult = $conn->query("SELECT * FROM SURVEY WHERE SurveyID = '".$item_name."'");
        $SURVEYRow = $SURVEYResult->fetch_assoc();
        //Check if transaction data exists with the same TXN ID
        $prevPaymentResult = $conn->query("SELECT * FROM PAYMENT WHERE txn_id = '".$txn_id."'");
        if($prevPaymentResult->num_rows > 0){
            $paymentRow = $prevPaymentResult->fetch_assoc();
            $PaymentID = $paymentRow['PaymentID'];
            $payment_gross = $paymentRow['payment_gross'];
            $payment_status = $paymentRow['payment_status'];
            echo 'done';
        }else{
            //Insert transaction data into the database
            $insert = $conn->query("INSERT INTO PAYMENT(SurveyID, txn_id, payment_gross, currency_code, payment_status) VALUES('".$item_name."','".$txn_id."','".$payment_gross."','".$currency_code."','".$payment_status."')");
            $payment_id = $conn->insert_id;
            //echo $insert;
        }    

        header('Location: confirm.php');
        exit;

    }
    else {
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PayPal Payment Status</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="main">
            <div class="status">
            <?php if(!empty($payment_id)){ ?>
                    <h1 class="success">Your Payment has been successful</h1>
                    <h4>Payment Information</h4>
                    <p><b>Transaction ID:</b> <?php echo $txn_id; ?></p>
                    <p><b>Paid Amount:</b> <?php echo $payment_gross; ?></p>
                    <p><b>Payment Status:</b> <?php echo $payment_status; ?></p>
                <?php }else{ ?>
                    <h1 class="error">Your Payment has failed</h1>
                <?php } ?>
            </div>
            <?php echo "<a class='last_btn' href='confirm.php?user_survey_id=".$user_survey_id."&pass_survey_id=".$pass_survey_id."'>Go back</a>";?>
        </div>
    </div>
</body>
</html>









