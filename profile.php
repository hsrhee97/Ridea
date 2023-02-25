<?php  session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Profile</title>

    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;500;700&family=Roboto:wght@100;400;700&display=swap" rel="stylesheet">
    <!-- icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- another icons -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <style> <?php include 'css/profile.css'; ?> </style>
    
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>
<body>

<?php include 'includes/nav.php'; ?>
        <div class='table'>
            <?php
            $con = mysqli_connect("db.luddy.indiana.edu", "i494f22_team06", "my+sql=i494f22_team06", "i494f22_team06");
            if (!$con) {
                die("Failed to connect to MySQL: " . mysqli_connect_error());
            } else {
        
            }
            $type = $_SESSION['type'];
            $email = $_SESSION['login'];
            if ($type == 'driver') {
            $sql = "SELECT DriverID, fname ,lname, address, phone, email, password, biography, license_number, license_photo, color, model_name FROM DRIVER WHERE email='$email'";
            $result = mysqli_query($con, $sql);
            $num_rows = mysqli_num_rows($result);

            if ($num_rows > 0) {
                echo "<table style='border:1px red; border-collapse: collapse; width:40%; border: solid 2px solid black;'>";
                echo "<tr style='border:1px solid black;'><th>First Name</th><th>Last Name</th><th>Address</th><th>Phone Number</th><th>Email</th><th>Biography</th><th>License Number</th><th>License Photo</th><th>Vehicle Color</th><th>Vehicle Model</th>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr style='border:1px solid black;'>";
                    echo "<td>" .$row["fname"] . "</td>";
                    echo "<td>" . $row["lname"] . "</td>";
                    echo "<td>" . $row["address"] . "</td>";
                    echo "<td>" . $row["phone"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["biography"] . "</td>";
                    echo "<td>" . $row["license_number"] . "</td>";
                    echo "<td>" . $row["license_photo"] . "</td>";
                    echo "<td>" . $row["color"] . "</td>";
                    echo "<td>" . $row["model_name"] . "</td>";

                    echo "<div class='btn-group'>";
                    
                    echo "</div>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "<a class='btn btn-warning'href='editprofile.php'>Edit</a>";
                echo "</table>";
            } 
        }
            elseif ($type == 'passenger') {
             
                $sql = "SELECT PassengerID, fname ,lname, address, phone, email, password, biography, credit_card FROM PASSENGER WHERE email='$email'";
                $result = mysqli_query($con, $sql);
                $num_rows = mysqli_num_rows($result);
    
                if ($num_rows > 0) {
                    echo "<table style='border:1px red; border-collapse: collapse; width:40%; border: solid 2px solid black;'>";
                    echo "<tr style='border:1px solid black;'><th>First Name</th><th>Last Name</th><th>Address</th><th>Phone Number</th><th>Email</th><th>Biography</th><th>Credit Card</th>";
    
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr style='border:1px solid black;'>";
                        echo "<td>" .$row["fname"] . "</td>";
                        echo "<td>" . $row["lname"] . "</td>";
                        echo "<td>" . $row["address"] . "</td>";
                        echo "<td>" . $row["phone"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["biography"] . "</td>";
                        echo "<td>" . $row["credit_card"] . "</td>";
    
                        echo "<div class='btn-group'>";
                        
                        echo "</div>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    
                } 
                echo "<a class='btn btn-warning'href='editprofile.php'>Edit</a>";
                echo "</table>";
            }
            
            ?>
</body>
</html>



