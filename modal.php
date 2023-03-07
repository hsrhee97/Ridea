<?php
    session_start();
    $login = $_SESSION['login'];
    if (!isset($login)) {
    header('Location: home.php');
    exit;
    }
?>
<?php
    $conn=mysqli_connect("db.luddy.indiana.edu","i494f22_team06","my+sql=i494f22_team06","i494f22_team06");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    if (isset($_GET['id'])) {
        $eventId = $_GET['id'];
        $sql = "SELECT SURVEY.*, PASSENGER.fname, PASSENGER.lname FROM SURVEY
                JOIN PASSENGER ON SURVEY.PassengerID = PASSENGER.PassengerID
                WHERE SurveyID = '$eventId'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $event = $result->fetch_assoc();
            echo "<h2>" . $event['trip_date'] . "</h2>";
            echo "<p>Start City: " . $event['start_city'] . "</p>";
            echo "<p>End City: " . $event['end_city'] . "</p>";
            echo "<p>Passenger: " . $event['fname'] . " " . $event['lname'] . "</p>";
            echo "<a class='last_btn' href='survey_insert.php?survey_id=".$event['SurveyID']."&pass_survey_id=".$event['PassengerID']."'>Reserve your spot</a>";
        }
    }
?>