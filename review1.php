<?php  include('config.php'); ?>
<?php 
    session_start();
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
<?php include 'includes/nav.php'; 
$TripID = $_GET['TripID'];
$End_city = $_GET['end_city'];
$Date = $_GET['date'];?>

<div class="contents">
    <div class="texts">
    <h2>My <span>Review</span></h2>
    <p>Let other passengers know how your ride went! Write, view, and edit your reviews below.</p>
    </div>
</div>

<main>

    <h2 class="create-review">Create Review</h2>
    <h2><?php echo $End_city , ' ', $Date?></h2>
    

	<form method="post" action="config.php">

        <div class="wrapper">
        <h2>Overall rating</h2>
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
        <h2>Add a written review</h2>
			<textarea class="text-area" type="text" name="Comments" cols="40" rows="8" value="" placeholder="What did you like/dislike about the ride?"></textarea>
		</div>

		<div class="input-group2">
            <input type="hidden" name="TripID" value="<?php echo $TripID; ?>">
			<button class="btn" type="submit" name="save" >Submit Review</button>
		</div>
    
	</form> 

	<?php ＄results == mysqli_query(＄link, "SELECT * FROM RATING_PASSENGER"); ?>

        <div class='table'>
            <?php
            $con = mysqli_connect("db.luddy.indiana.edu", "i494f22_team06", "my+sql=i494f22_team06", "i494f22_team06");
            if (!$con) {
                die("Failed to connect to MySQL: " . mysqli_connect_error());
            } else {
        
            }

            $type = $_SESSION['type'];
            $email = $_SESSION['login'];
            $ID = '';
            $TripID = $_GET['TripID'];
            $End_city = $_GET['end_city'];
            $Date = $_GET['Date'];

            if ($type =='driver') {
                
                $sql = "SELECT * FROM DRIVER WHERE email='$email'";
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $ID = $row["DriverID"];
                    }

                    $sql = "SELECT * FROM RATING_DRIVER WHERE DriverID = '$ID'";
                    $result = mysqli_query($con, $sql);
                    $num_rows = mysqli_num_rows($result);

                    if ($num_rows > 0) {

                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='history-wrapper'>";
                            echo "<div class='databox'>";
    
                                echo "<span class='starrate'>".$row["Star_rating"]."</span>";
                                echo "<span class='data'>".$row["Comments"]."</span>";
                            
                                echo "<div class='btn-group'>";
                                    echo "<a class='btn btn-warning'href='edit.php?Rating_P_ID=".$row['Rating_P_ID']."'>Edit</a>";
                                    echo "<a class='btn btn-warning2'href='delete.php?Rating_P_ID=".$row['Rating_P_ID']."'>Delete</a>";
                                echo "</div>";
    
                            echo "</div>";
                        echo "</div>";
                        }
                    } else {
                        echo "";
                    }
                }
            } 
                elseif ($type == 'passenger')
                {
                    $sql = "SELECT * FROM PASSENGER WHERE email='$email'";
                    $result = $con->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $ID = $row["PassengerID"];
                        }
    
                        $sql = "SELECT * FROM RATING_PASSENGER WHERE PassengerID = '$ID'";
                        $result = mysqli_query($con, $sql);
                        $num_rows = mysqli_num_rows($result);
    
                        if ($num_rows > 0) {
    
                            while ($row = $result->fetch_assoc()) {
                                echo "<div class='history-wrapper'>";
                                echo "<div class='databox'>";
        
                                    echo "<span class='starrate'>".$row["Star_rating"]."</span>";
                                    echo "<span class='data'>".$row["Comments"]."</span>";
                                
                                    echo "<div class='btn-group'>";
                                        echo "<a class='btn btn-warning'href='edit.php?Rating_P_ID=".$row['Rating_P_ID']."'>Edit</a>";
                                        echo "<a class='btn btn-warning2'href='delete.php?Rating_P_ID=".$row['Rating_P_ID']."'>Delete</a>";
                                    echo "</div>";
        
                                echo "</div>";
                            echo "</div>";
                            }
                        } else {
                            echo "";
                        } 
                    }
                }
            ?>
    </main>
</body>
</html>
