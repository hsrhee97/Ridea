<?php
    session_start();
?>
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
    $PassengerID = "";
    $DriverID =  "";
	$update = false;
    $type = $_SESSION['type'];
    $email = $_SESSION['login'];
    $ID = '';
    
	if ($type =='driver') {
        $sql = "SELECT * FROM DRIVER WHERE email='$email'";
        $result = $link->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $ID = $row["DriverID"];
            }
    
            if (isset($_POST['save'])) {
                $Comments = $_POST['Comments'];
                $Star_rating = $_POST['Star_rating'];
                $TripID = $_POST['TripID'];
                echo $Comments;
                //change static passengerid of 2 to dynamic passengerid that is retrieved from session 
                $qcheck = "INSERT INTO RATING_DRIVER (DriverID, Star_rating, Comments, TripID) VALUES ($ID, $Star_rating, '$Comments', '$TripID')";
                echo $qcheck;
                $result = mysqli_query($link, $qcheck); 
                if(false===$result){
                    printf("error: %s\n", mysqli_error($link));
                }
                else {
                    echo 'done';
                    header('location: ride-history.php');
                }
            }  
        } 
    }
    elseif ($type == 'passenger') {
        $sql = "SELECT * FROM PASSENGER WHERE email='$email'";
        $result = $link->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $ID = $row["PassengerID"];
            }
        
            if (isset($_POST['save'])) {
                $Comments = $_POST['Comments'];
                $Star_rating = $_POST['Star_rating'];
                $TripID = $_POST['TripID'];
                echo $Comments;
                //change static passengerid of 2 to dynamic passengerid that is retrieved from session 
                $qcheck = "INSERT INTO RATING_PASSENGER (PassengerID, Star_rating, Comments, TripID) VALUES ($ID, $Star_rating, '$Comments', '$TripID')";
                echo $qcheck;
                $result = mysqli_query($link, $qcheck); 
                if(false===$result){
                    printf("error: %s\n", mysqli_error($link));
                }
                else {
                    echo 'done';
                    header('location: ride-history.php');
                }
            }
        }
    }


?>