<?php 
    session_start();
?>

<div class='table'>
<?php
            $row_details = $_POST['row_details'];

            $conn = mysqli_connect("db.luddy.indiana.edu", "i494f22_team06", "my+sql=i494f22_team06", "i494f22_team06");
            if (!$conn) {
                die("Failed to connect to MySQL: " . mysqli_connect_error());
            } else {
                echo 'done';
            }

            $type = $_SESSION['type'];
            $email = $_SESSION['login'];
            $ID = '';
            $TripID = 0 ;
            $passenger_name ='';
            $driver_name ='';

            echo $type;
            echo $email;
            
            if ($type =='driver') {
                $TripID = $_GET['TripID'];
                echo $TripID;
                $sql = "SELECT * FROM DRIVER WHERE email='$email'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $ID = $row["DriverID"];
                    echo "id: " . $row["DriverID"]. " - Name: " 
                        . $row["fname"]. " " . $row["lname"]. "<br>";
                    }

                $passenger_name = "SELECT fname, lname FROM PASSENGER WHERE PassengerID = $ID";
                $sql = "SELECT TripID, $passenger_name, Start_location, End_location, Distance, Date FROM TRIP WHERE TripID = $TripID";
                $result = mysqli_query($conn, $sql);
                $num_rows = mysqli_num_rows($result);
            
                if ($num_rows > 0) {
                    echo "<table style='border:1px red; border-collapse: collapse; width:40%; border: solid 2px solid black;'>";
                    echo "<tr style='border:1px solid black;'><th>TripID</th><th>Passenger Name</th><th>PassengerID</th><th>Start Location</th><th>End Location</th><th>Distance</th><th>Date</th>";
                
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr style='border:1px solid black;'>";
                        echo "<td>" . $row["TripID"] . "</td>";
                        echo "<td>" . $row["$passenger_name"] . "</td>";
                        echo "<td>" . $row["PassengerID"] . "</td>";
                        echo "<td>" . $row["Start_location"] . "</td>";
                        echo "<td>" . $row["End_location"] . "</td>";
                        echo "<td>" . $row["Distance"] . "</td>";
                        echo "<td>" . $row["Date"] . "</td>";
                        echo "<td>";
                        echo "</div>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "0 results";
                }
            

            }
        }
            elseif ($type == 'passenger'){
                echo $ID;
                $TripID = $_GET['TripID'];
                echo $TripID;
                $sql = "SELECT * FROM PASSENGER WHERE email='$email'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $ID = $row["PassengerID"];
                    echo "id: " . $row["PassengerID"]. " - Name: " 
                        . $row["fname"]. " " . $row["lname"]. "<br>";
                    }
                    
                $driver_id = "SELECT DriverID FROM TRIP WHERE TripID = $TripID";
                $result = mysqli_query($conn, $driver_id);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $D_ID = $row["DriverID"];
                    echo "Driverid: " . $row["DriverID"]. "<br>";
                    }
                    
                /* CONTINUE WORKING HERE */
                $driver_name = "SELECT fname, lname FROM DRIVER WHERE DriverID = '$D_ID'";
                $result = mysqli_query($conn, $driver_id);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $d_name = $row["DriverID"];
                    echo "id: " . $row["DriverID"]. " - Name: " 
                        . $row["fname"]. " " . $row["lname"]. "<br>";
                    }
                
                

                $sql = "SELECT TripID, $driver_name, Start_location, End_location, Distance, Date FROM TRIP WHERE TripID = $TripID";
                $result = mysqli_query($conn, $sql);
                $num_rows = mysqli_num_rows($result);
            
                if ($num_rows > 0) {
                    echo "<table style='border:1px red; border-collapse: collapse; width:40%; border: solid 2px solid black;'>";
                    echo "<tr style='border:1px solid black;'><th>TripID</th><th>Driver Name</th><th>PassengerID</th><th>Start Location</th><th>End Location</th><th>Distance</th><th>Date</th>";
                
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr style='border:1px solid black;'>";
                        echo "<td>" . $row["TripID"] . "</td>";
                        echo "<td>" . $row["$driver_name"] . "</td>";
                        echo "<td>" . $row["PassengerID"] . "</td>";
                        echo "<td>" . $row["Start_location"] . "</td>";
                        echo "<td>" . $row["End_location"] . "</td>";
                        echo "<td>" . $row["Distance"] . "</td>";
                        echo "<td>" . $row["Date"] . "</td>";
                        echo "<td>";
                        echo "</div>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "0 results";
                }
                }
            }
        }
    }
?>
                   
                
            