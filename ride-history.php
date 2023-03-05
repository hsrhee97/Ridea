<!--OPEN AND CLOSE PHP TAG HERE 
    /* session_start();
    $r=session_id();
    
    $sql = "select * from TRIP";
    $result = mysqli_query($con, $sql);
    while($row = mysqli_fetch_array($result)) {
        echo print_r($row);
    } 
    $_SESSION['PassengerID']=$PassengerID;
    echo $PassengerID;
    echo "the session id: ".$r;
    echo " and the session has been registered for: ".$_SESSION['PassengerID']; */
 

/* UNCOMMENT THIS CODE NOT THE PREVIOUS ONE */
/*     session_start();
    $user_check=$_SESSION['login'];
    echo $user_check;
    $ses_sql=mysqli_query($con,"select Start_location, End_Location, PassengerID from TRIP where email='$user_check'");
    $row=mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
    $loggedin_session=$row['Start_location'];
    $loggedin_id=$row['login'];
    echo $loggedin_id */
-->
<?php 
    session_start();
?>
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

    <style> <?php include 'css/ride_history.css'; ?> </style>
    
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>

<body>

<?php include 'includes/nav.php'; ?>



<div class="contents">
    <div class="texts">
    <h2>My Ride <span>History</span></h2>
    <p>When and where did you create new memories with us?<br>Check out your ride history below!</p>
    </div>
</div>

<main>

<p class="activity"> Activity </p>

<form id="period_select" name="period_selection" method="POST">
    <select name="month" value=''>Select Month</option>
        <option value='01'>January</option>
        <option value='02'>February</option>
        <option value='03'>March</option>
        <option value='04'>April</option>
        <option value='05'>May</option>
        <option value='06'>June</option>
        <option value='07'>July</option>
        <option value='08'>August</option>
        <option value='09'>September</option>
        <option value='10'>October</option>
        <option value='11'>November</option>
        <option value='12'>December</option>
    </select>

    <select name="year" value=''>Select Year</option>
        <option value='2023'>2023</option>
        <option value='2022'>2022</option>
        <option value='2021'>2021</option>
        <option value='2020'>2020</option>
        <option value='2019'>2019</option>
        <option value='2018'>2018</option>
        <option value='2017'>2017</option>
        <option value='2016'>2016</option>
        <option value='2015'>2015</option>
        <option value='2014'>2014</option>
        <option value='2013'>2013</option>
        <option value='2012'>2012</option>
    </select>

  <button type="Submit" id="Submit" name="Submit">Submit</button>
</form>



<div class='table'>
            <?php
            $conn = mysqli_connect("db.luddy.indiana.edu", "i494f22_team06", "my+sql=i494f22_team06", "i494f22_team06");
            if (!$conn) {
                die("Failed to connect to MySQL: " . mysqli_connect_error());
            } else {
                
            }
            

            $type = $_SESSION['type'];
            $email = $_SESSION['login'];
            $ID = '';
        
            if ($type =='driver') {
                
                $sql = "SELECT * FROM DRIVER WHERE email='$email'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $ID = $row["DriverID"];
                    }

                    if (isset($_POST["Submit"])) {
                        $month=$_POST["month"];
                        $year=$_POST["year"];
                        $sql = "select * from TRIP WHERE month(Date) = $month and year(Date) = $year and DriverID = $ID" ;
                        $result = mysqli_query($conn, $sql);
                        $num_rows = mysqli_num_rows($result);
            
                        if ($num_rows > 0) {
                            echo "<table style='border:1px red; border-collapse: collapse; width:40%; border: solid 2px solid black;'>";
                            echo "<tr style='border:1px solid black;'><th>Start Location</th><th>End Location</th><th>Date</th>";
                            
                            while ($row = $result->fetch_assoc()) {
                                echo "<div class='box'>";
                                    echo "<div class='address'>";
                                        echo "<span>FROM</span>". "<span class='data'>". $row["Start_location"]."</span>";
                                        echo "<br><span>TO</span>". "<span class='data'>". $row["End_location"]."</span>";
                                        echo "<div class='datebox'>";
                                            echo $row["Date"];
                                        echo "</div>";
                                echo "<div class='btn-group'>";
                                echo "<a class='btn btn-warning'href='ride-details.php?TripID=".$row['TripID']."'>Ride Details</a>";
                                echo "<a class='btn btn-warning'href='help.php'>Ride Help</a>";
                                echo "<a class='btn btn-warning'href='review1.php?TripID=".$row['TripID']."'>Create a review</a>"; 
                                    echo "</div>";
                                echo "</div>";
                                
                                // div ending for box
                                echo "</div>";


                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "<div class='no-result-wrapper'>";
                            echo "<div class='no-result'>";
                            echo "<h2>Looks like you haven't taken a ride with us yet!</h2>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        $sql_check = "SELECT * FROM TRIP WHERE PassengerID = $ID  ORDER BY Date DESC";
                        $result_check = mysqli_query($conn, $sql_check);
                        $num_rows_check = mysqli_num_rows($result_check);

                        if ($num_rows_check > 0) {
                            while ($row = $result_check->fetch_assoc()) {
                                echo "<div class='box'>";
                                    echo "<div class='address'>";
                                        echo "<span>FROM</span>". "<span class='data'>". $row["Start_location"]."</span>";
                                        echo "<br><span>TO</span>". "<span class='data'>". $row["End_location"]."</span>";
                                        echo "<div class='datebox'>";
                                            echo $row["Date"];
                                        echo "</div>";
                                echo "<div class='btn-group'>";
                                echo "<a class='btn btn-warning'href='ride-details.php?TripID=".$row['TripID']."'>Ride Details</a>";
                                echo "<a class='btn btn-warning'href='help.php'>Ride Help</a>";
                                echo "<a class='btn btn-warning'href='review1.php?TripID=".$row['TripID']."'>Create a review</a>"; 
                                    echo "</div>";
                                echo "</div>";
                                
                                // div ending for box
                                echo "</div>";


                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<div class='no-result-wrapper'>";
                            echo "<div class='no-result'>";
                            echo "<h2>Looks like you haven't taken a ride with us yet!</h2>";
                            echo "</div>";
                            echo "</div>";
                        }
                    }
                  

                }            
            } 
            elseif ($type == 'passenger')
            { 
                $sql = "SELECT * FROM PASSENGER WHERE email='$email'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $ID = $row["PassengerID"];

                    }
                    if (isset($_POST["Submit"])) {
                        $month=$_POST["month"];
                        $year=$_POST["year"];
                        
                        $sql = "select * from TRIP WHERE month(Date) = $month and year(Date) = $year and PassengerID = $ID" ;
                        $result = mysqli_query($conn, $sql);
                        $num_rows = mysqli_num_rows($result);
            
                        if ($num_rows > 0) {
                            
                            while ($row = $result->fetch_assoc()) {
                                echo "<div class='box'>";
                                    echo "<div class='address'>";
                                        echo "<span>FROM</span>". "<span class='data'>". $row["Start_location"]."</span>";
                                        echo "<br><span>TO</span>". "<span class='data'>". $row["End_location"]."</span>";
                                        echo "<div class='datebox'>";
                                            echo $row["Date"];
                                        echo "</div>";
                                echo "<div class='btn-group'>";
                                echo "<a class='btn btn-warning'href='ride-details.php?TripID=".$row['TripID']."'>Ride Details</a>";
                                echo "<a class='btn btn-warning'href='help.php'>Ride Help</a>";
                                echo "<a class='btn btn-warning'href='review1.php?TripID=".$row['TripID']."'>Create a review</a>"; 
                                    echo "</div>";
                                echo "</div>";
                                
                                // div ending for box
                                echo "</div>";


                                echo "</td>";
                                echo "</tr>";
                            }

                        } else {
                            echo "<div class='no-result-wrapper'>";
                            echo "<div class='no-result'>";
                            echo "<h2>Looks like you haven't taken a ride with us yet!</h2>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        $sql_check = "SELECT * FROM TRIP WHERE PassengerID = $ID  ORDER BY Date DESC";
                        $result_check = mysqli_query($conn, $sql_check);
                        $num_rows_check = mysqli_num_rows($result_check);

                        if ($num_rows_check > 0) {
                            
                            while ($row = $result_check->fetch_assoc()) {
                                echo "<div class='box'>";
                                    echo $row["Start_location"];
                                    echo $row["End_location"];
                                    echo $row["Date"];
                                echo "<div class='btn-group'>";
                                echo "<a class='btn btn-warning'href='ride-details.php?TripID=".$row['TripID']."'>Ride Details</a>";
                                echo "<a class='btn btn-warning'href='review1.php?TripID=".$row['TripID']."'>Create a review</a>"; 
                                    echo "<div class='address-box'>";
                                        echo "<span>FROM</span>". "<span class='data'>". $row["Start_location"]."</span>";
                                        echo "<span>TO</span>". "<span class='data'>". $row["End_location"]."</span>";
                                            echo "<div class='datebox'>";
                                                echo $row["Date"];
                                            echo "</div>";

                                        echo "<a class='btn btn-warning'href='ride-details.php?TripID=".$row['TripID']."'>Ride Details</a>";

                                echo "</div>";
                                
                                // div ending for box
                                echo "</div>";


                                echo "</td>";
                                echo "</tr>";
                            }

                        } else {
                            echo "<div class='no-result-wrapper'>";
                            echo "<div class='no-result'>";
                            echo "<h2>Looks like you haven't taken a ride with us yet!</h2>";
                            echo "</div>";
                            echo "</div>";
                        }
                    }

                }
            }
?>

</main>


</body>
</html> 