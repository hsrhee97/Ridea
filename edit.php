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
  $PassengerID = 0;
	$update = false;

$Rating_P_ID=$_GET['Rating_P_ID'];
$qcheck = "SELECT * from RATING_PASSENGER where Rating_P_ID=$Rating_P_ID"; 
$result = mysqli_query($link, $qcheck); 
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Review</title>


    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;500;700&family=Roboto:wght@100;400;700&display=swap" rel="stylesheet">
    <!-- icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- another icons -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <style>  <?php include 'css/review.css'; ?>  </style>

</head>
<body>

<?php include 'includes/nav.php'; ?>

<div class="contents">
    <div class="texts">
    <h2>Edit <span>Review</span></h2>
    <p>Let other passengers know how your ride went! Write, view, and edit your reviews below.</p>
    </div>
</div>

<div>
<form method="post" action="./update_review_edit.php?Rating_P_ID=<?= $Rating_P_ID ?>"" >
	<div class="wrapper">
		<div class="Star_rating">
    	<input type="radio" id="star5" name="Star_rating" value="5" />
    	<label for="star5" title="text">5</label>
    	<input type="radio" id="star4" name="Star_rating" value="4" />
    	<label for="star4" title="text">4</label>
    	<input type="radio" id="star3" name="Star_rating" value="3" />
    	<label for="star3" title="text">3</label>
    	<input type="radio" id="star2" name="Star_rating" value="2" />
    	<label for="star2" title="text">2</label>
    	<input type="radio" id="star1" name="Star_rating" value="1" />
    	<label for="star1" title="text">1</label>
        </div>
	</div>


	<div class="input-group">
			<label>Add a written review</label>
			<input type="text" name="Comments" required value="<?php echo $row['Comments'];?>"/>
	</div>

<p><input name="submit" type="submit" value="Update"/></p>
</form>

</body>
</html>


