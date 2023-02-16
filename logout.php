<?php
session_start();
session_destroy();
header('Location: home_beforelogin.php');
exit;
?>