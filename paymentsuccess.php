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










