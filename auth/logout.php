<?php 

session_start();
session_unset();
session_destroy();
header("location: http://localhost/CMS%20Project%202/index.php")

?>