<?php 
	
    /* Database credentials. Assuming you are running MySQL
    server with default setting (user 'root' with no password) */
    define('DB_SERVER', 'db.luddy.indiana.edu');
    define('DB_USERNAME', 'i494f22_desaikr');
    define('DB_PASSWORD', 'my+sql=i494f22_desaikr');
    define('DB_NAME', 'i494f22_desaikr');
 
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

	if (isset($_POST['save'])) {
		$Comments = $_POST['comments'];
        $Star_rating = $_POST['Star_rating'];
        echo $Comments;
        $qcheck = "INSERT INTO RATING_PASSENGER (PassengerID, Star_rating, Comments) VALUES (2, $Star_rating, '$Comments')";
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

