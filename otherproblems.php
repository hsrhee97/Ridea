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

        <h2>Lost and Found</h2>
        <p>Please fill this form to report any problem.</p>
        <form method="post" action="config_otherproblems.php">
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control value=">
            </div>    
            
            <div class="form-group">
                <label>Trip Date:</label>
                <input type="date" name="trip_date" value="<?php echo date('YYYY-MM-DD'); ?>" class="form-control">
            </div>

            <div class="form-group">
                <label>Problem:</label>
                <input type="description" name="description" class="form-control">
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit" name = "submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
        </form>
    </div>    
</body>
</html>
