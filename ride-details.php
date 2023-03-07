<?php
    session_start();
    $login = $_SESSION['login'];
    if (!isset($login)) {
    header('Location: home.php');
    exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    
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

<?php include 'includes/nav.php'; ?>
<div class='table'>
<?php
            $row_details = $_POST['row_details'];

            $conn = mysqli_connect("db.luddy.indiana.edu", "i494f22_team06", "my+sql=i494f22_team06", "i494f22_team06");
            if (!$conn) {
                die("Failed to connect to MySQL: " . mysqli_connect_error());
            } else {
            }

            $type = $_SESSION['type'];
            $email = $_SESSION['login'];
            // $ID = '';
            // $TripID = 0 ;
            // $passenger_name ='';
            // $driver_name ='';
            // $D_ID ='';
            // $d_name ='';
            // $d_fname = '';
            // $d_lname ='';
            // $P_ID ='';
            // $p_name ='';
            // $p_fname ='';
            // $p_lname ='';
            
            if ($type =='driver') {
                $TripID = $_GET['TripID'];
                $sql = "SELECT * FROM DRIVER WHERE email='$email'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $ID = $row["DriverID"];
                    }

                $passenger_id = "SELECT PassengerID FROM TRIP WHERE TripID = $TripID";
                $result = mysqli_query($conn, $passenger_id);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $P_ID = $row["PassengerID"];
                    }

                $passenger_name = "SELECT * FROM PASSENGER WHERE PassengerID = '$P_ID'";
                $result = $conn->query($passenger_name);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $p_name = $row["PassengerID"];
                        $p_fname = $row["fname"];
                        $p_lname = $row["lname"];
                    }

                
                $sql = "SELECT * FROM TRIP WHERE TripID = $TripID";
                $result = mysqli_query($conn, $sql);
                $num_rows = mysqli_num_rows($result);
            
                if ($num_rows > 0) {
                
                    while ($row = $result->fetch_assoc()) {

                        echo "<td>" . $row["TripID"] . "</td>";
                        echo "<td>" . $p_fname . "</td>";
                        echo "<td>" . $p_lname . "</td>";
                        echo "<td>" . $row["PassengerID"] . "</td>";
                        echo "<td>" . $row["Start_location"] . ", " . $row["start_city"] . "</td>";
                        echo "<td>" . $row["End_location"] . ", " . $row["end_city"] . "</td>";
                        echo "<td>" . $row["Distance"] . "</td>";
                        echo "<td>" . $row["Date"] . "</td>";
                        echo "<a class='btn btn-warning'href='review1.php?TripID=".$row['TripID']."&end_city=".$row['end_city']."&date=".$row['Date']."'>Create a review for this trip</a>";
                        
                    }
                } else {
                    echo "0 results";
                }
                }
            }
        }
    }
            elseif ($type == 'passenger'){
                $TripID = $_GET['TripID'];
                $sql = "SELECT * FROM PASSENGER WHERE email='$email'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $ID = $row["PassengerID"];

                    }
                    
                $driver_id = "SELECT DriverID FROM TRIP WHERE TripID = $TripID";
                $result = mysqli_query($conn, $driver_id);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $D_ID = $row["DriverID"];

                    }
                    
                $driver_name = "SELECT * FROM DRIVER WHERE DriverID = '$D_ID'";
                $result = $conn->query($driver_name);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $d_name = $row["DriverID"];
                        $d_fname = $row["fname"];
                        $d_lname = $row["lname"];
                    }


                

                $sql = "SELECT * FROM TRIP WHERE TripID = $TripID";
                $result = mysqli_query($conn, $sql);
                $num_rows = mysqli_num_rows($result);
            
                if ($num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='detail-box'>";
                            echo $row["TripID"];
                            echo $d_fname;
                            echo $d_lname;
                            echo "<td>" . $row["Start_location"] . ", " . $row["start_city"] . "</td>";
                            echo "<td>" . $row["End_location"] . ", " . $row["end_city"] . "</td>";
                            echo $row["Distance"];
                            echo $row["Date"];
                            echo "<a class='btn btn-warning'href='review1.php?TripID=".$row['TripID']."&end_city=".$row['end_city']."&date=".$row['Date']."'>Create a review for this trip</a>";
                        echo "</div>";
                    }

                } else {
                    echo "0 results";
                }
                }
            }
        }
    }
?>
                   
                
            