<?php
session_start();
include("../config/config.php");
$_SESSION['login'] == "";
date_default_timezone_set('Asia/Kolkata');
$ldate = date('d-m-Y h:i:s A', time());
mysqli_query($bd, "UPDATE userlog  SET logout = '$ldate' WHERE username = '" . $_SESSION['login'] . "' ORDER BY id DESC LIMIT 1");
session_unset();

// Use PHP header redirect instead of JavaScript
header("Location: ../index.html");
exit();
?>