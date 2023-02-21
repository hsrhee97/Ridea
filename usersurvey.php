<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
    <header>
        <nav>
        <a href="#" class="logo"><i class="ri-car-line"></i><span>RIDEA</span></a>
            <ul class="navbar">
                <li><a href="#">Schedule a Ride</a></li>
                <li><a href="#">My Rides</a></li>
                <li><a href="#">Calendar</a></li>
                <li><a href="#">Chat</a></li>
            </ul>
        </nav>        
    </header>

        <h2>Ride Reservation</h2>
        <p>Please fill this form to book a ride.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        
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
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
        </form>
    </div>    
</body>
</html>
