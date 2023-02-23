<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost and Found</title>

    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;500;700&family=Roboto:wght@100;400;700&display=swap" rel="stylesheet">
    <!-- icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- another icons -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>  <?php include 'css/help.css'; ?>  </style>

</head>
<?php include 'includes/nav.php'; ?>

<body>
    <div class="form-container">
    <div class="form-wrapper">
        <h2>Lost and Found</h2>
        <p>Please fill this form to report any lost items.</p>
        <form method="post" action="config_lost&found.php">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control value=">
            </div>    

            <div class="form-group">
                <label>Trip Date:</label>
                <input type="date" name="trip_date" value="<?php echo date('YYYY-MM-DD'); ?>" class="form-control">
            </div>

            <div class="form-group">
                <label>Lost Items</label>
                <input type="lost_items" name="lost_items" class="form-control">
            </div>

            <div class="form-group">
                <label>Description:</label>
                <input type="description" name="description" class="form-control">
            </div>

            <div class="form-group buttons">
                <input type="reset" class="btn btn-secondary ml-2" value="reset">
                <input type="submit" class="btn btn-primary" value="submit" name = "submit">
            </div>
        </form>
    </div>    
    </div>
</body>
</html>
