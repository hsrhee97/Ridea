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
    echo $type;
    echo $email;
    if ($type == 'driver') {
        $DriverID = '';
        $sql = "SELECT * FROM DRIVER WHERE email='$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
      
            while($row = $result->fetch_assoc()) {
        echo $DriverID;
            }
      } 
      else {
            echo "No records has been found";
      }
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


