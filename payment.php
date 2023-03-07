<?php 
    session_start();
    include_once 'paymentconfig.php';

    $conn = mysqli_connect("db.luddy.indiana.edu", "i494f22_team06", "my+sql=i494f22_team06", "i494f22_team06");
                if (!$conn) {
                    die("Failed to connect to MySQL: " . mysqli_connect_error());
                } else {
                    
                }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment</title>
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;500;700&family=Roboto:wght@100;400;700&display=swap" rel="stylesheet">
    <!-- icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- another icons -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <style> <?php include 'css/matching.css'; ?> </style>
    
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

</head>
<?php include 'includes/nav.php'; ?>
<body>
    <main>
        <?php
            $user_id = $_SESSION["id"];
            $user_survey_id = $_GET["user_survey_id"];
            $pass_survey_id = $_GET["pass_survey_id"];
            
            $_SESSION["user_survey_id"] = $user_survey_id;
            $_SESSION["pass_survey_id"] = $pass_survey_id;

            echo "U_survey:", $user_survey_id;
            echo "<br>";
            echo "P_survey:", $pass_survey_id;
            echo "<br>";
            echo "user id:", $user_id;
            echo "<br>";

            // echo "<a class='last_btn' href='confirm.php?user_survey_id=".$user_survey_id."&pass_survey_id=".$pass_survey_id."'>Pay & Confirm</a>";
        //Fetch products from the database
        $sql = "SELECT * FROM SURVEY WHERE SurveyID = '$user_survey_id' ";
        $results = $conn->query($sql);   
        while($row = $results->fetch_assoc()){
            ?>
            <div class="container">
                <div class="card">
                    <div class="body">
                        <h6>Price: <?php echo '$'.$row['price'].' '.PAYPAL_CURRENCY; ?></h6>
                        <!-- Paypal payment form for displaying the buy button -->
                        <form action="<?php echo PAYPAL_URL; ?>" method="POST">
                            <!-- Identify your bussiness so that you can collect the payment -->
                            <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">
                            <!-- Specify a buy now button -->
                            <input type="hidden" name="cmd" value="_xclick">
                            <input type="hidden" name="item_name" value="<?php echo $row['SurveyID']; ?>">
                            <input type="hidden" name="item_number" value="<?php echo $row['Distance']; ?>">
                            <input type="hidden" name="amount" value="<?php echo $row['price']; ?>">
                            <!-- Specify details about the item that buyers will purchase -->
                            <input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>">
                            <!-- Specify URLs -->
                            <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">
                            <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">
                            <!-- Display the payment button -->
                            <input type="image" name="submit" style="border:0;" src="https://paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif">
                        </form>
                    </div>
                </div>
                <?php
            }
        ?>
    </div>
    </main>
</body>
</html>
