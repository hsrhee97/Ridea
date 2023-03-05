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

    <br><br>
  <button type="Submit" id="Submit" name="Submit">Submit</button>
</form>



<div class='table'>
            <?php
            $conn = mysqli_connect("db.luddy.indiana.edu", "i494f22_team06", "my+sql=i494f22_team06", "i494f22_team06");
            if (!$conn) {
                die("Failed to connect to MySQL: " . mysqli_connect_error());
            } else {
                echo 'done';
            }
            

            $type = $_SESSION['type'];
            $email = $_SESSION['login'];
            echo $type;
            echo $email;
            $ID = '';
        
            if ($type =='driver') {
                
                $sql = "SELECT * FROM DRIVER WHERE email='$email'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $ID = $row["DriverID"];
                    echo "id: " . $row["DriverID"]. " - Name: " 
                        . $row["fname"]. " " . $row["lname"]. "<br>";
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
                                echo "<tr style='border:1px solid black;'>";
                                echo "<td>" . $row["Start_location"] . "</td>";
                                echo "<td>" . $row["End_location"] . "</td>";
                                echo "<td>" . $row["Date"] . "</td>";
                                echo "<td>";
                                echo "<div class='btn-group'>";
                                echo "<a class='btn btn-warning'href='ride-details.php?TripID=".$row['TripID']."'>Ride Details</a>";
                                echo "<a class='btn btn-warning'href='help.php?TripID=".$row['TripID']."'>Ride Help</a>";
                                echo "</div>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "0 results";
                        }
                    } else {
                        $sql_check = "SELECT * FROM TRIP WHERE PassengerID = $ID  ORDER BY Date DESC";
                        $result_check = mysqli_query($conn, $sql_check);
                        $num_rows_check = mysqli_num_rows($result_check);

                        if ($num_rows_check > 0) {
                            echo "<table style='border:1px red; border-collapse: collapse; width:40%; border: solid 2px solid black;'>";
                            echo "<tr style='border:1px solid black;'><th>Start Location</th><th>End Location</th><th>Date</th>";
                            
                            while ($row = $result_check->fetch_assoc()) {
                                echo "<tr style='border:1px solid black;'>";
                                echo "<td>" . $row["Start_location"] . "</td>";
                                echo "<td>" . $row["End_location"] . "</td>";
                                echo "<td>" . $row["Date"] . "</td>";
                                echo "<td>";
                                echo "<div class='btn-group'>";
                                echo "<a class='btn btn-warning'href='ride-details.php?TripID=".$row['TripID']."'>Ride Details</a>";
                                echo "<a class='btn btn-warning'href='help.php?TripID=".$row['TripID']."'>Ride Help</a>";
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
            elseif ($type == 'passenger')
            { 
                $sql = "SELECT * FROM PASSENGER WHERE email='$email'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $ID = $row["PassengerID"];
                    echo "id: " . $row["PassengerID"]. " - Name: " 
                        . $row["fname"]. " " . $row["lname"]. "<br>";
                    }
                    if (isset($_POST["Submit"])) {
                        $month=$_POST["month"];
                        $year=$_POST["year"];
                        
                        $sql = "select * from TRIP WHERE month(Date) = $month and year(Date) = $year and PassengerID = $ID" ;
                        $result = mysqli_query($conn, $sql);
                        $num_rows = mysqli_num_rows($result);
            
                        if ($num_rows > 0) {
                            echo "<table style='border:1px red; border-collapse: collapse; width:40%; border: solid 2px solid black;'>";
                            echo "<tr style='border:1px solid black;'><th>Start Location</th><th>End Location</th><th>Date</th>";
                            
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr style='border:1px solid black;'>";
                                echo "<td>" . $row["Start_location"] . "</td>";
                                echo "<td>" . $row["End_location"] . "</td>";
                                echo "<td>" . $row["Date"] . "</td>";
                                echo "<td>";
                                echo "<div class='btn-group'>";
                                echo "<a class='btn btn-warning'href='ride-details.php?TripID=".$row['TripID']."'>Ride Details</a>";
                                echo "<a class='btn btn-warning'href='help.php?TripID=".$row['TripID']."'>Ride Help</a>";
                                echo "</div>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "0 results";
                        }
                    } else {
                        $sql_check = "SELECT * FROM TRIP WHERE PassengerID = $ID  ORDER BY Date DESC";
                        $result_check = mysqli_query($conn, $sql_check);
                        $num_rows_check = mysqli_num_rows($result_check);

                        if ($num_rows_check > 0) {
                            echo "<table style='border:1px red; border-collapse: collapse; width:40%; border: solid 2px solid black;'>";
                            echo "<tr style='border:1px solid black;'><th>Start Location</th><th>End Location</th><th>Date</th>";
                            
                            while ($row = $result_check->fetch_assoc()) {
                                echo "<tr style='border:1px solid black;'>";
                                echo "<td>" . $row["Start_location"] . "</td>";
                                echo "<td>" . $row["End_location"] . "</td>";
                                echo "<td>" . $row["Date"] . "</td>";
                                echo "<td>";
                                echo "<div class='btn-group'>";
                                echo "<a class='btn btn-warning'href='ride-details.php?TripID=".$row['TripID']."'>Ride Details</a>";
                                echo "<a class='btn btn-warning'href='help.php?TripID=".$row['TripID']."'>Ride Help</a>";
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
?>

