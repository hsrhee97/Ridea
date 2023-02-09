<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;500;700&family=Roboto:wght@100;400;700&display=swap" rel="stylesheet">
    <!-- icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- another icons -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <style> <?php include 'css/register.css'; ?> </style>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

</head>
<body>
<main>

<div class="textcon">
    <h1>Welcome to <span>RIDEA</span></h1>
    <p>What do you want to Register as?</p>
</div>

    <section class="b-container">
        <div class="box" onclick="location.href='driver_regis.php';" style="cursor: pointer;">
            <div class="box-img ig1"></div>
                <h2>I'm a Driver</h2>
            </div>
        <div class="box">
            <div class="box-img ig2" onclick="location.href='pass_regis.php';" style="cursor: pointer;"></div>
                <h2>I'm a Passenger</h2>
            </div>
    </section>
</main>
</body>
</html>