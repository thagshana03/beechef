<?php

session_start();

session_destroy(); //destroy the session

header("Location:login.php"); //to redirect back to "login.php" after logging out

?>