<?php
session_start();
session_destroy();
header("Location: ../pages_php/login.php");
?>
