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
?>

<form id="period_select" name="period_selection" method="POST">
    <select name="month" value=''>Select Month</option>
        <option value='01'>January</option>
        <option value='02'>February</option>
        <option value='03'>March</option>
        <option value='04'>April</option>
        <option value='05'>May</option>
        <option value='06'>June</option>
        <option value='07'>July</option>
        <option value='08'>August</option>
        <option value='09'>September</option>
        <option value='10'>October</option>
        <option value='11'>November</option>
        <option value='12'>December</option>
    </select>

    <select name="year" value=''>Select Year</option>
        <option value='2023'>2023</option>
        <option value='2022'>2022</option>
        <option value='2021'>2021</option>
        <option value='2020'>2020</option>
        <option value='2019'>2019</option>
        <option value='2018'>2018</option>
        <option value='2017'>2017</option>
        <option value='2016'>2016</option>
        <option value='2015'>2015</option>
        <option value='2014'>2014</option>
        <option value='2013'>2013</option>
        <option value='2012'>2012</option>
    </select>

    <br><br>
  <button type="Submit" id="Submit" name="Submit">Submit</button>
</form>

<?php ＄results == mysqli_query(＄link, "SELECT * FROM TRIP"); ?>

<div class='table'>
            <?php
            $con = mysqli_connect("db.luddy.indiana.edu", "i494f22_team06", "my+sql=i494f22_team06", "i494f22_team06");
            if (!$con) {
                die("Failed to connect to MySQL: " . mysqli_connect_error());
            } else {
        
            }


if (isset($_POST["Submit"])) {
    $month=$_POST["month"];
    $year=$_POST["year"];
} /*echo "$month";
echo "$year"; */
          
            $sql = "select * from TRIP WHERE month(Date) = $month and year(Date) = $year";
            $result = mysqli_query($con, $sql);
            $num_rows = mysqli_num_rows($result);

            if ($num_rows > 0) {
                echo "<table style='border:1px red; border-collapse: collapse; width:40%; border: solid 2px solid black;'>";
                echo "<tr style='border:1px solid black;'><th>TripID</th><th>DriverID</th><th>PassengerID</th><th>Start Location</th><th>End Location</th><th>Date</th>";
                /* echo $row["month"];
                echo $row["year"]; */
                while ($row = $result->fetch_assoc()) {
                    echo "<tr style='border:1px solid black;'>";
                    echo "<td>" . $row["TripID"] . "</td>";
                    echo "<td>" . $row["DriverID"] . "</td>";
                    echo "<td>" . $row["Start_location"] . "</td>";
                    echo "<td>" . $row["End_location"] . "</td>";
                    echo "<td>" . $row["Distance"] . "</td>";
                    echo "<td>" . $row["Date"] . "</td>";
                    echo "<td>";
                    echo "</div>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "0 results";
            }
?>

