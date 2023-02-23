<?php  session_start();?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
</head>
<body>
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



