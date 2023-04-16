<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Features Explained</title>
</head>
<body>
    <h1> How our features work!</h1>
    <h2>Pricing Algorithm</h2>
    <p> Our pricing is based on a simple formula that we have created which has a set constant base amount of $6
        and includes a variable which is multiplied by $1.5 to come up with the price of our rides. The variable is 
        the distant of the trip which is calculated through the map once the passenger enters their start and end 
        destination. We have used the map and created an algorithm to automate the entire process of price calculation
        so that our users do not have to worry about calculating price or distance between their start and end location.
    </p>
    <h2>Matching Algorithm</h2>
    <p>One of our more complex feature is the matching algorithm that we have created to connect users with each other
        for a journey. The matching algorithm has 3 main criterias that are used to connect passengers. We use the start
        location, end location, and date to connect our passengers with each other. Once you have scheduled a ride you will
        be shown other passengers that you can select from. Ridea tells you how many of your criterias match. If it is a 
        perfect match our algorithm will say that you there is at least one other passenger who fits all three criterias as 
        you. If not it will show you the people that have 2 of the 3 criterias that meet and so on.
    </p>
</body>
