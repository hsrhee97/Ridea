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

    $DriverID = '';
    $fname = "";
    $sql = "SELECT * FROM DRIVER WHERE email='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $DriverID = $row["DriverID"];
            $fname = $row["fname"];
            $lname = $row["lname"];
            $address = $row["address"];
            $phone = $row["phone"];
            $biography = $row["biography"];
            $license_number = $row["license_number"];
            $color = $row["color"];
            $model_name = $row["model_name"];
            }
      } 
      else {
            echo "No records has been found";
      }
    

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Update Profile</title>
</head>
<body>
<h1>Update Profile</h1>
<?php echo $row['DriverID'];?> 
<div>
<form method="post" action="driveredit.php" >
            <div class="inputbox">
                <span>First name</span>
                <input class="reg_box" type='text' name = "fname" value="<?php echo $fname;?>">
            </div>

            <div class="inputbox">
                <span>Last name</span>
                <input class="reg_box" type='text' name = "lname" value="<?php echo $lname;?>">
            </div>

            <div class="inputbox">
                <span>Address </span>
            <input class="reg_box" type='text' name = "address" size="40" value="<?php echo $address;?>">
            </div>

            <div class="inputbox">
                <span>Phone</span>
            <input class="reg_box" type='tel' name = "phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" size="40" value="<?php echo $phone;?>">
            </div>

            <div class="inputbox">
                <span>Biography</span>
            <input class="reg_box" type='text' name = "biography" size="40" value="<?php echo $biography;?>">
            </div>

            <div class="inputbox">
                <span>License number</span>
            <input class="reg_box" type='text' name = "license_number" size="40" value="<?php echo $license_number;?>">
            </div>

            <div class="inputbox">
                <span>Vehicle Color</span>
            <input class="reg_box" type='text' name = "color" size="40" value="<?php echo $color;?>">
            </div>

            <div class="inputbox">
                <span>Model Name</span>
            <input class="reg_box" type='text' name = "model_name" size="40" value="<?php echo $model_name;?>">
            </div>

            <div class="inputbox">
                <input type="submit" name="submit" value="submit" class="btn">
            </div>
        </form>

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
 
    // Check connection
    if($link === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
    }
	// initializing variables
	$Star_rating = "";
    $Comments = "";
    $Rating_P_ID = 0;
    $PassengerID = 0;
	$update = false;

    if (isset($_POST['submit'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $biography = $_POST['biography'];
        $license_number = $_POST['license_number'];
        $color = $_POST['color'];
        $model_name = $_POST['model_name'];

        $query = "UPDATE DRIVER SET fname = '$fname', lname = '$lname', address = '$address', phone = '$phone', biography = '$biography', license_number = '$license_number', color = '$color', model_name = '$model_name' WHERE DriverID = '$DriverID' " ;
        echo $query;
        $result = mysqli_query($link, $query); 
        if(false===$result){
            printf("error: %s\n", mysqli_error($link));
        }
        else {
            echo 'done'; 
            header('location: profile.php');
        }
    }
        ?>
