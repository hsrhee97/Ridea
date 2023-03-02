<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

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
<body>

<?php include 'includes/nav.php'; ?>

<main>
    <?php
        $ID = $_SESSION['id'];
        $conn=mysqli_connect("db.luddy.indiana.edu","i494f22_team06","my+sql=i494f22_team06","i494f22_team06");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        // 여행 일정 조회
        $sql = "SELECT * FROM SURVEY";
        $result = mysqli_query($conn, $sql);

        $user_sql = "SELECT * FROM SURVEY ORDER BY SurveyID DESC LIMIT 1";
        $user_result = mysqli_query($conn, $user_sql);

        if (mysqli_num_rows($user_result) > 0) {
            // 결과를 처리
            $user_row = mysqli_fetch_assoc($user_result);
            // $row 변수에는 마지막으로 저장된 데이터가 저장됩니다.
        } 
        else {

        }
        
        if (mysqli_num_rows($result) > 1) { // 일정이 2개 이상인 경우에만 매칭 수행
            $schedules = array(); // 여행 일정을 저장할 배열
            while($row = mysqli_fetch_assoc($result)) {
                $schedules[] = $row; // 일정을 배열에 추가
            }
        
            $matches = array(); // 매칭 결과를 저장할 배열
            for ($i = 0; $i < count($schedules) - 1; $i++) {
                    // 날짜, 도착지, 출발지가 모두 같은 경우
                if ($user_row['trip_date'] == $schedules[$i]['trip_date']
                    && $user_row['end_city'] == $schedules[$i]['end_city']
                    && $user_row['start_city'] == $schedules[$i]['start_city']) {
                    // 매칭 결과를 matches 배열에 저장
                    if ($user_row['PassengerID'] == $schedules[$i]['PassengerID']) {
                        continue; // 동일한 유저 아이디인 경우 skip
                    }
                    $match = array($user_row['PassengerID'], $schedules[$i]['PassengerID'], $schedules[$i]['SurveyID']);
                    $matches['same_all'][] = $match;
                // 날짜, 도착지, 출발지 중 두 개가 같은 경우

                } else if (($user_row['trip_date'] == $schedules[$i]['trip_date'] && $user_row['end_city'] == $schedules[$i]['end_city'])
                    || ($user_row['trip_date'] == $schedules[$i]['trip_date'] && $user_row['start_city'] == $schedules[$i]['start_city'])
                    || ($user_row['end_city'] == $schedules[$i]['end_city'] && $user_row['start_city'] == $schedules[$i]['start_city'])) {
                    // 매칭 결과를 matches 배열에 저장
                    if ($user_row['PassengerID'] == $schedules[$i]['PassengerID']) {
                        continue; // 동일한 유저 아이디인 경우 skip
                    }
                    $match = array($user_row['PassengerID'], $schedules[$i]['PassengerID'], $schedules[$i]['SurveyID']);
                    $matches['same_two'][] = $match;
                // 날짜, 도착지, 출발지 중 하나만 경우

                } else if($user_row['trip_date'] == $schedules[$i]['trip_date']
                    || $user_row['end_city'] == $schedules[$i]['end_city']
                    || $user_row['start_city'] == $schedules[$i]['start_city']) {
                    // 매칭 결과를 matches 배열에 저장
                    if ($user_row['PassengerID'] == $schedules[$i]['PassengerID']) {
                        continue; // 동일한 유저 아이디인 경우 skip
                    }
                    $match = array($user_row['PassengerID'], $schedules[$i]['PassengerID'], $schedules[$i]['SurveyID']);
                    $matches['same_one'][] = $match;

                } else {
                    $match = array($user_row['PassengerID'], $schedules[$i]['PassengerID'], $schedules[$i]['SurveyID']);
                    $matches['different_all'][] = $match;
                }
                
            }

            // printing out the results
            $user_survey_id = $user_row['SurveyID'];

            if (count($matches['same_all']) > 0) {
                echo "<h2 class='header'>Looks like we found your perfect match! </h2>";
                echo "<div class='row'>";
                foreach ($matches['same_all'] as $match) {
                    $pass_ID = $match[1];
                    $survey_id = $match[2];

                    $pass_sql = "SELECT CONCAT(p.fname, ' ', p.lname) AS Name, s.start_city , s.end_city, s.trip_date AS Date, p.biography AS Bio
                    FROM PASSENGER p 
                    JOIN SURVEY s ON p.PassengerID = s.PassengerID
                    WHERE s.SurveyID = $survey_id";

                    $pass_result = mysqli_query($conn, $pass_sql);
                    $pass_data = mysqli_fetch_assoc($pass_result);

                    echo "<div class='box'>";
                        echo "<p> <span class='data'>{$pass_data['start_city']}</span> TO <span class='data'>{$pass_data['end_city']}</span></p>";
                        echo "<p>Date: {$pass_data['Date']}</p>";
                        echo "<p> Name: {$pass_data['Name']}</p>";
                        echo "<p>Bio: {$pass_data['Bio']}</p>";
                        echo "<a class='btn btn-warning' href='payment.php?user_survey_id=".$user_survey_id."&pass_survey_id=".$survey_id."'>Confirm</a>";
                    echo "</div>";
                }
                echo "</div>";
            }
            else {
                echo "<h2>Cases where one of the date, destination, or departure is the same.</h2>";
                echo "<p class='ask_book'> There are no cases where all of the date, destination, and origin are the same. </p>";
            }
            
            //for two equls
            if (count($matches['same_two']) > 0) {
                echo "<h2 class='header'>Two of your search criteria have been matched with the users below!</h2>";
                echo "<div class='row'>";
                foreach ($matches['same_two'] as $match) {
                    $pass_ID = $match[1];
                    $survey_id = $match[2];

                    $pass_sql = "SELECT CONCAT(p.fname, ' ', p.lname) AS Name, s.start_city , s.end_city, s.trip_date AS Date, p.biography AS Bio
                    FROM PASSENGER p 
                    JOIN SURVEY s ON p.PassengerID = s.PassengerID
                    WHERE s.SurveyID = $survey_id";

                    $pass_result = mysqli_query($conn, $pass_sql);
                    $pass_data = mysqli_fetch_assoc($pass_result);

                    echo "<div class='box'>";
                        echo "<p> <span class='data'>{$pass_data['start_city']}</span> TO <span class='data'>{$pass_data['end_city']}</span></p>";
                        echo "<p>Date: {$pass_data['Date']}</p>";
                        echo "<p> Name: {$pass_data['Name']}</p>";
                        echo "<p>Bio: {$pass_data['Bio']}</p>";
                        echo "<a class='btn btn-warning' href='payment.php?user_survey_id=".$user_survey_id."&pass_survey_id=".$survey_id."'>Confirm</a>";
                    echo "</div>";
                }
                echo "</div>";
            }
            else {
                // echo "<h2>When two of the following match: date, destination, and departure</h2>";
                // echo "There are no cases where two of the date, destination, and origin are the same.";
                echo "<h2>Cases where one of the date, destination, or departure is the same.</h2>";
                echo "<p class='ask_book'> There are no cases where two of the date, destination, and origin are the same. </p>";
            }

            //for one equal
            if (count($matches['same_one']) > 0) {
                echo "<h2 class='header'>One of your search criteria have been matched with the users below!</h2>";
                echo "<div class='row'>";
                foreach ($matches['same_one'] as $match) {
                    $pass_ID = $match[1];
                    $survey_id = $match[2];

                    $pass_sql = "SELECT CONCAT(p.fname, ' ', p.lname) AS Name, s.start_city , s.end_city, s.trip_date AS Date, p.biography AS Bio
                    FROM PASSENGER p 
                    JOIN SURVEY s ON p.PassengerID = s.PassengerID
                    WHERE s.SurveyID = $survey_id";

                    $pass_result = mysqli_query($conn, $pass_sql);
                    $pass_data = mysqli_fetch_assoc($pass_result);

                    echo "<div class='box'>";
                        echo "<p> <span class='data'>{$pass_data['start_city']}</span> TO <span class='data'>{$pass_data['end_city']}</span></p>";
                        echo "<p>Date: {$pass_data['Date']}</p>";
                        echo "<p> Name: {$pass_data['Name']}</p>";
                        echo "<p>Bio: {$pass_data['Bio']}</p>";
                        echo "<a class='btn btn-warning' href='payment.php?user_survey_id=".$user_survey_id."&pass_survey_id=".$survey_id."'>Confirm</a>";
                    echo "</div>";
                }
                echo "</div>";
            }
            else {
                echo "<h2>Cases where one of the date, destination, or departure is the same.</h2>";
                echo "<p class='ask_book'> There are no cases where one of the date, destination, and departure is the same. </p>";
            }

            //None
            if (count($matches['different_all']) > 0) {
                echo "<p class='ask_book'>You can still proceed with the booking even if there are no matching results for your search criteria</p>";

                echo "<a class='last_btn'href='calendar.php?TripID=".$row['TripID']."'>Book for future trip</a>";
            }


        } else {
            echo "<p class='ask_book'>There are no cases. You can still proceed with the booking even if there are no matching results for your search criteria</p>";
            echo "<a class='last_btn'href='calendar.php?TripID=".$row['TripID']."'>Book for future trip</a>";
        }

        mysqli_close($conn);
    ?>
</main>

</body>
</html>