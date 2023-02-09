<?php  include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>New Review</title>
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
    <h2>Create Review</h2>
	<form method="post" action="config.php" >
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
			<input type="text" name="comments" value="">
		</div>



		<div class="input-group">
			<button class="btn" type="submit" name="save" >Save</button>
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

            $sql = "SELECT RatingID, PassengerID ,Star_rating, Comments FROM RATING_PASSENGER";
            $result = mysqli_query($con, $sql);
            $num_rows = mysqli_num_rows($result);

            if ($num_rows > 0) {
                echo "<table style='border:1px red; border-collapse: collapse; width:40%; border: solid 2px solid black;'>";
                echo "<tr style='border:1px solid black;'><th>Rating</th><th>Comment</th>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr style='border:1px solid black;'>";
                    echo "<td>" .$row["Star_rating"] . "</td>";
                    echo "<td>" . $row["Comments"] . "</td>";
                    echo "<td>";
                    echo "<div class='btn-group'>";
                    echo "<a class='btn btn-warning'href='edit.php?RatingID=".$row['RatingID']."'>Edit</a>";
                    echo "<a class='btn btn-warning'href='delete.php?RatingID=".$row['RatingID']."'>Delete</a>";
                    echo "</div>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "0 results";
            }
            ?>
</body>
</html>



