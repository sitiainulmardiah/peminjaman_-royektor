<?php
session_start();
session_destroy();
header('Location: login.php'); // Arahkan ke login.php setelah logout
exit();
?>
