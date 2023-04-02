<?php
    session_start();
    $login = $_SESSION['login'];
    if (!isset($login)) {
    header('Location: home.php');
    exit;
    }
?>
<?php
/* 
PayPal Setting and Database configuration
*/
//Paypal Settings and Configuration
define('PAYPAL_ID','ridea@team06capstone.com');
define('PAYPAL_SANDBOX', TRUE); //TRUE OR FALSE
define('PAYPAL_RETURN_URL','https://cgi.luddy.indiana.edu/~team06/paymentsuccess.php');
define('PAYPAL_CANCEL_URL','https://cgi.luddy.indiana.edu/~team06/paymentcancel.php');
define('PAYPAL_NOTIFY_URL','https://cgi.luddy.indiana.edu/~team06/ipn.php');

define('PAYPAL_CURRENCY','USD');
//Database Configuration
define('DB_SERVER', 'db.luddy.indiana.edu');
define('DB_USERNAME', 'i494f22_team06');
define('DB_PASSWORD', 'my+sql=i494f22_team06');
define('DB_NAME', 'i494f22_team06');
//Change Not Required
define('PAYPAL_URL', (PAYPAL_SANDBOX == true) ? "https://www.sandbox.paypal.com/cgi-bin/webscr" : "https://www.paypal.com/cgi-bin/webscr");
