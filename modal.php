<?php
    $conn=mysqli_connect("db.luddy.indiana.edu","i494f22_team06","my+sql=i494f22_team06","i494f22_team06");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    if (isset($_GET['id'])) {
        $eventId = $_GET['id'];
        $sql = "SELECT * FROM SURVEY WHERE SurveyID = '$eventId'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $event = $result->fetch_assoc();
            echo "<h2>" . $event['trip_date'] . "</h2>";
            echo "<p>Start City: " . $event['start_city'] . "</p>";
            echo "<p>End City: " . $event['end_city'] . "</p>";
            echo "<p>Passenger: " . $event['PassengerID'] . "</p>";
            echo "<a class='last_btn' href='payment.php?user_survey_id=".$user_survey_id."&pass_survey_id=".$pass_survey_id."'>Pay & Confirm</a>";
        }
    }
?>