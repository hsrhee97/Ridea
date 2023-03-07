<?php
    session_start();
    $login = $_SESSION['login'];
    if (!isset($login)) {
    header('Location: home.php');
    exit;
    }
?>
<?php
    $other_surID = $_GET['survey_id'];
    $other_pass_id = $_GET['pass_survey_id'];
    echo $other_surID;
    if (isset($other_surID)) {
        $conn=mysqli_connect("db.luddy.indiana.edu","i494f22_team06","my+sql=i494f22_team06","i494f22_team06");
    
        // Get the survey data from the original survey
        // Get the survey data from the original survey
        $sql = "SELECT PassengerID, start_address, start_city, end_address, end_city, trip_date, other, Distance, price FROM SURVEY WHERE SurveyID = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, 'i', $other_surID);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $passenger_id, $start_address, $start_city, $end_address, $end_city, $trip_date, $other, $distance, $price);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
        }

        // Insert the copied survey data with new survey ID
        $sql = "INSERT INTO SURVEY (PassengerID, start_address, start_city, end_address, end_city, trip_date, other, Distance, price) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, 'issssssdd', $other_pass_id, $start_address, $start_city, $end_address, $end_city, $trip_date, $other, $distance, $price);
            mysqli_stmt_execute($stmt);
            $new_survey_id = mysqli_insert_id($conn);
            mysqli_stmt_close($stmt);
        }

        // Redirect to payment page with new survey ID
        header("Location: payment.php?user_survey_id=".$new_survey_id."&pass_survey_id=".$other_surID);
        $conn->close();
        exit();
    }
    

    if (isset($_POST['survey_submit'])){ 
        $passenger_id = $_SESSION['id'];
        $start_address = $_POST['start_point'];
        $start_city = $_POST['city_start'];
        $end_address = $_POST['destination'];
        $end_city = $_POST['city_end'];
        $luggage = $_POST['luggage'];
        $trip_date = $_POST['date'];
        $other = $_POST['other'];
        $distance = $_POST['distance'];
        $price = $_POST['price'];

        $conn=mysqli_connect("db.luddy.indiana.edu","i494f22_team06","my+sql=i494f22_team06","i494f22_team06");

        
        

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO SURVEY (PassengerID, start_address, start_city, end_address, end_city, trip_date, other, Distance, price) 
        VALUES  (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {

            mysqli_stmt_bind_param($stmt, 'issssssdd', $passenger_id, $start_address, $start_city, $end_address, $end_city, $trip_date, $other, $distance, $price);
            if (mysqli_stmt_execute($stmt)) {
                echo ("<script>alert('You have scheduled the trip')</script>");
                echo("<script>location.replace('matching.php');</script>");
              } 
              else {

              }
        }

        $conn->close();
    }
?>