<?php 
    session_start();
?>

<div class='table'>
            <?php
            $conn = mysqli_connect("db.luddy.indiana.edu", "i494f22_team06", "my+sql=i494f22_team06", "i494f22_team06");
            if (!$conn) {
                die("Failed to connect to MySQL: " . mysqli_connect_error());
            } else {
                echo 'done';
            }
?>
<!-- /*             $type = $_SESSION['type'];
            $email = $_SESSION['login'];
            $ID = ''

            if ($type =='driver') {
                
                $sql = "SELECT * FROM DRIVER WHERE email='$email'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $ID = $row["DriverID"];
                    echo "id: " . $row["DriverID"]. " - Name: " 
                        . $row["fname"]. " " . $row["lname"]. "<br>";
                    }

                $driver_name = "SELECT fname, lname FROM DRIVER WHERE DriverID = $ID"
                $sql = "SELECT TripID, $driver_name, Start_location, End_location, Distance, Date FROM TRIP WHERE "
            } */
             -->
            