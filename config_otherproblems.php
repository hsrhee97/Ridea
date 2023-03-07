<?php
    session_start();
    $login = $_SESSION['login'];
    if (!isset($login)) {
    header('Location: home.php');
    exit;
    }
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
    else {
        echo 'done';
    }

	// initializing variables
	$email = "";
    $help_type = "";
    $lost_items = "";
    $trip_date = "";
    $description = "";
    $DriverID = 0;
    $PassengerID = 0;
	$HelpID = 0;
	$update = false;

	if (isset($_POST['submit'])) {
		$email = $_POST['email'];
        $lost_items = $_POST['lost_items'];
        $description = $_POST['description'];
        $trip_date = $_POST['trip_date'];
        $help_type = "Other Problem";
        echo $description;
        $qcheck = "INSERT INTO HELP (email, help_type, lost_items, description, trip_date) VALUES ('$email', '$help_type', '$lost_items', '$description', '$trip_date')";
        echo $qcheck;
        $result = mysqli_query($link, $qcheck); 
        if(false===$result){
            printf("error: %s\n", mysqli_error($link));
        }
        else {
            echo ("<script>alert('Your form has been submitted. Thank you for reporting!')</script>");
            echo("<script>location.replace('home.php');</script>");
            exit;
        }
        
		//$_SESSION['message'] = "Address saved"; 
		/* $Star_rating = $_POST['Star_rating']; */

	} 

?>
