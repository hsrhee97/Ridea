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
        $RatingID=$_GET['RatingID'];
        echo $Comments;
        $query = "UPDATE RATING_PASSENGER SET Comments = $Comments, Star_rating = $Star_rating WHERE RatingID=$RatingID";
        echo $qcheck;
        $result = mysqli_query($link, $query); 
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

$RatingID=$_GET['RatingID'];
$qcheck = "SELECT * from RATING_PASSENGER where RatingID=$RatingID"; 
$result = mysqli_query($link, $qcheck); 
$row = mysqli_fetch_assoc($result);


?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Update Review</title>
<style type="text/css">        
    *{
    margin: 0;
    padding: 0;
}
.Star_rating {
    float: left;
    height: 46px;
    padding: 0 10px;
}
.Star_rating:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.Star_rating:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:30px;
    color:#ccc;
}
.Star_rating:not(:checked) > label:before {
    content: '★ ';
}
.Star_rating > input:checked ~ label {
    color: #ffc700;    
}
.Star_rating:not(:checked) > label:hover,
.Star_rating:not(:checked) > label:hover ~ label {
    color: #deb217;  
}
.Star_rating > input:checked + label:hover,
.Star_rating > input:checked + label:hover ~ label,
.Star_rating > input:checked ~ label:hover,
.Star_rating > input:checked ~ label:hover ~ label,
.Star_rating > label:hover ~ input:checked ~ label {
    color: #c59b08;
}
    </style>
</head>
<body>
<h1>Update Record</h1>

<h2>Edit</h2>

<?php
$status = "";
if(isset($_POST['update']))
{
$RatingID = $_REQUEST['RatingID'];
$Star_rating = $_REQUEST['Star_rating'];
$Comments = $_REQUEST['Comments'];
$PassengerID = $_REQUEST['PassengerID'];
$update="RatingID".$RatingID."',
Star_rating='".$Star_rating."', Comments='".$Comments."',
PassengerID='".$PassengerID."'";
mysqli_query($con, $update) or die(mysqli_error());
$status = "Record Updated Successfully. </br></br>
<a href='index.php'>View Updated Record</a>";
echo '<p style="color:#FF0000;">'.$status.'</p>';
}else {
?>

<div>
<form method="post" action="edit.php" >
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
			<input type="text" name="comments" required value="<?php echo $row['Comments'];?>"/>
	</div>

<p><input name="submit" type="submit" value="Update"/></p>
</form>

<?php } ?>

</body>
</html>


