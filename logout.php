<?php
session_start(); 
$name=$_SESSION['name'];
session_destroy();
header("Location: index.php?msg=Goodbye, $name!");
?>
