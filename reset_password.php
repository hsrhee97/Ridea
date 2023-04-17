<?php
    $conn = mysqli_connect("db.luddy.indiana.edu","i494f22_team06","my+sql=i494f22_team06","i494f22_team06");
    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $user_type = $_POST['user_type'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        
        if($new_password != $confirm_password) {
            echo ("<script>alert('Password does not match')</script>");
            echo("<script>location.replace('reset_password.php');</script>");
            exit();
        }

        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        if($user_type == 'driver') {
            $sql_e = "SELECT COUNT(*) FROM DRIVER WHERE email='$email'";
            $result = mysqli_query($conn, $sql_e);
            $count = mysqli_fetch_array($result)[0];
            if($count == 0) {
                echo ("<script>alert('The user with the provided email and user type does not exist.')</script>");
                echo("<script>location.replace('reset_password.php');</script>");
                exit();
            }

            $sql = "UPDATE DRIVER SET password='$hashed_password' WHERE email='$email'";
        } 
        
        elseif($user_type == 'passenger') {
            $sql_e = "SELECT COUNT(*) FROM PASSENGER WHERE email='$email'";
            $result = mysqli_query($conn, $sql_e);
            $count = mysqli_fetch_array($result)[0];
            if($count == 0) {
                echo ("<script>alert('The user with the provided email and user type does not exist.')</script>");
                echo("<script>location.replace('reset_password.php');</script>");
                exit();
            }
            $sql = "UPDATE PASSENGER SET password='$hashed_password' WHERE email='$email'";
        } 
        
        else {
            echo ("<script>alert('Invalid user type.')</script>");
            echo("<script>location.replace('reset_password.php');</script>");
            exit();
        }

        mysqli_query($conn, $sql);
        echo ("<script>alert('The password has been reset successfully.')</script>");
        echo("<script>location.replace('home.php');</script>");
        exit();
    }
?>

<form method="post">
    <label>
        <input type="radio" name="user_type" value="driver" required>
        Driver
    </label>
    <label>
        <input type="radio" name="user_type" value="passenger" required>
        Passenger
    </label>
    <br>
    <label>
        Email:
        <input type="email" name="email" required>
    </label>
    <br>
    <label>
        New Password:
        <input type="password" name="new_password" required>
    </label>
    <br>
    <label>
        Confirm Password:
        <input type="password" name="confirm_password" required>
    </label>
    <br>
    <input type="submit" value="Reset Password">
</form>

<?php
    mysqli_close($conn);
?>
