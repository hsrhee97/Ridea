<?php
    session_start();
    $login = $_SESSION['login'];
    if (!isset($login)) {
    header('Location: home.php');
    exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
        <!-- google fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;500;700&family=Roboto:wght@100;400;700&display=swap" rel="stylesheet">
    <!-- icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- another icons -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <style> <?php include 'css/help.css'; ?> </style>
    
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

</head>
<?php include 'includes/nav.php'; ?>
<body>
    <div class="form-container">
    <div class="form-wrapper">
        <h2>Other Problems</h2>
        <p>Please fill this form to report any problem.</p>
        
        <form method="post" action="config_otherproblems.php">

            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control value=">
            </div>    
            
            <div class="form-group">
                <label>Trip Date:</label>
                <input type="date" name="trip_date" value="<?php echo date('YYYY-MM-DD'); ?>" class="form-control">
            </div>

            <div class="form-group">
                <label>Problem:</label>
                <input type="text" name="description" class="form-control">
            </div>
    
            <div class="form-group buttons">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
                <input type="submit" class="btn btn-primary" value="Submit" name = "submit">
            </div>
        </form>
    </div>    
    </div>
</body>
</html>
