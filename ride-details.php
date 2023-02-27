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
            $D_ID ='';
            $d_name ='';
            $d_fname = '';
            $d_lname ='';
            $P_ID ='';
            $p_name ='';
            $p_fname ='';
            $p_lname ='';

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

                $passenger_id = "SELECT PassengerID FROM TRIP WHERE TripID = $TripID";
                $result = mysqli_query($conn, $passenger_id);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $P_ID = $row["PassengerID"];
                    echo "Passengerid: " . $row["PassengerID"]. "<br>";
                    }

                $passenger_name = "SELECT * FROM PASSENGER WHERE PassengerID = '$P_ID'";
                $result = $conn->query($passenger_name);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $p_name = $row["PassengerID"];
                        $p_fname = $row["fname"];
                        $p_lname = $row["lname"];
                    echo "id: " . $row["PassengerID"]. " - Name: " 
                        . $row["fname"]. " " . $row["lname"]. "<br>";
                    }
                    echo $p_fname;
                    echo $p_lname;

                
                $sql = "SELECT TripID, Start_location, End_location, Distance, Date FROM TRIP WHERE TripID = $TripID";
                $result = mysqli_query($conn, $sql);
                $num_rows = mysqli_num_rows($result);
            
                if ($num_rows > 0) {
                    echo "<table style='border:1px red; border-collapse: collapse; width:40%; border: solid 2px solid black;'>";
                    echo "<tr style='border:1px solid black;'><th>TripID</th><th>Passenger First Name</th><th>Passenger Last Name</th><th>PassengerID</th><th>Start Location</th><th>End Location</th><th>Distance</th><th>Date</th>";
                
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr style='border:1px solid black;'>";
                        echo "<td>" . $row["TripID"] . "</td>";
                        echo "<td>" . $p_fname . "</td>";
                        echo "<td>" . $p_lname . "</td>";
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
                $driver_name = "SELECT * FROM DRIVER WHERE DriverID = '$D_ID'";
                $result = $conn->query($driver_name);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $d_name = $row["DriverID"];
                        $d_fname = $row["fname"];
                        $d_lname = $row["lname"];
                    echo "id: " . $row["DriverID"]. " - Name: " 
                        . $row["fname"]. " " . $row["lname"]. "<br>";
                    }
                    echo $d_fname;
                    echo $d_lname;

                

                $sql = "SELECT TripID, Start_location, End_location, Distance, Date FROM TRIP WHERE TripID = $TripID";
                $result = mysqli_query($conn, $sql);
                $num_rows = mysqli_num_rows($result);
            
                if ($num_rows > 0) {
                    echo "<table style='border:1px red; border-collapse: collapse; width:40%; border: solid 2px solid black;'>";
                    echo "<tr style='border:1px solid black;'><th>TripID</th><th>Driver First Name</th><th>Driver Last Name</th><th>Start Location</th><th>End Location</th><th>Distance</th><th>Date</th>";
                
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr style='border:1px solid black;'>";
                        echo "<td>" . $row["TripID"] . "</td>";
                        echo "<td>" . $d_fname . "</td>";
                        echo "<td>" . $d_lname . "</td>";
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
                   
                
            