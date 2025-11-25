<?php
session_start();
$_SESSION['alogin'] == "";
session_unset();
//session_destroy();
$_SESSION['errmsg'] = "You have successfully logout";
// Use PHP header redirect instead of JavaScript
header("Location: index.php");
exit();
?>