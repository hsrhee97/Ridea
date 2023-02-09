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
	$RatingID = 0;
    $PassengerID = 0;
	$update = false;

	if (isset($_POST['submit'])) {
		$Comments = $_POST['comments'];
        $Star_rating = $_POST['Star_rating'];
        $RatingID = $_REQUEST['RatingID'];
        echo $Comments;
        $qcheck = "UPDATE RATING_PASSENGER SET Comments = $Comments, Star_rating = $Star_rating WHERE RatingID=$RatingID";
        echo $qcheck;
        $result = mysqli_query($link, $qcheck); 
        if(false===$result){
            printf("error: %s\n", mysqli_error($link));
        }
        else {
            echo 'done';
            header('location: index.php');
        }
        
		//$_SESSION['message'] = "Address saved"; 
		/* $Star_rating = $_POST['Star_rating']; */

	} 

?>

