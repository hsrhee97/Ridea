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
    <title>Reservation</title>

    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;500;700&family=Roboto:wght@100;400;700&display=swap" rel="stylesheet">
    <!-- icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- another icons -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">



    <style>  <?php include 'css/user_survey.css'; ?>  </style>

</head>
<?php include 'includes/nav.php'; ?>

<body>
    <div class="form-container">
        <div class="form-wrapper">

            <h2>Ride Reservation</h2>
            <p>Please fill this form to book a ride.</p>

            <div class="map">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="from"></label>
                        <input type="text" id="from" placeholder="Please enter the address in the street format only!" class="form-control">

                    </div>
                    <div class="form-group">
                        <label for="to"></label>
                        <input type="text" id="to" placeholder="Please enter the address in the street format only!" class="form-control">

                    </div>
                </form>

                <div class="form-group">
                    <button class="roll_but" onclick="calcRoute();">Continue to Booking Form</button>
                </div>

                <div class="container-fluid">
                    <div id="output">

                    </div>
                    <div id="googleMap">

                    </div>
                </div>

                <div id="survey-form" style="display:none">
                    <form method="post" action="survey_insert.php">
                        <div class="container">

                            <div class="col">

                                <div class="form-group">
                                    <label>Pickup Address</label>
                                    <input type="text" name="start_point" class="form-control">
                                </div>    

                                <div class="form-group">
                                    <label>Departure city</label>
                                    <input type="text" name="city_start" class="form-control value=">
                                </div>   

                                <div class="form-group">
                                    <label>Date:</label>
                                    <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Other:</label>
                                    <input type="text" name="other" class="form-control">
                                </div>

                            </div>

                            <div class="col">

                                <div class="form-group">
                                    <label>Destination Address</label>
                                    <input type="text" name="destination" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Destination City</label>
                                    <input type="text" name="city_end" class="form-control value=">
                                </div> 

                                <div class="form-group">
                                    <label>Number of luggages:</label>
                                    <input type="text" name="luggage" class="form-control">
                                </div>

                                <input type="hidden" name="distance" value="<?php  echo $distance; ?>">
                                <input type="hidden" name="price" value="<?php  echo $price; ?>">
                                
                                <div class="form-group buttons">
                                    <input type="reset" class="btn btn-secondary ml-2" value="Reset">
                                    <input type="submit" name="survey_submit" class="btn btn-primary" value="Submit">
                                </div>

                            </div>

                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5ReqYcOembRKbjFdMSvPRbbyqqTPVOis&libraries=places"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/Main.js"></script>
</body>
</html>
