<?php
session_start();


// remove all session variables
session_unset();

// destroy the session
session_destroy();
//unset($_SESSION["user"]);
header('Location: ' . "index.php", true, $permanent ? 301 : 302);
?>