<?php
session_start();
session_destroy();
//so that cant go back on logging out
header("location:index.php")
?>