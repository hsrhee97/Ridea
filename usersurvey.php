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
<body>
    <div class="form-container">
    <div class="form-wrapper">

        <h2>Ride Reservation</h2>
        <p>Please fill this form to book a ride.</p>
        
        <?php
            if (isset($_POST['survey_submit'])){ 
                $passenger_id = $_SESSION['id'];
                $start_address = $_POST['start_point'];
                $start_city = $_POST['city_start'];
                $end_address = $_POST['destination'];
                $end_city = $_POST['city_end'];
                $luggage = $_POST['luggage'];
                $trip_date = $_POST['date'];
                $other = $_POST['other'];

                $conn=mysqli_connect("db.luddy.indiana.edu","i494f22_team06","my+sql=i494f22_team06","i494f22_team06");

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Insert the data into the SURVEY table
                $sql = "INSERT INTO SURVEY (PassengerID, start_address, start_city, end_address, end_city, trip_date, other)
                        VALUES (?, ?, ?, ?, ?, ?, ?)";
                $sur = $conn->prepare($sql);
                $sur->bind_param('issssss', $passenger_id, $start_address, $start_city, $end_address, $end_city, $trip_date, $other);



                if ($sur->execute()) {
                    echo ("<script>alert('You have scheduled the trip')</script>");
                    echo("<script>location.replace('matching.php');</script>");
                    exit;
                } 
                else {
                }

                $sur->close();
                $conn->close();
            }
        ?>

        <form method= "post">
        
            <div class="form-group">
                <label>Pickup Point</label>
                <label>Address</label>
                <input type="text" name="start_point" class="form-control value=">
            </div>    
            <div class="form-group">
                <label>City</label>
                <input type="text" name="city_start" class="form-control value=">
            </div>   

            <div class="form-group">
                <label>Destination</label>
                <label>Address</label>
                <input type="destination" name="destination" class="form-control">
            </div>
            <div class="form-group">
                <label>City</label>
                <input type="text" name="city_end" class="form-control value=">
            </div> 

            <div class="form-group">
                <label>Number of luggages:</label>
                <input type="luggage" name="luggage" class="form-control">
            </div>

            <div class="form-group">
                <label>Date:</label>
                <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" class="form-control">
            </div>

            <div class="form-group">
                <label>Other:</label>
                <input type="other" name="other" class="form-control">
            </div>

            <div class="form-group">
                <input type="submit" name="survey_submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
        </form>
    </div>    
    </div>
</body>
</html>
