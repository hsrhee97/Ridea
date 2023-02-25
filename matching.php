<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
        <!-- google fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;500;700&family=Roboto:wght@100;400;700&display=swap" rel="stylesheet">
    <!-- icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- another icons -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <style> <?php include 'css/help.css'; ?> </style>
    
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<?php include 'includes/nav.php'; ?>

<body>
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
                    $match = array($user_row['PassengerID'], $schedules[$i]['PassengerID']);
                    $matches['same_all'][] = $match;
                // 날짜, 도착지, 출발지 중 두 개가 같은 경우

                } else if (($user_row['trip_date'] == $schedules[$i]['trip_date'] && $user_row['end_city'] == $schedules[$i]['end_city'])
                    || ($user_row['trip_date'] == $schedules[$i]['trip_date'] && $user_row['start_city'] == $schedules[$i]['start_city'])
                    || ($user_row['end_city'] == $schedules[$i]['end_city'] && $user_row['start_city'] == $schedules[$i]['start_city'])) {
                    // 매칭 결과를 matches 배열에 저장
                    if ($user_row['PassengerID'] == $schedules[$i]['PassengerID']) {
                        continue; // 동일한 유저 아이디인 경우 skip
                    }
                    $match = array($user_row['PassengerID'], $schedules[$i]['PassengerID']);
                    $matches['same_two'][] = $match;
                // 날짜, 도착지, 출발지 중 하나만 경우

                } else if($user_row['trip_date'] == $schedules[$i]['trip_date']
                    || $user_row['end_city'] == $schedules[$i]['end_city']
                    || $user_row['start_city'] == $schedules[$i]['start_city']) {
                    // 매칭 결과를 matches 배열에 저장
                    if ($user_row['PassengerID'] == $schedules[$i]['PassengerID']) {
                        continue; // 동일한 유저 아이디인 경우 skip
                    }
                    $match = array($user_row['PassengerID'], $schedules[$i]['PassengerID']);
                    $matches['same_one'][] = $match;

                } else {
                    $match = array($user_row['PassengerID'], $schedules[$i]['PassengerID']);
                    $matches['different_all'][] = $match;
                }
                
            }

            // printing out the results
            if (count($matches['same_all']) > 0) {
                echo "<h2>Cases where the date, destination, and departure are all the same</h2>";
                echo "<ul>";
                foreach ($matches['same_all'] as $match) {
                    echo "<li> You could match with {$match[1]}</li>";
                }
                echo "</ul>";
            }
            else {
                echo "<h2>Cases where the date, destination, and departure are all the same</h2>";
                echo "There are no cases where the date, destination, and origin are all the same.";
            }

            if (count($matches['same_two']) > 0) {
                echo "<h2>When two of the following match: date, destination, and departure</h2>";
                echo "<ul>";
                foreach ($matches['same_two'] as $match) {
                    echo "<li> You could match with {$match[1]}</li>";
                }
                echo "</ul>";
            }
            else {
                echo "<h2>When two of the following match: date, destination, and departure</h2>";
                echo "There are no cases where two of the date, destination, and origin are the same.";
            }

            if (count($matches['same_one']) > 0) {
                echo "<h2>Cases where one of the date, destination, or departure is the same.</h2>";
                echo "<ul>";
                foreach ($matches['same_one'] as $match) {
                    echo "<li> You could match with {$match[1]}</li>";
                }
                echo "</ul>";
            }
            else {
                echo "<h2>Cases where one of the date, destination, or departure is the same.</h2>";
                echo "There are no cases where one of the date, destination, and departure is the same.";
            }

            if (count($matches['different_all']) > 0) {
                echo "<h2>When the date, destination, and departure are all different</h2>";
                echo "There is no one to match.";
            }


        } else {
            echo "There is no one to match.";
        }

        mysqli_close($conn);
    ?>


</body>
</html>