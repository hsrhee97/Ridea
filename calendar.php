    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>RIDEA</title>
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;500;700&family=Roboto:wght@100;400;700&display=swap" rel="stylesheet">
    <!-- icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- another icons -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <style>  <?php include 'css/calendar.css'; ?>  </style>
    
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

</head>

<body>
    <?php
        $conn=mysqli_connect("db.luddy.indiana.edu","i494f22_team06","my+sql=i494f22_team06","i494f22_team06");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        // Set locale to English
        setlocale(LC_TIME, 'en_US.utf8');

        // Today's date
        $today = strftime('%B %d, %Y');

        // Year and month calculation
        if (isset($_GET['ym'])) {
            $ym = $_GET['ym'];
        } else {
            $ym = date('Y-m');
        }

        // Current year and month, previous and next year and month calculation
        $timestamp = strtotime($ym . '-01');
        $title = strftime('%Y %B', $timestamp);
        $prev = date('Y-m', strtotime('-1 month', $timestamp));
        $next = date('Y-m', strtotime('+1 month', $timestamp));

        // First and last day of the month calculation
        $first_day = date('w', $timestamp);
        $last_day = date('t', $timestamp);

        // Calendar output preparation
        $weeks = array();
        $week = '';

        // If the first week is empty
        $week .= str_repeat('<td></td>', $first_day);

        for ($day = 1; $day <= $last_day; $day++, $first_day++) {
            $date = $ym . '-' . $day;
            $sql = "SELECT * FROM SURVEY WHERE trip_date = '$date'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $event = $result->fetch_assoc();
                $week .= '<td class="event">' . $day . '<br>SurveyID = ' . $event['SurveyID'] . '</td>';
            } else {
                $week .= '<td>' . $day . '</td>';
            }

            // If it is the last day of the week, add the week and reset
            if ($first_day % 7 == 6 || $day == $last_day) {
                if ($day == $last_day) {
                    $week .= str_repeat('<td></td>', 6 - ($first_day % 7));
                }
                $weeks[] = '<tr>' . $week . '</tr>';
                $week = '';
            }
        }
    ?>
    <?php include 'includes/nav.php'; ?>

    <div class="calendar">
        <div class="header">
        <?php echo "<a href='calendar.php?ym=" . $prev . "'>&lt;</a> " . $title . " <a href='calendar.php?ym=" . $next . "'>&gt;</a>"; ?>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>SUN</th>
                    <th>MON</th>
                    <th>TUE</th>
                    <th>WED</th>
                    <th>THU</th>
                    <th>FRI</th>
                    <th>SAT</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($weeks as $week) {
                        echo $week;
                    }
                ?>
            </tbody>
        </table>
    </div>
    
</body>
</html>

