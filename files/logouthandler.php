<?php
session_start();

session_unset();
session_destroy();

header("Location:/forum/home.php?logoutsuccess=true");
?>
