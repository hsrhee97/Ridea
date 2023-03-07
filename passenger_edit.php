<?php 
    session_start();
    /* Database credentials. Assuming you are running MySQL
    server with default setting (user 'root' with no password) */
    define('DB_SERVER', 'db.luddy.indiana.edu');
    define('DB_USERNAME', 'i494f22_team06');
    define('DB_PASSWORD', 'my+sql=i494f22_team06');
    define('DB_NAME', 'i494f22_team06');
 
    /* Attempt to connect to MySQL database */
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
    // Check connection
    if($conn === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    $type = $_SESSION['type'];
    $email = $_SESSION['login'];

    $sql = "SELECT * FROM PASSENGER WHERE email='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $PassengerID = $row["PassengerID"];
            $fname = $row["fname"];
            $lname = $row["lname"];
            $password = $row["password"];
            $address = $row["address"];
            $phone = $row["phone"];
            $biography = $row["biography"];
            }
      } 
      else {
            echo "No records has been found";
      }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Passenger Profile</title>
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;500;700&family=Roboto:wght@100;400;700&display=swap" rel="stylesheet">
    <!-- icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- another icons -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <style> <?php include 'css/help.css'; ?> </style>
</head>

    <body>
        <?php include 'includes/nav.php'; ?>
        <div class="form-container">
    <div class="form-wrapper">
        <h2>Edit my information</h2>

                <form method="post" action="passenger_edit.php" >

                    <div class="form-group">
                        <span>First name</span>
                        <input class="reg_box" type='text' name = "fname" value="<?php echo $fname;?>">
                    </div>

                    <div class="form-group">
                        <span>Last name</span>
                        <input class="reg_box" type='text' name = "lname" value="<?php echo $lname;?>">
                    </div>

                    <div class="form-group">
                        <span>Password </span>
                    <input class="reg_box" type='password' name = "password" value="<?php echo $password;?>">
                    </div>

                    <div class="form-group">
                        <span>Address </span>
                    <input class="reg_box" type='text' name = "address"  value="<?php echo $address;?>">
                    </div>

                    <div class="form-group">
                        <span>Phone</span>
                    <input class="reg_box" type='tel' name = "phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" value="<?php echo $phone;?>">
                    </div>

                    <div class="form-group">
                        <span>Biography</span>
                    <input class="reg_box" type='text' name = "biography"  value="<?php echo $biography;?>">
                    </div>

                    <div class="form-group buttons">
                        <input type="submit" name="submit" value="submit" class="btn">
                    </div>
                    
                </form>
            </div>
    </body>
</html>


<?php 
    /* Database credentials. Assuming you are running MySQL
    server with default setting (user 'root' with no password) */
    define('DB_SERVER', 'db.luddy.indiana.edu');
    define('DB_USERNAME', 'i494f22_team06');
    define('DB_PASSWORD', 'my+sql=i494f22_team06');
    define('DB_NAME', 'i494f22_team06');
 
    /* Attempt to connect to MySQL database */
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    $PassengerID = $_SESSION['id'];
    // Check connection
    if($link === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    if(isset($_POST['submit'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $biography = $_POST['biography'];
        $credit_card = $_POST['credit_card'];
    
        if(empty($fname) || empty($lname) || empty($password) || empty($address) || empty($phone) || empty($biography) || empty($credit_card)) {
            echo ("<script>alert('Please fill in all the required fields')</script>");
        }
        else {
            $query = "UPDATE PASSENGER SET fname = '$fname', lname = '$lname', address = '$address', phone = '$phone', password = PASSWORD('$password'), biography = '$biography' WHERE PassengerID = '$PassengerID' " ;
    
            $result = mysqli_query($link, $query); 
            if(false===$result){
                printf("error: %s\n", mysqli_error($link));
            }
            else {
                echo ("<script>alert('Your profile has been successfully updated')</script>");
                echo("<script>location.replace('profile.php');</script>");
                exit;
            }
        }
    }
    
?>