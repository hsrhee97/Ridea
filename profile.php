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

                while ($row = $result->fetch_assoc()) {

                echo "<div class='wrapper1'>";
                    echo "<div class='div_test1'>";

                    echo "<div class='col1_driver'>";

                        echo "<div class='label'>";
                            echo"<h2>My Name is</h2>";
                                echo $row["fname"];
                                echo " ";
                                echo $row["lname"];
                        echo "</div>";

                        echo "<div class='label'>";
                            echo"<h2>A little bit about me</h2>";
                            echo $row["biography"];
                        echo "</div>";

                        echo "<div class='label'>";
                            echo"<h2>Address</h2>";
                                echo $row["address"];
                        echo "</div>";

                        echo "<div class='label'>";
                            echo"<h2>Phone Number</h2>";
                                echo $row["phone"];
                        echo "</div>";

                        echo "<div class='label'>";
                            echo"<h2>Email</h2>";
                                echo $row["email"];
                        echo "</div>";

                        echo "<div class='label'>";
                            echo"<h2>Password</h2>";
                            echo $row["password"] ? str_repeat("*", strlen($row["password"])) : "";
                        echo "</div>";
                        
                    echo "<div class='btn-group'>";
                    echo "<a class='btn btn-warning'href='edit_profile.php'>Edit</a>";
                    echo "</div>";

                    echo "</div>";

                        echo "<div class='col2_driver'>";
                            echo "<div class='label'>";
                                echo"<h2>License number</h2>";
                                echo $row["license_number"];
                            echo "</div>";

                            echo "<div class='label'>";
                                echo"<h2>Licence photo</h2>";
                                echo $row["license_photo"];
                            echo "</div>";

                            echo "<div class='label'>";
                                echo"<h2>Model name</h2>";           
                                echo $row["model_name"];
                            echo "</div>";

                            echo "<div class='label'>";
                                echo"<h2>Color</h2>";
                                echo $row["color"];
                            echo "</div>";


                    echo "</div>";

                echo "</div>";
                }

            } 
        }
            elseif ($type == 'passenger') {
             
                $sql = "SELECT PassengerID, fname ,lname, address, phone, email, password, biography, credit_card FROM PASSENGER WHERE email='$email'";
                $result = mysqli_query($con, $sql);
                $num_rows = mysqli_num_rows($result);
    
                if ($num_rows > 0) {
    
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='wrapper'>";
                            echo "<div class='div_test'>";

                            echo "<div class='col1'>";

                                echo "<div class='label'>";
                                    echo"<h2>My Name is</h2>";
                                        echo $row["fname"];
                                        echo " ";
                                        echo $row["lname"];
                                echo "</div>";

                                echo "<div class='label'>";
                                    echo"<h2>A little bit about me</h2>";
                                    echo $row["biography"];
                                echo "</div>";

                                echo "<div class='label'>";
                                    echo"<h2>Address</h2>";
                                        echo $row["address"];
                                echo "</div>";

                                echo "<div class='label'>";
                                    echo"<h2>Phone Number</h2>";
                                        echo $row["phone"];
                                echo "</div>";

                                echo "<div class='label'>";
                                    echo"<h2>Email</h2>";
                                        echo $row["email"];
                                echo "</div>";

                                echo "<div class='label'>";
                                    echo"<h2>Password</h2>";
                                    echo $row["password"] ? str_repeat("*", strlen($row["password"])) : "";
                                echo "</div>";

                                echo "<div class='label'>";
                                    echo"<h2>Credt card</h2>";
                                        echo $row["credit_card"] ;
                                echo "</div>";

                                
                            echo "<div class='btn-group'>";
                            echo "<a class='btn btn-warning'href='edit_profile.php'>Edit</a>";
                            echo "</div>";

                            echo "</div>";

                                echo "<div class='col2'>";

                                    echo "<div class='bookmark'>";
                                    echo "</div>";

                            echo "</div>";

                        echo "</div>";
                    }
                    
                } 


            }
            
            ?>
</body>
</html>



