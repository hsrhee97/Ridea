<?php
    session_start();
    $login = $_SESSION['login'];
    if (!isset($login)) {
    header('Location: home.php');
    exit;
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
            // $user_survey_id = $_GET["user_survey_id"];
            // $pass_survey_id = $_GET["pass_survey_id"];
            // confirm.php 파일
            $user_survey_id = $_SESSION["user_survey_id"];  
            $pass_survey_id = $_SESSION["pass_survey_id"];


            echo "U_survey:", $user_survey_id;
            echo "<br>";
            echo "P_survey:", $pass_survey_id;
            echo "<br>";
            echo "user id:", $user_id;
            echo "<br>";

            $conn = mysqli_connect("db.luddy.indiana.edu","i494f22_team06","my+sql=i494f22_team06","i494f22_team06");

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // USER
            $user_sql = "SELECT * FROM SURVEY WHERE SurveyID = $user_survey_id";
            $user_result = $conn->query($user_sql);

            if ($user_result->num_rows > 0) {
                while($user_row = $user_result->fetch_assoc()) {
                    $driver_id = 1;
                    $passenger_id = $user_row["PassengerID"];
                    $start_location = $user_row["start_address"] . ", " . $user_row["start_city"];
                    $end_location = $user_row["end_address"] . ", " . $user_row["end_city"];
                    $distance = $user_row["Distance"];
                    $date = $user_row["trip_date"];

                    $sql_insert = "INSERT INTO TRIP (DriverID, PassengerID, Start_location, End_location, Distance, Date)
                    VALUES ('$driver_id', '$passenger_id', '$start_location', '$end_location', '$distance', '$date')";

                    if ($conn->query($sql_insert) === TRUE) {
                        echo "Record moved to trip";
                    } else {
                        echo "Error: " . $sql_insert . "<br>" . $conn->error;
                    }
                }

                $sql_delete = "DELETE FROM SURVEY WHERE SurveyID = $user_survey_id";
                if ($conn->query($sql_delete) === TRUE) {
                    echo "Record deleted from survey";
                } else {
                    echo "Error: " . $sql_delete . "<br>" . $conn->error;
                }
            } else {
                echo "0 results";
            }


            //passenger
            $pass_sql = "SELECT * FROM SURVEY WHERE SurveyID = $pass_survey_id";
            $pass_result = $conn->query($pass_sql);

            if ($pass_result->num_rows > 0) {
                while($pass_row = $pass_result->fetch_assoc()) {
                    //임시 드라이버
                    $p_driver_id = 1; 
                    $p_passenger_id = $pass_row["PassengerID"];
                    $p_start_location = $pass_row["start_address"] . ", " . $pass_row["start_city"];
                    $p_end_location = $pass_row["end_address"] . ", " . $pass_row["end_city"];
                    $p_distance = $pass_row["Distance"]; 
                    $p_date = $pass_row["trip_date"];

                    $p_sql_insert = "INSERT INTO TRIP (DriverID, PassengerID, Start_location, End_location, Distance, Date)
                    VALUES ('$p_driver_id', '$p_passenger_id', '$p_start_location', '$p_end_location', '$p_distance', '$p_date')";

                    if ($conn->query($p_sql_insert) === TRUE) {
                        echo "passenger record moved to trip";
                    } else {
                        echo "Error: " . $p_sql_insert . "<br>" . $conn->error;
                    }
                }

                $p_sql_delete = "DELETE FROM SURVEY WHERE SurveyID = $pass_survey_id";

                if ($conn->query($p_sql_delete) === TRUE) {
                    echo "passenger record deleted from survey";
                } else {
                    echo "Error: " . $p_sql_delete . "<br>" . $conn->error;
                }
            } else {
                echo "0 results";
            }

            $chat_sql_insert = "INSERT INTO CHAT (SenderID, ReceiverID, message) VALUES ('$passenger_id', '$p_passenger_id', '')";

            if ($conn->query($chat_sql_insert) === TRUE) {
                unset($_SESSION["user_survey_id"]); // user_survey_id 변수 삭제
                unset($_SESSION["pass_survey_id"]); // pass_survey_id 변수 삭제
                echo ("<script>alert('Now you can start the CHAT!')</script>");
                echo("<script>location.replace('chat_before.php');</script>");
                exit;
            } else {
                echo "Error: " . $chat_sql_insert . "<br>" . $conn->error;
            }
            $conn->close();
        ?>
    </main>
</body>
</html>
