<?php
    session_start();

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

        $_SESSION["pass_survey_id"] = $distance;

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